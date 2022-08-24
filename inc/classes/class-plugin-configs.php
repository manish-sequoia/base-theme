<?php
/**
 * Third-party Plugin Config.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Traits\Singleton;

use Base_Theme\Inc\Plugin_Configs\ACF;

/**
 * Class Plugin_Configs
 */
class Plugin_Configs {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		ACF::get_instance();

	}

}
