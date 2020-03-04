<?php /* Template Name: Homepage Template */ ?>

<?php 
$ctaLink = '';

if (is_user_logged_in()) : 
  $ctaLink = '/concept-report';
else :
  $ctaLink = '/project-vision';
endif;
?>
<!-- Need to add an image background here and crop the existing header image -->
<div id="homepage">

  <section class="section section--hero text-center" style="background-image: url(<? echo get_template_directory_uri();
  ?>/assets/images/homepage/homepage-banner.jpg)">
  <div class="overlay overlay--white"></div>
  
  <div class="container">
    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <h1 class="text-uppercase text-background-highlight">The Future of Agriculture <br>is in your Hands</h1>
        </div>

        <a href="<? echo $ctaLink; ?>" class="btn btn-wide">Get Started</a>
      </div>
    </div>
  </div>
</section>


<section class="section">
  <div class="container">

    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <h2 class="text-uppercase">
            <div class="text-highlight"><span>Introducing:&nbsp;</span></div><div class="text-highlight"><span>Agritecture&nbsp;</span></div><div class="text-highlight"><span>Designer</span></div>
          </h2>
          <p class="lead">The first digital platform to accelerate urban farming entrepreneurs around the world.</p>
        </div>
      </div>
    </div>



    <!-- Vertically align this content -->
    <div class="row pt-4 pb-4">
      <div class="col-md-6">
        <img class="img-fluid mb-4" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/Illustration/Ideas.svg" alt="">
      </div>

      <div class="col-md-6 v-align--middle">
        <div>
          <h3>Step 1: <br> Hone Your Vision</h3>
          <p>Tell us about your goals, ideas, and the stage of your project. From our proprietary database, we'll recommend some existing projects and top-read articles for inspiration. Then, we've made it easy for you to share and get feedback on your big vision.</p>

          <blockquote class="quote">
            <p class="lead quote__content">See, Mom! I'm not the only crazy person doing this!</p>
          </blockquote>
        </div>
      </div>
    </div>

    <!-- Reorders these columns -->
    <div class="row pt-4 pb-4">
      <!-- Add code to reorder this on mobile -->
      <div class="col-md-6 v-align--middle">
        <div>
          <h3>Step 2: <br>Build Your Plan</h3>
          <p>Realistic data is the key to developing a feasible urban farming business plan. We’ve taken our years of experience doing just that and boiled it down to a few key decisions that we’ll walk you through. Then, access and update your plan from anywhere for the next 180 days.</p>

          <blockquote class="quote">
            <p class="lead quote__content">I’m a data-driven, future farmer!</p>
          </blockquote>
        </div>
      </div>

      <div class="col-md-6 order-first--mobile">
        <img class="img-fluid mb-4" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/Illustration/Build.svg" alt="">
      </div>
    </div>


    <div class="row pt-4 pb-4">
      <div class="col-md-6">
        <img class="img-fluid mb-4" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/Illustration/Expedite.svg" alt="">
      </div>

      <div class="col-md-6 v-align--middle">
        <div>
          <h3>Step 3: <br> Expedite Your Progress</h3>
          <p>Now that you have the economic foundations for your new farm, use other Agritecture resources to advance your progress. We have experts on hand ready to assist you with finalizing designs, equipment selections, market research, and much more!</p>

          <blockquote class="quote">
            <p class="lead quote__content">I’ll be farming in no time!</p>
          </blockquote>
        </div>
      </div>
    </div>

    <div class="pt-4 pb-4 text-center">
      <a href="<? echo $ctaLink; ?>" class="btn btn-primary btn-wide">Get Started</a>
    </div>
  </div>
</section>


