<?php
/**
 * To register custom taxonomy - Advert Location.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Taxonomies;

use Base_Theme\Inc\Post_Types\Post_Type_Adverts;

/**
 * Class Taxonomy_Advert_Location
 */
class Taxonomy_Advert_Location extends Base {

	/**
	 * Slug of taxonomy.
	 *
	 * @var string
	 */
	const SLUG = 'bt-advert-location';

	/**
	 * Construct.
	 */
	public function __construct() {

		parent::__construct();

		$this->setup_location();

	}

	/**
	 * To setup action/filter.
	 *
	 * @return void
	 */
	public function setup_location() {

		add_action( 'init', [ $this, 'advert_location_setup' ] );
		add_action( 'admin_head', [ $this, 'remove_add_taxonomy' ] );

	}

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
				'name'          => _x( 'Advert Locations', 'Taxonomy General Name', 'base-theme' ),
				'singular_name' => _x( 'Advert Location', 'Taxonomy Singular Name', 'base-theme' ),
				'menu_name'     => __( 'Advert Location', 'base-theme' ),
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
			'bt-adverts',
		];

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
				'public'            => false,
				'show_ui'           => true,
				'show_admin_column' => true,
				'show_in_nav_menus' => false,
				'show_in_menu'      => false,
				'show_in_rest'      => false,
			]
		);

	}

	/**
	 * Add custom taxonomy terms for advert locations.
	 *
	 * @return false|void
	 */
	public function advert_location_setup() {

		// Check if terms are already registered or not.
		if ( get_option( 'advert_location_setup' ) ) {
			return false;
		}

		$locations = [
			[
				'title'       => 'Before Header',
				'slug'        => 'before-header',
				'description' => 'Before Header',
			],
			[
				'title'       => 'After Header',
				'slug'        => 'after-header',
				'description' => 'After Header',
			],
			[
				'title'       => 'Before Content',
				'slug'        => 'before-content',
				'description' => 'Before Content',
			],
			[
				'title'       => 'After Content',
				'slug'        => 'after-content',
				'description' => 'After Content',
			],
			[
				'title'       => 'Before Footer',
				'slug'        => 'before-footer',
				'description' => 'Before Footer',
			],
			[
				'title'       => 'After Footer',
				'slug'        => 'after-footer',
				'description' => 'After Footer',
			],
			[
				'title'       => 'Before Sidebar',
				'slug'        => 'before-sidebar',
				'description' => 'Before Sidebar',
			],
			[
				'title'       => 'After Sidebar',
				'slug'        => 'after-sidebar',
				'description' => 'After Sidebar',
			],
			[
				'title'       => 'Before Content Image',
				'slug'        => 'before-content-image',
				'description' => 'Before Content Image',
			],
			[
				'title'       => 'After Content Image',
				'slug'        => 'after-content-image',
				'description' => 'After Content Image',
			],
			[
				'title'       => 'Sidebar Block',
				'slug'        => 'sidebar-block',
				'description' => 'Sidebar Block',
			],
			[
				'title'       => 'Content Block',
				'slug'        => 'content-block',
				'description' => 'Content Block',
			],
			[
				'title'       => 'Repeat After 2 Paragraphs',
				'slug'        => 'repeat-after-2-paragraphs',
				'description' => 'Repeat After 2 Paragraphs',
			],
		];

		foreach ( $locations as $location ) {

			wp_insert_term(
				$location['title'],
				self::SLUG,
				array(
					'description' => $location['description'],
					'slug'        => $location['slug'],
				)
			);

			unset( $location );

		}

		update_option( 'advert_location_setup', 1 );

	}

	/**
	 * Hide the add term link from Advert locations metabox.
	 *
	 * @return void
	 */
	public function remove_add_taxonomy() {

		global $pagenow;

		if ( 'post.php' === $pagenow ) {

			?><style>#bt-advert-location-adder{display:none;}</style><?php

		}
	}

}
