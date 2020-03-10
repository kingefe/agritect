<?php /* Project Vision Results */
  $project_detail_params = array(
    /*
    Array to be used to generate the table output for survey data.
    Field names must parallel the onboarding form questions:
     - assets/scripts/form-onboard.js
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

<section class="section project-details">
  <div class="container">
    <div class="intro row">
      <div class="col-12 text-center">
        <h3 class="featured-title">Vision Report</h3>
      </div>

      <div class="congrats col-12">
        <h4><span class="user_name">Your</span> Urban Farm Vision</h4>
        <h5 class="color-grey">Congratulations!</h5>
        <p>You've created the Vision that will serve as an important reference for your urban farming project. Your customized Vision Report and our recommended next steps that follow are intended to guide you as you make progress toward turning your concept into a reality.</p>
      </div>
    </div>

    <div class="vision-badges row">
      <?php foreach($project_detail_params as $field=>$details) : ?>
        <div class="parameter <?=$field?>">
          <span class="badges"></span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section> <!-- project-details -->

<div class="timeline-wrapper">
  <div class="container">
    <h3 class="text-center">Project Timeline</h3>
    
    <div class="timeline">
      <div class="timeline__phase timeline__phase--1">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-vision.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3><img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-check.svg" alt="">&nbsp;&nbsp;Vision</h3>
            <p>You did it!</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>

      <div class="timeline__phase timeline__phase--2">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-feasibility.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3><img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-flag.svg" alt="">&nbsp;&nbsp;Feasibility</h3>
            <p>The next step is understanding your financial feasibility through our unique dataset and methodology.</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>

      <div class="timeline__phase timeline__phase--3">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-research.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3>Market Research & Crop Analysis</h3>
            <p>Our automated feasibility tool will help you plan for this, but for larger operations we also recommend a more thorough crop analysis and market research.</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>


      <div class="timeline__phase timeline__phase--4">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-design.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3>Farm Design & Equipment Selection</h3>
            <p>This is where you’ll select and lay out your HVAC systems, energy needs, and your farming-related equipment.</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>

      <div class="timeline__phase timeline__phase--5">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-financing.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3>Financing</h3>
            <p>The stage where you finance your farm’s upfront costs. You’ll feel a lot more confident reaching this stage having received Agritecture’s guidance.</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>

      <div class="timeline__phase timeline__phase--6">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-construction.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3>Construction & Team Selection</h3>
            <p>The stage where you build your farm and hire your team.</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>

      <div class="timeline__phase timeline__phase--7">
        <div class="timeline__icon">
          <img src="<?php echo get_template_directory_uri() ?>/assets/images/timeline/icon-growth.svg" alt="">
        </div>

        <div class="timeline__content">
          <div class="timeline__milestone timeline__milestone--1">
            <h3>Start Growing!</h3>
            <p>After all, this is what you’re here for, isn’t it?!</p>
          </div>
        </div>

        <div class="timeline__spacer"></div>
      </div>
    </div>
  </div>
</div>


<?php
// SOCIAL SHARE LINK PATHS
$action = array(
  'linkedin' => "window.open('https://www.linkedin.com/shareArticle?url='+encodeURIComponent(window.location.href)+'&title=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer:%20');return false;",
  'twitter' => "window.open('https://twitter.com/intent/tweet?url='+encodeURIComponent(window.location.href)+'&text=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer%3A%20');return false",
  'facebook' => "window.open('https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(window.location.href));return false;",
  'whatsapp' => "window.open('https://wa.me/?text=Check out my Urban Farm Vision on Agritecture Designer: '+encodeURIComponent(window.location.href));return false;"
);
?>

<section class="section social-share">
  <div class="container">
    <div class="row">
      <div class="title col-12 col-md-6 text-center">
        <h5>Get feedback on your Vision by sharing it!</h5>
      </div>
      <div class="social-icons col-12 col-md-6">
        <a href="#" class="fab fa-linkedin" onclick="<?=$action['linkedin']?>">Linkedin</a>
        <a href="#" class="fab fa-twitter" onclick="<?=$action['twitter']?>">Twitter</a>
        <a href="#" class="fab fa-facebook-square" onclick="<?=$action['facebook']?>">Facebook</a>
        <a href="#" class="fab fa-whatsapp-square" onclick="<?=$action['whatsapp']?>">WhatsApp</a>
      </div>
    </div>
  </div>
</section> <!-- / social-share -->


<section class="section inspiration background-brand">
  <div class="container">
    <div class="title row">
      <h3 class="featured-title invert">Inspiration</h3>
    </div>
    <div class="subtext row">
      <p>Below you will find urban farming projects and recommended Agritecture articles that have the highest relevance score with your Vision.</p>
    </div>


    <div class="farms">
      <?php $n=0; while($n<1) { $n++; ?>
        <div class="farm row">
          <div class="col-md-5 col-12 image">
            <img src="" alt="">
          </div>
          <div class="details col-12 col-md-7 background-white">
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


<section class="section">
  <div class="container">
    <div class="row">
      <?php
        // Show actionable content based on user status  //////////
        // If user is logged in - and -
        // User was not referred here externally
        // Show the pricing and subscription table
        if(is_user_logged_in() && !array_key_exists('ref',$_GET)) :
      ?>

        <div class="col-12">
          <h3 class="featured-title">Next Step: Build Your Data Report</h3>
        </div>

        <div class="col-12 col-md-8">
          <p><img src="<?=get_template_directory_uri()?>/assets/images/homepage/V3.gif" alt="" /></p>
        </div>

        <div class="col-12 col-md-4 v-align--column">
          <div class="pms-content--free">
            <p class="lead">Every farm needs a thoroughly vetted plan. Unlock the numbers you’ll need to properly plan yours.</p>

            <p><em>*Currently for greenhouses and vertical farms.</em></p>

            <p><a href="/plans" class="btn">Get Started</a></p>  
          </div>

          <div class="pms-content--paid">
            <p class="lead">You’re a premium user of Agritecture Designer!</p>
            <p>You can create projects and access your dashboard below.</p>
            <p><a href="/dashboard/vision" class="btn">Access your Dashboard</a></p>
          </div>

          <?php echo do_shortcode('[pms-restrict subscription_plans="211,212,303" message=" "]<style>.pms-content--free{display:none;}.pms-content--paid{display:block !important;}</style>[/pms-restrict]'); ?>
        </div>

      <?php 
        // If user is not logged in - or -
        // If user was referred here externally (ie: social, email)
        // Show the Get Started CTA
        elseif (!is_user_logged_in() || array_key_exists('ref', $_GET) ) :
      ?>
        <div class="col-12">
          <h3 class="featured-title">Next Step: Build Your Own Urban Farming Vision</h3>
        </div>

        <div class="col-12 col-md-8">
          <p><img src="<?=get_template_directory_uri()?>/assets/images/homepage/V3.gif" alt="" /></p>
        </div>

        <div class="col-12 col-md-4 v-align--column">
          <p class="lead">Our 3-minute survey is all that stands between you now and you with a concrete vision of your urban farming aspirations! Plus, you’ll unlock inspiration from our database of more than 100 urban agriculture models.</p>

          <p><a href="/project-vision" class="btn">Get Started</a></p>
        </div>
      <?php else : ?>
      <?php endif; ?>
    </div>
  </div>
</section><!-- Why Data-->

<script>
  jQuery(document).ready(function() {
    // if (!firebase.auth().currentUser) {
    //   getFirebaseToken(loadConceptReport);
    //  } else {
      loadConceptReport();
    // }
  });
</script>



