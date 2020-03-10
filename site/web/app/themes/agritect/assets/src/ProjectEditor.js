import React from 'react'
import { Switch, Route, Link, useRouteMatch, withRouter, useHistory, Redirect } from 'react-router-dom'
import Form, { BaseInput, SelectInput } from './Form'
import debounce from 'debounce'
import FormBuilder from './FormBuilder'
import FinancialReport from './FinancialReport'
import profileIcon from     "../images/icons/general/icon-profile.svg"
import loadingGif from "../images/Agritecture-animated-logo.gif"


const db = window.firebase.firestore()

class ProjectEditor extends React.Component {
    state = {
        project: null,
        financialReport: null
    }

    saveDoc = formData => {
        console.log("saveDoc firing, formData is: ", formData)
        formData.cropData = {}
        Object.keys(formData).forEach((fieldName, index)=> {
            if (fieldName.includes("cropId") && formData[fieldName] != ""){
                formData.cropData[formData[fieldName]] = {}
                formData.cropData[formData[fieldName]]["fraction of bedspace"] = formData[`cropPercentage${fieldName.slice(-1)}`]
            }
        })
        console.log("saveDoc firing, formData is: ", formData)
        this.doc.set(formData)
    }

    debouncedSaveDoc = debounce(this.saveDoc, 5000)

    handleFormChange = formData => {
        this.setState({ project: formData })
        this.debouncedSaveDoc(formData)
    }

    render () {
        const { wpid, match } = this.props

        const { project, financialReport } = this.state

        const { projectId } = match.params.projectId

        return (
            <>
                <Switch>
                    <Route path={`${match.path}/financial-report`}>
                        <>
                            <div className={`section`}>
                                <FinancialReport wpid={wpid} projectId={match.params.projectId} report={financialReport} project={project} />
                            </div>
                        </>
                    </Route>

                    <Route exact path={match.path}>
                        <Form onSubmit={this.saveDoc} data={project} onChange={this.handleFormChange}>
                            {
                            project ?
                            <>
                                <div className={`section section--dark`}>
                                    <Form onSubmit={this.saveDoc} data={project} onChange={this.handleFormChange}>
                                        <FormBuilder wpid={wpid} projectId={match.params.projectId} model={project.operationType ? project.operationType : "gh"} />
                                    </Form>
                                </div>   
                            </>                         
                            :
                                <div className="dashboard-loader">
                                    <img class="dashboard-loader__image" src={loadingGif} alt="" />
                                </div>
                            }
                        </Form>
                    </Route>

                </Switch>
            </>
        )
    }

    get doc () {
        const { wpid, match } = this.props

        if (wpid === '0' || !wpid)
            return

        const collection = db.collection(`users/${wpid}/projects`)

        return collection.doc(match.params.projectId)
    }

    async componentDidMount () {
        const { wpid } = this.props

        if (wpid === '0' || !wpid)
            return

        if (!firebase.auth().currentUser) {
            const response  = await fetch(`${ajaxurl}?action=user_meta`, { method: 'POST' })
            const tokenData = await response.json()

            await firebase.auth()
                .signInWithCustomToken(tokenData.firebase_token)
        }

        const result = await this.doc.get()
        this.setState({ project: result.data() || {}, financialReport: result.data() && result.data().financialReport }, () => console.log("after setting state in PE CDM, state is: ", this.state))
    }
}

export default withRouter(ProjectEditor)
