<?php
/**
 * ACF Plugin Config.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Advert Block.
 */
class ACF_Advert_Block {

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

		add_action( 'acf/init', [ $this, 'advert_block' ] );

	}

	/**
	 * Register Block.
	 */
	public function advert_block() {

		if ( function_exists( 'acf_register_block_type' ) ) {

			$settings = [
				'name'        => 'bt_advert_block',
				'title'       => __( 'Advert Block', 'base-theme' ),
				'description' => __( 'Advert Block to display ads on the front-end side.', 'base-theme' ),
				'category'    => 'advert',
				'icon'        => 'megaphone',
				'keywords'    => [
					'advert',
					'ad',
					'advertisement',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => true,
					'mode'     => true,
					'multiple' => true,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = base_theme_render_template_path( 'advert-block' );

			acf_register_block_type( $settings );
		}
	}
}
