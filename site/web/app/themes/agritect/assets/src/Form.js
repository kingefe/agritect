import React from 'react'
import api from './api'
import { addCommasToNumber } from './utils'


let distanceFirstLevelFromFloor = 2 
let distanceLastLevelFromRoof = 2.5 
let heightBetweenLevels = 2

const commonRequiredFields = [
    'name',
    'city',
    'state-province',
    'country',
    'operationType',
    'land status',
    'site area',
    'organic production',
    'owner is headgrower',
    'grower experience',
    'financing option',
    'water cost',
    'labor wages',
    'electricity cost',
    'tax rate'
]

const greenHouseRequiredFields = [
    // 'area fraction dedicated to production',
    'structure type',
    'heating',
    'supplementary lighting',
    'co2 injection'
]
const verticalFarmRequiredFields = [
    'building insulation',
    'building roof type',
    'number of levels'
]
const landStatusIsBuyRequiredFields = ['land cost']
const landStatusIsRentRequiredFields = ['rent cost']
const financingOptionIsDebtRequiredFields = ['interest rate', 'repayment time']

const heatingIsTrueRequiredFields = ['gas cost',
    'gas cost unit id'
]

const FormContext = React.createContext({
    form:     {},
    setValue: () => {},
    getLocation: () => {}
})

const fieldIsWaterOrElectricityCost = (fieldName) => {
    return ["electricity cost", "water cost"].includes(fieldName)
}
export const BaseInput = ({ name, placeholder, type, min, max, step, defaultValue, className }) =>
    <FormContext.Consumer>
        {({ form, setValue }) =>
            <input
                className={className ? className : `form-control ${name == "name" ? "form-control--transparent": null} form-control--large`}
                placeholder={placeholder}
                type={type}
                onChange={e => {
                    fieldIsWaterOrElectricityCost(name) ?
                    setValue(name, e.target.value)
                    :
                    setValue(name, addCommasToNumber(e.target.value))
                }}
                value={form[name] || "" }
                min={min}
                max={max}
                step={step}
                />
        }
    </FormContext.Consumer>

// export const CropRating = ({ name, validation = () => {} }) => {
//     return (
//         <FormContext.Consumer>
//             {({ form, setValue, setValidation }) => {
//                 return(
//                     <div className="form-check">
//                         {
//                             [1, 2, 3, 4, 5].map(el => {
//                                 return (
//                                     <input
//                                         type ="radio"
//                                         key={el}
//                                         className=""
//                                         checked={el <= form[name]}
//                                         onClick={e => setValue(name, el)}
//                                     />
//                                 )
//                             })
//                         }
//                     </div>
//                 )}}
//         </FormContext.Consumer>
//     )
// }

const getLocation = async (whatever, value, setValue, model) => {

    if (value){
        const googleMapsKey = "AIzaSyD7o0-_t2n5yRc-Yt60mfX1HngTplo1jwY"

        let url = `https://maps.googleapis.com/maps/api/geocode/json?address=${value}'&key=${googleMapsKey}`
    
        const response = await fetch(url)
        const json = await response.json()
        const adminLevels = json.results[0].address_components
    
        let city, stateProvince, country = null
    
        adminLevels.forEach((level) => {
            level.types.forEach((type) => {
                if (type == "sublocality"){
                    city = level["long_name"]
                    setValue("city", city)
                }else if (type == "locality"){
                    city = level["long_name"]
                    setValue("city", city)
                }
                if (type == "administrative_area_level_1"){
                    stateProvince = level["long_name"]
                    setValue("state-province", stateProvince)
                }
                if (type == "country"){
                    country = level["long_name"]
                    setValue("country", country)
                }
            })
    
        })
    
        let defaultValues = await api({
            model,
            mode: 'defaults',
            command: 'compute',
            args: { location: `${city}, ${stateProvince}` },
        })
    

        let defaultFormValues = ["heating", "supplementary lighting", "co2 injection", 
        "electricity cost", "labor wages", "water cost",
        "tax rate", "gas cost"]
    
        defaultFormValues.forEach(input => {
            if (input == "tax rate"){
                setValue(input, (defaultValues[input]*100).toFixed(2))
            }else if (input == "heating" || input == "supplementary lighting" || input == "co2 injection"){
                setValue(input, defaultValues[input])
            }
            else
                setValue(input, defaultValues[input])
        })
    }

}

