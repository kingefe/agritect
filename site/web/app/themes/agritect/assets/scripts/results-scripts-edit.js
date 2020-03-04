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
  var wpID = jQuery('meta[name="wpID"]').attr('content');
  // get Firebase user ID based on WordPress ID
  db.collection("users/" + wpID + "/surveys")
    .orderBy("timestamp","desc")
    .limit(1)
    .get()
    .then((querySnapshot) => {
      var projectID = false;

      querySnapshot.forEach((doc) => {
        projectID = doc.id;
      });

      return projectID;
    });
};

console.log(getWPUserVisionID());

// Just a function to return the's logged-in user's project
function getProjectData(projectID) {
  var db = firebase.firestore();
  var wpID = jQuery('meta[name="wpID"]').attr('content');
  db.collection("/users/" + wpID + "/surveys")
    .doc(projectID)
    .onSnapshot(function(doc) {
      return doc.data();
    });
}

// Get Concept Report Results (ie: recommendations)
function getConceptReportData(projectData) {
  jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    contentType: 'application/json',
    url: 'https://us-east1-agritecture-prototyping.cloudfunctions.net/concept-survey',
    data: JSON.stringify(projectData),
    success: function(data){
      return data;
    }
  });
}

// Display the Farm Examples based on the Concept Report from the Project
function displayFarmExamples(conceptReportData) {
  let recommendations = conceptReportData.recommendations; // get the farms
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

// Display the vision badges using the concen
function displayVisionBadges(conceptReportData) {
  let container = '.project-details .vision-badges'; // set the container to populate
  let imgdir = themeurl + '/assets/images/icons/'; // set the path for icon files
  Object.keys(conceptReportData).forEach(function(questionName){ // foreach of the survey responses
    let answerBadges = [], // prepare to populate response badges
      answerName = conceptReportData[questionName], // capture the answer name (code)
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

// Add Username to Concept Report
function displayUserName(wpID) {
  var db = firebase.firestore();
  db.collection("users")
    .doc(wpID)
    .onSnapshot(function(doc) {
      jQuery('.user_name').text(doc.data().name + "'s");
    });
}


// Run this function with the projectID on the concept report page
// history.replaceState('', 'Your Urban Farm Vision', '/concept-report?project=' + visionID);
function loadConceptReport() {
  var projectData = '';
  var conceptReportData = '';
  var projectID = '';
  var wpID = jQuery('meta[name=wpID]').attr('content');

  // if Project ID is specified in URL
  if(getUrlVars()['project']) {
    projectID = getUrlVars()['project'];
  // if no Project ID is specified and visitor is user, show their latest Vision
  } else if (wpID > 0) {
    projectID = getWPUserVisionID();
    console.log('the project id is ' + projectID);
  } else {
    document.location = '/';
  }

  projectData = getProjectData(projectID);
  conceptReportData = getConceptReportData(projectData);

  // if the user has a correct project ID and we can find the concept report
  if ((projectData != undefined) && (conceptReportData != undefined)) {
    displayVisionBadges(projectData);
    displayFarmExamples(conceptReportData);
    displayUserName(wpID);
    history.replaceState('', 'Your Urban Farm Vision', '/concept-report?project=' + visionID);
  }
}