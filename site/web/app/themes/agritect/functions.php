<?php

// Requires: composer require firebase/php-jwt
require_once('php-jwt-master/src/JWT.php');
use Firebase\JWT\JWT;


# Imports Auth libraries and Guzzle HTTP libraries.
use Google\Auth\OAuth2;
use Google\Auth\Middleware\ScopedAccessTokenMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

/**
 * Sage includes
 *
 * The $sage_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/sage/pull/1042
 */
$theme_includes = [
   // SAGE DEFAULTS
  'lib/assets.php',    // Scripts and stylesheets
  'lib/extras.php',    // Custom functions
  'lib/setup.php',     // Theme setup
  'lib/titles.php',    // Page titles
  'lib/wrapper.php',   // Theme wrapper class
  'lib/customizer.php', // Theme customizer

  // CMS ADD-ONS
  'assets/meta/user-logged-in.php', // Ajax is user logged in
  'assets/meta/ajax-login.php', // Ajax login
  'assets/meta/email-login.php', // Only allow login/register via email
];

foreach ($theme_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'sage'), $file), E_USER_ERROR);
  }
  require_once $filepath;
}
unset($file, $filepath);

// FORM SCRIPTS
function form_scripts() {

  // Theme Funcs
  wp_enqueue_script('agritect-main', get_template_directory_uri() . ('/assets/scripts/main.js'), ['jquery'], null, true);
  wp_enqueue_script('fontawesome', 'https://kit.fontawesome.com/e633042268.js', ['jquery'], null, true);

  // Login
  wp_enqueue_script('ajax-login', get_template_directory_uri() . ('/assets/scripts/ajax-login.js'), ['jquery'], null, true);

  // Firebase
  wp_enqueue_script('firebase-app', ('https://www.gstatic.com/firebasejs/6.4.2/firebase-app.js'), ['jquery'], null, true);
  wp_enqueue_script('firebase-config', get_template_directory_uri() . ('/assets/scripts/firebase-config.js'), ['jquery'], null, true);
  wp_enqueue_script('firebase-auth', ('https://www.gstatic.com/firebasejs/6.4.2/firebase-auth.js'), ['jquery'], null, true);
  wp_enqueue_script('firebase-firestore', ('https://www.gstatic.com/firebasejs/6.4.2/firebase-firestore.js'), ['jquery'], null, true);
  
  // jQuery Steps / Forms
  wp_enqueue_script('jquery_validate', ('https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js'), ['jquery'], null, true);
  wp_enqueue_script('jquery_steps', get_template_directory_uri() . ('/assets/scripts/jquery-steps.js'), ['jquery'], null, true);

  // Forms Content
  wp_enqueue_script('form_onboard', get_template_directory_uri() . ('/assets/scripts/form-onboard.js'), ['jquery'], null, true);
  wp_enqueue_script('form_locations', get_template_directory_uri() . ('/assets/scripts/form-locations.js'), ['jquery'], null, true);
  wp_enqueue_script('form_serialize', get_template_directory_uri() . ('/assets/scripts/form-serialize.js'), ['jquery'], null, true);
  wp_enqueue_script('form_scripts', get_template_directory_uri() . ('/assets/scripts/forms.js'), ['jquery'], null, true);
  wp_enqueue_script('form_scripts', get_template_directory_uri() . ('/assets/scripts/vision-edit.js'), ['jquery'], null, true);

  // Response / Results Content
  wp_enqueue_script('results_scripts', get_template_directory_uri() . ('/assets/scripts/results-scripts.js'), ['jquery'], null, true);
  wp_enqueue_script('designer', Roots\Sage\Assets\asset_path('index.js'), [], null, true);
}
add_action( 'wp_footer', 'form_scripts' );

function bootstrap_scripts() {
  // jQuery Slim, Bootstrap and Popper JS
  // wp_enqueue_script('jquery_slim', ('https://code.jquery.com/jquery-3.3.1.slim.min.js'), ['jquery'], null, true);
  wp_enqueue_script('popper', ('https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js'), ['jquery'], null, true);
  wp_enqueue_script('bootstrap', ('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js'), ['jquery'], null, true);
}

add_action( 'wp_footer', 'bootstrap_scripts' );

