<?php /* Template Name: Dashboard Market Pricing Edit Template */ ?>
<!-- This is the collapsable navigation -->
<div class="dashboard">
  <div class="container-fluid">
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-project-icons'); ?>
      </div>


      <div class="dashboard__pane">
        <div class="section pb-2">
          <a class="text-white" href="/projects">< Back to All Projects</a>
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
              <a class="nav-link active" id="crop-pricing-tab" data-toggle="tab" href="#crop-pricing" role="tab" aria-controls="crop-pricing" aria-selected="true">Crop<br>Pricing</a>
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
              <h3 class="text-uppercase"><div class="text-highlight"><span>Crop&nbsp;</span></div><div class="text-highlight"><span>Pricing&nbsp;</span></div></h3>

              <p class="lead">Use this panel to calculate the pricing of your crop(s) through verified market research.</p>

              <p>Instructions: Find a similar product being sold at the same type of outlet you intend to sell through. For example, if you intend to sell Genovese Basil to local restaurants, research what similar restaurants are paying for their Basil. Under each crop type, enter up to 3 rows of information for that crop's Price, Sales Unit, and Quality Score. From their, we'll calculate a fair price for each crop. Don't worry, you can always override this calculation.</p>

              <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="home-tab" data-toggle="tab" href="#crop-1" role="tab" aria-controls="crop-1" aria-selected="true">Crop 1</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#crop-2" role="tab" aria-controls="crop-2" aria-selected="false">Crop 2</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#crop-3" role="tab" aria-controls="crop-3" aria-selected="false">Crop 3</a>
                </li>
              </ul>

              <div class="tab-content form-pricing" id="myTabContent">
                <div class="tab-pane fade show active" id="crop-1" role="tabpanel" aria-labelledby="crop-1-tab">

                  <!-- First row of price inputs -->
                  <form action="" class="form--dark">
                    <div class="row">
                      <div class="col-sm-8">
                        <div class="form-group">
                          <label for="">Crop Name</label>
                          <select name="" id="" class="form-control">
                            <option value="">Broccoli</option>
                            <option value="">Not Broccoli</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Percentage Allotment</label>
                          <div class="form-unit form-unit--right">
                            <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100" step="1">
                            <div class="form-unit__type">%</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Price 1</label>
                          <div class="form-unit form-unit--left">
                            <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" step="1">
                            <div class="form-unit__type">$</div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Unit</label>
                          <select class="form-control" name="" id="">
                            <option value="">OZ</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Quality Score</label>
                          <select class="form-control" name="" id="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Second row of price inputs -->
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Price 2</label>
                          <div class="form-unit form-unit--left">
                            <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" step="1">
                            <div class="form-unit__type">$</div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Unit</label>
                          <select class="form-control" name="" id="">
                            <option value="">OZ</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Quality Score</label>
                          <select class="form-control" name="" id="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Third row of price inputs -->
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Price 3</label>
                          <div class="form-unit form-unit--left">
                            <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" step="1">
                            <div class="form-unit__type">$</div>
                          </div>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Unit</label>
                          <select class="form-control" name="" id="">
                            <option value="">OZ</option>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Quality Score</label>
                          <select class="form-control" name="" id="">
                            <option value="">1</option>
                            <option value="">2</option>
                            <option value="">3</option>
                            <option value="">4</option>
                            <option value="">5</option>
                          </select>
                        </div>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-12"><hr></div>
                      <div class="col-sm-4">
                        <div class="text-right">
                          Calculated Price: 
                          <br>
                          <h3 class="lead">$3.10</h3>
                        </div>    
                      </div>
                      <div class="col-sm-4">
                        <div class="form-group">
                          <label for="">Unit</label>
                          <select class="form-control" name="" id="">
                            <option value="">OZ</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-4">
                        <a class="btn btn-block btn-primary mt-4" href="/dashboard/projects/project-results">Save Results</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>  


        <div class="section section--grey px-5 text-center">
          <?php echo do_shortcode('[contact-form-7 id="107" title="Project Help Request Form"]'); ?>
        </div>
      </div>
    </div>
  </div>