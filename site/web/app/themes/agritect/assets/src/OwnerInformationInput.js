import React from 'react'
import { SelectInput, RadioInput } from './Form'
import { owner } from './Form'
import InfoIcon from './InfoIcon'

const BOOLEAN_OPTIONS = [
  { id: true,  description: 'Yes' },
  { id: false, description: 'No' },
]

const GROWER_EXPERIENCE_OPTIONS = [
  {id: 1, description: "Low"},
  {id: 2, description: "Mid"},
  {id: 3, description: "High"}
]

const OwnerInformationInput = ({ model }) => {

  return(
    <>
      <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="">
                    <h4>
                      {`Will Owner act as head grower? `}
                    </h4>
                </label>
                <SelectInput model={model} key="owner is headgrower" name="owner is headgrower" options={BOOLEAN_OPTIONS}/>                        
            </div>
        </div>
      </div>

      <fieldset>
          <legend>
              <h4>
                {`Grower Experience: `}
              </h4>
          </legend>
          <div className="form-group form-group--flex">
              <RadioInput model={model} key="grower experience" name="grower experience" options={GROWER_EXPERIENCE_OPTIONS}/>
          </div>
      </fieldset>
    </>
  )

}

export default OwnerInformationInput