<?php
/**
 * To register custom taxonomy.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Taxonomies;

/**
 * Class Taxonomy_Example
 */
class Taxonomy_Sub_Category extends Base {

	/**
	 * Slug of taxonomy.
	 *
	 * @var string
	 */
	const SLUG = 'sub-category';

	/**
	 * Labels for taxonomy.
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
				'name'          => _x( 'Sub Categories', 'Taxonomy General Name', 'base-theme' ),
				'singular_name' => _x( 'Sub Category', 'Taxonomy Singular Name', 'base-theme' ),
				'menu_name'     => __( 'Sub Category', 'base-theme' ),
			]
		);
	}

	/**
	 * To get argument to register taxonomy.
	 *
	 * @return array Args to register taxonomy type.
	 */
	public function get_args() {

		$args = parent::get_args();
		$args = ( ! empty( $args ) && is_array( $args ) ) ? $args : [];

		return array_merge(
			$args,
			[
				'hierarchical'      => true,
				'public'            => true,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => true,
				'show_in_menu'      => true,
				'show_in_rest'      => true,
			]
		);
	}

	/**
	 * List of post types for taxonomy.
	 *
	 * @return array
	 */
	public function get_post_types() {

		return [
			'post'
		];
	}

}
