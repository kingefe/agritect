// TODO: Fix the part of this script at the bottom that replaces the URL
// Get Onboarding Form Field Data - assets/scripts/form-onboard.js
// used to retrieve data from the onboarding questionnaire json
// for referencing data such as option text and icon urls
function getSurveyQuestionParams(name) {
  return allQuestions.filter(
    function(allQuestions){ return allQuestions.name == name; }
  );
}
function getSurveyResponseParams(name,question) {
  return question.filter(
    function(question){ return question.name == name; }
  );
}

// Get Concept Survey Repsonses from Firestore
// doc.data() returns the concept report responses
// Can we change this getCurrentProject function to run a specific set of functions
// that are defined elsewhere, like a callback(), but not when the previous function runs?
function getCurrentProject(project) {
  // the db is the firebase db
  var db = firebase.firestore();
  // get the user's wpID from the meta tag (is this secure?)
  // var wpID = jQuery('meta[name="wpID"]').attr('content');
  console.log("updated wpid grab")
  let wpID = new URLSearchParams(window.location.search).get('uid')
  // query the db and find the right user's survey based on the wpID
  db.collection("/users/" + wpID + "/surveys")
    // get the project specific data from the survey
    .doc(project)
    // when you get that, run these functions using that object
    .onSnapshot(function(doc) {
      // this function displays all the badges
      // it takes the json object from the query and cleans that data using
      // the getSurveyQuestionParams + getSurveyResponseParams functions up on the top
      populateCurrentProject(doc.data());
      // this queries the db and gets the concept survey results
      getConceptReport(doc.data());
      getUserName(wpID);
      // console.log(doc.data());
      return doc.data();
    });
}

// Write page specific functions that don't replace the URL
// These should only worked for logged in users who have access to this page
function displayVisionBadges() {
  var db = firebase.firestore();
  var wpID = jQuery('meta[name="wpID"]').attr('content');

  db.collection("users/" + wpID + "/surveys")
    .orderBy("timestamp","desc")
    .limit(1)
    .get()
    .then((querySnapshot) => {
      querySnapshot.forEach((doc) => {
        populateCurrentProject(doc.data());
      });
    });
}

function displaySharingLinks() {
  var db = firebase.firestore();
  var wpID = jQuery('meta[name="wpID"]').attr('content');

  db.collection("users/" + wpID + "/surveys")
    .orderBy("timestamp","desc")
    .limit(1)
    .get()
    .then((querySnapshot) => {
      var visionID = false;
      querySnapshot.forEach((doc) => {
        visionID = doc.id;
        // generate the concept survey url
        var conceptReportURL = window.location.protocol + '//' + window.location.host + '/concept-report?project=' + visionID;
        
        // encode it properly
        conceptReportURL = encodeURIComponent(conceptReportURL);

        // set the tags
        document.getElementById('dashboardShareLinkedIn').href = 'https://www.linkedin.com/shareArticle?url=' + conceptReportURL + '&title=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer:%20';
        document.getElementById('dashboardShareTwitter').href = 'https://twitter.com/intent/tweet?url=' + conceptReportURL +'&text=Check%20out%20my%20Urban%20Farm%20Vision%20on%20Agritecture%20Designer%3A%20';
        document.getElementById('dashboardShareFacebook').href = 'https://www.facebook.com/sharer/sharer.php?u=' + conceptReportURL;
        document.getElementById('dashboardShareWhatsapp').href = 'https://wa.me/?text=Check out my Urban Farm Vision on Agritecture Designer: ' + conceptReportURL;
      });
    });

}

function displayFarmExamples() {
  var db = firebase.firestore();
  var wpID = jQuery('meta[name="wpID"]').attr('content');

  db.collection("users/" + wpID + "/surveys")
    .orderBy("timestamp","desc")
    .limit(1)
    .get()
    .then((querySnapshot) => {
      querySnapshot.forEach((doc) => {
        getConceptReport(doc.data());
      });
    });
}

