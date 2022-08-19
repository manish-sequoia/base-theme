<?php
/**
 * Base Theme file includes and definitions.
 *
 * @package Base-Theme
 */

use Base_Theme\Inc\BASE_THEME;

if ( ! defined( 'BASE_THEME_VERSION' ) ) {

	define( 'BASE_THEME_VERSION', 1.0 );

}

if ( ! defined( 'BASE_THEME_TEMPLATE_DIR' ) ) {

	define( 'BASE_THEME_TEMPLATE_DIR', untrailingslashit( get_template_directory() ) );

}

if ( ! defined( 'BASE_THEME_BUILD_URI' ) ) {

	define( 'BASE_THEME_BUILD_URI', untrailingslashit( get_template_directory_uri() ) . '/assets/build' );

}

if ( ! defined( 'BASE_THEME_BUILD_DIR' ) ) {

	define( 'BASE_THEME_BUILD_DIR', untrailingslashit( get_template_directory() ) . '/assets/build' );

}

require_once BASE_THEME_TEMPLATE_DIR . '/inc/helpers/autoloader.php';
require_once BASE_THEME_TEMPLATE_DIR . '/inc/helpers/custom-functions.php';
require_once BASE_THEME_TEMPLATE_DIR . '/inc/helpers/template-tags.php';

/**
 * Get base-theme instance.
 *
 * @return object \Base_Theme\Inc\BASE_THEME
 */
function base_theme_get_theme_instance() {

	return BASE_THEME::get_instance();

}

base_theme_get_theme_instance();
