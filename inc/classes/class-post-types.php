<?php
/**
 * Custom Post Types.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Traits\Singleton;
use Base_Theme\Inc\Post_Types\Post_Type_Example;

/**
 * Class Post_Types
 */
class Post_Types {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->load_post_types();

	}

	/**
	 * Load Post Types.
	 */
	public function load_post_types() {

		// Load all post types.
		Post_Type_Example::get_instance();

	}
}
