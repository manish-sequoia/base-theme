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
	 * To get list of labels for post type.
	 *
	 * @param array $label_args Array of labels.
	 *
	 * @return array
	 */
	public function get_labels( $label_args = [] ) {

		$labels     = parent::get_labels();
		$label_args = ( ! empty( $labels ) && is_array( $labels ) ) ? $labels : [];

		return array_merge(
			$label_args,
			[
				'name'           => _x( 'Sample Post Types', 'Post Type General Name', 'base-theme' ),
				'singular_name'  => _x( 'Sample Post Type', 'Post Type Singular Name', 'base-theme' ),
				'menu_name'      => __( 'Sample Post Types', 'base-theme' ),
				'name_admin_bar' => __( 'Sample Post Type', 'base-theme' ),
			]
		);

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
