<?php /* Template Name: Dashboard Template */ ?>
<?php /* Project Vision Results */

$project_detail_params = array(
  /*
  Array to be used to generate the table output for survey data.
  Field names must parallel the onboarding form questions:
   - assets/scripts/form-onboard.js
  'field_name' => array(
    'title'=>'Title Text',
  )
   */
  'role' => array(
    'title'=>'Your Role',
  ),
  'stage' => array(
    'title'=>'Project Stage',
  ),
  'goals' => array(
    'title'=>'Primary Goals',
  ),
  'farm_type' => array(
    'title'=>'Operation System',
  ),
  'locale' => array(
    'title'=>'Project Location',
  ),
  'crop' => array(
    'title'=>'Your Interested Crops',
  ),
  'distribution' => array(
    'title'=>'Distribution',
  )
);

?>

<div class="dashboard">
  <div class="container-fluid">
    <!-- This is where you can find code that shows the dashboard layout with Bootstrap: https://getbootstrap.com/docs/4.0/examples/dashboard/ -->
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-dashboard'); ?>
      </div>

      <div class="dashboard__pane">
        <section class="section project-details">
          <h2 class="text-uppercase"><div class="text-highlight"><span>Vision</span></div></h2>
          <p>Your Vision will serve as an important reference for your urban farming project. Your customized Vision Report and our recommended next steps that follow are intended to guide you as you make progress toward turning your concept into a reality.</p>

          <div class="vision-badges row">
            <?php foreach($project_detail_params as $field=>$details) { ?>
              <div class="parameter <?=$field?>">
                <span class="badges">
                </span>
              </div>
            <?php } ?>
          </div>
        </section>

        <?php
        // SOCIAL SHARE LINK PATHS
        // $action = array(
        //   'linkedin' => "window.open('https://www.linkedin.com/shareArticle?url='+encodeURIComponent(window.location.href)+'&title=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer:%20');return false;",
        //   'twitter' => "window.open('https://twitter.com/intent/tweet?url='+encodeURIComponent(window.location.href)+'&text=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer%3A%20');return false",
        //   'facebook' => "window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href));return false;",
        //   'whatsapp' => "window.open('https://wa.me/?text=Check out my Urban Farm Vision on Agritecture Designer: '+encodeURIComponent(window.location.href));return false;"
        // );
        ?>

        <section class="section social-share">
          <div class="container">
            <div class="row">
              <div class="title col-12 col-md-6 text-center">
                <h5>Get feedback on your Vision by sharing it!</h5>
              </div>
              <div class="social-icons col-12 col-md-6">
                <a href="#" id="dashboardShareLinkedIn" class="fab fa-linkedin" target="_blank">Linkedin</a>
                <a href="#" id="dashboardShareTwitter" class="fab fa-twitter" target="_blank">Twitter</a>
                <a href="#" id="dashboardShareFacebook" class="fab fa-facebook-square" target="_blank">Facebook</a>
                <a href="#" id="dashboardShareWhatsapp" class="fab fa-whatsapp-square" target="_blank">WhatsApp</a>
              </div>
            </div>
          </div>
        </section>

      </div>
    </div>
  </div>
</div>

<script>
  jQuery(document).ready(function() {
    // Need code to create the URL based on the vision page
    // copy the code from the $action code above and then implement it in JavaScript
    displayVisionBadges();
    displaySharingLinks();
  });
</script>