export const LocationInput = ({ name, model }) =>
    <FormContext.Consumer>
        {({ form, setValue }) =>{
            return(
                <input
                    className="form-control"
                    type="text"
                    onChange={e => setValue(name, e.target.value)}
                    onBlur={e => getLocation(name, e.target.value, setValue, model)}
                    value={form[name] || ""}
                />
            )
        }}
    </FormContext.Consumer>


export const SelectInput = ({ name, options, includeBlank = true }) => {

    return (
        <FormContext.Consumer>
            {({ form, setValue }) => {
                return(
                    <select
                    className="form-control"
                    onChange={e => setValue(name, e.target.value)} value={form[name] || ""}
                    >
                    {includeBlank && <option value=""></option>}
                    {options.map(option =>
                        <option key={option.id} value={option.id}>{option.description || option.crop_type}</option>
                    )}
                </select>
                )
            }}
        </FormContext.Consumer>
    )
}

export const RadioInput = ({ name, options, className }) => {
    return (
        <FormContext.Consumer>
            {({ form, setValue }) =>{
                return(
                    <>
                        {options.map((option, index) =>
                            <div className="form-check form-check-inline form-check--button">
                                <input
                                    type ="radio"
                                    name={name || ""}
                                    key={option.id}
                                    id={`${name.replace(" ", "_")}${index+1}`}
                                    className="form-check-input"
                                    checked={form[name] == option.id}
                                    value={option.id}
                                    onChange={e => setValue(name, e.target.value)}
                                />
                                <label
                                    className="form-check-label"
                                    htmlFor={`${name.replace(" ", "_")}${index+1}`}>
                                        {option.description}
                                </label>
                            </div>
                        )}
                    </>
                )
            }
            }
        </FormContext.Consumer>
    )
}

export const BooleanInput = ({ name }) => {
    return (
        <FormContext.Consumer>
            {({ form, setValue }) =>{
                return(
                    <label className="switch">
                        <input
                            type="checkbox"
                            name={name}
                            id={`${name}-checkbox`}
                            key={name}
                            default="false"
                            checked={form[name] || false}
                            onChange = {e => setValue(name, e.target.checked)}
                        />
                        <span className="slider"></span>
                    </label>
                )
            }
            }
        </FormContext.Consumer>
    )
}


export const withFormValue = Component => props =>
    <FormContext.Consumer>
        {({ form, formErrors, missingFields, cropFractionWithinRange, numberOfLevelsWithinRange }) =>
            <Component {...props} form={form} formErrors={formErrors} missingFields={missingFields} cropFractionWithinRange={cropFractionWithinRange} numberOfLevelsWithinRange={numberOfLevelsWithinRange}/>
        }
    </FormContext.Consumer>


export default class Form extends React.Component {
    setValue = (field, value) => {
        const { onChange } = this.props

        const form = {
            ...this.state.form,
            [field]: value,
        }

        this.setState({ form }, () => this.errorHandler(field, form))

        if (onChange)
            onChange(form)
    }


    errorHandler = (field, form) => {
        if (field == 'cropPercentage1' || field == 'cropPercentage2' || field == 'cropPercentage3'){
            this.resetSectionErrors("Crops")
            let percentages = [parseInt(form["cropPercentage1"]), parseInt(form["cropPercentage2"]), parseInt(form["cropPercentage3"])]
            let cropFractionTotal = 0

            percentages.forEach((value) => {
                if (Number(value)) 
                cropFractionTotal = cropFractionTotal + value
            })


            if (cropFractionTotal > 100){
                this.addError("Crops", ["Bedspace cannot exceed 100%"])
            }
            if (cropFractionTotal < 80){
                this.addError("Crops", ["It is not recommended to use less than 80% of grow space."])
            }
        }else if (field == 'number of levels'){
            let height = parseInt(form['height'])
            let maxNumberOfLevels = Math.floor((height - distanceFirstLevelFromFloor - distanceLastLevelFromRoof) / heightBetweenLevels)
    
            if(form['number of levels'] <= maxNumberOfLevels){
                this.resetSectionErrors('Number of Levels')
                return true
            }
            else 
                this.addError("Number of Levels", [`Number of Levels cannot exceed ${maxNumberOfLevels} considering the height of your building`])
                return false    
        }
    }

