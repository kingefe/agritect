import React from 'react'
import { BaseInput, RadioInput, BooleanInput } from './Form'
import { structureTypeInfo, roofTypeInfo,heatingInfo, supplementaryLightingInfo, co2InjectionInfo } from './info'
import InfoIcon from './InfoIcon'

const STRUCTURE_TYPE_OPTIONS = [
  { id: 1,  description: 'Light Duty' },
  { id: 2, description: 'Medium Duty' },
  { id: 3, description: 'Heavy Duty' },
]

const BOOLEAN_OPTIONS = [
  { id: true,  description: 'Yes' },
  { id: false, description: 'No' },
]


const BUILDING_INSULATION_OPTIONS = [
  {id: 1, description: "Low insulation"},
  {id: 2, description: "Mid insulation"},
  {id: 3, description: "High insulation"}
]

const BUILDING_ROOF_TYPE_OPTIONS = [
  {id: 1, description: "Flat roof"},
  {id: 2, description: "Pitched roof"}
]

export const BuildingInput = ({ model }) => {
  return(
    <div id="structure-type">
      {
        model =="gh" ?
        <>
          <fieldset>
            <legend>
              <h4>
                {`Structure Type: `}
                <InfoIcon position="right" content={structureTypeInfo} target="structure-type"/> 
              </h4>
            </legend>
            <div class="form-group form-group--flex">
              <RadioInput className="form-check form-check-inline form-check--button" model={model} key="structure type" name="structure type" options={STRUCTURE_TYPE_OPTIONS}/> 
            </div>
          </fieldset>

          <div className="row">
            <div className="col-md-4">
              <div className="form-group">
                <div className="text-accent mb-3">
                  {`Heating: `}
                  <InfoIcon position="right" content={heatingInfo} target="heating"/> 
                </div>
                <BooleanInput model={model} key={"heating"} name={"heating"} options={BOOLEAN_OPTIONS}/> 
              </div>
            </div>
            <div className="col-md-4">
              <div className="form-group">
                <div className="text-accent mb-3">
                  {`Supplementary Lighting: `}
                  <InfoIcon position="right" content={supplementaryLightingInfo} target="supplementary-lighting"/> 
                </div>
                <BooleanInput model={model} key={"supplementary lighting"} name={"supplementary lighting"} options={BOOLEAN_OPTIONS}/> 
              </div>
            </div>
            <div className="col-md-4">
              <div className="form-group">
                <div className="text-accent mb-3">
                  {`CO2 Injection: `}
                  <InfoIcon position="right" content={co2InjectionInfo} target="co2-injection"/> 
                </div> 
                  <BooleanInput model={model} key="co2 injection" name="co2 injection" options={BOOLEAN_OPTIONS}/> 
              </div>
            </div>
          </div>
        </>
        :
        <>
          <fieldset>
            <legend>
              <h4>Insulation Level:</h4>
            </legend>
            <div className="form-group form-group--flex">
              <RadioInput name="building insulation" options={BUILDING_INSULATION_OPTIONS} key="building insulation" className="form-check form-check-inline form-check--button" model={model} key={"structure type"} /> 
            </div>
          </fieldset>

          <fieldset>
            <legend>
              <h4>
                {`Roof Type: `}
                <InfoIcon position="right" content={roofTypeInfo} target="structure-type"/>
              </h4>
            </legend>
            <div className="form-group form-group--flex">
              <RadioInput name="building roof type" options={BUILDING_ROOF_TYPE_OPTIONS} key="building roof type" className="form-check form-check-inline form-check--button" model={model} key={"building roof type"} /> 
            </div>
            <legend>
              <h4>Desired Number of Vertical Grow Levels:</h4>
            </legend>
            <div className="form-group form-group--flex">
              <BaseInput key={"number of levels"} name={"number of levels"} type={"number"} model={model} min={0} max={100}/> 
            </div>
          </fieldset>
        </> 
      }
    </div>
  )
}