<?php
/**
 * Abstract class to register post type.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Post_Types;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Base class to register post types.
 */
abstract class Base {

	use Singleton;

	/**
	 * Construct method.
	 */
	final protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To register action/filters.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Actions
		 */
		add_action( 'init', [ $this, 'register_post_type' ] );

	}

	/**
	 * To register post type.
	 *
	 * @return void
	 */
	final public function register_post_type() {

		if ( empty( static::SLUG ) ) {
			return;
		}

		$args = $this->get_args();
		$args = ( ! empty( $args ) && is_array( $args ) ) ? $args : [];

		$labels = $this->get_labels();
		$labels = ( ! empty( $labels ) && is_array( $labels ) ) ? $labels : [];

		if ( ! empty( $labels ) && is_array( $labels ) ) {
			$args['labels'] = $labels;
		}

		register_post_type( static::SLUG, $args );

	}

	/**
	 * To get argument to register custom post type.
	 *
	 * To override arguments, defined this method in child class and override args.
	 *
	 * @return array
	 */
	public function get_args() {

		return [
			'supports'            => [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ],
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
		];

	}

	/**
	 * To get slug of post type.
	 *
	 * @return string Slug of post type.
	 */
	public function get_slug() {

		return ( ! empty( static::SLUG ) ) ? static::SLUG : '';

	}

	/**
	 * To get list of labels for custom post type.
	 * Must be in child class.
	 *
	 * @param array $labels Array of labels.
	 *
	 * @return array
	 */
	public function get_labels( $labels = [] ) {

		$defaults = [
			'parent_item_colon'     => __( 'Parent Item:', 'base-theme' ),
			'all_items'             => __( 'All Items', 'base-theme' ),
			'add_new_item'          => __( 'Add New Item', 'base-theme' ),
			'add_new'               => __( 'Add New', 'base-theme' ),
			'new_item'              => __( 'New Item', 'base-theme' ),
			'edit_item'             => __( 'Edit Item', 'base-theme' ),
			'view_item'             => __( 'View Item', 'base-theme' ),
			'search_items'          => __( 'Search Item', 'base-theme' ),
			'not_found'             => __( 'Not found', 'base-theme' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'base-theme' ),
			'archives'              => __( 'Item Archives', 'base-theme' ),
			'attributes'            => __( 'Item Attributes', 'base-theme' ),
			'update_item'           => __( 'Update Item', 'base-theme' ),
			'view_items'            => __( 'View Items', 'base-theme' ),
			'featured_image'        => __( 'Featured Image', 'base-theme' ),
			'set_featured_image'    => __( 'Set featured image', 'base-theme' ),
			'remove_featured_image' => __( 'Remove featured image', 'base-theme' ),
			'use_featured_image'    => __( 'Use as featured image', 'base-theme' ),
			'insert_into_item'      => __( 'Insert into item', 'base-theme' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'base-theme' ),
			'items_list'            => __( 'Items list', 'base-theme' ),
			'items_list_navigation' => __( 'Items list navigation', 'base-theme' ),
			'filter_items_list'     => __( 'Filter items list', 'base-theme' ),
		];

		return wp_parse_args( $labels, $defaults );

	}

}
