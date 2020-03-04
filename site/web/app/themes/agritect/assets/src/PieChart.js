import React from 'react';
import Plot from 'react-plotly.js';

const clickPie = (e) => {
  jQuery(e.target).addClass('hover');
}

export const PieChart = ({data, labels, layout}) => {
  console.log("Inside PieChart, points are: ", data, "labels are: ", labels)
  return(
    <div className="exp-piechart">
      <Plot
      onClick={clickPie}
      data={[{
        values: data,
        labels: labels,
        type: 'pie',
        textinfo: 'none',
        automargin: true
      }]}
      layout={{
        title: '',
        autosize: true
      }}
      useResizeHandler={true}
      style={{
        width: "100%", 
        height: "100%"
      }}
      />
    </div>
  )
}
