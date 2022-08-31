<?php
/**
 * ACF Featured Story.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Featured Story Block.
 */
class ACF_Featured_Story {

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
				'name'        => 'bt_featured_story',
				'title'       => __( 'Featured Story', 'base-theme' ),
				'description' => __( 'Select featured story which will display in the front-end.', 'base-theme' ),
				'category'    => 'featured-story',
				'icon'        => 'admin-post',
				'keywords'    => [
					'featured-story',
					'featured',
					'story',
					'stories',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => false,
					'mode'     => false,
					'multiple' => true,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = base_theme_render_template_path( 'featured-story' );

			acf_register_block_type( $settings );
		}
	}
}
