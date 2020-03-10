<?php

namespace Roots\Sage\Customizer;

use Roots\Sage\Assets;

/**
 * Add postMessage support
 */
function customize_register($wp_customize) {
  $wp_customize->get_setting('blogname')->transport = 'postMessage';
  $wp_customize->remove_section("static_front_page");
 }
add_action('customize_register', __NAMESPACE__ . '\\customize_register');

 add_theme_support( 'custom-header', array(
		'height'      => 1000,
		'width'       => 1000,
    'flex-width' => true,
    'flex-height' => true
	) );

/**
 * Customizer JS
 */
function customize_preview_js() {
  wp_enqueue_script('sage/customizer', Assets\asset_path('scripts/customizer.js'), ['customize-preview'], null, true);
}
add_action('customize_preview_init', __NAMESPACE__ . '\\customize_preview_js');
