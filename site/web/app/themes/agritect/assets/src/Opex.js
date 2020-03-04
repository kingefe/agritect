import React from 'react'
import { numberWithCommas } from './utils'
import { PieChart } from './PieChart';

const getDataLabels = (opexBreakout) => {
  return opexBreakout.map((entry) => {
    if (entry['category'] != 'Total')
      return entry['category']
  })
}

const getDataPoints = (opexBreakout) => {
  return opexBreakout.map((entry) => {
    if (entry['category'] != 'Total')
      return entry['total price']
  })
}

const Opex = ({ report }) => {
  const opexBreakout = report["cogs & opex breakout"]

  let dataLabels = getDataLabels(opexBreakout)
  let dataPoints = getDataPoints(opexBreakout)

  let layout = {
    height: 500,
    width: 600
  };

  return(
    <>
      <h3 className="text-uppercase"><div className="text-highlight"><span>Opex&nbsp;</span></div><div className="text-highlight"><span>Breakout&nbsp;</span></div></h3>
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
            {opexBreakout.map((entry) => {
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

export default Opex
