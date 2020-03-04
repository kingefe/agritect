// TODO
// Onboarding flow:
// 1. User completes survey questions
// 2. User registers for a WordPress account
// 3. Transmit data to Firecloud:
//    - User Profile, ie: username, name, WordPress ID
//    - Project with question responses
// 4. Receive data from Firecloud
// 5. Show Project Single View

(function($) {
  // Variable for relative path to icons
  var pathToIcons = themeurl + "/assets/images/icons/";

  //////////////////////////////
  // GOOGLE LOCATIONS FUNCTIONALITY
  //////////////////////////////
  // Google Maps API Key
  var googleMapsKey = "AIzaSyDs9qPdssSsGJrBJ-VNBhD0CWRYGQ3bfQs";
  // Function to geocode entry and get Google Map img
  function getLocMap(locfield) {
    var loc = $(locfield).val();
    // If there's a location string
    if (loc.length > 0) {
      // Request a Google Geocode location string
      $.getJSON('https://maps.googleapis.com/maps/api/geocode/json?address='+loc+'&key='+googleMapsKey).done(function(response){
        // If Google can't find it, display a failure message and stop progress button
        if(response.status != 'OK') {
          let errortext = 'Sorry, we couldn\'t understand your location. Please try again.';
          $('#map-preview img').attr('src','').attr('alt','').attr('title','');
          $('#map-preview .alert').text(errortext);
          $('a[href="#next"], a[href="#finish"]').addClass('disable');
        // If the location is valid, show a preview map, and allow progress button
        } else {
          let location = response.results[0].formatted_address;
          let location_lat = response.results[0].geometry.location.lat;
          let location_long = response.results[0].geometry.location.lng;
          $('#map-preview img').attr('src','https://maps.googleapis.com/maps/api/staticmap?center='+location+'&zoom=13&size=480x240&maptype=roadmap&markers=color:red%7C'+location+'&key='+googleMapsKey).attr('alt','Map of '+location).attr('title','Map of '+location);
          $('#map-preview .alert').text('');
          $('#farm_location').val(location);
          $('#farm_location_lat').val(location_lat);
          $('#farm_location_long').val(location_long);
          $('a[href="#next"], a[href="#finish"]').removeClass('disable');
        }
      });
    // If location string is empty, revert to default state and stop progress button
    } else {
      $('#map-preview img').attr('src','').attr('alt','').attr('title','');
      $('#map-preview .alert').text('');
      $('a[href="#next"], a[href="#finish"]').addClass('disable');
    }
  }
  // Function to run on Location slide
  var locationSelectEvents = function() {
    // Set a timer to limit executions of Maps API
    var locationTimer = null;
    // Set field for user entered location string
    let field = $('#loc');
    // On keyup, reset the timer; run function to get Preview Map
    $(field).keyup(function() {
      clearTimeout(locationTimer);
      locationTimer = setTimeout(function() { getLocMap(field) }, 1000);
    });
  }
  // END GOOGLE LOCATIONS FUNCTIONALITY ////////////////////


  // Check if User is Logged In
  function isLoggedIn(){
    var isLoggedIn = $('body').hasClass('logged-in');
    return isLoggedIn;
  }

  // Create an array of the just the indexes of the questions and the posts
  var allPosts = []

  for (var i = 0; i < allQuestions.length; i++) {
    if (allQuestions[i].post != null && allQuestions[i].post.length > 0) {
      // Get the question object
      var question = allQuestions[i];
      // Create a new object using the two
      var postObject = {
        index: question.index,
        post: question.post
      }
      allPosts.push(postObject);
    }
  }

  $('#qLength').html(allQuestions.length);


  // Label for label
  $('input[type="range"]').on('input change', function(){
    $(this).closest($('output')).html(this.value);
  });

  $('output').each(function(){
    var value = $(this).prev().attr('value');
    $(this).html(value);
  });


// TODO:
// - pull in the answers that are stored in the firebase from the results-scripts.js
// - render each of the questions differently on this page
// - submitting will update the answers to the vision report
// - There are also a couple of event listeners in the jQuery steps function that checks if responses are valid
// - Specifically, if at least one radio button is checked per section
// - and limiting to two checkboxes

// NICETOHAVE:
// - fixing the taskrunners to include the files in the 'scripts' folder
function displayAllEdits(array) {
  var output = '';
  for (var i = 0; i < array.length; i++ ) {
    if ( array[i].type == 'userAuth' && jQuery('body').hasClass('logged-in')) {
      // if type=userAuth and user is already logged in
      // skip this question
    } else {
      output += displaySingleEdit(array[i]);
    }
  }
  return output;
}

function displaySingleEdit(question) {
    var output = '';
    var questionText = '';
    var targetID = 'projectVisionEditSection'+ question.index;
    customClass = (question.customClass ? question.customClass : '');

    if (question.text) {
      questionText = '&nbsp;<small>' + question.text + '</small>'
    }

    output = '<div class="form-section ' + customClass + '">'
    + '<div class="form-section__text">'
    + '<h4>'
    + '<button type="button" data-toggle="collapse" aria-expanded="true" data-target="' +
    + targetID + '"" aria-controls="'
    + targetID + '">'
    + question.index + '. '
    + question.question
    + questionText
    + '</h4>'
    + '</div>'
    + '<div class="form-section__inputs form-section__inputs--'
    + question.type + ' '+customClass+'">';

    if (question.type == "radio") {
      output += displaySingleRadio(question);
    }

    if (question.type == "icon") {
      output += displaySingleIcon(question);
    }

    if (question.type == "checkbox") {
      output += displaySingleCheckbox(question);
    }

    if (question.type == "text") {
      output += displaySingleText(question);
    }

    if (question.type == "yn") {
      output += displaySingleYesNo(question);
    }

    if (question.type == "range") {
      output += displaySingleRange(question);
    }

    if (question.type == "locationSelect") {
      output += displayLocationSelect(question);
    }

    if (question.type == "userAuth") {
      output += displayUserAuth(question);
    }

    output += '</div></div>';
    return output;
    callback();
  }

  











































  // All the stuff for steps
  // $.when($.ajax(displayAllQuestions(allQuestions))).then(function () {
  // displayAllQuestions(allQuestions);
  displayAllQuestions(allQuestions, createQuizSteps);

  function createQuizSteps(){
    locationSelectEvents();
    $('input[type="text"]:not(X#zip)').prop('required', true);
    $('select').prop('required', true);
    // here's the js for the progress meter and steps
    var formLength = $('.form-section').length;
    var progressStep = (1 / formLength) * 100;
    var progressMeter = 0;
    var form = $('#js-quiz');
    var currentUserName = '';


    form.validate({
      errorPlacement: function errorPlacement(error, element) { element.before(error); }
    });

    form.steps({
      headerTag: 'span',
      bodyTag: 'div',
      labels: {
        next: 'Next',
        previous: '< Back',
        finish: 'See Results',
      },
      onInit: function (event, currentIndex) {
        $('.loading-overlay').fadeOut();
        $('.actions li').has('a[href="#previous"]').hide();
        $('a[href="#next"]').addClass('disable');
        $('#jsFormMessage').html('<div class="navbar-brand navbar-brand--center text-left mb-3"><img src="' + themeurl + '/assets/images/logo-agritecture.svg" alt="" height="40"><h1><strong>Agritecture</strong><br /><small>Designer</small></h1></div><h2 class="color-brand">Hi!</h2><p class="lead">You\'re just a few minutes away from knocking out the first step in any entrepreneur\'s journey: your vision. The following questions will help you set an intention for your project and help us provide you with a general timeline and some helpful inspiration.</p><a href="#" id="formStart" class="btn btn-transparent">Start</a>');

        //setTimeout(function() {
          $('#formStart').click( function() {
            $('.form-message').fadeOut(250);
            $('#jsFormMessage').html('');
        }); //, 4000);

          $('#qNumber').html(currentIndex + 1);
          $('.body.current input[type=radio]').on('change', function() {
            if($(this).val()) {
              $('a[href="#next"]').removeClass('disable');
            } else {
              $('a[href="#next"]').addClass('disable');
            }
          });

          $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              form.steps("next");
            }
          });
        },
        onStepChanging: function (event, currentIndex, newIndex)
        {
        // Always allow previous action even if the current form is not valid!
        if (currentIndex > newIndex)
        {
          return true;
        }

        if (currentIndex === 0) {
          currentUserName = $('.body.current input[type=text]').val();
          $('.actions li').has('a[href="#previous"]').show();
        }

        // This is to check checkboxes ; this is to make sure they can't progress
        if ($('.body.current').has($('.form-section__inputs--checkbox')).length > 0) {
          console.log('this has a checkbox input');
          if ($('.body.current input[type=checkbox]:checked').length == 0) {
            return false;
          }
        }


        // Check for icons
        if ($('.body.current').has($('.form-section__inputs--icon')).length > 0) {
          if ($('.body.current input[type=radio]').length > 0) {
            if ($('.body.current input[type=radio]:checked').length == 0) {
              alert ('Please choose an option');
              return false;
            }
          } else {
            if ($('.body.current input[type=checkbox]').length > 0) {
              if ($('.body.current input[type=checkbox]:checked').length == 0) {
                alert ('Please choose an option');
                return false;
              }
            }
          }
        }

        // Check if it has multipleYN questions, else do the same as the radio check
        if ($('.body.current').has($('.form-section__inputs--yn')).length > 0) {
          if ($('.body.current').has($('.form-multiple-yn')).length > 0) {
            console.log('this has a multipleYN inputs');
            var multipleYNCount = $('.body.current .form-multiple-yn').length;
            if ($('.body.current input[type=radio]:checked').length < multipleYNCount) {
              alert ('Please choose at least one option for each question');
              return false;
            } else {
              if ($('.body.current input[type=radio]:checked').length == multipleYNCount) {
                return true;
              }
            }
          } else {
            console.log('this has a radio input');
            if ($('.body.current input[type=radio]:checked').length == 0) {
              alert ('Please choose an option');
              return false;
            }
          }
        }

        // Needed in some cases if the user went back (clean up)
        if (currentIndex < newIndex)
        {
            // To remove error styles
            form.find(".body:eq(" + newIndex + ") label.error").remove();
            form.find(".body:eq(" + newIndex + ") .error").removeClass("error");
          }
          form.validate().settings.ignore = ":disabled,:hidden";
          return form.valid();
        },

        onStepChanged: function (event, currentIndex, priorIndex)
        {
          progressMeter = currentIndex * progressStep;
          window.scrollTo(0, 0);
          $('.actions li').has('a[href="#next"]').show();
          $('#qNumber').html(currentIndex + 1);

          if ($('.body.current').has($('input#loc'))) {
            locationSelectEvents();
          }


          // These are all to toggle .disabled class on the next button
          if ($('.body.current').has($('input[type=checkbox]')).length > 0) {
            $('a[href="#next"]').addClass('disable');
            $('.body.current input[type=checkbox]').change(function() {
              if ($('.body.current input[type=checkbox]:checked').length > 0) {
                $('a[href="#next"]').removeClass('disable');
              } else {
                $('a[href="#next"]').addClass('disable');
              }
            });
          }

          if ($('.body.current').has($('input[type=radio]')).length > 0) {
            $('a[href="#next"]').addClass('disable');
            $('.body.current input[type=radio]').change(function() {
              if ($('.body.current input[type=radio]:checked').length > 0) {
                $('a[href="#next"]').removeClass('disable');
              } else {
                $('a[href="#next"]').addClass('disable');
              }
            });
          }

          // If on userAuth step, disable the 'next' buttons and check for login status to proceed
          if($('.body.current').has('form#register')) {
            $('a[href="#next"], a[href="#finish"]').addClass('disable');//.hide();
            function userAuthStep() {
              var loggedIn = isLoggedIn();
              // console.log(loggedIn);
              var userAuthStepTimeout = setTimeout( function() {
                if(loggedIn != true) {
                  userAuthStep();
                } else {
                  var userAuthStepTimeout = '';
                  $('a[href="#next"], a[href="#finish"]').show().removeClass('disable');
                }
              }, 1000);
            }
            userAuthStep();
          } else {
            var userAuthStepTimeout = '';
          }


          // Rewrite this to trigger only when all 4 yns have been answered
          if ($('.body.current').has($('.form-multiple-yn')).length > 0) {
            $('a[href="#next"]').addClass('disable');

            var multipleYNCount = $('.body.current .form-multiple-yn').length;
            console.log('this is a multipleYN with ' + multipleYNCount);

            $('.body.current input[type=radio]').change(function() {
              if ($('.body.current input[type=radio]:checked').length == multipleYNCount) {
                $('a[href="#next"]').removeClass('disable');
              }
            });
          }


          // If an ALL checkbox is selected:
          // Activate ALL siblings and deselect self
          if ($('.body.current').has($('.form-check')).length > 0) {
            $('input[data-toggle="all"]').on('click',function() {
              $(this).prop("checked", false);
              $(this).parents('.form-check').siblings().find('input').each(
                function() { $(this).prop("checked",true); }
              );
            });
          }



          // Here goes the JavaScript to show post question messages.
          // The text that needs to change is the #jsFormMessage element
          // look at the current index
          // if the allPosts array has an object with the index = the current index
          // console.log('The current index is ' + currentIndex);
          if (allPosts.find(post => post.index === currentIndex)) {
            var currentPost = allPosts.find(post => post.index === currentIndex);

            // For the first edge case
            if (currentIndex === 2) {
              // if this is the case, then skip the bottom stuff
              if ($('#question2answer1').is(":checked")) {
                // show the message here because it's checked
                $('.form-message').show();
                $('#jsFormMessage').html(currentPost.post[0].text);
                $('.progress-wrapper').hide();
                $('.actions').hide();
              }
            } else {
              $('.form-message').show();

              function loopFormMessage(i, currentPostText) {
                setTimeout(function() {
                  $('#jsFormMessage').html(currentPostText);
                }, i * 2000);
              }

              for (var i = 0; i < currentPost.post.length; i++) {
                loopFormMessage(i, currentPost.post[i].text.replace("USERNAME", currentUserName));
              }

              setTimeout(function() {
                $('.form-message').hide();
                $('#jsFormMessage').html('');
              }, currentPost.post.length * 2000);
            }
          }

           // Set the width of the progress meter
           $('.progress-bar').css({
            "width" : progressMeter + "%"
          });

          // Question / Response Based Logic
          if (currentIndex === 27) {
            if ($('#question18answer0').is(":checked")) {
              form.steps("setStep", 31);
            }
          }
          // ! Question / Response Based Logic
        },
        onFinishing: function (event, currentIndex)
        {
          form.validate().settings.ignore = ":disabled";
          return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
          // show the Finished message
          $('.form-message').show();
          $('#jsFormMessage').html(
            '<img src="'+themeurl+'/assets/images/Agritecture-animated-logo.gif" class="loading" />'
            );
          $('.progress-wrapper').hide();
          $('.actions').hide();

          // get values for wpID & projectID & timestamp
          var wpID = $(form).attr('data-wpID');
          var wpName = $(form).attr('data-name');
          var wpEmail = $(form).attr('data-email');
          var projectID = $(form).attr('data-projectID');
          var timestamp = Date.now();

          // connect to Firestore
          var db = firebase.firestore();

          db.collection("users").doc(wpID).set({
            name: wpName,
            email: wpEmail,
            wpid: wpID,
          })
          .then(processForm)

          // append fields for wpid & userid (firebase id) & projectid & timestamp
          function processForm () {
            // update existing user in firebase
            var retUser= db.collection("users").doc(wpID);
            retUser.update({
              name: wpName,
              email: wpEmail,
              wpid: wpID,
            });
            // add fields to form for Firebase Survey entry
            $(form)
            .append('<input type="hidden" name="wpid" value="'+wpID+'" />')
            .append('<input type="hidden" name="userid" value="'+wpID+'" />')
            .append('<input type="hidden" name="projectid" value="'+projectID+'" />')
            .append('<input type="hidden" name="timestamp" value="'+timestamp+'" />');
            formData = form.serializeObject();

            // add the form data to Firestore
            db.collection("users/"+wpID+"/surveys").add(formData)
              .then(function(docRef) {
                console.log("Survey written with ID: ", docRef.id);
                jQuery.ajax({
                  type: 'POST',
                  dataType: 'json',
                  contentType: 'application/json',
                  url: 'https://us-east1-agritecture-prototyping.cloudfunctions.net/concept-survey',
                  data: JSON.stringify(formData),
                  success: function(data){
                    console.log('cachebuster');
                  }
                });
                // redirect to Concept Report
                setTimeout(function(){
                  console.log("ABOUT TO REDIRECT !!!")
                  window.location.href = '/concept-report?project=' + docRef.id + '&uid='+wpID;
                },3000);
              })
              .catch(function(error) {
                console.error("Error adding survey: ", error);
              });
          }

        }
      });
};

