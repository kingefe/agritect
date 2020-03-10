import React from 'react'
import { BaseInput, SelectInput } from './Form'
import InfoIcon from './InfoIcon'
import api from './api'
import { growSystemInfo } from './info'


const BOOLEAN_OPTIONS = [
    { id: true,  description: 'Yes' },
    { id: false, description: 'No' },
]

export default class FormInput extends React.Component {
    state = {
        options: [],
    }

    render () {
        const { name, label, formName, field, infoIcon } = this.props
        const { options } = this.state
        const fieldID = `FormInput_${name}`
        
        return <div className="form-group">
            <label htmlFor={fieldID}>{label || name}</label>
            {
                infoIcon ? 
                <InfoIcon position="right" content={growSystemInfo} target="grow-system-type-info"/>
                : 
                null
            }
            <Input
                id={fieldID}
                name={formName || name}
                className="form-control"
                type={field.type}
                options={options}
                default={field.default}
            />

            <small id="emailHelp" className="form-text text-muted">{field.description}</small>
        </div>
    }

    async componentDidUpdate(prevProps) {
        const { model, field, name } = this.props

        if (field.type !== 'choice')
            return
            
        if (prevProps.model !== model ){
            const options = await api({ model, mode: 'deliverables', command: 'input_values', input: name })
            this.setState({ options })
        }

    }

    async componentDidMount () {
        const { model, field, name } = this.props

        if (field.type !== 'choice')
            return

        const options = await api({ model, mode: 'deliverables', command: 'input_values', input: name })

        this.setState({ options })
    }
}

const Input = ({ type, options, ...props }) => {
  switch (type) {
      case 'choice':  return <SelectInput {...props} options={options} />
      case 'bool':    return <SelectInput {...props} options={BOOLEAN_OPTIONS} />
      case 'decimal': return <BaseInput   {...props} type="text" />
      case 'list':    return 'What is a list ?!?!'
      default:        return <div>UNKOWN TYPE: {type}</div>
  }
}
