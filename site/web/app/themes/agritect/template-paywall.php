<?php /* Template Name: Paywall Template */ ?>
<style>
  body {
    padding-top: 62px !important;
  }
</style>

<?php 
$ctaLink = '#';
?>

<div class="sr-only">
  <?php echo do_shortcode('[pms-restrict subscription_plans="303" message=" "]<style>.current-plan--free,.current-plan--sb,.plan-cta--free,.current-plan--nc,.description--beta-access{display:none;}.plan-cta--nc,.current-plan--ncb{display:block;}</style>[/pms-restrict]'); ?>

  <?php echo do_shortcode('[pms-restrict subscription_plans="211" message=" "]<style>.current-plan--free,.current-plan--sb,.plan-cta--free,.plan-cta--nc{display:none;}.current-plan--nc{display:block;}</style>[/pms-restrict]'); ?>

  <?php echo do_shortcode('[pms-restrict subscription_plans="212" message=" "]<style>.current-plan--free,.current-plan--nc,.plan-cta--free,.plan-cta--sb{display:none;}.current-plan--sb{display:block;}</style>[/pms-restrict]'); ?>
</div>

<div class="section">
  <div class="container">

    <!-- php if user is logged in -->
    <!-- restrict content if they have a plan and change copy to upgrade -->
    <?php if (is_user_logged_in()) :  ?>
      <h2 class="text-uppercase"><div class="text-highlight"><span>Continue&nbsp;</span></div><div class="text-highlight"><span>Your&nbsp; </span></div><div class="text-highlight"><span>Journey</span></div></h2>
      <?php else : ?>
        <h2 class="text-uppercase"><div class="text-highlight"><span>Start&nbsp;</span></div><div class="text-highlight"><span>Your&nbsp; </span></div><div class="text-highlight"><span>Journey</span></div></h2>
      <?php endif; ?>


      <!-- TODO: there's a contact form here that doesn't exist yet -->
      <p class="lead">Select the option that's best for you.</p>
      <p>Have questions first? <a href="mailto:support@agritecture.com?subject=Question about Agritecture Designer Plans">Contact us.</a></p>


      <p class="description--beta-access">Have you been given beta access? <a href="/subscribe?subscription_plan=303&single_plan=yes">Click here.</a></p>

      <div class="table-wrapper table-wrapper--plans">
        <table class="table table-striped pricing-table">
          <thead>
            <tr>
              <th></th>
              <th scope="col">
                <h3 class="text-center">Sprout</h3>
              </th>
              <th scope="col">
                <h3 class="text-center">Number<br>Cruncher</h3>
              </th>
              <th scope="col">
                <h3 class="text-center">Starter<br>Bundle</h3>
              </th>
              <th scope="col">
                <h3 class="text-center">Full<br>Service</h3>
              </th>
            </tr>

            <tr>
              <td></td>
              <td class="text-center">
                <div class="pricing-table__package">
                  <div class="pricing-table__description">
                    <div class="mb-1">Free!</div>
                    <h2>$0</h2>
                    <div class="pricing-table__length">Unlimited</div>
                  </div>

                  <div class="pricing-table__cta">
                    <!-- here's the upgrade link if we want users to upgrade -->
                    <!-- http://agritect.test/subscribe/?pms-action=upgrade_subscription&subscription_id=12&subscription_plan=211&pmstkn=9af453d2c4 -->

                    <div class="current-plan current-plan--free">Your Current Plan</div>

                    <a class="btn btn-white btn-block plan-cta plan-cta--free" href="/project-vision">Start</a>
                  </div>
                </div>

              </td>

              <td>
                <div class="pricing-table__package">
                  <div class="pricing-table__description">
                    <div class="mb-1">< $1/day!</div>
                    <h2>$99</h2>
                    <div class="pricing-table__length">
                      For 180 days of access<br><br>
                      <div class="current-plan current-plan--ncb"><em>You are currently on a 14-day access plan.</em></div>
                    </div>
                    <br>
                  </div>

                  <div class="pricing-table__cta">
                    <div class="current-plan current-plan--nc">Your Current Plan</div>

                    <a class="btn btn-white btn-block plan-cta plan-cta--nc" href="/subscribe?subscription_plan=211&single_plan=yes">Select</a>
                  </div>
                </div>
              </td>

              <td>
                <div class="pricing-table__package">
                  <div class="pricing-table__description">
                    <div class="mb-1">< $2/day!</div>
                    <h2>$249</h2>
                    <div class="pricing-table__length">For 180 days of access</div>
                    <br>
                  </div>

                  <div class="pricing-table__cta">
                    <div class="current-plan current-plan--sb">Your Current Plan</div>

                    <a class="btn btn-white btn-block plan-cta--sb" href="/subscribe?subscription_plan=212&single_plan=yes" id="plan-cta plan-cta--sb">Select</a>
                  </div>
                </div>
              </td>

              <td>
                <div class="pricing-table__package">
                  <div class="pricing-table__description">
                    <div class="mb-1">Starting at</div>
                    <h2>$5,000</h2>
                    <div class="pricing-table__length">Speak to our experts before paying</div>
                    <br>
                  </div>

                  <div class="pricing-table__cta">
                    <?php echo do_shortcode('[contact-form-7 id="322" title="Full Service Request Form"]'); ?>
                  </div>
                </div>
              </td>
            </tr>
          </thead>

          <tbody>
            <tr>
              <th scope="row">Vision Report</th>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Farm Inspiration</th>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Feasibility Guided Assistance</th>
              <td></td>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Market Research Guided Assistance</th>
              <td></td>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Save and Update Your Work</th>
              <td></td>
              <td>✓</td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <!-- Inclue tooltip here -->
            <tr>
              <th scope="row">Commercial Urban Farming Class</th>
              <td></td>
              <td></td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">1 hour consultant-led conference call</th>
              <td></td>
              <td></td>
              <td>✓</td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Validated Feasibility Report</th>
              <td></td>
              <td></td>
              <td></td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Custom 1-on-1 Consultation</th>
              <td></td>
              <td></td>
              <td></td>
              <td>✓</td>
            </tr>

            <tr>
              <th scope="row">Optional Add-Ons</th>
              <td></td>
              <td></td>
              <td></td>
              <td>✓</td>
            </tr>
          </tbody>

        </table>
      </div>
    </div>
  </div>


  <section class="section section--light">
    <div class="container">
      <h2 class="text-uppercase">
        <div class="text-highlight text-highlight--light"><span>Testimonials</span></div>
      </h2>

      <div class="row">
        <div class="col-12">
          <blockquote class="testimonial testimonial--light">
            <p class="testimonial__quote">
              Working with Henry and the Agritecture team gave me the confidence that my project was receiving input from some of the most experienced players in the urban farming industry. One important 'edge' was Agritecture's access to real benchmark data and their experience of dozens of different types of projects, which is unrivaled in this new and evolving market.
            </p>

            <footer class="testimonial__company text-center v-align--middle">
              <div>
                <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/homepage/logo-farm-one.png" alt="">
                <h3>Robert Laing</h3>
                <cite>Founder & CEO</cite>
              </div>
            </footer>
          </blockquote>

          <blockquote class="testimonial testimonial--light">
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

          <blockquote class="testimonial testimonial--light">
            <p class="testimonial__quote">
              Agritecture is a reliable team consisting of some of the most knowledgeable urban agriculture professionals in the industry.
            </p>

            <footer class="testimonial__company text-center v-align--middle">
              <div>
                <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/bmoreag-logo.png" alt="">
                <h3>Alex Fisher</h3>
                <cite>Co-Founder & CEO</cite>
              </div>
            </footer>
          </blockquote>

          <blockquote class="testimonial testimonial--light">
            <p class="testimonial__quote">
              Agritecture provided a team of experts that cut across operations, technology, and infrastructure which provided the insight required to set a strong foundation and help launch my hydroponic farm operations.
            </p>

            <footer class="testimonial__company text-center v-align--middle">
              <div>
                <img class="img-fluid mb-3" src="<? echo get_template_directory_uri(); ?>/assets/images/magki_farms_logo.jpg" alt="">
                <h3>Greg Alexander</h3>
                <cite>Co-Founder & CEO</cite>
              </div>
            </footer>
          </blockquote>
        </div>
      </div>
    </div>
  </section>