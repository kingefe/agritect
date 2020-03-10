import React from 'react'
import { numberWithCommas } from './utils'
import { PieChart } from './PieChart';

const getDataLabels = (capexBreakout) => {
  return capexBreakout.map((entry) => {
    if (entry['category'] != 'Total')
      return entry['category']
  })
}

const getDataPoints = (capexBreakout) => {
  return capexBreakout.map((entry) => {
    if (entry['category'] != 'Total')
      return entry['total price']
  })
}

const Capex = ({ report }) => {
  const capexBreakout = report["capex breakout"]

  let dataLabels = getDataLabels(capexBreakout)
  let dataPoints = getDataPoints(capexBreakout)

  let layout = {
    height: 500,
    width: 600
  };

  return(
    <>
      <h3 className="text-uppercase"><div className="text-highlight"><span>Capex&nbsp;</span></div><div className="text-highlight"><span>Breakout&nbsp;</span></div></h3>
      <div className="expense-breakouts-wrapper clearfix">
        <table className="table table-dark exp-table">
          <thead className="thead-light">
            <tr>
              <th scope="col">Category</th>
              <th scope="col">Total Price</th>
              <th scope="col">% of Total</th>
            </tr>
          </thead>
          <tbody>
            {capexBreakout.map((entry) => {
              return(
                <tr>
                  <th scope="row">{entry["category"]}</th>
                  <td>${numberWithCommas(Math.round(entry["total price"]))}</td>
                  <td>{(entry["fraction"]*100).toFixed(2)}%</td>
                </tr>
              )
            })}
          </tbody>
        </table>
        <PieChart data={dataPoints} labels={dataLabels} layout={layout}/>
      </div>
    </>
  )
}

export default Capex
