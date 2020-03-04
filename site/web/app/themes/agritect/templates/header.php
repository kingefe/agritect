<nav class="navbar navbar--main navbar-expand-md navbar-dark bg-dark fixed-top">
  <a class="navbar-brand" href="<?=get_home_url();?>">
    <!--<img src="<?=header_image();?>" alt="<?=get_bloginfo('name')?>" height="40" />-->
    <img src="<? echo get_template_directory_uri() ?>/assets/images/logo-agritecture.svg" alt="" height="40">
    <h1><strong>Agritecture</strong><br /><small>Designer</small></h1>
  </a>

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">

      <?php if (!is_user_logged_in()) : ?>

        <li class="nav-item">
          <a href="/project-vision" class="btn btn-primary">
            <div>
              <img height="14" src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/Icon/Add-Black.svg" alt="" style="vertical-align: top; padding-right: 0.25rem; position: relative; top: 2px;"> 
              <span>Build</span>
            </div>
          </a>
        </li>

        <li class="nav-item">
          <a href="<?=wp_login_url()?>" class="btn btn-transparent">Login</a>
        </li>

        <? else : ?>
          <?php echo do_shortcode('[pms-restrict subscription_plans="211,212,303" message=" "]<li class="nav-item"><a class="btn btn-outline" href="/dashboard/vision">Dashboard</a></li>[/pms-restrict]'); ?>

          <li class="nav-item">
            <a class="btn btn-transparent" href="/concept-report">
              <!-- <img height="32" src="<?php echo get_template_directory_uri() ?>/assets/images/icons/general/icon-profile.svg" alt=""> -->
              Vision Report
            </a>
          </li>

          <?php echo do_shortcode('[pms-restrict subscription_plans="211,212,303" message=" "]<style>.nav-item--upgrade{display:none;}</style>[/pms-restrict]'); ?>

          <li class="nav-item nav-item--upgrade">
            <a href="/plans" class="btn btn-primary">Upgrade</a>
          </li>

          <li class="nav-item">
            <a class="btn btn-transparent" href="<?=wp_logout_url()?>">Log out</a>
          </li>
        <? endif; ?>

      </ul>
    </div>
  </nav>


  <header class="banner nolazy" style="display: none;">
    <div class="container"><div class="row">

      <div class="col-auto">
        <a class="navbar-brand" href="<?=get_home_url();?>">
          <!--<img src="<?=header_image();?>" alt="<?=get_bloginfo('name')?>" height="40" />-->
          <h1>Agritecture<br /><small>Designer</small></h1>
        </a>
      </div>

      <div class="col-auto">
        <a href="/project-vision" class="btn btn-primary">
          <span style="font-size: 120%; margin-right: 1rem;">+</span> Build
        </a>
        <a href="#" class="btn btn-transparent">
          Login
        </a>
      </div>

    </div></div>
  </header>


  <?php
          // $user_ID = get_current_user_id();
          // $user = new WP_User($user_ID);
          // // THIS IS AN ARRAY, YAY
          // $user_roles = $user->roles;
          // print_r($user_roles);

          // foreach($user_roles as $user_role) {
          //   if ($user_role == "customer") {
          //     echo "This user is a customer!";
          //   }
          // }
          // $all_meta_for_user = get_user_meta( $user_ID );
          // $caps = get_user_meta($user->ID, 'wp_capabilities', true);
          // $roles = array_keys((array)$caps);
          // print_r($caps);

          // $user = new WP_User( $user_id );
          // print_r($user_roles);
          // $user_roles = $user->roles;
          // print_r($user_roles);
          // print_r($roles[0]);
          // print_r( $all_meta_for_user );
          // $registered_user = get_field('registered_user', 'user_1');
          // echo $registered_user;

        ?>


