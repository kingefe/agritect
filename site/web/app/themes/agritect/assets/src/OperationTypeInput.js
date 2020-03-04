import React from 'react'
import { SelectInput } from './Form'
import { operationTypeInfo } from './info'
import  InfoIcon  from './InfoIcon'

const OPERATION_TYPES = [
  { id: 'vf', description: 'Vertical Farm' },
  { id: 'gh', description: 'Greenhouse' },
]

const OperationTypeInput = ({ model, form }) => {

  return(
    <div id="operation-type">
      <div class="row">
          <div class="col-md-8">
              <div class="form-group">
                  <label for="">
                      <h4>
                        {`Your operation type: `} 
                        <InfoIcon position="right" content={operationTypeInfo} target="operation type" /> 
                        </h4>
                  </label>
                  <SelectInput name="operationType" options={OPERATION_TYPES} />
              </div>
          </div>
      </div>
    </div>
  )

}

export default OperationTypeInput