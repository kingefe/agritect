from authentication import make_iap_request
from google.cloud import bigquery
import simplejson as json
import math

FUNCTION_URL = 'https://us-east1-agritecture-prototyping.cloudfunctions.net/model-viewer'


def get_points():
    """ Yields the desired latitude, longitude points. """
    print("Collecting data points...")

    bigquery_client = bigquery.Client()
    query = "SELECT DISTINCT latitude, longitude FROM JRC.TMY"
    query_job = bigquery_client.query(query, location='US')
    for row in query_job:
        yield row['latitude'], row['longitude']


def get_rate_defaults(location):
    """ Gets the rate defaults for a given location. """

    json_payload = {
        "model": "location_rates",
        "cmd": "compute",
        "args": {
            "location": location
        }
    }

    return json.loads(make_iap_request(
        url=FUNCTION_URL,
        client_id=FUNCTION_URL,
        method='POST',
        json=json_payload
    ))


def get_options():
    """ Yields potential input options for the model. """

    for structure_type in [1, 2, 3]:
        for supplementary_lighting in [True, False]:
            for heating in [True, False]:
                for co2_injection in [True, False]:
                    yield {
                        'structure type': structure_type,
                        'supplementary lighting': supplementary_lighting,
                        'heating': heating,
                        'co2 injection': co2_injection
                    }


def get_greenhouse_payback_period(latitude, longitude, rates, options):

    json_payload = {
        "model": "gh_deliverables",
        "cmd": "compute",
        "args": {
            "latitude": latitude,
            "longitude": longitude,
            "land status": 1,
            "land cost": 1,
            "owner is headgrower": True,
            "grower experience": 2,
            "site area": 15000,
            "crops": [{ "id": 9, "system fraction": 1, "sale unit id": 2, "price per unit": 1.5 }],
            "packaging type": 2,
            "structure type": options['structure type'],
            "grow system type": 1,
            "organic production": False,
            "supplementary lighting": options['supplementary lighting'],
            "heating": options['heating'],
            "co2 injection": options['co2 injection'],
            "electricity cost": rates['electricity cost'],
            "water cost": rates['water cost'],
            "gas cost": rates['gas cost'],
            "labor wages": rates['wage'],
            "rent cost": rates['rent'],
            "tax rate": rates['tax'],
            "financing option": 1,
            "interest rate": 0.08,
            "repayment time": 7
        }
    }

    print(json_payload)
    results = json.loads(make_iap_request(
        url=FUNCTION_URL,
        client_id=FUNCTION_URL,
        method='POST',
        json=json_payload
    ))

    return results['payback period']


def optimize_latitude_longitude(latitude, longitude):
    rates = get_rate_defaults(str(latitude) + ", " + str(longitude))
    best_payback = None
    best_options = None
    for options in get_options():
        payback_period = get_greenhouse_payback_period(latitude, longitude, rates, options)
        if payback_period is not None and not math.isnan(payback_period) and (best_payback is None or best_payback > payback_period):
            best_payback = payback_period
            best_options = options

    if best_options is None:
        return None

    return {
        'latitude': latitude,
        'longitude': longitude,
        'structure type': options['structure type'],
        'supplementary lighting': options['supplementary lighting'],
        'heating': options['heating'],
        'co2 injection': options['co2 injection']
    }


def main():
    x = optimize_latitude_longitude(40, -73)
    print(x)


if __name__ == '__main__':
    main()
