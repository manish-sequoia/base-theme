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
	 * @return array
	 */
	public function get_labels() {

		return [
			'name'                       => _x( 'Sample Taxonomies', 'Taxonomy General Name', 'base-theme' ),
			'singular_name'              => _x( 'Sample Taxonomy', 'Taxonomy Singular Name', 'base-theme' ),
			'menu_name'                  => __( 'Sample Taxonomy', 'base-theme' ),
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
