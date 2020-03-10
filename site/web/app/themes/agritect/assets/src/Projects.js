import React from 'react'
import { HashRouter as Router, Switch, Route, Link, withRouter, useLocation } from 'react-router-dom'
import ProjectEditor from './ProjectEditor'

import verticalFarmImage from "../images/icons/dashboard/Portfolio/Vertical Farm.svg"
import greenhouseImage from "../images/icons/dashboard/Portfolio/Greenhouse Ground.svg"
import plusIcon from "../images/icons/dashboard/icon-plus.svg"
import profileIcon from     "../images/icons/general/icon-profile.svg"
import deleteIcon from "../images/icons/dashboard/delete.svg"

import { deleteProjectFromFireStore } from './utils'


const db = window.firebase.firestore()

const NewProjectLink = withRouter(({ history, wpid, match }) =>{
    console.log("Do i have match in props ??", match)

    return(
        <div className="col-12 col-sm-6 col-md-4 d-flex"
        onClick={async () => {
            const doc = await db.collection(`users/${wpid}/projects`)
                .add({
                    status: 'in-progress',
                    created: firebase.firestore.FieldValue.serverTimestamp(),
                })

            history.push(`/projects/${doc.id}`)
        }}>
        <a className="card card--project-new">
            <span class="card-img-wrapper">
                <img src={plusIcon}  className="card-img-top"/>
            </span>
            <h4 class="card-title">Start a New Project</h4>
        </a>
    </div>
    )
})

const ProjectList = withRouter(({ projects, wpid, handleDelete }) => {

    let path = useLocation().pathname
    
    return(
        <>
        <div className="section">
            <h2 class="text-uppercase">
                <div class="text-highlight"><span>Projects</span></div>
            </h2>
            <ul className="nav nav-pills nav-pills--light" id="myTab" role="tablist">
                <li className="nav-item">
                    <Link 
                        to="/projects/all" 
                        className={`nav-link ${path == "/projects/all" ? "active" : null}`}
                        aria-selected="true">All</Link>
                </li>

                <li className="nav-item">
                    <Link 
                        to="/projects/in-progress" 
                        className={`nav-link ${path == "/projects/in-progress" ? "active" : null}`}
                        aria-selected="true">In Progress</Link>
                </li>

                <li className="nav-item">
                    <Link 
                        to="/projects/complete" 
                        className={`nav-link ${path == "/projects/complete" ? "active" : null}`}
                        aria-selected="true">Complete</Link>
                </li>
            </ul>

            <div class="pt-4">
                <div class="row">
                {projects
                .map(project =>
                    <div class="col-md-4 d-flex">
                        <div class="card card--project">
                            <div class="card-img-wrapper">
                                <img src={project.operationType == "vf" ? verticalFarmImage : greenhouseImage} alt="" class="card-img-top"/>
                            </div>
                            <div class="card-body">
                                <h4 class="card-title text-uppercase">{project.name}</h4>
                                <p>
                                {project.operationType == "vf" ? "Indoor Vertical Farm" : "Greenhouse"}
                                <br/>
                                <small class="text-muted text-uppercase">{project.status}</small>
                                </p>
                                <Link className="card-delete" onClick={() => handleDelete(wpid, project.id)}>
                                    <img src={deleteIcon} width="20" />
                                </Link>
                            </div>
                            <Link className="card-button" to={project.status == 'complete' ? `/projects/${project.id}/financial-report/overview` : `/projects/${project.id}`}>View</Link>
                        </div>
                    </div>
                )
                }
                <NewProjectLink wpid={wpid} />
                </div>
            </div>
        </div>
    </>
    )
})

const Header = () => 
    <div className={`section py-2 d-none`}>
        <nav className="navbar">
            <ul className="navbar-nav ml-auto flex-row">
                <li className="nav-item">
                    <a className="profile-link" href="/">
                        <img height="24" src={profileIcon} alt=""/>
                    </a>
                </li>
            </ul>
        </nav>
    </div>


class Projects extends React.Component {
    state = {
        projects: []
    }

    handleDelete = (wpid, projectId) => {
        if (window.confirm('Are you sure you wish to delete this project?')){
            deleteProjectFromFireStore(wpid, projectId)
            let projects = this.state.projects.filter((project) => {
                return project.id != projectId
            })
            this.setState({ projects })
        }else{
            console.log("No Deleting !")
        }
    }

    render () {
        const { wpid } = this.props
        const { projects } = this.state


        return <Router>
                <Switch>
                    <Route path="/projects/all">
                        <ProjectList handleDelete={this.handleDelete} projects={projects} wpid={wpid} />
                    </Route>

                    <Route path="/projects/in-progress">
                        <ProjectList handleDelete={this.handleDelete} projects={projects.filter(p => p.status === "in-progress")} wpid={wpid} />
                    </Route>

                    <Route path="/projects/complete">
                        <ProjectList handleDelete={this.handleDelete} projects={projects.filter(p => p.status === "complete")} wpid={wpid} />
                    </Route>

                    <Route path="/projects/:projectId">
                        <ProjectEditor wpid={wpid}/>
                    </Route>

                </Switch>
        </Router>
    }

    async componentDidMount () {
        const { wpid } = this.props

        if (wpid === '0' || !wpid)
            return

        if (!firebase.auth().currentUser) {
            const response = await fetch(`${ajaxurl}?action=user_meta`, { method: 'POST' })
            const tokenData = await response.json()

            await firebase.auth()
                .signInWithCustomToken(tokenData.firebase_token)
        }

        this.collection = db.collection(`users/${wpid}/projects`)

        const results = await this.collection
            .get()

        this.setState({
            projects: results.docs.map(d => ({ id: d.id, ...d.data() })),
        })
    }

    async componentDidUpdate(prevProps) {

        if(prevProps.location.pathname != this.props.location.pathname && this.props.location.pathname === '/projects/all'){
            const { wpid } = this.props

            if (wpid === '0' || !wpid)
            return

            if (!firebase.auth().currentUser) {
                const response = await fetch(`${ajaxurl}?action=user_meta`, { method: 'POST' })
                const tokenData = await response.json()

                await firebase.auth()
                    .signInWithCustomToken(tokenData.firebase_token)
            }
            this.collection = db.collection(`users/${wpid}/projects`)

            const results = await this.collection
                .get()
    
            this.setState({
                projects: results.docs.map(d => ({ id: d.id, ...d.data() })),
            })
        }
    }


}

export default withRouter(Projects)