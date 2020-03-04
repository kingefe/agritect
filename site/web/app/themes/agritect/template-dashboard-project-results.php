<?php /* Template Name: Dashboard Project Results Template */ ?>
<!-- This is the collapsable navigation -->
<div class="dashboard">
  <div class="container-fluid">
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-project-icons'); ?>
      </div>


      <div class="dashboard__pane">
        <div class="section py-2">
          <?php get_template_part('templates/sidebar-navbar'); ?>
          <a href="/projects">< Back to All Projects</a>
        </div>
        <div class="section">
          <div class="row">
            <div class="col-sm-8">
              <h2 class="text-uppercase mb-4">
                <div class="text-highlight"><span>Vertical&nbsp;</span></div><div class="text-highlight"><span>X</span>
                </div>
              </h2>
            </div>
            <div class="col-sm-4">
              <div class="mb-2 text-right">
                <a href="#" class="btn btn-primary">Edit Project</a>
                <br>
              </div>
            </div>
          </div>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
           <li class="nav-item">
            <a class="nav-link" id="crop-pricing-tab" data-toggle="tab" href="#crop-pricing" role="tab" aria-controls="crop-pricing" aria-selected="true">Crop<br>Pricing</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="financial-overview-tab" data-toggle="tab" href="#financial-overview" role="tab" aria-controls="financial-overview" aria-selected="true">Financial<br>Overview</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="capex-breakout-tab" data-toggle="tab" href="#capex-breakout" role="tab" aria-controls="capex-breakout" aria-selected="false">Capex<br>Breakout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="opex-breakout-tab" data-toggle="tab" href="#opex-breakout" role="tab" aria-controls="opex-breakout" aria-selected="false">Opex<br>Breakout</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="annual-summary-tab" data-toggle="tab" href="#annual-summary" role="tab" aria-controls="annual-summary" aria-selected="false">Annual<br>Summary</a>
          </li>
        </ul>

        <div class="tab-content" id="myTabContent">
          

          <div class="tab-pane fade show active" id="crop-pricing" role="tabpanel" aria-labelledby="crop-pricing-tab">
            <div class="mb-3"></div>
            
            <h3 class="text-uppercase"><div class="text-highlight"><span>Crop&nbsp;</span></div><div class="text-highlight"><span>Pricing&nbsp;</span></div></h3>

            <p class="lead">
              Your project is currently using <strong>default values</strong> from the Agritecture Database. To get more accurate results for your project, please edit the values below with pricing from your market research.
            </p>

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
                <tr>
                  <th scope="row">Broccoli</th>
                  <td>$5.00</td>
                  <td>Pound</td>
                  <td>20%</td>
                </tr>
                <tr>
                  <th scope="row">Brussels Sprouts</th>
                  <td>$6.53</td>
                  <td>Pound</td>
                  <td>30%</td>
                </tr>
                <tr>
                  <th scope="row">Spinach</th>
                  <td>$3.21</td>
                  <td>Pound</td>
                  <td>50%</td>
                </tr>
              </tbody>
            </table>

            <p>
              <a class="btn btn-primary" href="/dashboard/projects/project-results/crop-pricing-edit">Edit Prices</a>
            </p>

            <div>
              
            </div>
          </div>

          <div class="tab-pane fade" id="financial-overview" role="tabpanel" aria-labelledby="financial-overview-tab">

            <div>
              <h3 class="text-uppercase"><div class="text-highlight"><span>Financial&nbsp;</span></div><div class="text-highlight"><span>Overview</span></div></h3>

              <p class="lead">Note: these results are based on default Crop Pricing values from the Agritecture database. For more accurate results, please update the values in the Crop Pricing section.</p>

              <table class="table table-dark table--overview text-center">
                <tr>
                  <td>
                    <h2 class="text-accent mb-2">$776,698.68</h2>
                    Capital Expenses<br>
                    (Capex)
                  </td>

                  <td>
                    <h2 class="text-accent mb-2">$737,923.85</h2>
                    Operating Expenses<br>
                    (Opex/COGP)
                  </td>
                </tr>

                <tr>
                  <td>
                    <h2 class="text-accent mb-2">$1,012,712.49</h2>
                    Max. Annual Revenue
                  </td>

                  <td>
                    <h2 class="text-accent mb-2">7.89</h2>
                    Payback Period (in years)
                  </td>
                </tr>
              </table>
            </div>

            <div>
              <h3 class="text-uppercase"><div class="text-highlight"><span>10-Year&nbsp;</span></div><div class="text-highlight"><span>Operating&nbsp;</span></div><div class="text-highlight"><span>Summary</span></div></h3>

              <table class="table table-dark">
                <thead class="thead-light">
                  <tr>
                    <th></th>
                    <th scope="col">Year 1</th>
                    <th scope="col">Year 5</th>
                    <th scope="col">Year 10</th>
                  </tr>
                </thead>

                <tbody>
                  <tr>
                    <th scope="row">Wastage</th>
                    <td>12.42%</td>
                    <td>8.51%</td>
                    <td>5.99%</td>
                  </tr>
                  <tr>
                    <th scope="row">Waste-adjusted Revenue</th>
                    <td>886,934</td>
                    <td>926,480</td>
                    <td>952,091</td>
                  </tr>
                  <tr>
                    <th scope="row">EBITDA</th>
                    <td>202,079</td>
                    <td>241,626</td>
                    <td>267,237</td>
                  </tr>
                  <tr>
                    <th scope="row">EBITDA Margin</th>
                    <td>22.78%</td>
                    <td>26.08%</td>
                    <td>28.07%</td>
                  </tr>
                  <tr>
                    <th scope="row">Net Profit</th>
                    <td>5,074</td>
                    <td>34,299</td>
                    <td>158,269</td>
                  </tr>
                  <tr>
                    <th scope="row">Net Margin</th>
                    <td>0.57%</td>
                    <td>3.70%</td>
                    <td>16.62%</td>
                  </tr>
                </tbody>
              </table>
            </div>


          </div>

          <div class="tab-pane fade" id="capex-breakout" role="tabpanel" aria-labelledby="capex-breakout">
            <h3 class="text-uppercase"><div class="text-highlight"><span>Capex&nbsp;</span></div><div class="text-highlight"><span>Breakout&nbsp;</span></div></h3>

            <table class="table table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Category</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">% of Total</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">Grow System</th>
                  <td>$91,200.00</td>
                  <td>11.7%</td>
                </tr>
                <tr>
                  <th scope="row">Lighting</th>
                  <td>$267,840.00</td>
                  <td>34.5%</td>
                </tr>
                <tr>
                  <th scope="row">HVAC</th>
                  <td>$86,780.56</td>
                  <td>11.2%</td>
                </tr>
                <tr>
                  <th scope="row">Racking</th>
                  <td>$167,066.61</td>
                  <td>21.83%</td>
                </tr>
                <tr>
                  <th scope="row">Seeding</th>
                  <td>#37,557.44</td>
                  <td>4.8%</td>
                </tr>
                <tr>
                  <th scope="row">Propogation</th>
                  <td>$1,500.00</td>
                  <td>0.2%</td>
                </tr>
                <tr>
                  <th scope="row">Processing</th>
                  <td>$90,500.00</td>
                  <td>11.7%</td>
                </tr>
                <tr>
                  <th scope="row">Cold Storage</th>
                  <td>$5,882.40</td>
                  <td>0.8%</td>
                </tr>
                <tr>
                  <th scope="row">Real Estate</th>
                  <td>$0.00</td>
                  <td>0.0%</td>
                </tr>
                <tr>
                  <th scope="row">Building Renovations</th>
                  <td>$28,371.68</td>
                  <td>3.7%</td>
                </tr>
              </tbody>

              <tfoot>
                <tr>
                  <th scope="row">Total</th>
                  <td>$776,698.68</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="tab-pane fade" id="opex-breakout" role="tabpanel" aria-labelledby="opex-breakout">
            <h3 class="text-uppercase"><div class="text-highlight"><span>Opex&nbsp;</span></div><div class="text-highlight"><span>Breakout&nbsp;</span></div></h3>

            <table class="table table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Category</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">% of Total</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">Real Estate</th>
                  <td>$0.00</td>
                  <td>0%</td>
                </tr>
                <tr>
                  <th scope="row">Equipment</th>
                  <td>$267,840.00</td>
                  <td>34.5%</td>
                </tr>
                <tr>
                  <th scope="row">Materials/Footing</th>
                  <td>$86,780.56</td>
                  <td>11.2%</td>
                </tr>
                <tr>
                  <th scope="row">Hydroponic Equipment</th>
                  <td>$167,066.61</td>
                  <td>21.83%</td>
                </tr>
                <tr>
                  <th scope="row">Headhouse (storage)</th>
                  <td>#37,557.44</td>
                  <td>4.8%</td>
                </tr>
                <tr>
                  <th scope="row">Construction Mgmt</th>
                  <td>$1,500.00</td>
                  <td>0.2%</td>
                </tr>
                <tr>
                  <th scope="row">Propogation</th>
                  <td>$90,500.00</td>
                  <td>11.7%</td>
                </tr>
                <tr>
                  <th scope="row">Processing</th>
                  <td>$5,882.40</td>
                  <td>0.8%</td>
                </tr>
                <tr>
                  <th scope="row">Freight</th>
                  <td>$0.00</td>
                  <td>0.0%</td>
                </tr>
              </tbody>

              <tfoot>
                <tr>
                  <th scope="row">Total</th>
                  <td>$776,698.68</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>

          <div class="tab-pane fade" id="annual-summary" role="tabpanel" aria-labelledby="annual-summary">
            <h3 class="text-uppercase"><div class="text-highlight"><span>Annual&nbsp;</span></div><div class="text-highlight"><span>Summary&nbsp;</span></div></h3>
            <!-- We need d3.js to include graphs here and we need to make this table overflow: scroll horizontal -->
            <table class="table table-dark">
              <thead class="thead-light">
                <tr>
                  <th scope="col">Category</th>
                  <th scope="col">Total Price</th>
                  <th scope="col">% of Total</th>
                </tr>
              </thead>

              <tbody>
                <tr>
                  <th scope="row">Real Estate</th>
                  <td>$0.00</td>
                  <td>0%</td>
                </tr>
                <tr>
                  <th scope="row">Equipment</th>
                  <td>$267,840.00</td>
                  <td>34.5%</td>
                </tr>
                <tr>
                  <th scope="row">Materials/Footing</th>
                  <td>$86,780.56</td>
                  <td>11.2%</td>
                </tr>
                <tr>
                  <th scope="row">Hydroponic Equipment</th>
                  <td>$167,066.61</td>
                  <td>21.83%</td>
                </tr>
                <tr>
                  <th scope="row">Headhouse (storage)</th>
                  <td>#37,557.44</td>
                  <td>4.8%</td>
                </tr>
                <tr>
                  <th scope="row">Construction Mgmt</th>
                  <td>$1,500.00</td>
                  <td>0.2%</td>
                </tr>
                <tr>
                  <th scope="row">Propogation</th>
                  <td>$90,500.00</td>
                  <td>11.7%</td>
                </tr>
                <tr>
                  <th scope="row">Processing</th>
                  <td>$5,882.40</td>
                  <td>0.8%</td>
                </tr>
                <tr>
                  <th scope="row">Freight</th>
                  <td>$0.00</td>
                  <td>0.0%</td>
                </tr>
              </tbody>

              <tfoot>
                <tr>
                  <th scope="row">Total</th>
                  <td>$776,698.68</td>
                  <td></td>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
      </div>



      <div class="section section--grey px-5 text-center">
          <!-- <h3 class="text-uppercase"><div class="text-highlight"><span>Tell&nbsp;</span></div><div class="text-highlight"><span>us&nbsp;</span></div><div class="text-highlight"><span>what's&nbsp;</span></div><div class="text-highlight"><span>next&nbsp;</span></div></h3>

            <p>Select the right option(s) from our recommended next steps, <br>and we'll expedite your request with our expert consultants.</p> -->

            <?php echo do_shortcode('[contact-form-7 id="285" title="Project Request Form"]'); ?>

            <div class="row" style="display: none;">
              <div class="col-md-4">
                <div class="px-4 py-4">
                  <a href="#" class="card card--cta">
                    <div class="card-img-wrapper">
                      <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-projections.svg" alt="" class="card-img-top">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">
                        Get help improving projections
                      </h5>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-4">
                <div class="px-4 py-4">
                  <a href="#" class="card card--cta">
                    <div class="card-img-wrapper">
                      <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-equipment-advice.svg" alt="" class="card-img-top">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">
                        Get advice selecting equipment
                      </h5>
                    </div>
                  </a>
                </div>
              </div>

              <div class="col-md-4">
                <div class="px-4 py-4">
                  <a href="#" class="card card--cta">
                    <div class="card-img-wrapper">
                      <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-3d-farm-design.svg" alt="" class="card-img-top">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">
                        Request 3D farm design
                      </h5>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>