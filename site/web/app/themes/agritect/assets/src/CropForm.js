import React from 'react'
import  FormInput  from './FormInput'
import Form, { BaseInput, withFormValue, SelectInput } from './Form'
import { Switch, Route, Link, useRouteMatch, withRouter, Redirect, useLocation } from 'react-router-dom'

import api from './api'
import { turnStringWithCommasToNumber } from './utils'
import debounce from 'debounce'

const db = window.firebase.firestore()

const CROP_QUALITY_OPTIONS = [
    {id: 1, description: 1},
    {id: 2, description: 2},
    {id: 3, description: 3},
    {id: 4, description: 4},
    {id: 5, description: 5}
]

const CROP_SALE_UNIT_OPTIONS = {
    '1': "1 oz",
    '2': "2 oz",
    '3': "4 oz",
    '4': "150 g",
    '5': "8 oz",
    '6': "1 lb",
    '7': "bunch/head"
  }

const CropPricingLine = ({ index, model, onChange, value }) =>

// priceline["price per unit"] = priceline["price"]
// priceline["sale unit id"]   = priceline["unit sale id"]
// priceline["quality score"]  = priceline["rating"]

    <>
        <Form onChange={onChange} data={value}>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group form-group--light">
                        <label for="">Price {index + 1}</label>
                        <div class="form-unit form-unit--left">
                            <BaseInput name="price" type="decimal" />
                            <div class="form-unit__type">$</div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group form-group--light">
                            <FormInput
                                className="form-control"
                                model={model}
                                name="crops.sale unit id"
                                formName="unit sale id"
                                label={`Unit ${index + 1}`}
                                field={{
                                    type:        'choice',
                                    description: 'The amount of one unit of produce',
                                }}
                            />
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group form-group--light">
                        <label for="">Quality Score</label>
                        <SelectInput name="rating" options={CROP_QUALITY_OPTIONS} />
                    </div>
                </div>
            </div>
        </Form>
    </>


const CropPricing = ({ model, onChange, value, cropId }) => {

    return <>
        {value.map((row, i) =>{
            return(
                <CropPricingLine
                index={i}
                key={i}
                model={model}
                value={row}
                onChange={pricingLineData =>
                    onChange(cropId, i, pricingLineData)
                }
            /> 
            )
        }
       
        )}
    </>
}

const CropNavBar = withRouter(({ projectId, crops, cropData }) =>{

    let path = useLocation().pathname.split("/")[useLocation().pathname.split("/").length -1]

    return(
        <ul className="nav nav-pills" role="tablist">
            {Object.keys(cropData).map((cropId, index) =>{
                return(
                    <li className="nav-item" key={cropId}>
                        <Link
                            to={`/projects/${projectId}/financial-report/pricing/${cropId}`}
                            className={`nav-link text-dark ${path == cropId ? "active" : null}`}
                            id="home-tab" 
                            aria-controls={`crop-${index+1}`} 
                            aria-selected="true"
                        >{`crop${index+1}`}
                        </Link>
                    </li>
                )
            }
            )}
        </ul>
    )
})


const CropPricings = ({ cropData, model, onChange }) => {
    const match = useRouteMatch()
    const { cropId } = match.params

    return <>
        <div class="tab-content form-pricing" id="myTabContent">
            <div class="tab-pane fade show active" id="crop-1" role="tabpanel" aria-labelledby="crop-1-tab">
                {Object.keys(cropData).map(key =>{
                    return(
                        <div style={{ display: key === cropId ? 'block' : 'none' }} key={key}>
                        <h4>{cropData[key].name}</h4>
                        <CropPricing
                            model={model}
                            onChange={onChange}
                            value={cropData[key]["pricelines"] || cropData[key]}
                            cropId={key}
                        />
                    </div>
                    )
                }
                )}
            </div>
        </div>
    </>
}

class CropForm extends React.Component {
    state = {
        crops:    [],
        cropData: {},
    }

    setCropPricing = (cropId, index, pricingLineData) => {
        console.log("inside setCropPricing")
        console.log("cropId is: ", cropId)
        console.log("index is: ", index)
        console.log("pricingLineData is: ", pricingLineData)

        console.log("this.props.project is: ", this.props.project)

        const cropData  = this.props.project.cropData

        console.log("cropData is: ", cropData)

        cropData[cropId] = cropData[cropId] || []

        cropData[cropId]["pricelines"][index] = pricingLineData

        this.setCropDataOnDoc(cropData)
        this.setState({ cropData })
    }

    setCropDataOnDoc = debounce(cropData => {
        this.doc.set({ cropData }, { merge: true })
    }, 5000)

    get doc () {
        const { wpid, projectId } = this.props
        const collection = db.collection(`users/${wpid}/projects`)
        return collection.doc(projectId)
    }