// Clean up YouTube oEmbeds
function iweb_modest_youtube_player( $html, $url, $args ) {
  return str_replace( '?feature=oembed', '?feature=oembed&enablejsapi=1&showinfo=0&rel=0', $html );
}
add_filter( 'oembed_result', 'iweb_modest_youtube_player', 10, 3 );

// Only admins can see the wp-admin
if ( is_admin() && ( !defined('DOING_AJAX') || ! DOING_AJAX ) && !current_user_can('manage_options') ) {
  wp_redirect( get_bloginfo( 'url' ) );
}

add_action('wp_logout','redirect_after_logout');
function redirect_after_logout(){
  wp_redirect( '/' );
  exit();
}

add_action('wp_login','redirect_after_login');
function redirect_after_login () {
  $user = wp_get_current_user();
  create_custom_token($user->ID, false);

  if ( !current_user_can('manage_options') && !wp_doing_ajax()) {
    wp_redirect( '/concept-report' );
  }
}

$ajax_prefix = 'wp_ajax_';

add_action("${ajax_prefix}model_viewer", function () {
  // $ch = curl_init('https://us-east1-agritecture-prototyping.cloudfunctions.net/model-viewer');
  $body = file_get_contents('php://input');

  // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
  // curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
  // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //   'Content-Type: application/json',
  //   'Content-Length: ' . strlen($body)
  // ));

  // $result = curl_exec($ch);
  $path_to_service_account = dirname(__FILE__).'/agritecture-prototyping-1bd228f553a8.json';
  $service_account_key = json_decode(file_get_contents($path_to_service_account), true);
  $oauth_token_uri = 'https://www.googleapis.com/oauth2/v4/token';
  $iam_scope = 'https://www.googleapis.com/auth/iam';
  $oauth = new OAuth2([
    'audience' => $oauth_token_uri,
    'issuer' => $service_account_key['client_email'],
    'signingAlgorithm' => 'RS256',
    'signingKey' => $service_account_key['private_key'],
    'tokenCredentialUri' => $oauth_token_uri,
  ]);

  $client_id = 'https://us-east1-agritecture-prototyping.cloudfunctions.net/model-viewer';
  $oauth->setGrantType(OAuth2::JWT_URN);
  $url = $client_id;
  $oauth->setAdditionalClaims(['target_audience' => $client_id]);

  # Obtain an OpenID Connect token, which is a JWT signed by Google.
  $token = $oauth->fetchAuthToken();
  $id_token = $oauth->getIdToken();

  $middleware = new ScopedAccessTokenMiddleware(
    function () use ($id_token) {
        return $id_token;
    },
    $iam_scope
  );

  $stack = HandlerStack::create();
  $stack->push($middleware);


  # Create an HTTP Client using Guzzle and pass in the credentials.
  $http_client = new Client([
    'handler' => $stack,
    'base_uri' => $url,
    'auth' => 'scoped'
  ]);

  # Make an authenticated HTTP Request
  $response = $http_client->request('POST', '/model-viewer', [
    'body' => $body,
    'headers' => [
      'Content-Type' => 'application/json'
    ]
  ]);

  wp_send_json(json_decode($response->getBody()));

});

add_action("${ajax_prefix}user_meta", function () {
  $user = wp_get_current_user();

  wp_send_json(array(
    "firebase_token" => create_custom_token($user->ID, false)
  ));
});

// add_action("user_register", function ($user_id) {
//   update_user_meta($user_id, 'firebase_token', create_custom_token($user_id, false));
// });

function create_custom_token ($uid, $is_premium_account) {
  // var_dump(shell_exec('ls ' . dirname(__FILE__) .'/../../../..'));
  $credentials = json_decode(file_get_contents(dirname(__FILE__) . '/agritecture-firestore-ed34e3f166cd.json'));
  $now_seconds = time();

  $payload = array(
    "iss" => $credentials->client_email,
    "sub" => $credentials->client_email,
    "aud" => "https://identitytoolkit.googleapis.com/google.identity.identitytoolkit.v1.IdentityToolkit",
    "iat" => $now_seconds,
    "exp" => $now_seconds+(60*60),  // Maximum expiration time is one hour
    "uid" => $uid,
    "claims" => array(
      "premium_account" => $is_premium_account
    )
  );

  return JWT::encode($payload, $credentials->private_key, "RS256");
}

// update_user_meta($user_id, 'firebase_token', create_custom_token($user_id, false));

