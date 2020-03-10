import React from 'react'
import { BaseInput, withFormValue, SelectInput } from './Form'
import { operatingCostsInfo } from './info'
import InfoIcon from './InfoIcon'


const GAS_COST_UNIT_OPTIONS = [
  {
    "id": 1, 
    "description": "$/cubic meter"
  }, 
  {
    "id": 2, 
    "description": "$/1000 cubic feet"
  }
]

const OperatingCostsInput = ({ model, form }) => {
  return(
    <>
    <div id="operating-costs">
      <fieldset>
        <legend>
          <h4>
            {`Override of any default operating costs: `}
            <InfoIcon position="right" content={operatingCostsInfo} target="structure-type"/> 
          </h4>
        </legend>
        <div className="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">
                {`Water cost ($/gal) `}
              </label>
              <div class="form-unit form-unit--left">
                <BaseInput model={model} key="water cost" name="water cost" />
                <div class="form-unit__type">$</div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Avg farm worker labor rate ($/hour)</label>
              <div class="form-unit form-unit--left">
                <BaseInput model={model} type="number" key="labor wages" name="labor wages" />
                <div class="form-unit__type">$</div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Electricity cost ($/kWh)</label>
              <div class="form-unit form-unit--left">
                <BaseInput model={model} key="electricity cost" name="electricity cost" />                
                <div class="form-unit__type">$</div>
              </div>
            </div>
          </div>

          <div class="col-md-6 form-group">
            <label for="">Tax Rate</label>
            <div className="form-unit form-unit--right">
              <BaseInput key="tax rate" name="tax rate" type="number" model={model} min={0} max={100}/> 
              <div className="form-unit__type">%</div>
            </div>
          </div>
          {
          form["heating"] == true ?
          <>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Gas Cost ($)</label>
              <div class="form-unit form-unit--left">
                <BaseInput model={model} key={"gas cost"} name={"gas cost"} />
                <div class="form-unit__type">$</div>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="">Gas Unit</label>
              <div class="form-unit form-unit--left">
                <SelectInput key={"gas cost unit id"} name={"gas cost unit id"} options={GAS_COST_UNIT_OPTIONS}/>
              </div>
            </div>
          </div>
          </>
          :
          null
          }
        </div>
      </fieldset>
    </div>
    </>
  )
}

export default withFormValue(OperatingCostsInput)