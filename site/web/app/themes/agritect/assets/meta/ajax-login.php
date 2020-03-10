<?php
function ajax_login_init(){
  // c/t - http://natko.com/wordpress-ajax-login-without-a-plugin-the-right-way/

  wp_register_script('ajax-login-script', get_template_directory_uri() . '/assets/scripts/ajax-login.js', array('jquery'),5.5,true );
  wp_enqueue_script('ajax-login-script');

  wp_localize_script( 'ajax-login-script', 'ajax_login_object', array(
    'ajaxurl' => admin_url( 'admin-ajax.php' ),
    'redirecturl' => home_url(),
    'loadingmessage' => __('Sending user info, please wait...')
  ));

  // Enable the user with no privileges to run ajax_login() in AJAX
  add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );
}

add_action('init', 'ajax_login_init');



// AJAX LOGIN
function ajax_login(){

  // First check the nonce, if it fails the function will break
  check_ajax_referer( 'ajax-login-nonce', 'security' );

  // Nonce is checked, get the POST data and sign user on
  $info = array();
  $info['user_login'] = $_POST['username'];
  $info['user_password'] = $_POST['password'];
  $info['remember'] = true;

  $user_signon = wp_signon( $info, false );
  if ( is_wp_error($user_signon) ){
    if(array_key_exists('incorrect_password',$user_signon->errors)) {
      echo json_encode(array('loggedin'=>false, 'message'=>__('Incorrect email address or password'), 'code'=>'wrong_password' ));
    } else {
      echo json_encode(array('loggedin'=>false, 'message'=>__('Incorrect email address or password'), 'code'=>'invalid_account' ));
    }
  } else {
    echo json_encode(
      array(
        'loggedin'=>true,
        'message'=>__('Login successful...'),
        'wpid'=>$user_signon->data->ID,
        'user_email'=>$user_signon->data->user_email,
        'user_name'=>$user_signon->data->display_name,
      ));
  }

  die();
}


// AUTO LOGIN ON REGISTER
// deactivated, interferes with ajax register
function auto_login_new_user( $user_id ) {
  wp_set_current_user($user_id);
  wp_set_auth_cookie($user_id);
  $user = get_user_by( 'id', $user_id );
  do_action( 'wp_login', $user->user_login );//`[Codex Ref.][1]
  // wp_redirect( home_url() ); // You can change home_url() to the specific URL,such as "wp_redirect( 'http://www.wpcoke.com' )";
  exit;
}
// add_action( 'user_register', 'auto_login_new_user' );



// AJAX REGISTER USER
add_action('wp_ajax_register_user_front_end', 'register_user_front_end', 0);
add_action('wp_ajax_nopriv_register_user_front_end', 'register_user_front_end');
function register_user_front_end() {
  $new_user_name = stripcslashes($_POST['new_user_name']);
  $new_user_email = stripcslashes($_POST['new_user_email']);
  $new_user_password = $_POST['new_user_password'];
  $user_data = array(
    'user_login' => $new_user_email,
    'user_email' => $new_user_email,
    'user_pass' => $new_user_password,
    'user_nicename' => $new_user_name,
    'display_name' => $new_user_name,
    'nickname' => $new_user_name,
    'first_name' => $new_user_name,
    'role' => 'subscriber'
  );
  $user_signup = wp_insert_user($user_data);
  if (is_wp_error($user_signup)) {
    if (isset($user_signup->errors['empty_user_login'])) {
      echo json_encode( array(
        'registered'=>false,
        'message'=>'User Name and Email are mandatory',
        'code'=>'missing_required'
      ) );
    } elseif (isset($user_signup->errors['existing_user_login'])) {
      echo json_encode( array(
        'registered'=>false,
        'message'=>'User already exists.',
        'code'=>'user_exists'
      ) );
    } else {
      echo json_encode( array(
        'registered'=>false,
        'message'=>'Error occurred, please confirm your entries and try again.',
        'code'=>'error_occurred'
      ) );
    }
  } else {
    // log the user in
    wp_set_current_user($user_signup);
    wp_set_auth_cookie($user_signup);
    // get user meta for response
    $user_signon = wp_get_current_user($user_signup);
    echo json_encode( array(
      'registered'=>true,
      'message'=>__('Logging you in...'),
      'id'=>$user_signup,
      'wpid'=>$user_signon->ID,
      'user_email'=>$user_signon->user_email,
      'user_name'=>$user_signon->first_name,
    ) );
  }
  die;
}

?>
