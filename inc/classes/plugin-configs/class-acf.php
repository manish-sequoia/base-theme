<?php
/**
 * ACF Plugin Config.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class ACF
 */
class ACF {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To setup action filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		add_filter( 'acf/settings/save_json', [ $this, 'save_acf_json_path' ] );

		// Kses textarea value.
		add_filter( 'acf/format_value/type=textarea', 'wp_kses_post', 10, 1 );

		add_action( 'acf/init', [ $this, 'setup_option_page' ] );

		add_filter( 'acf/fields/wysiwyg/toolbars', [ $this, 'acf_wysiwyg_toolbars' ] );

	}

	/**
	 * Function to set ACF JSON file path.
	 *
	 * When save a field group, a JSON file will be created (or updated) with the field group and field settings.
	 * Ref: https://www.advancedcustomfields.com/resources/local-json/
	 *
	 * @param string $path Path to ACF JSON files folder.
	 *
	 * @return string Path to ACF JSON files folder.
	 */
	public function save_acf_json_path( $path ) {

		// Update path.
		$path = get_stylesheet_directory() . '/acf-json';

		return $path;

	}

	/**
	 * Register Theme setting page with ACF.
	 */
	public function setup_option_page() {

		if ( function_exists( 'acf_add_options_page' ) ) {

			// Register options page.
			acf_add_options_page(
				[
					'page_title' => esc_html__( 'Theme Settings', 'base-theme' ),
					'menu_title' => esc_html__( 'Theme Settings', 'base-theme' ),
					'menu_slug'  => 'theme-settings',
					'capability' => 'edit_posts',
					'redirect'   => false,
				]
			);
		}
	}

	/**
	 * Add or alter existing toolbars for ACF WYSIWYG.
	 *
	 * @param array $toolbars ACF WYSIWYG toolbars.
	 *
	 * @return mixed
	 */
	function acf_wysiwyg_toolbars( $toolbars ) {

		$toolbars['Base - Simple']    = array();
		$toolbars['Base - Simple'][1] = array( 'link' );

		return $toolbars;
	}

}
