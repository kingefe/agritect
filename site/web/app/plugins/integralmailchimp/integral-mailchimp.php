<?php

namespace IMC;

/*
Plugin Name: Integral MailChimp
Plugin URI: http://integralwp.com/plugins/complete-mailchimp-plugin-for-wordpress/
Description: Bring the power of MailChimp to the WordPress dashboard. Design and send email campaigns with a drag-and-drop builder; sync user data; track statistics and much more! 
Version: 1.10.18
Author: wunderdojo
Author URI: http://integralwp.com
Text-Domain: integral-mailchimp
Domain Path: /languages
------------------------------------------------------------------------
Copyright 2014-2016 wunderdojo, LLC

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see http://www.gnu.org/licenses.
*/


if (!defined('IMC_PLUGIN_PATH')) {
    define('IMC_PLUGIN_PATH', trailingslashit(plugin_dir_path(__FILE__)));
}

if (!defined('IMC_PLUGIN_FILE')) {
    define('IMC_PLUGIN_FILE', __FILE__);
}

if (!defined("IS_ADMIN")) {
    define("IS_ADMIN", is_admin());
}

if (!defined("IS_MULTISITE")) {
    define("IS_MULTISITE", is_multisite());
}

//- Include composer autoloader 
require_once(IMC_PLUGIN_PATH . 'library/composer/autoload.php');

//- Configuration
require_once(IMC_PLUGIN_PATH . 'config.php');


/**
 * Primary Plugin Class
 * 
 */
if (!class_exists('Integral_MailChimp')) {

    class Integral_MailChimp  {
        
        private static $_this = NULL;

        public function __construct() {

            //- Restrict instancing
            if (isset(self::$_this)) {
                wp_die(sprintf(__('%1$s is a singleton class. Creating a second instance is prohibited.', 'integral-mailchimp'), get_class($this)));
            }

            self::$_this = $this;
            
             //- Plugin activation/deactivation hooks
            register_activation_hook(__FILE__, array($this, 'activate'));
            register_deactivation_hook(__FILE__, array($this, 'deactivate'));

            //- Include preliminary files
            I_Conf::include_framework_files();            
            
            //- Run initial setup
            I_Conf::initialize_integral_mvc();
            
            //- Include additional preliminary files
            I_Conf::include_controller_files();
            I_Conf::include_api_files();

            //- Register WP filters
            I_Conf::register_filters();

            //- Register WP hooks
            I_Conf::register_plugins_loaded_hooks();
            I_Conf::register_init_hooks();
            I_Conf::register_admin_init_hooks();
            I_Conf::register_wp_loaded_hooks();
            I_Conf::register_enqueue_scripts_hooks();
            I_Conf::register_enqueue_styles_hooks();
            I_Conf::register_user_hooks();
            I_Conf::register_notices_hooks();
           
            add_action('init', array(__CLASS__, 'init_localization'));
	    
	    add_action( 'admin_init', array( 'IMC\Controllers\Email_Campaigns_CPT_Controller', 'fetch_all_post_types_as_array' ) );

        }
        
         /**
         * Activate the plugin
         * 
         */
        public static function activate() {
            
            $fresh_install = get_option(I_Conf::OPT_VERSION, -1);
            
            self::check_wp_ver();
            
            self::check_php_ver();

            if ($fresh_install === -1) {
                update_option(I_Conf::OPT_FRESH_INSTALL, TRUE);
            }
            
            $debug_enabled = get_option(I_Conf::OPT_ENABLE_DEBUG_MODE, -1);
            
            if ($debug_enabled === -1) {
                update_option(I_Conf::OPT_ENABLE_DEBUG_MODE, TRUE);
            }


        }


        /**
         * Deactivate the plugin
         * 
         */
        public static function deactivate() {
            //- TODO - RELEASE - Delete webhooks in MailChimp


        }


        /**
         * WordPress version check
         * 
         */
        public static function check_wp_ver() {
            $plugin_name         = I_Conf::PLUGIN_NAME;
            $wp_min_version      = I_Conf::MIN_WP_VERSION;
            $plugin_version_name = I_Conf::OPT_VERSION;
            $plugin_version      = I_Conf::PLUGIN_VERSION;

            if (version_compare(get_bloginfo('version'), $wp_min_version, '<')) {
                wp_die(sprintf(__('You must update to at least WordPress version %1$s to use this version of the %2$s plugin!', 'integral-mailchimp'), "<strong>{$wp_min_version}</strong>", $plugin_name));
            }

            if (get_option($plugin_version_name) === false) {
                add_option($plugin_version_name, $plugin_version);
            }


        }
        
        /**
         * PHP version check. v5.4+ required
         * PHP_VERSION_ID is available as of 5.2.7
         */
        public static function check_php_ver() {
            $plugin_name = I_Conf::PLUGIN_NAME;
            $php_min_version = I_Conf::MIN_PHP_VERSION;
            $php_min_version_formatted = I_Conf::MIN_PHP_VERSION_FORMATTED;

            if (!(PHP_VERSION_ID) || version_compare(PHP_VERSION_ID, $php_min_version, '<')) {
                wp_die(sprintf(__('PHP version %1$s or greater is required to use this version of the %2$s plugin!', 'integral-mailchimp'), "<strong>{$php_min_version_formatted}</strong>", $plugin_name));
            }

        }


        static public function init_localization() {

            //- Enable Localization
            $loaded = load_plugin_textdomain('integral-mailchimp', false, basename(dirname(__FILE__)) . '/languages/');

        }

    }

}

new Integral_MailChimp();