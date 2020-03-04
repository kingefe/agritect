import React from 'react'
import { numberWithCommas } from './utils'

export const AnnualSummaryTable = ({data}) => {
  return(
    <>
      <div className="py-4">  
        <h3 class="text-uppercase"><div class="text-highlight"><span>15 Year&nbsp;</span></div><div class="text-highlight"><span>Operating&nbsp;</span></div><div class="text-highlight"><span>Summary</span></div></h3>

        <div class="table-wrapper table-wrapper--overflow">
        <table className="table table-dark">
          <thead className="thead-light">
            <tr>
              <th>Year</th>
                {
                  data.map((year, i) => {
                    return <th scope="col">{`${i+1}`}</th>
                  })
                }
            </tr>
          </thead>

          <tbody>
            {summaryCategories.map((category) => {
              if (category != "year")
                return(
                <tr>
                  <AnnualSummaryColumnRow category={category}/>
                  {Object.keys(data).map((year) => {
                    return <AnnualSummaryColumn annualSummary={data} category={category} columnIndex={year}/>
                  })}
                </tr>
                )
            })}
          </tbody>
        </table>
        </div>
      </div>
    </>
  )
}

const summaryCategories = ["waste-adjusted revenue", 
    "total yield", 
    "wastage", 
    "cogs", 
    "opex", 
    "cogs + opex", 
    "ebitda", 
    "depreciation & amortization", 
    "interest payment", 
    "taxes", 
    "net profit"
  ]

const AnnualSummaryColumnRow = ({category}) => {

  switch (category) {
    case 'cogs':                          return <th scope="row">{`COGS `}</th>
    case 'depreciation & amortization':   return <th scope="row">{`Depreciation & Amortization`}</th>
    case 'ebitda':                        return <th scope="row">EBITDA</th>
    case 'interest payment':              return <th scope="row">Interest Payment</th>
    case 'net profit':                    return <th scope="row">{`Net Profit `}</th>
    case 'opex':                          return <th scope="row">{`Opex `}</th>
    case 'cogs + opex':                   return <th scope="row">{`COGS + Opex `}</th>
    case 'taxes':                         return <th scope="row">{`Taxes `}</th>
    case 'total yield':                   return <th scope="row">Total Yield</th>
    case 'wastage':                       return <th scope="row">{`Wastage `}</th>
    case 'waste-adjusted revenue':        return <th scope="row">{`Waste Adjusted Revenue `}</th>
    default:                              return <th scope="row">{category}</th>
  }
}

const AnnualSummaryColumn = ( {annualSummary, category, columnIndex} ) =>{
  if (category == "wastage"){
    return (
      <td>
        {
          numberWithCommas(annualSummary[columnIndex][category]) < 0 ?
          `-${numberWithCommas(Math.abs(annualSummary[columnIndex][category])*100).toFixed(2)} %`
        :
        `${(numberWithCommas(annualSummary[columnIndex][category])*100).toFixed(2)} %`
        }
      </td>
    )
  }else if(category == "cogs + opex"){
    let cogs = annualSummary[columnIndex]["cogs"]
    let opex = annualSummary[columnIndex]["opex"]
    let  cogsOpex = cogs + opex

    return (
      <td>
        ${numberWithCommas(cogsOpex)}
      </td>
    )
  }
  else{
    return (
      <td>
        {annualSummary[columnIndex][category] < 0 ?
        `-$${numberWithCommas(Math.abs(annualSummary[columnIndex][category]))}`
        :
        `$${numberWithCommas(annualSummary[columnIndex][category])}`
        }
      </td>
    )
  }
}
