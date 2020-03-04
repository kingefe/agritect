import React from 'react'
import { BaseInput, SelectInput, withFormValue } from './Form'
import { financingInfo, interestRateInfo, repaymentPeriodInfo } from './info'
import InfoIcon from './InfoIcon'

const FINANCING_OPTIONS = [
  {id: 1, description: "Debt"},
  {id: 2, description: "Equity"},
  {id: 3, description: "Self-funded"}
]

const FinancingInput = ({ model, form }) => {
  return (
    <>
      <div id="financing">
        <div class="row">
          <div class="col-md-9">
            <div class="form-group">
              <label for="">
                <h4>
                  {`What is the primary means through which you intend to finance your project? `}
                  <InfoIcon position="right" content={financingInfo} target="financing"/>
                </h4>
              </label>
              <SelectInput model={model} key="financing option" name="financing option" options={FINANCING_OPTIONS}/>
            </div>
          </div>
          {
            form["financing option"] == 1 ?
            <>
            
            <div class="col-md-6 form-group">
              <label for="">
                {`Interest Rate `}
                <InfoIcon position="right" content={interestRateInfo} target="interest-rate"/>
              </label>
              <div className="form-unit form-unit--right">
                <BaseInput key={"interest rate"} name="interest rate" type="number" model={model} type="number" min={0} max={100}/> 
                <div className="form-unit__type">
                  %
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="">
                  {`Repayment Period in Years `}
                  <InfoIcon position="right" content={repaymentPeriodInfo} target="repayment-time"/>
                </label>
                <BaseInput model={model} key={"repayment time"} name={"repayment time"} />
              </div>
            </div>

            </>
            :
            <></>
          }
        </div>
      </div>

    </>
  )
}

export default withFormValue(FinancingInput)