    compute = async () => {
        const { project, cropData, projectId } = this.props
        let cropDataKeys = Object.keys(cropData)

        cropDataKeys.forEach(key => {
            cropData[key].pricelines.forEach(priceline =>{
                priceline["price per unit"] = priceline["price"]
                priceline["sale unit id"]   = priceline["unit sale id"]
                priceline["quality score"]  = priceline["rating"]
            })
        })

        const aggregatePrices = await Promise.all(cropDataKeys.map(cropId =>
            {
                let data = cropData[cropId].pricelines
                return(
                    api({
                        command: 'compute',
                        model: 'price_market_research',
                        mode: null,
                        args: {
                            'crop id': cropId,
                            'result sale unit id': 6,
                            data: data
                        }
                    })
                )
            }
        ))

        let crops = []
        cropDataKeys.forEach( (cropId, i) => {
            crops.push(
                {
                    'id'               : cropDataKeys[i],
                    'system fraction'  : parseFloat(project[`cropPercentage${i+1}`])/100,
                    'grow system type' : project[`growSystemType${i+1}`],
                    'sale unit id'     : aggregatePrices[i]['result sale unit id'],
                    "price per unit"   : aggregatePrices[i]['price']               
                }
            )
        })

        project['crops'] = crops

        const googleMapsKey = "AIzaSyD7o0-_t2n5yRc-Yt60mfX1HngTplo1jwY"
        let url = `https://maps.googleapis.com/maps/api/geocode/json?address=${project.zipcode},${project.city.replace(" ", "+")},${project.country.replace(" ","+")}&key=${googleMapsKey}`
        const response = await fetch(url)
        const json = await response.json()

        const geopoints = json.results[0].geometry.location

        let lat = geopoints.lat
        let lng = geopoints.lng

        project["latitude"] = lat
        project["longitude"] = lng
        project['tax rate'] = project['tax rate'] / 100

        console.log("before site area")
        project["site area"] = turnStringWithCommasToNumber(project["site area"])
        if (project['land status'] == '1' || project['land status'] == '3')
            project['land cost'] = 0


        if (project['area fraction dedicated to production'])
            project['area fraction dedicated to production'] = parseFloat(project['area fraction dedicated to production']) > 1 ? parseFloat(project['area fraction dedicated to production'])/100 : parseFloat(project['area fraction dedicated to production'])

        console.log("before rent cost")
        if (project['rent cost']){
            console.log("project['rent cost'] exists")
            project['land cost'] = 0
            console.log("before seting rent cost, project['user inputed rent cost is'] :", project["user inputed rent cost"])
            project["rent cost"] = turnStringWithCommasToNumber(project["user inputed rent cost"]) / (project["site area"]*12)
        }
        else{
            project['rent cost'] = 0
        }
        console.log("before land cost")
        if (project["land cost"])
            console.log("project['land cost'] exists")
            project["land cost"] = turnStringWithCommasToNumber(project["land cost"])
            project["land cost"] = project["user inputed land cost"] / (project["site area"]*12)

        delete project['financialReport']

        console.log("args being sent to backend on second compute are: ", project)

        let financialReport = await api({
            model   : project.operationType,
            mode    : 'deliverables',
            command : 'compute',
            args    : project,
        })

        crops.forEach(crop => {
            let cropId = crop['id']

            cropData[cropId]['sale unit'] = CROP_SALE_UNIT_OPTIONS[crop['sale unit id']]
            cropData[cropId]['price per unit'] = crop['price per unit']
        })

        console.log("Computed FR rom report page is: ", financialReport)
        console.log("cropData about to be set on doc: ", cropData)
        console.log("crops about to be set on docs: ", crops)
        this.doc.set({ financialReport: financialReport }, { merge: true }).then(() => {
            this.doc.update({cropData: cropData, 'default crop prices': false})
        }).then(() => {
            this.props.updateReport(financialReport, cropData)
        }).then(() => {
            this.props.history.push(`/projects/${projectId}/financial-report`)
        })
        
    }


    render () {
        const { project, projectId, cropData, crops } = this.props

        console.log("CropForm rendered, project from props is: ", project)
        return <>
            <div>
                <div>
                    <h3 className="text-uppercase"><div className="text-highlight"><span>Crop&nbsp;</span></div><div class="text-highlight"><span>Pricing&nbsp;</span></div></h3>
                    <p className="lead">Use this panel to calculate the pricing of your crop(s) through verified market research.</p>
                    <p>Instructions: Find a similar product being sold at the same type of outlet you intend to sell through. For example, if you intend to sell Genovese Basil to local restaurants, research what similar restaurants are paying for their Basil. Under each crop type, enter up to 3 rows of information for that crop's Price, Sales Unit, and Quality Score. From their, we'll calculate a fair price for each crop. Don't worry, you can always override this calculation.</p>
                    <CropNavBar project={project} projectId={projectId} crops={crops} cropData={cropData}/>
                </div>
            </div>


            <Switch>
                <Route path="/projects/:projectId/financial-report/pricing/:cropId">
                    <CropPricings
                        cropData={cropData}
                        model={project.operationType}
                        onChange={this.setCropPricing}
                        crops={crops}
                    />
                </Route>
            </Switch>

            <div className="clearfix float-right">
                <Link
                    to={`/projects/${projectId}/financial-report/defaults`}
                    className="btn btn-grey mr-3" 
                >See final prices
                </Link>

                <div className="btn btn-primary" onClick={this.compute}>See Results</div>
            </div>
        </>
    }

    async componentDidMount () {
        const { cropData } = this.props.project
        this.props.history.push(`/projects/${this.props.projectId}/financial-report/pricing/${Object.keys(cropData)[0]}`)
    }
}

export default withRouter(
    withFormValue(
        CropForm
        )
        )