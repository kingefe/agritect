<?php /* Template Name: Dashboard Inspiration Template */

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


<!-- TODO: style the loading gif within the dashboard -->
<script>
  // $('#jsFormMessage').html(
  // '<img src="'+themeurl+'/assets/images/Agritecture-animated-logo.gif" class="loading" />'
  // );
</script>

<!-- TODO AS WELL - STYLE THE RANGE INPUT -->
<div class="dashboard">
  <div class="container-fluid">
    <!-- This is where you can find code that shows the dashboard layout with Bootstrap: https://getbootstrap.com/docs/4.0/examples/dashboard/ -->
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-dashboard'); ?>
      </div>

      <div class="dashboard__pane">
        <div class="section project-details">
          <h2 class="text-uppercase"><div class="text-highlight"><span>Inspirations</span></div></h2>

          <!-- <ul class="nav nav-pills nav-pills--light" id="myTab" role="tablist">
            <li class="nav-item mr-4">
              <span>Filter View</span>
            </li>
            <li class="nav-item">
              <a class="nav-link active" id="home-tab" data-toggle="tab" href="#crop-1" role="tab" aria-controls="crop-1" aria-selected="true">All</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" id="profile-tab" data-toggle="tab" href="#crop-2" role="tab" aria-controls="crop-2" aria-selected="false">Liked</a>
            </li>
          </ul> -->

          <!-- TODO: Run through inspiration loops here -->
          <section class="inspiration container">
            <div class="farms">
                <?php $n=0; while($n<1) { $n++; ?>
                  <div class="farm row">
                    <div class="col-md-5 col-12 image">
                      <img src="" alt="">
                    </div>
                    <div class="details col-12 col-md-7 background-brand">
                      <h4 class="name">Name</h4>
                      <h5 class="relevance">Relevance Score: <span class="score"></span></h5>
                      <ul class="farm-details">
                        <li><img class="mr-2" src="<? echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-farm-location.svg" alt="" width="24"> Location of Farm: <span class="location"></span></li>
                        <li><img class="mr-2" src="<? echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-farm-year.svg" alt="" width="24"> Year Farm was Founded: <span class="year-founded"></span></li>
                      </ul>

                      <div class="suggestions">
                        <a href="#" class="farm-website btn btn-dark"><img class="mr-2" src="<? echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-globe.svg" alt="" width="24"> Farm Website</a><br />
                        <a href="#" class="additional-reading btn btn-dark"><img class="mr-2" src="<? echo get_template_directory_uri() ?>/assets/images/icons/dashboard/icon-book.svg" alt="" width="24"> Additional Reading</a>
                      </div>
                    </div>
                  </div>
                <?php } ?>

              </div><!-- /.farms-->
            </div>
          </section> <!-- Inspiration / Farms -->

        </div>
      </div>
    </div>
  </div>
</div>


<script>
        jQuery(document).ready(function() {
          // Is this secure?
//        if (!firebase.auth().currentUser) {
//          getFirebaseToken(loadConceptReport)
//        } else {
displayFarmExamples();
//        }
});
</script>



