import React from 'react'
import { HashRouter as Router, Switch, Route, Link, withRouter } from 'react-router-dom'
import Projects from './Projects'
import TriggerModelViewer from './TriggerModelViewer'

import  visionLogo from     "../images/icons/dashboard/icon-vision.svg"
import  projectsLogo from   "../images/icons/dashboard/icon-folder.svg"
import  conceptLogo from    "../images/icons/dashboard/icon-concept.svg"
import accountLogo from "../images/icons/dashboard/Icon/Account Setting Black.svg"
import logoutLogo from "../images/icons/dashboard/Icon/Log out Black.svg"

import agritectureLogo from "../images/logo-agritecture.svg"

const Nav = withRouter(({ location }) =>
    <>
    <div className="sidebar">
        <div className="sidebar__list">
            <nav className="navbar" id="sidebar-project-list">
                <a className="navbar-brand navbar-brand--dark" href="#">
                    <img src={agritectureLogo} alt="" height="40"/>
                    <h1><strong>Agritecture</strong><br/><small>Designer</small></h1>
                </a>
                <ul className="nav">
                    <li className="nav-item">
                        <a href="/dashboard" className="nav-link">
                            <span className="menu-icon">
                                <img src={visionLogo} alt=""/>
                            </span> 
                            <span>
                                Vision
                            </span>
                        </a>
                    </li>

                    <li className="nav-item">
                        <Link to="/projects/all" className="nav-link active">
                            <span className="menu-icon">
                                <img src={projectsLogo} alt=""/> 
                            </span>
                            <span>
                                Projects
                            </span>
                        </Link>
                    </li>

                    <li className="nav-item">
                        <a href="/dashboard/inspirations" className="nav-link">
                            <span className="menu-icon">
                                <img src={conceptLogo} alt=""/> 
                            </span>
                            <span>
                                Inspiration
                            </span>
                        </a>
                    </li>

                    <li className="nav-item">
                        <a href="/dashboard/account" className="nav-link">
                            <span className="menu-icon">
                                <img src={accountLogo} alt="" width="20"/> 
                            </span>
                            <span>
                                Account
                            </span>
                        </a>
                    </li>

                    <li className="nav-item">
                        <a href="/wp/wp-login.php?action=logout" className="nav-link">
                            <span className="menu-icon">
                                <img src={logoutLogo} alt="" width="20"/> 
                            </span>
                            <span>
                                Log Out
                            </span>
                        </a>
                    </li>

                    {/* <li className="nav-item">
                        <Link to="/api-test" className="nav-link">Test API</Link>
                    </li> */}
                </ul>
            </nav>
        </div>
    </div>
    </>
)

const Designer = ({ wpid }) => {

    return(
        <Router>
            <Switch>
                <Route path="/projects">
                    <Projects wpid={wpid} />
                </Route>

                <Route path="/api-test">
                    <TriggerModelViewer />
                </Route>
            </Switch>
        </Router>
    )
}


export default Designer
