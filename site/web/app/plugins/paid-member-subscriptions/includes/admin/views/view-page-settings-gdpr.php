<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/*
 * HTML Output for the Payments tab
 */
?>

<div id="gdpr-general">

    <h3><?php _e( 'General', 'paid-member-subscriptions' ); ?></h3>

    <div class="pms-form-field-wrapper">
        <label class="pms-form-field-label" for="gdpr-checkbox"><?php _e( 'GDPR checkbox on Forms', 'paid-member-subscriptions' ) ?></label>

        <select id="gdpr-checkbox" name="pms_gdpr_settings[gdpr_checkbox]">
            <option value="disabled" <?php ( isset( $this->options['gdpr_checkbox'] ) ? selected( $this->options['gdpr_checkbox'], 'disabled', true ) : ''); ?>><?php _e( 'Disabled', 'paid-member-subscriptions' ); ?></option>
            <option value="enabled" <?php ( isset( $this->options['gdpr_checkbox'] ) ? selected( $this->options['gdpr_checkbox'], 'enabled', true ) : ''); ?>><?php _e( 'Enabled', 'paid-member-subscriptions' ); ?></option>
        </select>

        <p class="description"><?php _e( 'Select whether to show a GDPR checkbox on our forms.', 'paid-member-subscriptions' ); ?></p>
    </div>

    <div class="pms-form-field-wrapper">
        <label class="pms-form-field-label" for="gdpr-checkbox-text"><?php _e( 'GDPR Checkbox Text', 'paid-member-subscriptions' ) ?></label>
        <input type="text" id="gdpr-checkbox-text" class="widefat" name="pms_gdpr_settings[gdpr_checkbox_text]" value="<?php echo ( isset($this->options['gdpr_checkbox_text']) ? esc_attr( $this->options['gdpr_checkbox_text'] ) : __( 'I allow the website to collect and store the data I submit through this form. *', 'paid-member-subscriptions' ) ); ?>">
        <p class="description"><?php _e( 'Text for the GDPR checkbox. You can use {{privacy_policy}} to generate a link for the Privacy policy page', 'paid-member-subscriptions' ); ?></p>
    </div>

    <div class="pms-form-field-wrapper">
        <label class="pms-form-field-label" for="gdpr-delete-button"><?php _e( 'GDPR Delete Button on Forms', 'paid-member-subscriptions' ) ?></label>

        <select id="gdpr-delete-button" name="pms_gdpr_settings[gdpr_delete]">
            <option value="disabled" <?php ( isset( $this->options['gdpr_delete'] ) ? selected( $this->options['gdpr_delete'], 'disabled', true ) : ''); ?>><?php _e( 'Disabled', 'paid-member-subscriptions' ); ?></option>
            <option value="enabled" <?php ( isset( $this->options['gdpr_delete'] ) ? selected( $this->options['gdpr_delete'], 'enabled', true ) : ''); ?>><?php _e( 'Enabled', 'paid-member-subscriptions' ); ?></option>
        </select>

        <p class="description"><?php _e( 'Select whether to show a GDPR Delete button on our forms.', 'paid-member-subscriptions' ); ?></p>
    </div>

    <?php do_action( $this->menu_slug . '_gdpr_after_content', $this->options ); ?>

</div>

