<?php
/**
 * cbs_astratheme Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package cbs_astratheme
 * @since 1.0.0
 */

require_once get_stylesheet_directory() . '/includes/shortcodes.php';
require_once get_stylesheet_directory() . '/includes/sidebars.php';
require_once get_stylesheet_directory() . '/includes/hooks.php';

/**
 * Define Constants
 */
define( 'CHILD_THEME_CBS_ASTRATHEME_VERSION', rand(1000, 9999) );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {

	/* Fonts */
	wp_enqueue_style('font-awesome', get_stylesheet_directory_uri() . '/assets/css/fonts/font-awesome.min.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );
	wp_enqueue_style( 'playfair', 'https://fonts.googleapis.com/css?family=Roboto:400%7CPlayfair+Display:300,400,500,700,900', array(), false, 'all');
	
	/* Defaults */
	wp_enqueue_style( 'cbs_astratheme-theme', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );
	wp_enqueue_style( 'cbs_astratheme-theme-fonts', get_stylesheet_directory_uri() . '/css/fonts.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );
	wp_enqueue_style( 'cbs_astratheme-theme-woo', get_stylesheet_directory_uri() . '/css/woocommerce.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );
	wp_enqueue_style( 'cbs_astratheme-theme-colors', get_stylesheet_directory_uri() . '/css/colors.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );
	wp_enqueue_style( 'cbs_astratheme-theme-responsive', get_stylesheet_directory_uri() . '/css/responsive.css', array('astra-theme-css'), CHILD_THEME_CBS_ASTRATHEME_VERSION, 'all' );

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

/**
 * Enqueue scripts
 */
function child_enqueue_scripts() {
	
	wp_enqueue_script('cbstheme-custom', get_stylesheet_directory_uri() . '/js/custom.js', array('jquery'), CHILD_THEME_CBS_ASTRATHEME_VERSION, true);

    wp_localize_script('cbstheme-custom', 'cbs_ajax_object',
            array( 'ajax_url' => admin_url( 'admin-ajax.php' ) )
    );

}

add_action('wp_enqueue_scripts', 'child_enqueue_scripts');