// This function is specific to the onboarding quiz
function displayAllQuestions(array, callback) {
  for (var i = 0; i < array.length; i++ ) {
    if (
      array[i].type == 'userAuth'
      && jQuery('body').hasClass('logged-in')
      ) {
      // if type=userAuth and user is already logged in
      // skip this question
    } else {
      displaySingleQuestion(array[i]);
    }
  }
  callback();
}
  // This is the code that actually renders everything
  // We need to run the jQuery wizard when this is done
  // TODO: We need to rewrite this function so that we can choose a selector
  // to append the output to
  function displaySingleQuestion(question) {
    var output = '';
    var questionText = '';
    customClass = (question.customClass ? question.customClass : '');

    if (question.text) {
      questionText = '<p>' + question.text + '</p>'
    }

    output = '<span class="wizard-header"></span>'
    + '<div class="form-section ' + customClass + '">'
    + '<div class="form-section__text">'
    + '<h4>'
    // for testing
    + question.index + '. '
    + question.question + '</h4>'
    + questionText
    + '</div>'
    + '<div class="form-section__inputs form-section__inputs--'
    + question.type + ' '+customClass+'">';

    if (question.type == "radio") {
      output += displaySingleRadio(question);
    }

    if (question.type == "icon") {
      output += displaySingleIcon(question);
    }

    if (question.type == "checkbox") {
      output += displaySingleCheckbox(question);
    }

    if (question.type == "text") {
      output += displaySingleText(question);
    }

    if (question.type == "yn") {
      output += displaySingleYesNo(question);
    }

    if (question.type == "range") {
      output += displaySingleRange(question);
    }

    if (question.type == "locationSelect") {
      output += displayLocationSelect(question);
    }

    if (question.type == "userAuth") {
      output += displayUserAuth(question);
    }

    output += '</div></div>';
    // What we can do is just return the output,
    // and then append the results of this output to a selected element

    $('#js-quiz').append(output);
  }



  // render html for userAuth
  function displayUserAuth(question) {
    var output = '';
    questionID = 'question' + question.index;
    output += '<div class="form-section__authform">'
    output += jQuery('#authform').html();
    jQuery('#authform').remove();
    output += '</div>';
    return output;
  }


  // render html for select
  function displayLocationSelect(question) {
    var output = '';
    var spacer = '&nbsp;&nbsp;';
    questionID = 'question' + question.index;
    output += '<div class="form-section__input">'
    + '<p>Enter a full address, city, state, or zip code</p>'
    + '<label class="sr-only" for="loc">Farm Location</label>'
    + '<input class="form-control" type="text" id="loc" name="loc" placeholder="Farm Location" required/>'
    + '</div>'
    + '<div id="map-preview"><img src="" alt="" title="" /><p class="alert"></p></div>'
    + '<input type="hidden" id="farm_location" name="farm_location" value="" />'
    + '<input type="hidden" id="farm_location_lat" name="farm_location_lat" value="" />'
    + '<input type="hidden" id="farm_location_long" name="farm_location_long" value="" />'
    return output;
  }

  // to render html for ranges
  function displaySingleRange(question) {
    var output = '';
    var questionID = 'question' + question.index;

    if (question.multiple) {
      for (var i = 0; i < question.options.length; i++) {
        questionID += i;
        rangeValueID = 'rangeValue' + questionID;
        defaultOutput = Math.floor(question.options[i].max / 2);

        if (question.options[i].percent == true) {
          percent = '%';
          questionMinText = question.options[i].min;
          questionMaxText = question.options[i].max;
        } else {
          percent = '';
          questionMinText = question.options[i].minText;
          questionMaxText = question.options[i].maxText;
        }

        if (question.options[i].percent == true) {
          var percent = '%';
        } else {
          var percent = '';
        }

        output += '<h3>' + question.options[i].name + '</h3>'
        + '<div class="form-range">'
        // + '<span class="form-range__value">'
        // + '<output id="' + rangeValueID + '"'
        // + 'onforminput="value=' + questionID + '.valueAsNumber"' + '>'
        // + defaultOutput + '</output>'
        // + percent + '</span>'
        + '<input type="range" class="form-control-range"'
        + 'name="' + questionID + '"'
        + 'oninput="' + rangeValueID + '.value=' + questionID + 'value"'
        + 'id="' + questionID + '"'
        + 'min="' + question.options[i].min + '"'
        + 'max="' + question.options[i].max + '"'
        + 'step="' + question.options[i].step + '">'
        + '<div class="clearfix">'
        + '<span class="form-range__min">' + questionMinText +'%</span>'
        + '<span class="form-range__max">' + questionMaxText +'%</span>'
        + '</div></div>'
      }
    } else {
      defaultOutput = Math.floor(question.max / 2);

      if (question.percent == true) {
        var percent = '%';
        var questionMinText = question.min;
        var questionMaxText = question.max;
      } else {
        var percent = '';
        var questionMinText = question.minText;
        var questionMaxText = question.maxText;
      }

      rangeValueID = 'rangeValue' + questionID;
      output += '<div class="form-range">'
      // + '<span class="form-range__value">'
      // + '<output id="' + rangeValueID + '"'
      // + 'onforminput="value=' + questionID + '.valueAsNumber"' + '>'
      // + percent + '</span>'
      + '<input type="range" class="form-control-range"'
      + 'name="' + questionID + '"'
      + 'id="' + questionID + '"'
      + 'min="' + question.min + '"'
      + 'max="' + question.max + '"'
      + 'step="' + question.step + '">'
      + '<div class="clearfix">'
      + '<span class="form-range__min">' + questionMinText +'</span>'
      + '<span class="form-range__max">' + questionMaxText +'</span>'
      + '</div></div>'
    }
    return output;
  }

  // To render HTML for icon radio question
  function displaySingleText(question) {
    var output = '';
    output += '<input class="form-control" type="text" name="'
    + question.name + '" placeholder="'
    + question.placeholder
    + '"">'
    return output;
  }

  // To render HTML for icon radio question
  function displaySingleIcon(question) {
    var output = '';
    questionID = question.name;
    if (question.checkbox) {
      var inputType = 'checkbox';
      questionID = questionID + '[]';
    } else {
      var inputType = 'radio';
    }

    for (var i = 0; i < question.options.length; i++) {
      option = question.options[i];
      optionID = option.name;
      optionText = option.text;
      optionToggle = option.toggle ? "data-toggle="+option.toggle : '';
      if(optionText.includes("|")) {
        optionText = optionText.split("|");
        optionText = optionText[0]+" <small>"+optionText[1]+"</small>";
      }
      output += '<div class="form-check form-check--icon">'
      + '<input class="form-check-input" '
      + 'name="'+ questionID + '" '
      + 'value="' + optionID  + '" '
      + 'id="'+ questionID + '_' + optionID  + '" '
      + optionToggle + ' '
      + 'type="' + inputType + '" >'
      + '<label class="form-check-label"'
      + 'for="' + questionID + '_'+ optionID + '">'
      + '<div class="form-check-icon">'
      + '<img src="' + pathToIcons
      + option.icon + '"></div>'
      + '<span class="form-check-text">'+ optionText +'</span>'
      + '</label>'
      + '</div>'
    }
    return output;
  }

  // To render HTML for checkbox question
  function displaySingleCheckbox(question) {
    var output = '';
    questionID = 'question' + question.index;
    for (var i = 0; i < question.options.length; i++) {
      answerID = questionID + 'answer' + i;
      questionOption = question.options[i];
      output += '<div class="form-check form-check--checkbox">'
      + '<input class="form-check-input" id="'
      + answerID + '" '
      + 'name="'
      + questionID + '"'
      + 'type="checkbox"><label class="form-check-label" for="'
      + answerID + '"><span class="form-check-marker"></span><span class="form-check-text">'
      + questionOption
      + "</span></label></div>"
    }
    return output;
  }

  // To render HTML for radio question
  function displaySingleRadio(question) {
    var output = '';
    questionID = question.name;

    for (var i = 0; i < question.options.length; i++) {
      option = question.options[i];
      optionID = option.name;
      optionText = option.text;
      if(optionText.includes("|")) {
        optionText = optionText.split("|");
        optionText = optionText[0]+" <small>"+optionText[1]+"</small>";
        detailedOption = 'detailed';
      }
      else { detailedOption = ''; }
      output += '<div class="form-check form-check--radio '+detailedOption+'">'
      + '<input class="form-check-input"'
      + 'name="' + questionID + '" '
      + 'value="' + optionID  + '" '
      + 'id="a_' + optionID  + '" '
      + 'type="radio">'
      + '<label class="form-check-label"'
      + 'for="a_'+ optionID + '">'
      + '<span class="form-check-marker"></span>'
      + '<span class="form-check-text">'+ optionText +'</span>'
      + '</label>'
      + '</div>'
    }
    return output;
  }

  // To render HTML for radio question
  function displaySingleYesNo(question) {
    var output = '';
    questionID = 'question' + question.index;

    if (question.multiple) {
      for (var i = 0; i < question.options.length; i++) {
        questionID += i;
        answerYes = questionID + 'Yes';
        answerNo = questionID + 'No';
        output += '<div class="form-multiple-yn">'
        + '<h3>' + question.options[i] + '</h3>'
        + '<div class="form-check form-check--yn">'
        + '<input class="form-check-input" type="radio" name="'
        + questionID + '" id="'
        + answerYes + '" value="yes">'
        + '<label class="form-check-label" for="'
        + answerYes + '"><span class="form-check-text"><img src="/img/yes.svg"><br>Yes</span></label></div>'
        + '<div class="form-check form-check--yn">'
        + '<input class="form-check-input" type="radio" name="'
        + questionID + '" id="'
        + answerNo + '" value="no">'
        + '<label class="form-check-label" for="'
        + answerNo + '"><span class="form-check-text"><img src="/img/no.svg"><br>No</span></label></div></div>'
      }
    } else {
      questionID = 'question' + question.index;
      output = '<div class="form-check form-check--yn">'
      + '<input class="form-check-input" id="'
      + questionID + 'Yes" '
      + 'name="'
      + questionID + '"'
      + 'type="radio"><label class="form-check-label" for="'
      + questionID + 'Yes"><span class="form-check-text"><img src="/img/yes.svg"><br>Yes</span></label></div>'
      + '<div class="form-check form-check--yn">'
      + '<input class="form-check-input" id="'
      + questionID + 'No" '
      + 'name="'
      + questionID + '"'
      + 'type="radio"><label class="form-check-label" for="'
      + questionID + 'No"><span class="form-check-text"><img src="/img/no.svg"><br>No</span></label></div>'
    }
    return output;
  }
})(jQuery);
