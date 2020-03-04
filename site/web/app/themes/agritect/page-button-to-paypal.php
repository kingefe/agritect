<?php
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
      $subscription->remove();
    }
  }
}
?>

<form id="pms_<?php echo $form_name; ?>-form" class="pms-form" method="POST">

  <?php 
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
    echo '<input type="hidden" name="subscription_plans" ' . pms_get_subscription_plan_input_data_attrs( pms_get_subscription_plan("102") ) . ' value="' . esc_attr( pms_get_subscription_plan("102")->id ) . '" />'; 
  ?>
  <input name="pms_<?php echo $form_name; ?>" type="submit" value="<?php echo apply_filters( 'pms_' . $form_name . '_form_submit_text', __( 'Select 99$ #2', 'paid-member-subscriptions' ) ); ?>" />
</form>

<h1>now is your function</h1>

<?php
  render_subscribe_button_by_subscription_id("102");
  render_subscribe_button_by_subscription_id("103")
?>