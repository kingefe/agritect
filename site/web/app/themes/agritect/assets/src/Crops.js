import React from 'react'
import { CropInputDefault } from './CropInputDefault'
import { withFormValue } from './Form'
import InfoIcon from './InfoIcon'
import { cropInfo } from './info'

let errorStyle = {
  color: 'red',
};

const Crops = ({model, formErrors}) => {

  let  errors  = formErrors.Crops

  return(
    <>
      {errors ? <h5 style={errorStyle}>{`!! ${errors}`}</h5> : null}
      <label for="">
        <h4>
          {`Select your Crops: `}
          <InfoIcon position="right" content={cropInfo} target="crop-info"/>
        </h4>
      </label>
      
      <div className="row">
        <CropInputDefault index="1" model={model} infoIcon={true}/>
        <CropInputDefault index="2" model={model} />
        <CropInputDefault index="3" model={model} />
      </div>
    </>
  )
}

export default withFormValue(Crops)