    cropFractionWithinRange = (form) => {
        let cropFractionTotal = 0

        let percentages = [parseInt(form["cropPercentage1"]), parseInt(form["cropPercentage2"]), parseInt(form["cropPercentage3"])]

        percentages.forEach((value) => {
            if (Number(value)) 
            cropFractionTotal = cropFractionTotal + value
        })

        if(cropFractionTotal >= 80 && cropFractionTotal <= 100){
            return true
        }
        else{
            this.addError("Crops", ["Bedscape Total use must be within 80 - 100"])
        }
    }



    numberOfLevelsWithinRange = (form) => {

        if(form['operationType'] == 'gh')
            return true

        let height = parseInt(form['height'])
        let distanceFirstLevelFromFloor = 2 
        let distanceLastLevelFromRoof = 2.5 
        let heightBetweenLevels = 2
        let maxNumberOfLevels = Math.floor((height - distanceFirstLevelFromFloor - distanceLastLevelFromRoof) / heightBetweenLevels)

        if(form['number of levels'] <= maxNumberOfLevels){
            this.resetSectionErrors("Number of Levels")
            return true
        }
        else{
            this.addError("Number of Levels", [`Number of Levels cannot exceed ${maxNumberOfLevels} considering the height of your building`])
            return false
        }

    }

    missingFields = (form) => {

        let requiredFields = commonRequiredFields
        let missingFields = []

        if(form['operationType'] == 'gh'){
            requiredFields = requiredFields.concat(greenHouseRequiredFields)
        }
        else if (form['operationType'] == 'vf')
            requiredFields = requiredFields.concat(verticalFarmRequiredFields)
        if (form['land status'] == "2")
            requiredFields = requiredFields.concat(landStatusIsBuyRequiredFields)
        else if (form['land status'] == "3")
            requiredFields = requiredFields.concat(landStatusIsRentRequiredFields)
        if (form['financing option'] == "1")
            requiredFields = requiredFields.concat(financingOptionIsDebtRequiredFields)
        if(form['heating'])
            requiredFields = requiredFields.concat(heatingIsTrueRequiredFields)
        

        let booleanInputs = ['heating', 'organic production', 'supplementary lighting', 'co2 injection']
        booleanInputs.forEach((input) => {
            if(!form.hasOwnProperty(input)){
                form[input] = false
            }
        })

        requiredFields.forEach((fieldName) => {
            if( !form[fieldName] && typeof form[fieldName] != "boolean")
                missingFields.push(fieldName)
        })


        if (missingFields.length > 0){
            this.addError("Missing Fields", missingFields)

        }
        else
            this.resetSectionErrors('Missing Fields')
        return missingFields.length == 0 ? false : true

    }


    resetSectionErrors = (section) => {


        const formErrors = this.state.formErrors
        delete formErrors[section]

        this.setState({ formErrors }, () => console.log("After setting state in resetSectionErrors, this.state is : ", this.state))       
    }

    addError = (formSection, errorMessage) => {

        const formErrors = {
            ...this.state.formErrors,
            [formSection]: errorMessage
        }
        this.setState({ formErrors }, () => console.log("JUST setState in addError, and state is: ", this.state))
    }

    handleSubmit = callback => event => {
        event.preventDefault()
        callback(this.state.form)
    }

    state = {
        form:     {},
        setValue: this.setValue,
        getLocation: this.getLocation,
        formErrors: {},
        missingFields: this.missingFields,
        cropFractionWithinRange: this.cropFractionWithinRange,
        numberOfLevelsWithinRange: this.numberOfLevelsWithinRange,
    }

    static getDerivedStateFromProps(props, state) {
        if (props.data)
            return {
                ...state,
                form: {
                    ...state.form,
                    ...props.data,
                }
            }
        else
            return state
    }

    render () {
        const { children, onSubmit, onChange, ...props } = this.props

        return (
            <form className="form-large" onSubmit={this.handleSubmit(onSubmit)} {...props}>
                <FormContext.Provider value={this.state}>
                    {children}
                </FormContext.Provider>
            </form>
        )

    }
}
