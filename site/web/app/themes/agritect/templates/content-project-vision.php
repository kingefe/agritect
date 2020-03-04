<?php /* New Project Questionnaire Layout */
$user = wp_get_current_user();
?>

<style>
  body {
    padding-top: 0;
  }

  .navbar, .site-footer {
    display: none;
  }

  /*include wordbreak: break-word or reword some of the things*/
</style>

<header class="questionnaire-header">
  <a class="navbar-brand navbar-brand--center" href="<?=get_home_url();?>">
    <img src="<? echo get_template_directory_uri() ?>/assets/images/agritecture-logo.png" alt="" height="40">
    <h1>Agritecture<br /><small>Designer</small></h1>
  </a>
</header>

<div class="container">
  <!-- Just for development purposes -->
  <div class="form-message">
    <div class="form-message__text">
      <h1 id="jsFormMessage"></h1>
    </div>
  </div>

  <form id="js-quiz"
  data-wpID="<?=$user->ID?>"
  data-projectID="<?=array_key_exists('projectid',$_GET)?$_GET['projectid']:uniqid()?>"
  data-name="<?=$user->nickname?>"
  data-email="<?=$user->user_email?>"
  data-firebaseToken="<?=get_user_meta($user->ID, "firebase_token", true)?>"
  ></form>
</div>

<?php if(!is_user_logged_in()) { require('authform.php'); } ?>
