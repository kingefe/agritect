import React from 'react'
import { RadioInput, BaseInput, SelectInput, withFormValue } from './Form'
import InfoIcon from './InfoIcon'
import { ceilingHeightInfo, siteAreaInfo, siteAreaDedicatedToProductionInfo } from './info'


const LAND_STATUS_OPTIONS = [
  { id: 1,  description: 'Owned' },
  { id: 2, description: 'Looking to buy' },
  { id: 3, description: 'Looking to rent' },
]

const AreaCost = ({ model, form }) => {
  if (form["land status"] == 2 ) {
    return(
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">
              <h4>What's the total cost of your space ?</h4>
            </label>
            <div class="form-unit form-unit--left">
              <BaseInput model={model} key="land cost" name="land cost" type="text" model={model} min={0} max={1000000}/>
              <div class="form-unit__type">$</div>
            </div>
          </div>
        </div>
      </div>
    )
  }else if (form["land status"] == 3) {
    return(
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label for="">
              <h4>What's the yearly rent cost of your space ?</h4>
            </label>
            <div class="form-unit form-unit--left">
              <BaseInput model={model} key="rent cost" name="rent cost" type="text" model={model}/>
              <div class="form-unit__type">$</div>
            </div>
          </div>
        </div>
      </div>
    )
  }else{
    return(
      null
    )
  }
}

const AreaInput = ({ model, form }) => {

  return(
    <>

      <div id="space">
        <fieldset>
          <legend><h4>How will you obtain your land/building?</h4></legend>
          <div class="form-group form-group--flex">
            <RadioInput model={model} key={"land status"} name={"land status"} options={LAND_STATUS_OPTIONS}/>             
          </div>
        </fieldset>
        <AreaCost key={"area cost"} model={model} form={form} />
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="">
                <h4>
                  {`Site Area (in square feet): `}
                  <InfoIcon position="right" content={siteAreaInfo} target="site-area"/>
                </h4>
              </label>
              <div className="form-unit form-unit--right">
                <BaseInput key="site area" name="site area" type="text" model={model} /> 
                <div className="form-unit__type">
                  ft
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {
        model =="vf" ?
          <div className="row">
            <div className="col-md-6">
              <div className="form-group">
                <label for="">
                  <h4>
                    {`Ceiling Height: `}
                    <InfoIcon position="right" content={ceilingHeightInfo} target="ceiling height"/>
                  </h4>
                </label>
                <div className="form-unit form-unit--right">
                  <BaseInput key={"height"} name={"height"} type={"number"} model={model} min={0} max={100}/> 
                  <div className="form-unit__type">
                    ft
                  </div>
                </div>
              </div> 
            </div> 
          </div>
        :
        <div className="row">
          <div className="col-12">
            <label for="">
              <h4>
                {`% of Site Area Dedicated to Production: `}
                <InfoIcon position="right" content={siteAreaDedicatedToProductionInfo} target="% are to prod"/>
              </h4>
            </label>

            <div class="form-range form-range--dark">
              <BaseInput type="range" name="area fraction dedicated to production" className="form-control--range" defaultValue={70} placeholder={70} min="50" max="85" step="5" model={model}/>

              <div class="form-range__intervals">
                <span class="form-range__interval">50%</span>
                <span class="form-range__interval">55%</span>
                <span class="form-range__interval">60%</span>
                <span class="form-range__interval">65%</span>
                <span class="form-range__interval">70%</span>
                <span class="form-range__interval">75%</span>
                <span class="form-range__interval">80%</span>
                <span class="form-range__interval">85%</span>
              </div>
            </div>
          </div>
        </div>
      }
    </>
  )
}

export default withFormValue(AreaInput)