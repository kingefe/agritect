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
        <div class="sidebar">
          <div class="sidebar__list">

            <nav class="navbar" id="sidebar-project-list">
              <a class="navbar-brand navbar-brand--dark" href="#">
                <img src="<? echo get_template_directory_uri() ?>/assets/images/logo-agritecture.svg" alt="" height="40">
                <h1><strong>Agritecture</strong><br/><small>Designer</small></h1>
              </a>

              <ul class="nav flex-column">
                <li class="nav-item">
                  <a class="nav-link" href="/dashboard">
                    <span class="menu-icon">
                      <img src="<? echo get_template_directory_uri(); ?>/assets/images/icons/dashboard/icon-vision.svg" alt="">
                    </span>
                    <span>Vision</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link active" href="/dashboard/#/projects/all">
                    <span class="menu-icon">
                      <img src="<? echo get_template_directory_uri(); ?>/assets/images/icons/dashboard/icon-folder.svg" alt="">
                    </span>
                    <span>Projects</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/dashboard/inspirations">
                    <span class="menu-icon">
                      <img src="<? echo get_template_directory_uri(); ?>/assets/images/icons/dashboard/icon-concept.svg" alt="">
                    </span>
                    <span>Inspiration</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="/dashboard/account">
                    <span class="menu-icon">
                      <img width="20" src="<? echo get_template_directory_uri(); ?>/assets/images/icons/dashboard/Icon/Account Setting Black.svg" alt="">
                    </span>
                    <span>Account</span>
                  </a>
                </li>

                <li class="nav-item">
                  <a class="nav-link" href="<?=wp_logout_url()?>">
                    <span class="menu-icon">
                      <img width="20" src="<? echo get_template_directory_uri(); ?>/assets/images/icons/dashboard/Icon/Log out Black.svg" alt=""></span>
                      <span>Logout</span>
                    </a>
                  </li>
                </ul>
              </nav>

            </div>
          </div>
        </div>

        <div class="dashboard__pane">
          <div data-behavior="TriggerModelViewer" data-wp-user-id="<?php echo get_current_user_id(); ?>"></div>

          <div class="section section--grey text-center project-request-form" style="display: none;">
            <?php echo do_shortcode('[contact-form-7 id="285" title="Project Request Form"]'); ?>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    jQuery(document).ready(function() {
      if (jQuery('#jsProjectResults').length > 0) {
        jQuery('.project-request-form').show();
      }
    });
  </script>