<?php
/**
 * Menu.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Traits\Singleton;

/**
 * Class Menu
 */
class Menu {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'after_setup_theme', [ $this, 'register_nav' ] );

	}

	/**
	 * Register navigation menu.
	 */
	public function register_nav() {

		register_nav_menus(
			[
				'primary' => esc_html__( 'Primary Menu', 'base-theme' ),
			]
		);

	}

}
