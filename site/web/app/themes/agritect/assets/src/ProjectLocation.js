import React from 'react'
import Form, { BaseInput, LocationInput, SelectInput } from './Form'

class ProjectLocation extends React.Component {

  render () {
    const { model } = this.props
    return(
      <>
        <div id="location">
          <fieldset>
            <legend><h4>Location of your project:</h4></legend>
            <div className="row">

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Zip Code <small>(optional)</small></label>
                    <LocationInput name="zipcode" model={model}/>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">City</label>
                    {/* <BaseInput name="city"/> */}
                    <LocationInput name="city" model={model}/>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">State or Province</label>
                    <BaseInput name="state-province"/>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label for="">Country</label>
                    <BaseInput name="country"/>
                </div>
              </div>

            </div>
          </fieldset>
        </div>
      </>
    )
  }
}

export default ProjectLocation