<section class="section section--light">
  <div class="container">
    <div class="text-center">
      <h2 class="text-uppercase">
        <div class="text-highlight text-highlight--light"><span>Access&nbsp;</span></div><div class="text-highlight text-highlight--light"><span>the&nbsp;</span></div><div class="text-highlight text-highlight--light"><span>Data&nbsp;</span></div><div class="text-highlight text-highlight--light"><span>You&nbsp;</span></div><div class="text-highlight text-highlight--light"><span>Need&nbsp;</span></div>
      </h2>
    </div>

    <div class="row">
      <div class="col-12 col-md-8">
        <img class="img-fluid mb-4" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/V3.gif" alt="">
      </div>
      <div class="col-12 col-md-4 v-align--middle">
        <p class="lead">Unlock the numbers you need to properly plan any type of urban farm.</p> 
      </div>
    </div>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="text-center">
      <h2 class="text-uppercase">
        <div class="text-highlight"><span>Why&nbsp;</span></div><div class="text-highlight"><span>Agritecture&nbsp;</span></div><div class="text-highlight"><span>Designer?</span></div>
      </h2>
    </div>

    <div class="row">
      <div class="col-12 col-md-6">
        <div class="text-center">
          <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/icon-save-time.svg" alt="">
          <h3>Save Time</h3>
          <p>Quit scouring the internet for unverified information. You’ve got a farm to build!</p>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="text-center">
          <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/icon-autonomy.svg" alt="">
          <h3>Autonomy</h3>
          <p>Remain in control. Rather than sell you on one approach, we empower you with the data you'll need to make your own informed decisions.</p>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="text-center">
          <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/icon-credible.svg" alt="">
          <h3>Credible & Data-Driven</h3>
          <p>Agritecture Designer is backed by years of experience and proprietary data.</p>
        </div>
      </div>

      <div class="col-12 col-md-6">
        <div class="text-center">
          <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/icon-save-money.svg" alt="">
          <h3>Save Money</h3>
          <p>Mistakes are costly! Agritecture Designer will help you avoid them.</p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="text-center">
          <a href="<? echo $ctaLink; ?>" class="btn btn-primary btn-wide">Start Building</a>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="section section--dark">
  <div class="container">
    <div class="text-center position-relative z-index-10">
      <h2 class="text-uppercase">Agritecture Consulting: Our Work</h2>
      <h3 class="text-accent">100+ Clients | 44 Cities | 21 Countries</h3>
    </div>

    <!-- Include the image here, with negative margins for the header and the footer content -->
    <img class="img-fluid position-relative z-index--0 map-image" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/homepage-graph.png" alt="">

    <!-- <div class="row">
      <div class="col-md-6">
        <h4 class="text-uppercase text-accent">Projects Worldwide</h4>

        <ul class="location-list location-list--worldwide">
          <li>Bermuda</li>
          <li>Canada</li>
          <li>China</li>
          <li>France</li>
          <li>India</li>
          <li>Iran</li>
          <li>Italy</li>
          <li>Jordan</li>
          <li>Kosovo</li>
          <li>Kuwait</li>
          <li>Mauritius</li>
          <li>Mexico</li>
          <li>New Zealand</li>
          <li>Norway</li>
          <li>Philippines</li>
          <li>Qatar</li>
          <li>Sweden</li>
          <li>Saudi Arabia</li>
          <li>United Kingdom</li>
          <li>United Arab Emirates</li>
        </ul>
      </div>

      <div class="col-md-6">
        <h4 class="text-uppercase text-accent">USA Projects</h4>
        <ul class="location-list location-list--usa">
          <li>Tampa (FL)</li>
          <li>New York City (NY)</li>
          <li>Bergen County (NJ)</li>
          <li>Paterson (NJ)</li>
          <li>Baltimore (MD)</li>
          <li>Los Angeles (CA)</li>
          <li>Winston-Salem (NC)</li>
          <li>Atlanta (GA)</li>
          <li>Memphis (TN)</li>
          <li>Malta (ID)</li>
          <li>Mesa (AZ)</li>
          <li>Boca Raton (FL)</li>
          <li>Houston (TX)</li>
          <li>Springfield (MO)</li>
          <li>Ithaca (NY)</li>
          <li>Laurel (MD)</li>
          <li>Southlake (TX)</li>
          <li>Tulsa (OK)</li>
        </ul>
      </div>
    </div> -->
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="text-center">
      <h2 class="text-uppercase">
        <div class="text-highlight"><span>Clients&nbsp;</span></div><div class="text-highlight"><span>&amp;&nbsp;</span></div><div class="text-highlight"><span>Testimonials</span></div>
      </h2>
    </div>

    <div class="client-logos mb-4">
      <div class="client-logo">
        <a href="https://www.nxtlvlfarms.xyz/" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-nxtlvl-farms.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://threeforksfarms.com/" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/ThreeForksLocal.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://www.urbanoasis.life" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-urban-oasis.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://www.skyvegetables.com" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-sky-vegetables.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://www.cornell.edu" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-cornell-university.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://dreamharvestfarms.com" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-dream-harvest.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://www.strauss-group.com/" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-strauss.png" alt=""></a>
      </div>

      <div class="client-logo">
        <a href="https://www.montel.com/en" target="_blank"><img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-montel.png" alt=""></a>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <blockquote class="testimonial">
          <p class="testimonial__quote">
            Working with the Agritecture team gave me the confidence that my project was receiving input from some of the most experienced players in the urban farming industry. One important 'edge' was Agritecture's access to real benchmark data and their experience of dozens of different types of projects, which is unrivaled in this new and evolving market.
          </p>

          <footer class="testimonial__company text-center v-align--middle">
            <div>
              <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-farm-one.png" alt="">
              <h3>Robert Laing</h3>
              <cite>Founder & CEO</cite>
            </div>
          </footer>
        </blockquote>

        <blockquote class="testimonial">
          <p class="testimonial__quote">
            Our ambitious and unique model for the first urban agriculture accelerator needed a creative and fast-moving team to work within our tight timeline. The team at Agritecture were an ideal fit... Their extensive local and international network was an added bonus as we sought opinion and insight from around the globe.
          </p>

          <footer class="testimonial__company text-center v-align--middle">
            <div>
              <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-square-roots.png" alt="">
              <h3>Tobias Peggs</h3>
              <cite>Co-Founder & CEO</cite>
            </div>
          </footer>
        </blockquote>

        <div class="text-center">
          <a href="<? echo $ctaLink; ?>" class="btn btn-primary btn-wide">Get Started</a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section--light">
  <div class="container">

    <!-- add padding in this blockquote -->

    <!-- Need to change this line height -->
    <div class="row large-quote">
      <div class="large-quote__background d-none d-md-block"></div>
      
      <div class="col-md-7">
        <div class="large-quote__content">
          <h2>
            <div class="text-highlight"><span>Data-Driven</span></div><br><div class="text-highlight"><span>Unbiased&nbsp;</span></div><div class="text-highlight"><span>Approach</span></div><br><div class="text-highlight"><span>Proven&nbsp;</span></div><div class="text-highlight"><span>Methodology</span></div>
          </h2>

          <blockquote class="quote">
            <p class="quote__content">
              Agritecture has spent most of the past decade working with and telling the stories of aspiring urban farmers around the world. We believe in the opportunity that exists, but we also know the challenges. 
              <br><br>
              We developed Agritecture Designer to provide key insights and numbers to help emerging urban farmers make real progress toward their goals and avoid costly mistakes.
            </p>
          </div>
        </div>

        <div class="col-md-5">
          <div class="large-quote__image">
            <img class="img-fluid" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/homepage-henry-headshot.png" alt="">

            <div class="bg-black text-center text-white pt-2 pb-2 pl-2 pr-2">
              <h4 class="mb-1">Henry Gordon-Smith</h4>
              <p class="mb-0">Managing Director</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section">
    <div class="container">
      <div class="row">
        <div class="col-4">
          <div class="text-center mb-3">
            <img class="img-fluid" width="200" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/icon-graph.svg" alt="">
          </div>
        </div>

        <div class="col-8">
          <p>
            “Urban Agriculture: $80-160B in potential benefits"<br>
            <a href="https://agupubs.onlinelibrary.wiley.com/doi/full/10.1002/2017EF000536%0D" target="_blank"><em>- Earth's Future report</em></a>
          </p>

          <p>
            "Indoor farming tech to reach $40B by 2022"<br>
            <a href="https://www.marketsandmarkets.com/Market-Reports/indoor-farming-technology-market-40175861.html" target="_blank"><em>- MarketsandMarkets™</em></a>
          </p>

          <p>
            "Vertical farming: 24.8% annual growth rate"<br>
            <a href="https://www.marketsandmarkets.com/PressReleases/vertical-farming.asp" target="_blank"><em>- MarketsandMarkets™</em></a>
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section--dark">
    <div class="container">
      <div class="row">
        <div class="col-12 text-center pt-4 pb-4">
          <h3 class="text-accent">Don't wait!</h3>
          <p>Be the first to unlock our data-driven solutions to help you plan your urban farm.</p>

          <a href="<? echo $ctaLink; ?>" class="btn btn-primary btn-wide">Start Building</a>
        </div>
      </div>
    </div>
  </section>
</div>