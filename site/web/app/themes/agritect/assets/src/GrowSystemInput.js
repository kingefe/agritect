import React from 'react'
import { withFormValue, SelectInput } from './Form'
import api from './api'
import { growSystemInfo } from './info'

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

// Convert to class component
// make sure export is working
// Grab index from props
// Wrap in withFormValue

// export const GrowSystemInput = withFormValue(({form, index}) => {
//     console.log("inside GrowSystemInput form is: ", form)
//     let cropId = `cropId${index}`
//     return(
//       <>
//         <p>This is GrowSystemInput Component</p>
//         <p>{`Form crop ${index} id: ${form[cropId]} `}</p>
//         <SelectInput name="crops.grow system type" formName={`growSystemType${index}`} options={GAS_COST_UNIT_OPTIONS} key={"gas cost unit id"} />
//       </>
//     )
// })

class GrowSystemInput extends React.Component{
  

  state = {
    options: []
  }
  
  render(){

    const { index, form, label } = this.props
    let crop = `cropId${index}`
    let cropId = form[`${crop}`]
    let {options} = this.state

    console.log("about to render a GrowSystemInput, index is: ", index)
    console.log("growSystemType${index} is: ", `growSystemType${index}`)

    return(
      <>
        <div className="form-group">
          <label >Grow System {index}</label>
          <SelectInput name={`growSystemType${index}`} formName={`growSystemType${index}`} options={options} key={`grow-system-${index}`} />
          <small id="emailHelp" className="form-text text-muted">Grow system for your crop (select a crop first)</small>
        </div>
      </>
    )
  }

  async componentDidUpdate(prevProps){
    const { index, form, model } = this.props
    let crop = `cropId${index}`
    let cropId = form[`${crop}`]

    console.log("cropId is: ", cropId)
    console.log("component did update")

    if (prevProps.form[`cropId${index}`] != cropId){
      const options = await api({ 
        model: "crop_grow_system", 
        command: 'compute', 
        "args": {
          "crop id": cropId
        }
      })
      this.setState({ options: options['grow systems'] })
    }
  }

  async componentDidMount(){
    console.log("inside ComponentDidMount")
    const { form, index } = this.props
    let crop = `cropId${index}`
    let cropId = form[`${crop}`]

    if (cropId){
      console.log("cropId is true")
      const options = await api({ 
        model: "crop_grow_system", 
        command: 'compute', 
        "args": {
          "crop id": cropId
        }
      })
      console.log("response from api is: ", options)
      this.setState({ options: options['grow systems'] })
    }
    console.log("cropId is not found !")
  }
}

export default withFormValue(GrowSystemInput)