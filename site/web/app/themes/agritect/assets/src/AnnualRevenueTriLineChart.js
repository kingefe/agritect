import React from 'react';
import Plot from 'react-plotly.js';
import { useState } from 'react';

export const AnnualRevenueTriLineChart = ({data}) => {

  const [width, setWidth] = useState(window.innerWidth);

  console.log("Inside AnnualRevenueTriLineChart, data is: ", data)

  let wasteAdjustedRevenue = {
    name: 'Waste-adjusted Revenue',
    x: data[0].map(year => year.x + 1),
    y: data[0].map(year => year.y),
    type: 'scatter',
    showlegend: true,

  };

  let wastage = {
    name: 'Wastage',
    x: data[1].map(year => year.x + 1),
    y: data[1].map(year => year.y*100),
    type: 'scatter',
    mode: 'lines',
    line: {
      dash: 'dash',
      width: 4
    },
    showlegend: true,
    yaxis: 'y2'
  }

  let opex = {
    name: 'Opex + COGS',
    x: data[2].map(year => year.x + 1),
    y: data[2].map(year => year.y),
    type: 'scatter',
    showlegend: true,
  }

  console.log("opex is: ", opex)

  return(
    <div >
      <Plot
        style={{width: '100%', height: '100%'}}
        data={[wasteAdjustedRevenue, wastage, opex]}
        layout={ {
          autosize: true,
          title: '',
          autosize: true,
          xaxis: {
            visible: true,
            title: {
              text: 'Year',
              font:{
                family: '',
                size: '',
                color: ''
              }
            }
          },
          yaxis: {
            tickmode: 'array',
            // tickvals: [1, 2, 3, 4, 5],
            // ticktext: ["hey", "ho", "hey", "ho"],
            visible: true,
            title: {
              text: '',
              font:{
                family: '',
                size: '',
                color: ''
              }
            }
          },
          yaxis2: {
            title: '',
            overlaying: 'y',
            side: 'right',
          }
        }}
      />
    </div>
  )
}
