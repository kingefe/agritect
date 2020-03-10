import React from 'react'
import OverlayTrigger from 'react-bootstrap/OverlayTrigger'
import Button from 'react-bootstrap/Button'
import Tooltip from 'react-bootstrap/Tooltip'
import Overlay from 'react-bootstrap/Overlay'
import { useRef, useState } from 'react'

// const InfoIcon = ({position, content, target}) => {
//   return(
//     <OverlayTrigger
//     key={`${target}-info`}
//     placement={position}
//     overlay={
//       <Tooltip id={`${target}-info-content`}>
//         {content}.
//       </Tooltip>
//     }
//     >
//     <span class="tooltip-icon" data-toggle="popover" data-placement="right">i</span>
//   </OverlayTrigger>
//   )
// }

const InfoIcon = ({content}) => {
  const [show, setShow] = useState(false);
  const target = useRef(null);

  return (
    <>
      <span className="tooltip-icon" ref={target} onClick={() => setShow(!show)}>
        i
      </span>
      <Overlay target={target.current} show={show} placement="right">
        {({
          placement,
          scheduleUpdate,
          arrowProps,
          outOfBoundaries,
          show: _show,
          ...props
        }) => (
          <div
            {...props}
            className="tooltip-inner"
          >
            {content}
          </div>
        )}
      </Overlay>
    </>
  )
}

export default InfoIcon