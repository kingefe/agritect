import React from 'react'
import ReactDOM from 'react-dom'
// import TriggerModelViewer from './TriggerModelViewer'
import Designer from './Designer.js'

import '../styles/main.scss'

import 'bootstrap/dist/css/bootstrap.min.css';

const el = document.querySelector('[data-behavior="TriggerModelViewer"]')

const navbar = document.querySelector(".navbar--main")
const header = document.querySelector(".banner")
const footer = document.querySelector(".site-footer")

if (el)
    // navbar.parentNode.removeChild(navbar)
    // header.parentNode.removeChild(header)
    // footer.parentNode.removeChild(footer)
    ReactDOM.render(<Designer wpid={el.dataset.wpUserId} />, el)