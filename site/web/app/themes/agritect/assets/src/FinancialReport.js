import React from 'react'
import { Switch, Route, Link, useRouteMatch, withRouter, useLocation, Redirect } from 'react-router-dom'
import { CropDefaultInfo } from './CropDefaultInfo'
import  CropForm  from './CropForm'
import Opex from './Opex'
import Capex from './Capex'
import FinancialOverview from './FinancialOverview'
import AnnualSummary from './AnnualSummary'
import api from './api'
import loadingGif from "../images/Agritecture-animated-logo.gif"

const db = window.firebase.firestore()

const CROP_SALE_UNIT_OPTIONS = {
  '1': "1 oz",
  '2': "2 oz",
  '3': "4 oz",
  '4': "150 g",
  '5': "8 oz",
  '6': "1 lb",
  '7': "bunch/head"
}

{/* TODO: Code here that renders each row */}

const ReportNav = withRouter(() => {
  let match = useRouteMatch()
  let path = useLocation().pathname.split("/")[useLocation().pathname.split("/").length - 1]
  let pricingPath = useLocation().pathname.split("/")[useLocation().pathname.split("/").length - 2]

  console.log(" ", match, "path: ", path, "pricingPath: ", pricingPath )
  return(
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li className="nav-item">
        <Link to={`${match.url}/defaults`} className={`nav-link ${pricingPath == "pricing" || path == "defaults" ? "active" : null }`} id="crop-pricing-table" aria-controls="crop-pricing" aria-selected="true">Crop<br/>Pricing</Link>
      </li>
      <li className="nav-item">
        <Link to={`${match.url}/overview`} className={`nav-link ${path == "overview" ? "active" : null }`} id="financial-overview-tab" aria-controls="crop-pricing" aria-selected="true">Financial<br/>Overview</Link>
      </li>
      <li className="nav-item">
        <Link to={`${match.url}/capex`} className={`nav-link ${path == "capex" ? "active" : null }`} id="crop-pricing-table" aria-controls="crop-pricing" aria-selected="true">Capex<br/>Breakout</Link>
      </li>
      <li className="nav-item">
        <Link to={`${match.url}/opex`} className={`nav-link ${path == "opex" ? "active" : null }`} id="opex-breakout-tab" aria-controls="crop-pricing" aria-selected="true">Opex<br/>Breakout</Link>
      </li>
      <li className="nav-item">
        <Link to={`${match.url}/annual-summary`} className={`nav-link ${path == "annual-summary" ? "active" : null }`} id="annual-summary-tab" aria-controls="crop-pricing" aria-selected="true">Annual<br/>Summary</Link>
      </li>
    </ul>
  )
})

class FinancialReport extends React.Component {

  state = {
    project: null,
    report: null,
    cropData: null
  }

  updateReport = (report, cropData) => {
    console.log("updateReport firing in FinancialReport")
    let project = this.state.project
    project['default crop prices'] = false
    console.log("cropData coming from CropForm: ", cropData)
    console.log("cropData in state: ", this.state.cropData)
    this.setState({report, cropData})
  }

  render(){
    const { report, project, cropData } = this.state
    const { wpid, projectId, match } = this.props

    console.log("inside Render of FR, project is: ", project)
    return(
      project == null ? 
      <>
          <div className="dashboard-loader-white">
              <img class="dashboard-loader__image" src={loadingGif} alt="" />
          </div>
      </>
      :
      <>
        <div className="row">
          <div className="col-sm-8">
            <h2 className="text-uppercase mb-4">
              <div className="text-highlight"><span>{project.name}&nbsp;</span></div>
            </h2>
          </div>
          <div className="col-sm-4">
            <div className="mb-2 text-right">
              <Link to={`/projects/${projectId}`} className="btn btn-primary" id="crop-pricing-table" aria-controls="crop-pricing" aria-selected="true">Edit Project</Link>
              <br/>
            </div>
          </div>
        </div>
  
        <ReportNav />
  
        <div className="tab-content" id="jsProjectResults">
          <Switch>
            <Route path={`${match.path}/pricing`}>
              <CropForm wpid={wpid} project={project} model={project.operationType} projectId={projectId} cropData={cropData} updateReport={this.updateReport} />
            </Route>
  
            <Route path={`${match.path}/overview`}>
              <FinancialOverview report={report} />
            </Route>
  
            <Route path={`${match.path}/capex`}>
              <Capex report={report} />
            </Route>
  
            <Route path={`${match.path}/opex`}>
              <Opex report={report} />
            </Route>
  
            <Route path={`${match.path}/annual-summary`}>
              <AnnualSummary report={report} />
            </Route>

            <Route path={`${match.path}/defaults`}>
              <CropDefaultInfo match={match} project={project} cropData={cropData}/>
            </Route>

            <Route exact path={match.path}>
              <Redirect to={`${match.url}/overview`} />
            </Route>

          </Switch>
        </div>
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
    window.scrollTo(0,0)
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
    let project = result.data()

    const allCrops = await api({ model: project.operationType, mode: "deliverables", command: "input_values", input: "crops.id" })
    
    console.log("FR componentDidMount, project is: ", project)
    if (project['default crop prices']){
      console.log("What's project.cropData: ", project.cropData)
      project.cropData={}

      console.log("Inside FinancialReport, project is: ", project)
      Object.keys(project).forEach(keyName => {
        if (keyName.includes("cropId")){
          console.log('keyName.match(/\d+/) is: ', keyName.match(/\d+/))
          project.cropData[project[keyName]] = {}
          project.cropData[project[keyName]]["fraction of bedspace"] = project[`cropPercentage${keyName.match(/\d+/)}`]
          project.cropData[project[keyName]]["default price"] = project['default crop info'].find((crop) => crop['id'] == project[keyName])['price per unit']
          project.cropData[project[keyName]]["default sale unit"] = CROP_SALE_UNIT_OPTIONS[project['default crop info'].find((crop) => crop['id'] == project[keyName])['sale unit id']]
        }
      })
  
      const crops = allCrops.filter(crop => {
        return Object.keys(project.cropData).includes(crop.id.toString())
      })
        
      console.log("crops are:", crops)
      console.log("project.cropData is:", project.cropData)
  
      Object.keys(project.cropData).forEach((cropId) => {
        if (project.cropData[cropId]["fraction of bedspace"] != "")
          project.cropData[cropId]["pricelines"] = [0, 1, 2].map(() => ({})),
          project.cropData[cropId]["name"] = crops.filter((crop) => crop["id"] == cropId)[0].crop_type
        if (cropId == "")
          delete project.cropData[""]
      })
    }

    console.log("project.cropData is: ", project.cropData)

    this.setState({ project: project || {}, report: project && project.financialReport, cropData: project && project.cropData}, () => console.log("after setting state in FinancialReport CDM, state is: ", this.state))
  }

}




export default withRouter(FinancialReport)