<?php
/**
 * Register Example post type.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Post_Types;

/**
 * Class Post_Type_Example
 */
class Post_Type_Example extends Base {

	/**
	 * Slug of post type.
	 *
	 * @var string
	 */
	const SLUG = 'post-type-slug';

	/**
	 * Post type label for internal uses.
	 *
	 * @var string
	 */
	const LABEL = 'Post Type';

	/**
	 * To get list of labels for post type.
	 *
	 * @return array
	 */
	public function get_labels() {

		return [
			'name'                  => _x( 'Sample Post Types', 'Post Type General Name', 'base-theme' ),
			'singular_name'         => _x( 'Sample Post Type', 'Post Type Singular Name', 'base-theme' ),
			'menu_name'             => __( 'Sample Post Types', 'base-theme' ),
			'name_admin_bar'        => __( 'Sample Post Type', 'base-theme' ),
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

	}

	/**
	 * To get argument to register custom post type.
	 *
	 * @return array Args to register post type.
	 */
	public function get_args() {

		$args = parent::get_args();
		$args = ( ! empty( $args ) && is_array( $args ) ) ? $args : [];

		return array_merge(
			$args,
			[
				'menu_icon' => 'dashicons-admin-post',
			]
		);

	}

}
