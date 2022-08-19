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
	 * @return array
	 */
	abstract public function get_labels();

	/**
	 * List of post types for taxonomy.
	 *
	 * @return array
	 */
	abstract public function get_post_types();

}
