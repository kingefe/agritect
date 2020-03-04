import React from 'react'
import api from './api'
import FormBuilder from './FormBuilder'

const db = window.firebase.firestore()

const MODELS = ['vf', 'gh', 'price_market_research']
const MODES  = ['defaults', 'warning', 'deliverables', 'crop_price']
const COMMANDS = [
    'inputs',
    'input_values',
    'outputs',
    'compute',
]

export default class TriggerModelViewer extends React.Component {
    state = {
        input:   localStorage.getItem('TriggerModelViewer_input') || '',
        mode:    localStorage.getItem('TriggerModelViewer_mode') || '',
        command: localStorage.getItem('TriggerModelViewer_command') || '',
        model:   localStorage.getItem('TriggerModelViewer_model') || '',
        output:  '',
    }

    async componentDidMount () {
        const { wpid } = this.props

        if (wpid === '0' || !wpid)
            return

        const results = await db
            .collection('surveys')
            .where('wpid', '==', wpid)
            .get()

        this.setState({
            survey: results.docs[0].data()
        })
    }

    submitOnEnter = async event => {
        if (event.key !== '+')
            return

        event.preventDefault()

        const input = JSON.parse(this.state.input)
        const { command, model, mode } = this.state

        const data = await api({ ...input, command, model, mode })

        this.setState({
            output: JSON.stringify(data, null, 4)
        })
    }

    setField = name => event => {
        const { value } = event.target
        this.setState({ [name]: value })
        localStorage.setItem(`TriggerModelViewer_${name}`, value)
    }

    render () {
        const { survey, input, output } = this.state
        const style = { fontFamily: 'monospace', width: 800, height: 500 }

        const FieldSelect = ({ field, options }) =>
            <>
                {field}
                <select onChange={this.setField(field)} value={this.state[field]}>
                    <option value="">Please Select an option</option>
                    {options.map(v => <option key={v} value={v}>{v}</option>)}
                </select>
                <br />
            </>

        return <div className="container">
            <FieldSelect field="model" options={MODELS} />
            <FieldSelect field="mode" options={MODES} />
            <FieldSelect field="command" options={COMMANDS} />

            <textarea style={style} value={input} onChange={this.setField('input')} onKeyPress={this.submitOnEnter} />
            <textarea style={style} value={output} readOnly />
        </div>
    }
}
