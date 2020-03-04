import React from 'react'
import { withFormValue } from './Form'
import { titleCase } from './utils'

const headerStyle = {
  textDecoration: 'underline',
  textDecorationColor: 'red'
}

const textStyle = {
  color: 'red'
}

const Errors = ({ formErrors }) => {

  if(Object.keys(formErrors).length > 0 ){
    return(
      <>
        <hr/>
        <OtherErrors formErrors={formErrors}/>
        <MissingFieldsErrors formErrors={formErrors}/>
        <hr/>
      </>
    )
  }else{
    return <></>
  }
}

const MissingFieldsErrors = ({ formErrors }) => {
  if(Object.keys(formErrors).length > 0)
    if (formErrors["Missing Fields"]){
      let missingFieldsErrors = formErrors["Missing Fields"].map(error => {
        return <p style={textStyle}> {titleCase(error)} </p>
      })
      return(
        <>
          <h4 style={headerStyle}>These fields cannot be blank</h4>
          {missingFieldsErrors}
        </>
      )
    }else{
      return <></>
    }
  else{
    return <></>
  }
}

const OtherErrors = ({ formErrors }) => {
  if(formErrors["Number of Levels"] || formErrors["Crops"])
    return(
      <>
        <h4 style={headerStyle}>Please resolve the following errors before continuing</h4>
        <CropErrors formErrors={formErrors}/>
        <NumberOfLevelsErrors formErrors={formErrors}/>
      </>
    )
  else
      return <></>
}

const CropErrors = ({ formErrors }) => {

  if(formErrors['Crops']){
    console.log("errors are: ", errors)

    let errors = formErrors['Crops'].map((error) => {
      return <p style={textStyle}>{error}</p>
    })

    return(
      <>
        { errors }
      </>
    )
  }else{
    return<></>
  }
}

const NumberOfLevelsErrors = ({ formErrors }) => {

  if(formErrors['Number of Levels']){
    console.log("errors are: ", formErrors)
    
    let errors = formErrors['Number of Levels'].map((error) => {
      return <p style={textStyle}>{error}</p>
    })

    return(
      <>
        { errors }
      </>
    )
  }else{
    return<></>
  }
}



export default withFormValue(Errors)