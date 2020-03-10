import os
import simplejson as json
import time

import google.auth
import google.auth.app_engine
import google.auth.compute_engine.credentials
import google.auth.iam
from google.auth.transport.requests import Request
import google.oauth2.credentials
import google.oauth2.service_account
import requests


IAM_SCOPE = 'https://www.googleapis.com/auth/iam'
OAUTH_TOKEN_URI = 'https://www.googleapis.com/oauth2/v4/token'


timestamp_memoized_cache = {}


def get_key(key, timeout):
    if key not in timestamp_memoized_cache:
        return None
    value, timestamp = timestamp_memoized_cache[key]
    if timestamp + timeout > time.time():
        return None
    return value


def set_key(key, value):
    timestamp_memoized_cache[key] = (value, time.time())


def make_iap_request(url, client_id, method='GET', **kwargs):
    """Makes a request to an application protected by Identity-Aware Proxy.

    Args:
      url: The Identity-Aware Proxy-protected URL to fetch.
      client_id: The client ID used by Identity-Aware Proxy.
      method: The request method to use
              ('GET', 'OPTIONS', 'HEAD', 'POST', 'PUT', 'PATCH', 'DELETE')
      **kwargs: Any of the parameters defined for the request function:
                https://github.com/requests/requests/blob/master/requests/api.py
                If no timeout is provided, it is set to 90 by default.

    Returns:
      The page body, or raises an exception if the page couldn't be retrieved.
    """
    # Set the default timeout, if missing
    if 'timeout' not in kwargs:
        kwargs['timeout'] = 90

    timestamp_timeout = kwargs['timeout'] - 10
    tuple = get_key('credentials', timestamp_timeout)
    if tuple is None:
        service_account_credentials, signer_email = get_credentials(client_id)

        # service_account_credentials gives us a JWT signed by the service
        # account. Next, we use that to obtain an OpenID Connect token,
        # which is a JWT signed by Google.
        google_open_id_connect_token = get_google_open_id_connect_token(
            service_account_credentials)
        tuple = (service_account_credentials, signer_email, google_open_id_connect_token)
        set_key('credentials', tuple)

    else:
        service_account_credentials, signer_email, google_open_id_connect_token = tuple

    # Fetch the Identity-Aware Proxy-protected URL, including an
    # Authorization header containing "Bearer " followed by a
    # Google-issued OpenID Connect token for the service account.
    resp = requests.request(
        method, url,
        headers={'Authorization': 'Bearer {}'.format(
            google_open_id_connect_token)}, **kwargs)
    if resp.status_code == 403:
        raise Exception('Service account {} does not have permission to '
                        'access the IAP-protected application.'.format(
            signer_email))
    elif resp.status_code != 200:
        raise Exception(
            'Bad response from application: {!r} / {!r} / {!r}'.format(
                resp.status_code, resp.headers, resp.text))
    else:
        return resp.text


def get_credentials(client_id):
    bootstrap_credentials = google.oauth2.service_account.Credentials.from_service_account_file('credentials.json')
    signer_email = bootstrap_credentials.service_account_email

    if isinstance(bootstrap_credentials,
                  google.auth.compute_engine.credentials.Credentials):
        # Since the Compute Engine metadata service doesn't expose the service
        # account key, we use the IAM signBlob API to sign instead.
        # In order for this to work:
        #
        # 1. Your VM needs the https://www.googleapis.com/auth/iam scope.
        #    You can specify this specific scope when creating a VM
        #    through the API or gcloud. When using Cloud Console,
        #    you'll need to specify the "full access to all Cloud APIs"
        #    scope. A VM's scopes can only be specified at creation time.
        #
        # 2. The VM's default service account needs the "Service Account Actor"
        #    role. This can be found under the "Project" category in Cloud
        #    Console, or roles/iam.serviceAccountActor in gcloud.
        signer = google.auth.iam.Signer(
            Request(), bootstrap_credentials, signer_email)
    else:
        # A Signer object can sign a JWT using the service account's key.
        signer = bootstrap_credentials.signer

    # Construct OAuth 2.0 service account credentials using the signer
    # and email acquired from the bootstrap credentials.
    service_account_credentials = google.oauth2.service_account.Credentials(
        signer, signer_email, token_uri=OAUTH_TOKEN_URI, additional_claims={
            'target_audience': client_id
        })

    return service_account_credentials, signer_email


def get_google_open_id_connect_token(service_account_credentials):
    """Get an OpenID Connect token issued by Google for the service account.

    This function:

      1. Generates a JWT signed with the service account's private key
         containing a special "target_audience" claim.

      2. Sends it to the OAUTH_TOKEN_URI endpoint. Because the JWT in #1
         has a target_audience claim, that endpoint will respond with
         an OpenID Connect token for the service account -- in other words,
         a JWT signed by *Google*. The aud claim in this JWT will be
         set to the value from the target_audience claim in #1.

    For more information, see
    https://developers.google.com/identity/protocols/OAuth2ServiceAccount .
    The HTTP/REST example on that page describes the JWT structure and
    demonstrates how to call the token endpoint. (The example on that page
    shows how to get an OAuth2 access token; this code is using a
    modified version of it to get an OpenID Connect token.)
    """

    service_account_jwt = (
        service_account_credentials._make_authorization_grant_assertion())
    request = google.auth.transport.requests.Request()
    body = {
        'assertion': service_account_jwt,
        'grant_type': google.oauth2._client._JWT_GRANT_TYPE,
    }
    token_response = google.oauth2._client._token_endpoint_request(
        request, OAUTH_TOKEN_URI, body)
    return token_response['id_token']
