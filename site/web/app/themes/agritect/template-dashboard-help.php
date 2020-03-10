<?php /* Template Name: Dashboard Help Template */ ?>

<style>
  .navbar.navbar-dark,
  .site-footer {
    display: none;
  }

  body {
    padding-top: 0;
  }
</style>


<div class="dashboard">
  <div class="container-fluid">
    <div class="row row--nowrap">
      <div class="dashboard__sidebar">
        <?php get_template_part('templates/sidebar-dashboard'); ?>
      </div>

      <div class="dashboard__pane">
        <div class="section">
          <h3 class="text-uppercase"><div class="text-highlight"><span>Get Help</span></div></h3>
          <h2>Have questions? <br/> We have answers!</h2>
          <p class="text-muted">Please use the below categories to find frequently asked questions and our corresponding answers. You can always submit a request to us if you don't see the question on your mind.</p>

          <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
              <a class="nav-link active" id="general-questions-tab" data-toggle="tab" href="#general-q-" role="tab" aria-controls="general-questions" aria-selected="true">General Questions</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="product-questions-tab" data-toggle="tab" href="#product-q-" role="tab" aria-controls="product-questions" aria-selected="true">Product Functionality Questions</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" id="technical-questions-tab" data-toggle="tab" href="#technical-q-" role="tab" aria-controls="technical" aria-selected="false">Technical Questions</a>
            </li>
          </ul>

          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="general-q-" role="tabpanel" aria-labelledby="general-questions">

              <div class="accordion faq" id="general-accordion">
                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-1-a" aria-expanded="true" aria-controls="general-q-1-a" id="general-q-1">
                    What is Agritecture Designer?
                  </button>

                  <div id="general-q-1-a" class="faq__answer collapse" aria-labelledby="general-q-1-a" data-parent="#general-accordion">
                    Agritecture Designer is a new digital platform to help anyone plan their urban or controlled environment farm. Agritecture has taken our years of experience as leading industry consultants and translated that into a toolset that can help you hone your vision, explore your project’s financial feasibility, and rapidly accelerate progress toward launching your farming business.                  
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-2-a" aria-expanded="true" aria-controls="general-q-2-a" id="general-q-2">
                    Who is Agritecture Designer intended for?
                  </button>
                  <div id="general-q-2-a" class="faq__answer collapse" aria-labelledby="general-q-2-a" data-parent="#general-accordion">
                    Agritecture Designer is intended for anyone planning an urban or controlled environment farm.                  sh
                  </div>
                </div>

                <div class="faq__section">  
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-3-a" aria-expanded="true" aria-controls="general-q-3-a" id="general-q-3">
                    What is the purpose of Agritecture Designer?
                  </button>

                  <div id="general-q-3-a" class="faq__answer collapse" aria-labelledby="general-q-3-a" data-parent="#general-accordion">
                    The purpose of Agritecture Designer is to create tools that can help anyone, anywhere in the world, who is considering starting an urban farm find inspiration for their project and access the data they’ll need to make critical early-stage decisions.
                  </div>
                </div>

                <div class="faq__section">  
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-4-a" aria-expanded="true" aria-controls="general-q-4-a" id="general-q-4">
                    What does it mean that Agritecture Designer is in “beta”?
                  </button>

                  <div id="general-q-4-a" class="faq__answer collapse" aria-labelledby="general-q-4-a" data-parent="#general-accordion">
                    Agritecture Designer launched publicly in December 2019. While we know that our knowledge and data are helpful, we’re constantly working on perfecting how that knowledge and data are delivered to you -- meaning the design, the complex logic driving the site’s functionality, the general features, and our business model for making sure the site can sustain itself (this is a business, after all!). 
                    <br/>
                    <br/>
                    What this means for you is that, while we are in beta mode, the platform will change frequently - but we’ll always try to make changes based on <a href="/dashboard/contact#feedback">your actual feedback</a>!
                    <br/>
                    <br/>
                    Plus, you’ll be grandfathered in to the price/package you select - so if our prices increase but you’ve already paid, that price will be set for the full length of that package!
                  </div>
                </div>

                <div class="faq__section">  
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-5-a" aria-expanded="true" aria-controls="general-q-5-a" id="general-q-5">
                    What is the purpose of Agritecture Designer?
                  </button>

                  <div id="general-q-5-a" class="faq__answer collapse" aria-labelledby="general-q-5-a" data-parent="#general-accordion">
                    The purpose of Agritecture Designer is to create tools that can help anyone, anywhere in the world, who is considering starting an urban farm find inspiration for their project and access the data they’ll need to make critical early-stage decisions.
                  </div>
                </div>

                <div class="faq__section">  
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-6-a" aria-expanded="true" aria-controls="general-q-6-a" id="general-q-6">
                    How long will Agritecture Designer be in “beta” for?
                  </button>

                  <div id="general-q-6-a" class="faq__answer collapse" aria-labelledby="general-q-6-a" data-parent="#general-accordion">
                    3-6 months
                  </div>
                </div>

                <div class="faq__section">  
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#general-q-7-a" aria-expanded="true" aria-controls="general-q-7-a" id="general-q-7">
                    How do I get started?
                  </button>

                  <div id="general-q-7-a" class="faq__answer collapse" aria-labelledby="general-q-7-a" data-parent="#general-accordion">
                    Go <a href="/project-vision">here</a>
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="product-q-" role="tabpanel" aria-labelledby="product-question">

              <div class="accordion faq" id="product-accordion">
                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-1-a" aria-expanded="true" aria-controls="product-q-1-a" id="product-q-1">
                    How do I save my work?
                  </button>

                  <div id="product-q-1-a" class="faq__answer collapse" aria-labelledby="product-q-1-a" data-parent="#product-accordion">
                    Your “Vision” will be automatically saved, as long as you create an account by simply logging in.
                    <br/>
                    <br/>
                    Your “Project” will also be automatically saved, as long as you’ve selected one of our paid access options.
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-2-a" aria-expanded="true" aria-controls="product-q-2-a" id="product-q-2">
                    How do I share my work?
                  </button>

                  <div id="product-q-2-a" class="faq__answer collapse" aria-labelledby="product-q-2-a" data-parent="#product-accordion">
                    Your “Vision” can be shared via the social links in your Vision Report page.
                    <br/>
                  We suspect that your “Project” will be more private - so for now, we have not created specific sharing/access privileges. If you think we should change that, <a href='/dashboard/contact'>just tell us.</a></div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-3-a" aria-expanded="true" aria-controls="product-q-3-a" id="product-q-3">
                    Can I download my data? 
                  </button>

                  <div id="product-q-3-a" class="faq__answer collapse" aria-labelledby="product-q-3-a" data-parent="#product-accordion">
                    Right now we have not created the functionality to directly download your full feasibility report. If you’d like to explore this option, please <a href="/dashboard/contact">contact our consulting team</a>. 
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-4-a" aria-expanded="true" aria-controls="product-q-4-a" id="product-q-4">
                    Can I develop more than one Vision?
                  </button>

                  <div id="product-q-4-a" class="faq__answer collapse" aria-labelledby="product-q-4-a" data-parent="#product-accordion">
                    Right now you are limited to creating one Vision, but you can edit that Vision any time you’d like.
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-5-a" aria-expanded="true" aria-controls="product-q-5-a" id="product-q-5">
                    Who owns the data that I enter into the product?
                  </button>

                  <div id="product-q-5-a" class="faq__answer collapse" aria-labelledby="product-q-5-a" data-parent="#product-accordion">
                    In accordance with GDPR standards, the data subject (that's you) owns the data they enter. Agritecture retains the rights to use any non-personally identifiable information you enter for our own analysis and business purposes. You can read more via our <a href="https://app.termly.io/document/privacy-policy/c0a0c9e8-6231-416e-9f45-e3188dc9ebdc" target="_blank">Privacy Policy.</a>
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-6-a" aria-expanded="true" aria-controls="product-q-6-a" id="product-q-6">
                    Does this work on desktop, mobile, and tablet?
                  </button>

                  <div id="product-q-6-a" class="faq__answer collapse" aria-labelledby="product-q-6-a" data-parent="#product-accordion">
                    Yes. And if something doesn’t work up to your expectations, let us know!
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-7-a" aria-expanded="true" aria-controls="product-q-7-a" id="product-q-7">
                    How can I contribute to this project?
                  </button>

                  <div id="product-q-7-a" class="faq__answer collapse" aria-labelledby="product-q-7-a" data-parent="#product-accordion">
                    Good question! The two best ways to contribute are to tell a friend about Agritecture Designer and to send us any feedback you have or ideas on what features we should build next.
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-8-a" aria-expanded="true" aria-controls="product-q-8-a" id="product-q-8">
                    Where can I find news about updates, bugs, and new releases?
                  </button>

                  <div id="product-q-8-a" class="faq__answer collapse" aria-labelledby="product-q-8-a" data-parent="#product-accordion">
                    You will automatically receive updates via email as long as you remain subscribed to receive them.
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-9-a" aria-expanded="true" aria-controls="product-q-9-a" id="product-q-9">
                    I don’t see the specific crop I want to grow as an option in the Project stage. What should I do?
                  </button>

                  <div id="product-q-9-a" class="faq__answer collapse" aria-labelledby="product-q-9-a" data-parent="#product-accordion">
                    The options presented for crops are the ones most compatible with the operation system you have selected. These are also crops that we have the highest degree of familiarity with. If you do not see the crop you want to grow, we recommend the following steps:

                    <ol>
                      <li>
                        Try choosing a crop that is similar in terms of growth cycle and ideal climate. You will have full control over the price you charge for that crop by completing the market research evaluation within the 'Crop Pricing' tab on the Project Results page.
                      </li>

                      <li>
                        Tell us the specific crop you want to see, and we’ll research it for you! If we can find accurate data we will add it into our database. Either way, we’ll touch base with you shortly to give you more info.
                      </li>
                    </ol>
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-10-a" aria-expanded="true" aria-controls="product-q-10-a" id="product-q-10">
                    How do I know what the best “Grow System” is to select in the Project stage?
                  </button>

                  <div id="product-q-10-a" class="faq__answer collapse" aria-labelledby="product-q-10-a" data-parent="#product-accordion">
                    The options presented for grow systems are the ones most compatible with the operation type and crops you have selected. These grow systems are the most common commercial hydroponic systems and the ones we have the highest degree of familiarity with. If you need help selecting the right system, we recommend reading through <a href="https://www.agritecture.com/blog/2019/3/7/soilless-agriculture-an-in-depth-overview" target="_blank">this overview</a> on our blog, or creating multiple Projects to compare the various options.
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-11-a" aria-expanded="true" aria-controls="product-q-11-a" id="product-q-11">
                    Why don’t you have aquaponics as an option for “Grow System” in the Project stage?
                  </button>

                  <div id="product-q-11-a" class="faq__answer collapse" aria-labelledby="product-q-11-a" data-parent="#product-accordion">
                    Aquaponics is a highly complex method for growing, meaning it can be more challenging to predict yields than hydroponics. However, we currently plan on adding aquaponics as an option in the next 6 months. You can help us speed up that process by <a href="/dashboard/contact">letting us know</a> that you’re interested in data for aquaponics! 
                    <!-- letting us know {should link to contact form} -->
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-12-a" aria-expanded="true" aria-controls="product-q-12-a" id="product-q-12">
                    How does the “Compare to Soil” feature work?
                  </button>

                  <div id="product-q-12-a" class="faq__answer collapse" aria-labelledby="product-q-12-a" data-parent="#product-accordion">
                    We are currently working on allowing users to build a full feasibility report for a soil-based farm. In the meantime, our “Compare to Soil” feature allows you to compare any Vertical Farm (VF) or Greenhouse (GH) to a soil-based farm assuming the same location, plot size, and crop selection. The “Compare” feature also 
                  </div>
                </div>


                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#product-q-13-a" aria-expanded="true" aria-controls="product-q-13-a" id="product-q-13">
                    My “Project” is complete. What should I do now?
                  </button>

                  <div id="product-q-13-a" class="faq__answer collapse" aria-labelledby="product-q-13-a" data-parent="#product-accordion">
                    At the bottom of your Project Report, you’ll see a section entitled “Tell Us What’s Next”. Click the appropriate button and we’ll put you in our expedited consulting services track. One of our expert team members will reach out within 24 hours on next steps.
                  </div>
                </div>
              </div>
            </div>


            <div class="tab-pane fade" id="technical-q-" role="tabpanel" aria-labelledby="technical-question">

              <div class="accordion faq" id="technical-accordion">
                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#technical-q-1-a" aria-expanded="true" aria-controls="technical-q-1-a" id="technical-q-1">
                    What is the difference between a Greenhouse (GH) and a Vertical Farm (VF)?
                  </button>

                  <div id="technical-q-1-a" class="faq__answer collapse" aria-labelledby="technical-q-1-a" data-parent="#technical-accordion">
                    A <strong>Greenhouse</strong> is an enclosed structure that grows crops while harnessing light from the sun. There are various structure types and coverings for a greenhouse which range from plastic films to double pane glass. For the purposes of our feasibility tool, we have limited the range of structure types to “Low Duty” (lower cost but less environmental control and structural integrity); “Medium Duty” (medium cost, more environmental control and structural integrity); and “Heavy Duty” (highest cost, highest level of environmental control and structural integrity). There are also various methods of growing in a greenhouse. For the purposes of our feasibility tool, we have limited the range just to hydroponic systems - but one can also build a greenhouse for growing in soil or for other soilless methods such as aquaponics. For more information on greenhouses, check out our <a href="https://www.agritecture.com/blog/2019/5/7/growing-more-with-less-the-past-present-and-future-of-greenhouses" target="_blank">3-part series </a>co-authored by Plug and Play.
                    <br/>
                    <br/>
                    A <strong>Vertical Farm</strong> is an indoor structure that grows crops in vertical racks while using artificial light to provide energy for photosynthesis. Vertical farms have a higher level of insulation than greenhouses and thus are capable of achieving a higher level of environmental control. By using multiple grow levels, a farmer may also be able to increase their yield per square foot (footprint) significantly versus a single layer farming setup which occurs in soil and greenhouse operations. Typically, only soilless cultivation methods are practiced in a VF. For the purposes of our feasibility tool, we have limited the range just to hydroponic systems - the most common method for growing in a VF.
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#technical-q-2-a" aria-expanded="true" aria-controls="technical-q-2-a" id="technical-q-2">
                    How should I decide between a Greenhouse (GH) or a Vertical Farm (VF)?
                  </button>

                  <div id="technical-q-2-a" class="faq__answer collapse" aria-labelledby="technical-q-2-a" data-parent="#technical-accordion">
                    <em>The shorter answer:</em> This is the reason we built our feasibility tool! We recommend creating multiple “Projects” - some using GH as your Operation Type and some using VF as your Operation Type - in order to weigh some of the pros/cons of each approach and decide for yourself which model best fits your goals.
                    <br/><br/>
                    <em>The longer answer:</em> While each situation is unique, generally a VF is going to be significantly more capital-intensive, with a longer project ROI and higher costs of production, but have higher total yields per square foot than a GH. Additionally, the level of environmental and crop control one can achieve is greater in a VF, which can result in higher-quality produce or produce with a specific outcome that may be in demand. Of course, there are considerations that will affect these assumptions. For example, if you already own a building, your capital costs will be lower than if you were to purchase that building - or your operating costs will be lower versus if you were to pay rent on that building. The level of automation technology used, as well as sales/distribution channels chosen, will also play important roles in your total cost of production. And, it’s important to remember that your cost is just one-half of the equation - if you are able to grow a more consistent product in a VF for instance, that may translate to higher revenues that will make up for the increase in production costs. Finally, VFs still tend to have a higher carbon footprint per biomass of output than GHs, which may be another important consideration for you. 
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#technical-q-3-a" aria-expanded="true" aria-controls="technical-q-3-a" id="technical-q-3">
                    Can vertical farms use natural sunlight? 
                  </button>

                  <div id="technical-q-3-a" class="faq__answer collapse" aria-labelledby="technical-q-3-a" data-parent="#technical-accordion">
                    There are various “definitions” for vertical farms, but for the purpose of this site, we are adhering to the definition that a vertical farm uses only artificial light, and does not use any natural sunlight.
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#technical-q-4-a" aria-expanded="true" aria-controls="technical-q-4-a" id="technical-q-4">
                    Does a greenhouse need supplemental lighting?
                  </button>

                  <div id="technical-q-4-a" class="faq__answer collapse" aria-labelledby="technical-q-4-a" data-parent="#technical-accordion">
                    Not always. The reason you would need supplemental lighting depends upon the <a href="https://en.wikipedia.org/wiki/Daily_light_integral" target="_blank">DLI</a> of your specific location in combination with your crop choice, as well as your budget/objectives.
                  </div>
                </div>

                <div class="faq__section">
                  <button class="faq__question collapsed" type="button" data-toggle="collapse" data-target="#technical-5" aria-expanded="true" aria-controls="technical-5">
                    What are the different costs of indoor farms?
                  </button>

                  <div id="technical-5" class="faq__answer collapse" aria-labelledby="technical-5" data-parent="#technical-accordion">
                    They can vary greatly. We developed Agritecture Designer to help you understand how various decisions affect these costs. Using our Project section, you can build multiple feasibility reports to understand the breakdown of various capital (upfront) costs and operating (recurring annual) costs.
                    <br/>
                    <br/>
                    You can always <a href="/dashboard/contact">contact us</a> with any additional questions!

                    <!-- Link contact us to contact form -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="section section--grey">
          <div class="text-center">
            <h3><div class="text-highlight"><span>Still have questions?</span></div></h3>
            <p>Submit form for a specific question or feedback.</p>
          </div>

          <div class="row justify-content-center">
            <div class="col-md-4 offset-md-2">
              <div class="px-4 py-4">
                <a href="/dashboard/contact/?question-type=Technical%20Support" class="card card--cta">
                  <div class="card-img-wrapper">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/Submit/Question.svg" alt="" class="card-img-top">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-center">
                      Get specific help
                    </h5>
                  </div>
                </a>
              </div>
            </div>

            <div class="col-md-4">
              <div class="px-4 py-4">
                <a href="/dashboard/contact/?question-type=Feedback" class="card card--cta">
                  <div class="card-img-wrapper">
                    <img src="<?php echo get_template_directory_uri() ?>/assets/images/icons/dashboard/Submit/Feedback.svg" alt="" class="card-img-top">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-center">
                      Provide feedback
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

  <script>
    jQuery(document).ready(function () {
      let url = location.href.replace(/\/$/, "");
      var dfd = jQuery.Deferred();
      promise = dfd.promise();

      // first go to correct tab
      var showTab = function() {        
        var questionType = location.hash.replace(/\d+/g, '');
        jQuery('#myTab a[href="'+questionType+'"]').tab("show");
      };

      // second go to the correct question
      // var showQuestion = function() {
      //   jQuery('html, body').animate({
      //     scrollTop: jQuery('.faq__question[data-target="' + location.hash + '"]').offset().top
      //   }, 300);
      // };

      // third open the correct answer
      var showAnswer = function() {
        var answerID = location.hash + '-a';
        jQuery(answerID + '.collapse').collapse('show');
      }

      if (location.hash) {
        url = location.href.replace(/\/#/, "#");
        history.replaceState(null, null, url);
        promise.then(showTab()).then(showAnswer());
      }

    // jQuery(document).ready(() => {
    //   let url = location.href.replace(/\/$/, "");

    //   if (location.hash) {
    //     const hash = url.split("#");
    //     jQuery('#myTab a[href="#'+hash[1]+'"]').tab("show");
    //     url = location.href.replace(/\/#/, "#");
    //     history.replaceState(null, null, url);
    //     setTimeout(() => {
    //       jQuery(window).scrollTop(0);
    //     }, 400);
    //   } 

    // This needs to set the URL to the question it was clicked on
    jQuery('.faq__question').on("click", function() {
      let newUrl;
      const hash = '#' + jQuery(this).attr("id");
      newUrl = url.split("#")[0] + hash;
      history.replaceState(null, null, newUrl);
    });

    // function highlightHelpSection() {
    //   jQuery('.faq__answer.show').parents('.faq__section').css('background-color', '#e9f8fa');  
    // }
    
  });
</script>