<?php /* Template Name: Input Sandbox Template */ ?>

<section class="section">
  <div class="form-range form-range--dark">
    <input type="range" class="form-control--range" min="50" max="85" step="5">

    <div class="form-range__intervals">
      <span class="form-range__interval">50%</span>
      <span class="form-range__interval">55%</span>
      <span class="form-range__interval">60%</span>
      <span class="form-range__interval">65%</span>
      <span class="form-range__interval">70%</span>
      <span class="form-range__interval">75%</span>
      <span class="form-range__interval">80%</span>
      <span class="form-range__interval">85%</span>
    </div>
  </div>
</section>


<!-- This is if you want to show the current output value -->
<div class="form-range form-range--dark">
  <input type="range" class="form-control--range" id="productionAreaInput" min="50" max="85" step="5" oninput="productionAreaOutput.value = productionAreaInput.value">
  <span><output name="productionArea" id="productionAreaOutput"></output>%</span>

  <div class="form-range__intervals">
    <span class="form-range__interval">50%</span>
    <span class="form-range__interval">55%</span>
    <span class="form-range__interval">60%</span>
    <span class="form-range__interval">65%</span>
    <span class="form-range__interval">70%</span>
    <span class="form-range__interval">75%</span>
    <span class="form-range__interval">80%</span>
    <span class="form-range__interval">85%</span>
  </div>
</div>

<section class="section dashboard">
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div>Styling Number Inputs with Percentages and Currency</div>
        <div class="form-group">
          <label for="">Tax Rate</label>
          <input type="text" class="form-control">
        </div>
      </div>


      <div class="col-12">
        <div>Add up to 3 crops</div>
        <button id="jsAddCrop" type="button">Add Crop</button>
        <table class="table table--crops">
          <thead>
            <tr>
              <th>Crop Name</th>
              <th>Percentage of total</th>
            </tr>
          </thead>

          <!-- Crop row -->
          <!-- Use JS to add these rows -->
          <tbody>
            <tr>
              <td>
                <select name="" id="">
                  <option value="">Crop 1</option>
                  <option value="">Crop 2</option>
                  <option value="">Crop 3</option>
                </select>
              </td>
              <td>
                <input class="crop-percentage" type="number" min="0" max="100" step="1">
                <span>%</span>
              </td>
            </tr>

            <tr>
              <td>
                <select name="" id="">
                  <option value="">Crop 1</option>
                  <option value="">Crop 2</option>
                  <option value="">Crop 3</option>
                </select>
              </td>
              <td>
                <input class="crop-percentage" type="number" min="0" max="100" step="1">
                <span>%</span>
              </td>
            </tr>


            <tr>
              <td>
                <select name="" id="">
                  <option value="">Crop 1</option>
                  <option value="">Crop 2</option>
                  <option value="">Crop 3</option>
                </select>
              </td>
              <td>
                <input class="crop-percentage" type="number" min="0" max="100" step="1">
                <span>%</span>
              </td>
            </tr>
          </tbody>

          <tfoot>
            <tr>
              <td></td>
              <td></td>
              <td>
                <div>
                  <span id="jsTotalPercentage"></span>%
                </div>
                <div>
                  <span id="jsRemainingPercentage"></span>% remaining
                </div>
              </td>
            </tr>
          </tfoot>


        </table>
      </div>
    </div>
  </div>
</section>

<script type="text/javascript">
  jQuery(function() {
    var totalCropPercentage = 0;
    
    jQuery('.crop-percentage').blur(function(e) {
      console.log('you changed a percentage input');

      jQuery('.crop-percentage').each(function() {
        totalCropPercentage += Number($(this).val());
      });

      jQuery('#jsTotalPercentage').val(totalCropPercentage);
      jQuery('#jsRemainingPercentage').val(100 - totalCropPercentage);
    });
  });
</script>