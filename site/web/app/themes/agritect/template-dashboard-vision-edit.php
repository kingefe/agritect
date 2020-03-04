<?php /* Template Name: Dashboard Vision Edit Template */ ?>
<div class="dashboard">
  <div class="container-fluid">

    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-dashboard'); ?>
      </div>

      <!-- Projects Index -->
      <div class="dashboard__pane">
        <div class="section py-4">
          <?php get_template_part('templates/sidebar-navbar'); ?>
        </div>

        <div class="section pt-2">
          <h2 class="text-uppercase"><div class="text-highlight"><span>Vision</span></div></h2>

          <p>Your Vision will serve as an important reference for your urban farming project. Your customized Vision Report and our recommended next steps that follow are intended to guide you as you make progress toward turning your concept into a reality.</p>

          <!-- This is currently loading in all the questions, which is good -->
          <div class="accordion vision-edit" id="projectVisionEdit"></div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  jQuery(document).ready(function() {
    jQuery('#projectVisionEdit').append(displayAllEdits(allQuestions));
  });
</script>