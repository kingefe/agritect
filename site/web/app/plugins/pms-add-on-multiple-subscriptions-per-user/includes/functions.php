<?php

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// Return if PMS is not active
if( ! defined( 'PMS_VERSION' ) ) return;


/**
 * Returns the output for the add new subscription members subpage
 *
 * @param string $output
 *
 * @return string
 *
 */
function pms_msu_output_add_new_subscription_subpage( $output = '' ) {

    if( empty( $_GET['member_id'] ) )
        return $output;

    if( empty( $_GET['subpage'] ) || $_GET['subpage'] != 'add_subscription' )
        return $output;


    ob_start();

    if( file_exists( PMS_PLUGIN_DIR_PATH . 'includes/admin/views/view-page-members-add-new-edit-subscription.php' ) )
        include_once PMS_PLUGIN_DIR_PATH . 'includes/admin/views/view-page-members-add-new-edit-subscription.php';

    $output = ob_get_contents();

    ob_clean();

    return $output;

}
add_filter( 'pms_submenu_page_members_output', 'pms_msu_output_add_new_subscription_subpage' );


/*
 * Return the number of subscription plan groups
 *
 */
 function pms_get_subscription_plan_groups_count() {

     $active_parent_plans = get_posts( array( 'post_type' => 'pms-subscription', 'numberposts' => -1, 'post_parent' => 0, 'post_status' => 'any', 'meta_key' => 'pms_subscription_plan_status', 'meta_value' => 'active' ) );

     $active_tiers = count( $active_parent_plans );

     //get inactive parent plans
     $inactive_parent_plans = get_posts( array( 'post_type' => 'pms-subscription', 'numberposts' => -1, 'post_parent' => 0, 'post_status' => 'any', 'meta_key' => 'pms_subscription_plan_status', 'meta_value' => 'inactive' ) );

     foreach ( $inactive_parent_plans as $plan ) {
         $tier = pms_get_subscription_plans_group( $plan->ID, true );

         if ( !empty( $tier ) && isset( $tier[0]->id ) )
             $active_tiers = $active_tiers + 1;
     }


     return $active_tiers;

 }


/*
 * Add new button for subscription plans allows you to add top level subscription plan
 *
 */
function pms_msu_add_subscription_plan_action( $action ) {
    return 'allow';
}
add_filter( 'pms_action_add_new_subscription_plan', 'pms_msu_add_subscription_plan_action' );


/*
 * Add the "Add New Subscription" button on members add/edit list table
 *
 */
function pms_msu_member_subscription_list_table_add_new_button( $which, $member, $existing_subscriptions ) {

    if( $which == 'bottom' ) {

        $subscription_groups_count = pms_get_subscription_plan_groups_count();

        if( ( $subscription_groups_count > 1 && count( $member->subscriptions ) < $subscription_groups_count ) ) {
            echo '<a href="' . add_query_arg( array( 'page' => 'pms-members-page', 'subpage' => 'add_subscription', 'member_id' => $member->user_id ), admin_url( 'admin.php' ) ) . '" class="button-secondary" style="display: inline-block;">' . __( 'Add New Subscription', 'paid-member-subscriptions' ) . '</a>';
        }

        echo '<input id="pms-subscription-groups-count" type="hidden" value="' . $subscription_groups_count . '" />';

    }

}
add_action( 'pms_member_subscription_list_table_extra_tablenav', 'pms_msu_member_subscription_list_table_add_new_button', 10, 3 );

function pms_msu_nav_menu_extra_fields( $item ) {
    if( empty( $item->type ) )
        return;

    if( strpos( $item->type, 'pms_') === false || $item->type == 'pms_logout' )
        return;

    if( !( pms_get_subscription_plan_groups_count() > 1 ) )
        return;

    $selected_subscription = get_post_meta( $item->ID, '_pms_msu_nav_menu_subscription', true );
    ?>

    <div class="pms-options">
        <p class="description"><?php _e( 'Subscription plan', 'paid-member-subscriptions' ); ?></p>

        <label class="pms-menu-item-msu-subscription-label" for="pms-menu-li-<?php echo esc_attr( $item->ID ); ?>">

            <select id="pms-msu-subscription" name="pms-msu-subscription-<?php echo $item->ID; ?>" class="widefat code edit-menu-item-url">
                <option value="-1"><?php _e( 'Choose...', 'paid-member-subscriptions' ) ?></option>

                <?php
                foreach( pms_get_subscription_plans_list() as $plan_id => $plan_title )
                    echo '<option value="' . esc_attr( $plan_id ) . '"' . selected( $selected_subscription, $plan_id, false ) . '>' . esc_html( $plan_title ) . ' (ID: ' . esc_attr( $plan_id ) . ')' . '</option>';
                ?>
            </select>

        </label>
    </div>

    <?php
}
add_action( 'pms_nav_menu_extra_fields_top', 'pms_msu_nav_menu_extra_fields' );

function pms_msu_nav_menu_save( $menu_id, $menu_item_db_id ) {

    if( !empty( $_REQUEST['pms-msu-subscription-' . $menu_item_db_id] ) )
        update_post_meta( $menu_item_db_id, '_pms_msu_nav_menu_subscription', sanitize_text_field( $_REQUEST['pms-msu-subscription-' . $menu_item_db_id] ) );
    else
        delete_post_meta( $menu_item_db_id, '_pms_msu_nav_menu_subscription' );

}
add_action( 'wp_update_nav_menu_item', 'pms_msu_nav_menu_save', 10, 2 );
