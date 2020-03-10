import React from 'react'
import { numberWithCommas } from './utils'
import InfoIcon from './InfoIcon'
import { 
  opexInfo, 
  paybackPeriodInfo, 
  ebidtaInfo, 
  netProfitInfo,
  jobsCreatedInfo,
  populationFedInfo,
  bedspaceInfo,
  wastageInfo,
  wasteAdjustedRevenue
} from './info'


const FinancialOverview = ({report}) => {
  const financialSummary = report["financial summary"][0]
  const operatingSummaryArray = report["operating summary"]

  console.log("inside FinancialOverView, report is: ", report)
  console.log("operatingSummaryArray is: ", operatingSummaryArray)
  return(
    <>
      <div>
        <h3 className="text-uppercase"><div className="text-highlight"><span>Financial&nbsp;</span></div><div className="text-highlight"><span>Overview</span></div></h3>
        <p className="lead">Note: these results are based on default Crop Pricing values from the Agritecture database. For more accurate results, please update the values in the Crop Pricing section.</p>
        
        <table className="table table-dark table--overview table--fixed text-center">
          <tr>
            <td>
              <h2 className="text-accent mb-2">${numberWithCommas(financialSummary["capex"])}<br/><small><strong>total</strong></small></h2>
              Capital Expenses<br/>(Capex)
            </td>

            <td>
              <h2 className="text-accent mb-2">${numberWithCommas(financialSummary["opex + cogs"])}<br/><small><strong>/ year</strong></small></h2>
              Operating Expenses + COGS<br/>
              {`(Opex) `}<br/>
              <InfoIcon position="right" content={opexInfo} target="opex"/>
            </td>
          </tr>

          <tr>
            <td>
              <h2 className="text-accent mb-2">${numberWithCommas(financialSummary["max annual revenue"])}<br/><small><strong>/ year</strong></small></h2>
              Max Annual Revenue
            </td>

            <td>
              <h2 className="text-accent mb-2">{financialSummary["payback period"] ? ` ${financialSummary["payback period"]} years`: "> 15 years"}<br/><small><strong>years</strong></small></h2>
              {`Payback Period (in years) `}<br/>
              <InfoIcon position="right" content={paybackPeriodInfo} target="payback-period"/>
            </td>
          </tr>
        </table>
      </div>

      <h3 class="text-uppercase"><div class="text-highlight"><span>10-Year&nbsp;</span></div><div class="text-highlight"><span>Operating&nbsp;</span></div><div class="text-highlight"><span>Summary</span></div></h3>

      <div className="table-wrapper table-wrapper--overflow">  
        <table className="table table-dark">
          <thead className="thead-light">
            <tr>
              <th></th>
              <th scope="col">Year 1</th>
              <th scope="col">Year 5</th>
              <th scope="col">Year 10</th>
            </tr>
          </thead>

          <tbody>
            {['waste-adjusted revenue', 'wastage', 'ebitda', 'ebitda margin', 'net profit', 'net margin'].map((category) => {
              if (category != "year")
                return(
                <tr>
                  <OperatingSummaryColumnRow category={category}/>
                  <OperatingSummaryColumn operatingSummary={operatingSummaryArray} category={category} columnIndex={0}/>
                  <OperatingSummaryColumn operatingSummary={operatingSummaryArray} category={category} columnIndex={1}/>
                  <OperatingSummaryColumn operatingSummary={operatingSummaryArray} category={category} columnIndex={2}/>
                </tr>
                )
            })}
          </tbody>
        </table>
      </div>

      <div>
        <h3 className="text-uppercase"><div className="text-highlight"><span>Production&nbsp;</span></div><div className="text-highlight"><span>Summary</span></div></h3>
        
        <table className="table table-dark table--overview table--fixed text-center">
          <tr>
            <td>
              <h2 className="text-accent mb-2">{report["number of people employed"]}</h2>
              {`Estimated Jobs Created `}<br/>
              <InfoIcon position="right" content={jobsCreatedInfo} target="jobs-creates"/>
            </td>
            <td>
              <h2 className="text-accent mb-2">{numberWithCommas(report["potential population fed"])}</h2>
              Potential Population Fed (Daily)<br/>
              <InfoIcon position="right" content={populationFedInfo} target="population-fed"/>

            </td>
          </tr>

          <tr>
            <td>
              <h2 className="text-accent mb-2">{numberWithCommas(report["bedspace"])}</h2>
              Required Bedspace (sq ft)<br/>
              <InfoIcon position="right" content={bedspaceInfo} target="bedspace"/>

            </td>
            <td>
              <h2 className="text-accent mb-2">{numberWithCommas(report["max total yield"])}</h2>
              Max. Annual Yield (lbs)
            </td>
          </tr>
        </table>
      </div>

    </>
  )
}

const OperatingSummaryColumnRow = ({category}) => {

  switch (category) {
    case 'ebitda':                    return <th scope="row">{`EBITDA `}<InfoIcon content={ebidtaInfo} target="ebitda"/></th>
    case 'ebitda margin':             return <th scope="row">EBITDA Margin</th>
    case 'wastage':                   return <th scope="row">{`Wastage `}<InfoIcon content={wastageInfo} target="wastage"/></th>
    case 'net margin':                return <th scope="row">Net Margin</th>
    case 'waste-adjusted revenue':    return <th scope="row">{`Waste Adjusted Revenue `}<InfoIcon content={wasteAdjustedRevenue} target="waste-adjusted-revenue"/></th>
    case 'net profit':                return <th scope="row">{`Net Profit `}<InfoIcon content={netProfitInfo} target="net-profit"/></th>
    default:                          return <th scope="row">{category}</th>
  }
}

const OperatingSummaryColumn = ( {operatingSummary, category, columnIndex} ) =>{
  if (category == "ebitda margin" || category == "net margin" || category == "wastage"){
    return (
      <td>
        {
          numberWithCommas(operatingSummary[columnIndex][category]) < 0 ?
          `-${Math.abs(numberWithCommas(operatingSummary[columnIndex][category])*100).toFixed(2)} %`
        :
        `${Math.abs(numberWithCommas(operatingSummary[columnIndex][category])*100).toFixed(2)} %`
        }
      </td>
    )
  }
  else{
    return (
      <td>
        {numberWithCommas(operatingSummary[columnIndex][category]) < 0 ?
        `-$${Math.abs(numberWithCommas(operatingSummary[columnIndex][category]))}`
        :
        `$${numberWithCommas(operatingSummary[columnIndex][category])}`
        }
      </td>
    ) 
  }
}

export default FinancialOverview