function render_subscribe_button_by_subscription_id($id){
  $atts = array(
    'subscription_plans' => [],
    'exclude' => [],
    'selected' => ''
  );

  // Exit if accessed directly
  if ( ! defined( 'ABSPATH' ) ) exit;
    /*
      * HTML output for new subscription form
      *
      * @param $atts     - is available from parent file, in the register_form method of the PMS_Shortcodes class
      */
    $form_name = 'new_subscription';

  $member = pms_get_member(get_current_user_id());

  if ($member->subscriptions){
    $member_id           = ( ! empty( $user_id ) ? $user_id : pms_get_current_user_id() );
    $subscription_plans  = ( ! empty( $_POST['subscription_plans'] ) ? array( trim( $_POST['subscription_plans'] ) ) : array() );

    foreach($member->subscriptions as $subscription_data) {
      $subscription = pms_get_member_subscription( (int)$subscription_data['id'] );

      if ($subscription->status == "pending") {
        wp_delete_post($subscription->id, true);
      }
    }
  }

  echo "<form id='pms_.$form_name.-form' class='pms-form' method='POST'>";

  do_action( 'pms_' . $form_name . '_form_top', $atts );
  wp_nonce_field( 'pms_' . $form_name . '_form_nonce', 'pmstkn' );
  pms_display_success_messages( pms_success()->get_messages('subscription_plans') );

  $field_errors = pms_errors()->get_error_messages( 'subscription_plans' );
  // echo '<li class="pms-field pms-field-subscriptions ' . ( !empty( $field_errors ) ? 'pms-field-error' : '' ) . '">';
  $include = array();
  $exclude_id_group = array();
  $member = false;
  $default_checked = '';
  $form_location = '';
  $output = '';
  $pms_settings = get_option( 'pms_payments_settings' );

  // Get all subscription plans
  if( empty( $include ) )
      $subscription_plans = pms_get_subscription_plans();
  else {
    if( !is_object( $include[0] ) )
        $subscription_plans = pms_get_subscription_plans( true, $include );
    else
        $subscription_plans = $include;
  }
  if( !$member )
    $output .= pms_display_field_errors( pms_errors()->get_error_messages('subscription_plans'), true );
    echo apply_filters( 'pms_output_subscription_plans', $output, $include, $exclude_id_group, $member, $pms_settings, $subscription_plans, $form_location );
    echo '</li>';

  do_action( 'pms_' . $form_name . '_form_bottom', $atts );
  echo '<input type="hidden" name="subscription_plans" ' . pms_get_subscription_plan_input_data_attrs( pms_get_subscription_plan($id) ) . ' value="' . esc_attr( pms_get_subscription_plan($id)->id ) . '" />';

  $filters = apply_filters( 'pms_' . $form_name . '_form_submit_text', __( 'Select', 'paid-member-subscriptions' ) );

  echo "<input name='pms_.$form_name' type='submit' value='$filters' />";
  echo "</form>";

};



// Mailchimp Integration Functions
//- INTEGRAL MAILCHIMP MERGE TAG REGISTRATION HOOK 
//- To provide the merge tag definition 
add_filter('integral_mailchimp_plugin_sync_merge_tags', 'get_sync_merge_tag_definitions');

function get_sync_merge_tag_definitions($tags) {
  $tags['REG_USER'] = array(
    'name' => 'Registered user?',
    'field_type' => 'text',
    'req' => FALSE,
    'public' => FALSE,
    'show' => TRUE,
    'plugin_name' => 'Agritecture Designer'
  );

  $tags['PAID_USER'] = array(
    'name' => 'Paid user?',
    'field_type' => 'text',
    'req' => FALSE,
    'public' => FALSE,
    'show' => TRUE,
    'plugin_name' => 'Agritecture Designer'
  );

  return $tags;
}

add_filter('integral_mailchimp_plugin_get_merge_tags', 'get_sync_merge_tag_values', 10, 2);

function get_sync_merge_tag_values($tags, $user) {
  // $user_ID = get_current_user_id();
  $user = new WP_User($user->ID);
  $user_roles = $user->roles;

  foreach($user_roles as $user_role) {
    if ($user_role == "subscriber") {
      $tags['REG_USER'] = 'Yes';
    }

    if ($user_role == "customer") {
      $tags['PAID_USER'] = 'Yes';
    }
  }

  return $tags;
}