// in case project URL parameter is not set:
// Get the Current WP user's latest Concept Survey Repsonses from Firestore
// TODO: check the page url to see if it includes 'concept-report'
// if it has it, append the visionID
// if not, then don't
// however, we need that link to be on the share buttons
// more to come. need to figure this out.
// save this in a variable 
function getWPUserVisionID() {
  var db = firebase.firestore();
  // get current user's WordPress ID
  // var wpID = jQuery('meta[name="wpID"]').attr('content');
  console.log("updated wpid grab")
  let wpID = new URLSearchParams(window.location.search).get('uid')
  // get Firebase user ID based on WordPress ID
  db.collection("users/" + wpID + "/surveys")
    .orderBy("timestamp","desc")
    .limit(1)
    .get()
    .then((querySnapshot) => {
      var visionID = false;
      querySnapshot.forEach((doc) => {
        visionID = doc.id;
        visionData = doc.data();
        history.replaceState('', 'Your Urban Farm Vision', '/concept-report?project=' + visionID);
        getCurrentProject(visionID);
      });
    });
};

// Add Username to Concept Report
function getUserName(wpID) {
  var db = firebase.firestore();
  db.collection("users")
    .doc(wpID)
    .onSnapshot(function(doc) {
      jQuery('.user_name').text(doc.data().name + "'s");
    });
}

// Get Concept Report Results (ie: recommendations)
// This is the function running that pulls just the farm examples that they want to display
function getConceptReport(conceptData) {
  jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    contentType: 'application/json',
    url: 'https://us-east1-agritecture-prototyping.cloudfunctions.net/concept-survey',
    data: JSON.stringify(conceptData),
    success: function(data){
      populateFarmExamples(data);
    }
  });
}

// Populate Current Project
function populateCurrentProject(conceptData) {
  let container = '.project-details .vision-badges'; // set the container to populate
  let imgdir = themeurl + '/assets/images/icons/'; // set the path for icon files
  Object.keys(conceptData).forEach(function(questionName){ // foreach of the survey responses
    let answerBadges = [], // prepare to populate response badges
      answerName = conceptData[questionName], // capture the answer name (code)
      questionParams = getSurveyQuestionParams(questionName); // and the question parameters
    if(questionParams[0]) { // if the question exists
      if(!Array.isArray(answerName)) { answerName = [answerName]; } // confirm response is in Array format
      // Compile the response badge markup
        answerName.forEach(function(aAnswerName) {
        answerParams = getSurveyResponseParams(aAnswerName,questionParams[0].options); // get the answer params
        let answerQuestion = questionParams[0].badge,
            answerText = answerParams[0].text.split('|')[0],
            answerImage = answerParams[0].icon;
        answerBadges.push(
          '<div class="vision-badge">'
          + '<span class="icon"><img src="'+imgdir+answerParams[0].icon+'"/></span>'
          + '<span class="question">'+answerQuestion+'</span>'
          + '<span class="response">'+answerText+'</span>'
          + '</div>'
        );
      });
    }
    jQuery(container + ' .' + questionName + ' .badges').html(answerBadges);
  });
}

// Populate Farm Examples, from Concept Report
function populateFarmExamples(conceptReport) {
  let recommendations = conceptReport.recommendations; // get the farms
  let container = '.inspiration .farms'; // set the container to populate
  // Duplicate the farm template to match the number of returned Farm Examples
  for(var i = 1; i < recommendations.length; i++){
    jQuery('.farms .farm').first().clone().appendTo(".farms");
  }
  recommendations.forEach(function(farm,i){ // foreach of the survey responses
    // Process data by case
    Object.keys(farm).forEach(function(key){
      let farmcontainer = container + ' .farm:nth-of-type(' + (i+1)  + ')';
      let farmelement = farmcontainer + ' .' + key.replace(' ','-');
      let farmvalue = farm[key].toString();
      if(key=="image") { // for Farm image
        jQuery(farmelement).find('img').attr('src',farm[key]);
      } else if(farmvalue.indexOf('http')>=0) {
        jQuery(farmelement).attr('href',farm[key]);
      } else if(key=='match') {
        let matchscore = Math.round(farm[key] * 100) + '/100';
        jQuery(farmcontainer).find('.score').html(matchscore);
      } else {
        jQuery(farmelement).html(farm[key]);
      }
    });
  });
}

// Load the Concept Report!
function loadConceptReport() {
  if(getUrlVars()['project']) { // if Project ID is specified in URL
    // getUrlVars() is defined in main.js
    getCurrentProject(getUrlVars()['project']);
  } else if ( jQuery('meta[name=wpID]').attr('content') > 0 ) { // if no Project ID is specified and visitor is user, show their latest Vision
    // This function gets the WPUserID + runs getCurrentProject with that information
    getWPUserVisionID();
  } else {
    document.location = '/';
  }
}



