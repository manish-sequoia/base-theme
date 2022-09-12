<?php
/**
 * ACF Read This Story class.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Read This Story.
 */
class ACF_Read_This {

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
				'name'        => 'bt_read_this',
				'title'       => __( 'Read This Story', 'base-theme' ),
				'description' => __( 'Select a story which will display in the front-end, mostly this will be used in the between of the articles.', 'base-theme' ),
				'category'    => 'featured-story',
				'icon'        => 'admin-post',
				'keywords'    => [
					'read-this-story',
					'read-this',
					'read',
					'story',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => false,
					'mode'     => false,
					'multiple' => true,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = base_theme_render_template_path( 'read-this' );

			acf_register_block_type( $settings );
		}
	}
}
