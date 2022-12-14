<?php
/**
 * Custom Taxonomies.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Traits\Singleton;
use Base_Theme\Inc\Taxonomies\Taxonomy_Advert_Location;
use Base_Theme\Inc\Taxonomies\Taxonomy_Sub_Category;

/**
 * Class Taxonomies
 */
class Taxonomies {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->load_taxonomies();

	}

	/**
	 * Load Taxonomies.
	 */
	public function load_taxonomies() {

		// Load all taxonomies classes.
		Taxonomy_Advert_Location::get_instance();
		Taxonomy_Sub_Category::get_instance();

	}
}
