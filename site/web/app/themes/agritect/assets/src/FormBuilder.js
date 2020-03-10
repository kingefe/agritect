import React from 'react'
import api from './api'
import { turnStringWithCommasToNumber } from './utils'
import { BaseInput, BooleanInput, withFormValue } from './Form'
import { Link, withRouter} from 'react-router-dom'

import Crops from './Crops'
import OperatingCostsInput from './OperatingCostsInput'
import FinancingInput  from './FinancingInput'
import Errors  from './Errors'
import { BuildingInput } from './BuildingInput'
import  AreaInput  from './AreaInput'
import ProjectLocation from './ProjectLocation'
import InfoIcon from './InfoIcon'
import OperationTypeInput from './OperationTypeInput'
import OwnerInformationInput from './OwnerInformationInput'

import { growSystemInfo, organicProductionInfo } from './info'


const db = window.firebase.firestore()

const BOOLEAN_OPTIONS = [
    { id: true,  description: 'Yes' },
    { id: false, description: 'No' },
]

const GROW_SYSTEM_TYPE = [
    {id: 1, description: "NFT"},
    {id: 2, description: "Ebb/Flow"},
    {id: 3, description: "Deep Water Culture"},
    {id: 4, description: "Bucket"},
    {id: 5, description: "Slab"},
    {id: 6, description: "Soil"},
    {id: 7, description: "Aeroponic"}
]

class FormBuilder extends React.Component {
    state = {
        fields: {},
        isComputing: false,
    }

    async componentDidMount () {
        const { model } = this.props
        const fields = await api({ model, mode: 'deliverables', command: 'inputs' })
        this.setState({ fields })
    }

    async componentDidUpdate(prevProps) {
        const { model } = this.props

        if (prevProps.model !== model ){
            const fields = await api({ model, mode: 'deliverables', command: 'inputs' })
            this.setState({ fields })
        }
    }

    get doc () {
        const { wpid, match } = this.props

        if (wpid === '0' || !wpid)
            return

        const collection = db.collection(`users/${wpid}/projects`)

        return collection.doc(match.params.projectId)
    }

