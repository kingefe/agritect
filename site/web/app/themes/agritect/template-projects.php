<?php /* Template Name: Dashboard Projects Template */ ?>
<style>
  body {
    padding-top: 0;
    padding-bottom: 0;
  }

  .site-footer, .navbar--main {
    display: none;
  }
</style>

<div class="dashboard">
  <div class="container-fluid">
    <div class="row row--nowrap">

      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-dashboard'); ?>
      </div>

        <div class="dashboard__pane">
          <div data-behavior="TriggerModelViewer" data-wp-user-id="<?php echo get_current_user_id(); ?>"></div>

          <div class="section section--grey px-5 text-center">
            <?php echo do_shortcode('[contact-form-7 id="285" title="Project Request Form"]'); ?>

            <div class="row">
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
  </div>