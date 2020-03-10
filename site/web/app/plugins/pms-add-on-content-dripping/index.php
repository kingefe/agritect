<?php
/**
 * Plugin Name: Paid Member Subscriptions - Content Dripping
 * Plugin URI: http://www.cozmoslabs.com/
 * Description: Drips your content. Different users get access to different amounts of content based on how long they've been an active member.
 * Version: 1.0.5
 * Author: Cozmoslabs, Mihai Iova
 * Author URI: http://www.cozmoslabs.com/
 * Text Domain: paid-member-subscriptions
 * License: GPL2
 * 
 * == Copyright ==
 * Copyright 2015 Cozmoslabs (www.cozmoslabs.com)
 * 
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 */

if( ! defined( 'ABSPATH' ) )
    exit;

if( ! defined( 'PMS_VERSION' ) )
    return;

Class PMS_Content_Dripper {

    public function __construct() {

        $this->define_constants();

        $this->load_dependencies();

        $this->init();

    }

    private function init() {

        add_action( 'init', array( $this, 'init_translation' ) );

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_back_end_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front_end_scripts' ) );

    }

    public function init_translation() {

        $current_theme = wp_get_theme();

        if( !empty( $current_theme->stylesheet ) && file_exists( get_theme_root().'/'. $current_theme->stylesheet .'/local_pms_lang' ) )
            load_plugin_textdomain( 'pms-content-dripping-add-on', false, basename( dirname( __FILE__ ) ).'/../../themes/'.$current_theme->stylesheet.'/local_pms_lang' );
        else
            load_plugin_textdomain( 'pms-content-dripping-add-on', false, basename(dirname(__FILE__)) . '/translation/' );

    }


    private function define_constants() {

        define( 'PMS_CONTENT_DRIPPING_VERSION', '1.0.5' );
        define( 'PMS_CONTENT_DRIPPING_DIR_PATH', plugin_dir_path( __FILE__ ) );
        define( 'PMS_CONTENT_DRIPPING_DIR_URL', plugin_dir_url( __FILE__ ) );

    }

    private function load_dependencies() {

        if( file_exists( PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-admin-content-dripping.php' ) )
            include PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-admin-content-dripping.php';

        if( file_exists( PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-meta-box-content-dripping-details.php' ) )
            include PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-meta-box-content-dripping-details.php';

        if( file_exists( PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-meta-box-content-dripping-rules.php' ) )
            include PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-meta-box-content-dripping-rules.php';

        if( file_exists( PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/functions-content-filtering.php' ) )
            include PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/functions-content-filtering.php';

        if( file_exists( PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-shortcodes.php' ) )
            include PMS_CONTENT_DRIPPING_DIR_PATH . 'includes/class-shortcodes.php';

    }


    /**
     * Enqueue back end scripts and styles
     *
     */
    public function enqueue_back_end_scripts() {

        wp_enqueue_script( 'pms-content-dripping-script', PMS_CONTENT_DRIPPING_DIR_URL . 'assets/js/back-end.js', array( 'jquery', 'jquery-ui-core' ), PMS_CONTENT_DRIPPING_VERSION );
        wp_enqueue_style( 'pms-content-dripping-style', PMS_CONTENT_DRIPPING_DIR_URL . 'assets/css/back-end.css', array(), PMS_CONTENT_DRIPPING_VERSION );

    }

    /**
     * Enqueue front-end scripts and styles
     *
     */
    public function enqueue_front_end_scripts() {}

}

// Let's get this party started
new PMS_Content_Dripper;


if( class_exists( 'pms_PluginUpdateChecker' ) ) {
    $slug = 'content-dripping';
    $localSerial = get_option( $slug . '_serial_number');
    $pms_content_dripping_update = new pms_PluginUpdateChecker('http://updatemetadata.cozmoslabs.com/?localSerialNumber=' . $localSerial . '&uniqueproduct=CLPMSCD', __FILE__, $slug );
}