    compute = () => {
        console.log("compute triggered, this.state.isComputing is: ", this.state.isComputing)
        if (this.state.isComputing == false) 
            this.setState({ isComputing: true }, async () => {
                const { fields } = this.state
                const { wpid, form, model, missingFields, cropFractionWithinRange, numberOfLevelsWithinRange } = this.props
                const fieldNames = Object.keys(form)
    
                if (cropFractionWithinRange(form) && !missingFields(form) && numberOfLevelsWithinRange(form) ){
                    console.log("HERE")
                    console.log("HERE")
                    console.log("HERE")
                    console.log("HERE")
                    console.log("HERE")
                    let args = fieldNames
                    .map(fieldName => {
                        const field = fields[fieldName]
                        if(fieldName == "site area" || fieldName == "land cost" || fieldName == "rent cost"){
                            return {
                                [fieldName]: form[fieldName]
                            }
                        }else if(fieldName == "owner is headgrower"){
                            return {
                                [fieldName]: form[fieldName] == "true" ? true : false
                            }
                        }else if(typeof form[fieldName] === "boolean"){
                            return{
                                [fieldName]: Boolean(form[fieldName])
                            }
                        }else if(isNaN(form[fieldName])){
                            return {
                                [fieldName]: Boolean(form[fieldName])
                            }
                        }else{
                            return{
                                [fieldName]: parseFloat(form[fieldName])
                            }
                        }
                    })
                    .reduce((a,b) => Object.assign(a,b), {})        
                
                    console.log("args after iterating: ", args)
                    args.crops = [
                        {
                            id:                 parseFloat(form.cropId1),
                            'system fraction':  parseFloat(form.cropPercentage1)/100,
                            'grow system type': form.growSystemType1
                        },
                        {
                            id:                parseFloat(form.cropId2),
                            'system fraction': parseFloat(form.cropPercentage2)/100,
                            'grow system type': form.growSystemType2
                        },
                        {
                            id:                parseFloat(form.cropId3),
                            'system fraction': parseFloat(form.cropPercentage3)/100,
                            'grow system type': form.growSystemType3
                        },
                    ]
    
                    args.crops = args.crops.filter(crop => {
                        return !isNaN(crop.id)
                    })
                    
                    console.log("args.crops are: ", args.crops)
                    let cropPrices = await Promise.all(args.crops.map(crop =>
                        {
                            return(
                                api({
                                    command: 'compute',
                                    model: 'price_market_research',
                                    mode: null,
                                    args: {
                                        'crop id':      crop.id,
                                    },
                                })
                            )
                        }
                    ))
    
                    console.log('cropPrices in compute are: ', cropPrices)
    
                    cropPrices = cropPrices.filter(cropPrice => {
                        return cropPrice != null
                    })
    
                    cropPrices.forEach((result, i) => {
                        args.crops[i]['price per unit'] = result.price
                        args.crops[i]['sale unit id'] = 6
                    })
    
                    args["site area"] = turnStringWithCommasToNumber(args["site area"])
                    let siteArea = args["site area"]
                    let landCost = ""
                    let rentCost = ""
    
                    if (args["land status"] === 1){
                        args["land cost"] = 0
                        args["rent cost"] = 0
                    }else if(args["land status"] === 2){
                        landCost = turnStringWithCommasToNumber(args["land cost"])
                        delete args["rent cost"]
                        args["land cost"] = landCost / siteArea
                    }else if(args["land status"] === 3){
                        rentCost = turnStringWithCommasToNumber(args["rent cost"])
                        args["land cost"] = 0
                        args["rent cost"] = (turnStringWithCommasToNumber(rentCost)/12)/siteArea
                    }
    
                    const googleMapsKey = "AIzaSyD7o0-_t2n5yRc-Yt60mfX1HngTplo1jwY"
                    let url = `https://maps.googleapis.com/maps/api/geocode/json?address=${form.zipcode},${form.city.replace(" ", "+")},${form.country.replace(" ","+")}&key=${googleMapsKey}`
                    const response = await fetch(url)
                    const json = await response.json()
    
                    const geopoints = json.results[0].geometry.location
    
                    let lat = geopoints.lat
                    let lng = geopoints.lng
    
                    args["latitude"] = lat
                    args["longitude"] = lng
                    args["tax rate"] = args["tax rate"]/100
                    args["area fraction dedicated to production"] = args["area fraction dedicated to production"]/100
    
                    if (!args['interest rate'])
                        delete args['interest rate']
                    else
                        args['interest rate'] = args['interest rate']/100
                    
                    if (!args['repayment time'])
                        delete args['repayment time']
    
                    if (isNaN(args['area fraction dedicated to production'])){
                        console.log("isNaN(args['area fraction dedicated to production'] is :", isNaN(args['area fraction dedicated to production']))
                        args['area fraction dedicated to production'] = 0.7
                    }
    
                        
                    console.log("args sent to backend on first compute are: ", args)
                    let financialReport = await api({
                        model,
                        mode: 'deliverables',
                        command: 'compute',
                        args: args,
                    })
    
                    if(financialReport){
                        this.doc.update({ status: "complete" })
                        this.doc.set({ 
                            financialReport: financialReport, 
                            'default crop info': args.crops, 
                            'default crop prices': true, 
                            'user inputed land cost': landCost ? landCost : '', 
                            'user inputed rent cost': rentCost ? rentCost : '' }, 
                            { merge: true }).then(() => {
                                this.setState({ isComputing: false })
                                this.props.history.push(`${this.props.projectId}/financial-report/overview`)
                        })
                    }
                }else{
                    this.setState({ isComputing: false })
                }
            })
    }

    // add load animation to button
    // if button is animated, cannot be clicked

    render () {
        const { fields, isComputing } = this.state
        const { model } = this.props
        return (
            <>
                <FormFields fields={fields} model={model} onSubmit={this.compute} isComputing={isComputing}/>
            </>
        )
    }
}

const FormFields = ({ model, onSubmit, isComputing }) => {


    return (
        <>
            <div className="py-4">
              <Link className="btn btn-transparent" to="/projects/all"><small>Back to All Projects</small></Link>
            </div>
            <br />
            <div id="project-name">
              <div class="form-group">
                <label for="">Project Name</label>
                    <BaseInput name="name" placeholder="Name your project here"/>
              </div>
            </div>
            <ProjectLocation model={model}/>
            <OperationTypeInput />
            <hr/>
            <AreaInput model={model}/>
            <hr/>
            <div id="crops">

                <Crops model={model} />

                <div className="form-group">
                    <div className="mb-2">
                        <h4>
                            {`Organic Production: `}
                            <InfoIcon position="right" content={organicProductionInfo} target="organic-production"/>
                        </h4>
                    </div>
                    <BooleanInput model={model} key="organic production" name="organic production" options={BOOLEAN_OPTIONS}/>   
                </div>
            </div>
            <hr/>
            <BuildingInput model ={model} />
            <hr/>
            <OwnerInformationInput model={model} />
            <hr/>
            <FinancingInput model={model}/>
            <hr/>
            <OperatingCostsInput model ={model} />

            <Errors />

            <div class="text-center" onClick={onSubmit}>
                <a class="btn btn-outline text-dark btn-wide">
                    {
                        isComputing ?
                        <div class="spinner-border" role="status">
                            <span class="sr-only">Loading...</span>
                        </div> :
                        `See Results`
                    }
                </a>
            </div>
        </>
    )
}


export default withRouter(withFormValue(FormBuilder))
