<?php

// Exit if accessed directly
if( ! defined( 'ABSPATH' ) ) exit;

// Return if PMS is not active
if( ! defined( 'PMS_VERSION' ) )
    return;


/**
 * Add tab for Invoices under PMS Settings page
 *
 * @param array $pms_tabs The PMS Settings tabs
 *
 * @return array
 *
 */
function pms_inv_add_invoices_tab( $pms_tabs ) {

    $pms_tabs['invoices'] = __( 'Invoices', 'paid-member-subscriptions' );

    return $pms_tabs;
}
add_filter( 'pms-settings-page_tabs', 'pms_inv_add_invoices_tab' );


/**
 * Add content for Invoices tab
 *
 * @param string $output     Tab content
 * @param string $active_tab Current active tab
 * @param array $options     The PMS settings options
 *
 */
function pms_inv_add_invoices_tab_content( $output, $active_tab, $options ) {

    if ( $active_tab == 'invoices' ) {
        ob_start();

        include_once 'views/view-settings-tab-invoices.php';

        $output = ob_get_clean();
    }

    return $output;
}
add_action( 'pms_settings_tab_content', 'pms_inv_add_invoices_tab_content', 20, 3 );

add_action( 'pms_register_tab_settings', 'pms_inv_register_settings' );
function pms_inv_register_settings() {
    register_setting( 'pms_invoices_settings', 'pms_invoices_settings', 'pms_inv_sanitize_settings' );
}

/**
 * Sanitize PMS Invoices settings
 *
 * @param array $options The PMS settings options
 *
 * @return array
 *
 */
function pms_inv_sanitize_settings( $options ) {

    if( !isset( $_REQUEST['option_page'] ) )
        return $options;

    $option_page = sanitize_text_field( $_REQUEST['option_page'] );

    if ( $option_page != 'pms_invoices_settings' ) return $options;

    // Invoice Details
    if( empty( $options['company_details'] ) ) {
        add_settings_error('general', 'invoices_company_details', __('Company Details are required in order to create invoices.', 'paid-member-subscriptions'), 'error');
    }

    if( isset( $options['company_details'] ) ) {
        $options['company_details'] = wp_kses_post( $options['company_details'] );
    }

    if( isset( $options['notes'] ) ) {
        $options['notes'] =  wp_kses_post( $options['notes'] );
    }

    // Invoice Settings
    if( isset( $options['title'] ) ) {

        if ( !empty( $options['title'] ) ) {
            $options['title'] = sanitize_text_field( $options['title'] );
        } else {
            $options['title'] = __( 'Invoice', 'paid-member-subscriptions' );
        }

    }

    if( isset( $options['format'] ) ) {

        // {{number}} tag is required in invoice format
        if ( strpos( $options['format'], '{{number}}' ) === false ) {
            add_settings_error('general', 'invoices_format', __('The {{number}} tag is required under Format.', 'paid-member-subscriptions'), 'error');
            $options['format'] = '{{number}}';
        } else {
            $options['format'] = sanitize_text_field($options['format']);
        }

    }

    // Remove Reset Invoice Counter
    if( isset( $options['reset_invoice_counter'] ) ) {
        if( isset( $_POST['pms_inv_invoice_number'] ) )
            update_option( 'pms_inv_invoice_number', (int)$_POST['pms_inv_invoice_number'] );

        unset( $options['reset_invoice_counter'] );
    }

    if( isset( $options['next_invoice_number'] ) ) {
        $options['next_invoice_number'] =  (int)$options['next_invoice_number'];
    }

    if( isset( $options['reset_yearly'] ) ) {
        $options['reset_yearly'] =  (int)$options['reset_yearly'];
    }

    return $options;

}
add_filter( 'pms_sanitize_settings', 'pms_inv_sanitize_settings' );

if ( defined( 'PMS_VERSION' ) && version_compare( PMS_VERSION, '1.7.7', '<=' ) && class_exists( 'PMS_Add_General_Notices' ) ) {

    new PMS_Add_General_Notices( 'pms_inv_core_incompatibility',
         sprintf( __( 'Your <strong>Paid Member Subscriptions</strong> version is not 100%% compatible with this version of the <strong>Invoices</strong> add-on.<br>Please go to the <a href="%s">plugins</a> page and <strong>update Paid Member Subscriptions</strong> to the latest version.', 'paid-member-subscriptions' ), admin_url( 'plugins.php?s=paid member subscriptions&plugin_status=all' ) ),
         'error' );

}
