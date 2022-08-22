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
class Taxonomy_Example extends Base {

	/**
	 * Slug of taxonomy.
	 *
	 * @var string
	 */
	const SLUG = 'taxonomy-slug';

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
				'name'          => _x( 'Sample Taxonomies', 'Taxonomy General Name', 'base-theme' ),
				'singular_name' => _x( 'Sample Taxonomy', 'Taxonomy Singular Name', 'base-theme' ),
				'menu_name'     => __( 'Sample Taxonomy', 'base-theme' ),
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
			'post',
			'post-type-slug',
		];

	}

}
