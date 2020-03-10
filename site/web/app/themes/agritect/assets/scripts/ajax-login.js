// LOG IN EXISTING USER
function ajaxLoginSubmit() {
  console.log("Inside ajaxLoginSubmit")
  jQuery('form#login').on('submit', function(e){
    jQuery('form#login p.status').show().text(ajax_login_object.loadingmessage);

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajax_login_object.ajaxurl,
      data: {
        'action': 'ajaxlogin', //calls wp_ajax_nopriv_ajaxlogin
        'username': jQuery('form#login #username').val(),
        'password': jQuery('form#login #password').val(),
        'security': jQuery('form#login #security').val()
      },
      success: function(data) {
        console.log("SUCCESS ! data is: ", data)
        jQuery('form#login p.status').text(data.message);

        if (data.loggedin == true)
          getFirebaseToken(function () {
            console.log('in response from get token')
            postLogin(data)
          })
      },
      error: function (a,b,c,d,e,f) {
        console.log("ERROR ! error is: ", a,b,c,d,e,f)
      }
    });
    e.preventDefault();
  });
}

// REGISTER NEW USER
function ajaxRegisterSubmit() {
  jQuery('form#register').on('submit',function(e){
    jQuery('form#register .message').show().text('Creating your account...');

    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      url: ajaxurl,
      data: {
        'action': 'register_user_front_end',
        'new_user_name' : jQuery('#new-username').val(),
        'new_user_email' : jQuery('#new-useremail').val(),
        'new_user_password' :  jQuery('#new-userpassword').val()
      },
      success: function(data) {
        jQuery('form#register p.message').text(data.message);

        if(data.registered == true)
          getFirebaseToken(function () {
            postLogin(data)
          })
      }
    });

    e.preventDefault();
  });
}

window.getFirebaseToken = function getFirebaseToken (callback) {
  console.log('about to do getFirebaseToken stuff')
  jQuery.ajax({
    type: 'POST',
    dataType: 'json',
    url: ajaxurl,
    data: {
      'action': 'user_meta',
    },
    success: function (tokenData) {
      console.log("Succesfull, token data is: ", tokenData)
      firebase.auth()
        .signInWithCustomToken(tokenData.firebase_token)
        .then(callback);
    },
    error: function (a,b,c,d,e,f) {
      console.log("ERROR ! error is: ", a,b,c,d,e,f)
    }
  })
}

function postLogin (data) {
  console.log("inside postLogin")
  console.log("data is: ", data)
  jQuery('body').addClass('logged-in')
  jQuery('#loginModal').modal('hide')

  jQuery('form#js-quiz')
    .attr('data-wpID',          data.wpid)
    .attr('data-email',         data.user_email)
    .attr('data-name',          data.user_name)
    // .attr('data-firebaseToken', tokenData.firebase_token)

  jQuery('form#register').html('<h3>Welcome, '+data.user_name+'!</h3>')
}
