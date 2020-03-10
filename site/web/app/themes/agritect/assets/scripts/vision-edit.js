// TODO:
// - enqueue this script in the functions.js
// - pull in the answers that are stored in the firebase from the results-scripts.js
// - render each of the questions differently on this page
// - submitting will update the answers to the vision report
// NICETOHAVE:
// - fixing the taskrunners to include the files in the 'scripts' folder
// This function is specific to the onboarding quiz
function displayAllEdits(array, callback) {
  var output = '';
  for (var i = 0; i < array.length; i++ ) {
    if ( array[i].type == 'userAuth' && jQuery('body').hasClass('logged-in')) {
      // if type=userAuth and user is already logged in
      // skip this question
    } else {
      output += displaySingleEdit(array[i]);
    }
  }
  callback();
  return output;
}

function displaySingleEdit(question) {
    var output = '';
    var questionText = '';
    var targetID = 'projectVisionEditSection'+ question.index;
    customClass = (question.customClass ? question.customClass : '');

    if (question.text) {
      questionText = '<small>' + question.text + '</small>'
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
  }

  $('#projectVisionEdit').append(displayAllEdits(allQuestions));
