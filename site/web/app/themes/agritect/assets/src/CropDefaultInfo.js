import React from 'react'
import { Link } from 'react-router-dom'


export const CropDefaultInfo = ({match, project, cropData}) => {

  const defaultCropPrices = project['default crop prices']

  return(
    <>
      <div class="tab-pane fade show active" id="crop-pricing" role="tabpanel" aria-labelledby="crop-pricing-tab">
        <div class="mb-3"></div>
        
        <h3 class="text-uppercase"><div class="text-highlight"><span>Crop&nbsp;</span></div><div class="text-highlight"><span>Pricing&nbsp;</span></div></h3>

        {
          defaultCropPrices ? 
            <p class="lead">
              Your project is currently using <strong>default values</strong> from the Agritecture Database. To get more accurate results for your project, please edit the values below with pricing from your market research.
            </p>
            :
            null
        }

        <table class="table table-dark table--fixed">
          <thead class="thead-light">
            <tr>
              <th scope="col">Crop Name</th>
              <th scope="col">Price</th>
              <th scope="col">Unit of Measurement</th>
              <th scope="col">Percentage of Allotment</th>
            </tr>
          </thead>

          <tbody>
            {
              Object.keys(cropData).map((cropId) => {
                return(
                  <tr>
                    <th scope="row">{cropData[cropId]['name']}</th>
                    <td>{defaultCropPrices ?  `$${parseFloat(cropData[cropId]['default price']).toFixed(2)}` : `$${parseFloat(cropData[cropId]['price per unit']).toFixed(2)}`}</td>
                    <td>{defaultCropPrices ? cropData[cropId]['default sale unit'] : cropData[cropId]['sale unit']}</td>
                    <td>{cropData[cropId]['fraction of bedspace']}%</td>
                  </tr>
                )
              })
            }
          </tbody>
        </table>

          <Link to={`${match.url}/pricing`} className='btn btn-primary'>Edit Prices</Link>

        <div>
          
        </div>
      </div>
    </>
  )
}