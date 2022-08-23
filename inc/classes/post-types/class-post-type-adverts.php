<?php
/**
 * Register Adverts post type.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Post_Types;

/**
 * Class Post_Type_Adverts
 */
class Post_Type_Adverts extends Base {

	/**
	 * Slug of post type.
	 *
	 * @var string
	 */
	const SLUG = 'bt-adverts';

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
				'name'           => _x( 'Adverts', 'Post Type General Name', 'base-theme' ),
				'singular_name'  => _x( 'Advert', 'Post Type Singular Name', 'base-theme' ),
				'menu_name'      => __( 'Adverts', 'base-theme' ),
				'name_admin_bar' => __( 'Advert', 'base-theme' ),
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
				'supports'            => [ 'title', 'editor' ],
				'menu_icon'           => 'dashicons-megaphone',
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => true,
				'show_in_admin_bar'   => false,
				'show_in_nav_menus'   => false,
				'has_archive'         => false,
				'exclude_from_search' => true,
				'publicly_queryable'  => false,
				'capability_type'     => 'page',
				'show_in_rest'        => false,
			]
		);

	}

}
