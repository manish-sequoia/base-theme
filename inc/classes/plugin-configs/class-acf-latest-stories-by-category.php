<?php
/**
 * Latest stories by category block.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Latest Stories by Category Block.
 */
class ACF_Latest_Stories_By_Category {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To setup action filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		add_action( 'acf/init', [ $this, 'block' ] );

	}

	/**
	 * Register Block.
	 */
	public function block() {

		if ( function_exists( 'acf_register_block_type' ) ) {

			$settings = [
				'name'        => 'bt_latest_stories_by_category',
				'title'       => __( 'Latest Stories by Category', 'base-theme' ),
				'description' => __( 'Latest Stories will be displayed based on current post\'s category.', 'base-theme' ),
				'category'    => 'latest-stories',
				'icon'        => 'list-view',
				'keywords'    => [
					'latest-stories',
					'category',
					'stories',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => false,
					'mode'     => false,
					'multiple' => false,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = base_theme_render_template_path( 'latest-stories-by-category' );

			acf_register_block_type( $settings );
		}
	}
}
