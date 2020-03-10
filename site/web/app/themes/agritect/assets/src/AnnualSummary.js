import React from 'react'
import { NetProfitLineChart } from './NetProfitLineChart';
import { AnnualRevenueTriLineChart } from './AnnualRevenueTriLineChart';
import { AnnualSummaryTable } from './AnnualSummaryTable';


const AnnualSummary = ({report}) => {
  const annualSummary = report['annual summary']

  let warWOpex = ["waste-adjusted revenue", "wastage", "opex"].map(el => {
    return annualSummary.map((elem, i)=> {
      return (
        { x: i, y: elem[el] }
      )
    })
  })

  let netProfit = annualSummary.map((entry, i) => {
    return {x: i, y: entry['net profit']}
  })

  const data = annualSummary && warWOpex
  const maxima = data.map(
    (dataset) => Math.max(...dataset.map((d) => d.y))
  )

  const xOffsets = [50, 350, 'DO_NOT_RENDER'];
  const tickPadding = [ 0, -15, -15 ];
  const anchors = ["end", "start", "start"];
  const colors = ["black", "red", "blue"];

  return(
    <>
      <h3 className="text-uppercase"><div className="text-highlight"><span>Annual&nbsp;</span></div><div className="text-highlight"><span>Summary&nbsp;</span></div></h3>
      <div class="piechart-wrapper">
        <AnnualSummaryTable data={annualSummary}/>
        <h3 className="text-uppercase"><div className="text-highlight"><span>Annual Revenue v. Operating Expenses&nbsp;</span></div></h3>
        <AnnualRevenueTriLineChart data={warWOpex}/>
      </div>
    </>
  )
}

export default AnnualSummary
