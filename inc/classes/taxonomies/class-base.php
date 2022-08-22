<?php
/**
 * Base class to register taxonomy.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Taxonomies;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Base
 */
abstract class Base {

	use Singleton;

	/**
	 * Base constructor.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To setup action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		add_action( 'init', [ $this, 'register_taxonomy' ] );

	}

	/**
	 * Register taxonomy.
	 *
	 * @return void
	 */
	public function register_taxonomy() {

		if ( empty( static::SLUG ) ) {
			return;
		}

		$post_types = $this->get_post_types();

		if ( empty( $post_types ) || ! is_array( $post_types ) ) {
			return;
		}

		$args = $this->get_args();
		$args = ( ! empty( $args ) && is_array( $args ) ) ? $args : [];

		$labels = $this->get_labels();
		$labels = ( ! empty( $labels ) && is_array( $labels ) ) ? $labels : [];

		if ( ! empty( $labels ) && is_array( $labels ) ) {
			$args['labels'] = $labels;
		}

		register_taxonomy( static::SLUG, $post_types, $args );

	}

	/**
	 * To get argument to register taxonomy.
	 *
	 * @return array
	 */
	public function get_args() {

		return [
			'hierarchical'      => false,
			'public'            => true,
			'show_ui'           => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'show_in_rest'      => true,
		];

	}

	/**
	 * Labels for taxonomy.
	 *
	 * @param array $labels Array of labels.
	 *
	 * @return array
	 */
	public function get_labels( $labels = [] ) {

		$defaults = [
			'all_items'                  => __( 'All Items', 'base-theme' ),
			'parent_item'                => __( 'Parent Item', 'base-theme' ),
			'parent_item_colon'          => __( 'Parent Item:', 'base-theme' ),
			'new_item_name'              => __( 'New Item Name', 'base-theme' ),
			'add_new_item'               => __( 'Add New Item', 'base-theme' ),
			'edit_item'                  => __( 'Edit Item', 'base-theme' ),
			'update_item'                => __( 'Update Item', 'base-theme' ),
			'view_item'                  => __( 'View Item', 'base-theme' ),
			'separate_items_with_commas' => __( 'Separate items with commas', 'base-theme' ),
			'add_or_remove_items'        => __( 'Add or remove items', 'base-theme' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'base-theme' ),
			'popular_items'              => __( 'Popular Items', 'base-theme' ),
			'search_items'               => __( 'Search Items', 'base-theme' ),
			'not_found'                  => __( 'Not Found', 'base-theme' ),
			'no_terms'                   => __( 'No items', 'base-theme' ),
			'items_list'                 => __( 'Items list', 'base-theme' ),
			'items_list_navigation'      => __( 'Items list navigation', 'base-theme' ),
		];

		return wp_parse_args( $labels, $defaults );

	}

	/**
	 * List of post types for taxonomy.
	 *
	 * @return array
	 */
	abstract public function get_post_types();

}
