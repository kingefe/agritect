import React from 'react';
import Plot from 'react-plotly.js';

export const NetProfitLineChart = ({data, labels}) => {
  console.log("Inside LineChart, points are: ", data, "labels are: ", labels)

  let netProfit = {
    name: 'Profit',
    x: data.map(year => year.x + 1),
    y: data.map(year => year.y),
    type: 'scatter',
    showlegend: true,
  };

  return(
    <div style={{borderColor: 'black', borderStyle: 'solid'}}>
      <Plot
        data={[netProfit]}
        layout={ {
          width: 'max', 
          height: 'max', 
          title: 'Net Profit',

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
            visible: true,
            title: {
              text: 'Profit',
              font:{
                family: '',
                size: '',
                color: ''
              }
            }
          }
        }}
      />
    </div>
  )
}