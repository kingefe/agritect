<?php /* Template Name: Dashboard Project New Template */ ?>

<style>
  .navbar.navbar-dark,
  .site-footer {
    display: none;
  }

  body {
    padding-top: 0;
  }
</style>

<!-- This is the collapsable navigation -->
<div class="dashboard">
  <div class="container-fluid">
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-project-icons'); ?>
      </div>

      <div class="dashboard__pane" data-spy="scroll" data-target="#sidebar-project-list" data-offset="0">
        <div class="section section--dark py-2">
          <?php get_template_part('templates/sidebar-navbar'); ?>
          <a class="text-white" href="/dashboard/projects">< Back to All Projects</a>
        </div>

        <div class="section section--dark">
          <form class="form-large" action="">

            <!-- Project Name Form Group -->
            <div id="project-name">
              <div class="form-group">
                <label class="sr-only" for="">Project Name</label>
                <input type="text" class="form-control form-control--transparent form-control--large" id="" aria-describedby="" placeholder="Name your project here">
              </div>
            </div>

            <!-- Location Form Groups -->
            <div id="location">
              <fieldset>
                <legend><h4>Location of your project:</h4></legend>

                <!-- should we just replace all of this with the map input? -->
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Zip Code</label>
                      <input type="number" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">City</label>
                      <input type="text" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">State/Province</label>
                      <input type="text" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Country</label>
                      <input type="text" class="form-control" id="" aria-describedby="" placeholder="">
                    </div>
                  </div>
                </div>
              </fieldset>

              <hr>
            </div>



            <!-- Operation Type Form Group -->
            <div id="operation-type">
              <div class="row">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="">
                      <h4>Your operation type: <span class="tooltip-icon" data-toggle="tooltip" data-placement="right" title="Tooltip on right">i</span></h4>
                    </label>
                    <select class="form-control" id="">
                      <option>Greenhouse - Rooftop</option>
                    </select>
                  </div>
                </div>
              </div>

              <hr>
            </div>


            <div id="space">
              <fieldset>
                <legend><h4>How will you obtain your land/building?</h4></legend>

                <div class="form-group form-group--flex">
                  <div class="form-check form-check-inline form-check--button">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                    <label class="form-check-label" for="inlineRadio1">Already Own</label>
                  </div>

                  <div class="form-check form-check-inline form-check--button">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                    <label class="form-check-label" for="inlineRadio2">Looking to buy</label>
                  </div>

                  <div class="form-check form-check-inline form-check--button">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                    <label class="form-check-label" for="inlineRadio3">Looking to rent</label>
                  </div>
                </div>
              </fieldset>

              <fieldset>
                <legend><h4>What's the cost of your space?</h4></legend>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                    <label for="">Price Per Square Foot</label>
                    <input type="number" class="form-control" id="" aria-describedby="" placeholder="">
                  </div>
                </div>
              </fieldset>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">
                      <h4>Site Area (in square feet):</h4>
                    </label>
                    <input type="number" class="form-control" id="" aria-describedby="" placeholder="">
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="">
                      <h4>% of Site Area Dedicated to Production:</h4>
                    </label>
                    <div class="form-unit form-unit--right">
                      <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="55" max="100">
                      <div class="form-unit__type">
                        %
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <hr>

              <div id="crops">
                <h4>Select your crop(s):</h4>

                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Crop 1</label>
                      <select class="form-control" id="">
                        <option>Broccoli</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Percentage of total</label>

                      <div class="form-unit form-unit--right">
                        <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                        <div class="form-unit__type">%</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Crop 2</label>
                      <select class="form-control" id="">
                        <option>Broccoli</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Percentage of total</label>
                      <div class="form-unit form-unit--right">
                        <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                        <div class="form-unit__type">%</div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Crop 3</label>
                      <select class="form-control" id="">
                        <option>Broccoli</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Percentage of total</label>
                      <div class="form-unit form-unit--right">
                        <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                        <div class="form-unit__type">%</div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for=""><h4>Select your grow system:</h4></label>
                  <select class="form-control" id="">
                    <option>Hydroponics: Nutrient Film Technique (NFT)</option>
                  </select>
                </div>

                <div class="form-group">
                  <div class="mb-2"><h4>Organic Production:</h4></div>
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                  </label>
                </div>
              </div>

              <hr>

              <div id="structure-type">
                <fieldset>
                  <legend><h4>Structure Type:</h4></legend>


                  <div class="form-group form-group--flex">
                    <div class="form-check form-check-inline form-check--button">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1">
                      <label class="form-check-label" for="inlineRadio1">Low Duty</label>
                    </div>

                    <div class="form-check form-check-inline form-check--button">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2">
                      <label class="form-check-label" for="inlineRadio2">Medium Duty</label>
                    </div>

                    <div class="form-check form-check-inline form-check--button">
                      <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" disabled>
                      <label class="form-check-label" for="inlineRadio3">High Duty</label>
                    </div>
                  </div>
                </fieldset>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="text-accent mb-3">Heating:</div>

                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="text-accent mb-3">Supplementary Lighting:</div>

                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                      </label>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <div class="text-accent mb-3">CO2 Injection:</div>

                      <label class="switch">
                        <input type="checkbox">
                        <span class="slider"></span>
                      </label>
                    </div>
                  </div>
                </div>              
              </div>

              <hr>

              <div id="financing">
                <div class="row">
                  <div class="col-md-9">
                    <div class="form-group">
                      <label for=""><h4>What is the primary means through which you intend to finance your project?</h4></label>

                      <select class="form-control" id="">
                        <option>New York</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Interest Rate</label>
                      <input type="number" class="form-control">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">Repayment Period in Years</label>
                      <input type="number" class="form-control">
                    </div>
                  </div>
                </div>

                <div><hr></div>
              </div>


              <div id="operating-costs">
                <fieldset>
                  <legend><h4>Override of any default operating costs:</h4></legend>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Water cost ($/gal)</label>
                        <div class="form-unit form-unit--left">
                          <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                          <div class="form-unit__type">$</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Avg farm worker labor rate ($/hour)</label>
                        <div class="form-unit form-unit--left">
                          <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                          <div class="form-unit__type">$</div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Electricity cost ($/kWh)</label>
                        <div class="form-unit form-unit--left">
                          <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                          <div class="form-unit__type">$
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Tax Rate</label>
                        <div class="form-unit form-unit--right">
                          <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                          <div class="form-unit__type">%</div>
                        </div>
                      </div>
                    </div>

                    <!-- TODO: Need to add in a dropdown here -->
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Gas Cost ($)</label>
                        <div class="form-unit form-unit--left">
                          <input type="number" class="form-control" id="" aria-describedby="" placeholder="" min="0" max="100">
                          <div class="form-unit__type">$
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>                  
                </fieldset>
              </div>


              <div class="text-center">
                <!-- <button class="btn btn-outline">See Results</button> -->
                <a href="/dashboard/projects/project-results" class="btn btn-outline">See Results</a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  });
</script>