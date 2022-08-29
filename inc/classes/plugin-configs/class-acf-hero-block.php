<?php
/**
 * ACF Plugin Config.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class hero Block.
 */
class ACF_Hero_Block {

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

		add_action( 'acf/init', [ $this, 'hero_block' ] );

	}

	/**
	 * Register Block.
	 */
	public function hero_block() {

		if ( function_exists( 'acf_register_block_type' ) ) {

			$settings = [
				'name'        => 'hero',
				'title'       => __( 'Hero Block', 'base-theme' ),
				'description' => __( 'A custom Hero Block.', 'base-theme' ),
				'icon'        => 'cover-image',
				'keywords'    => [
					'hero',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => true,
					'mode'     => true,
					'multiple' => true,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = $this->render_template_path( 'hero' );

			acf_register_block_type( $settings );
		}
	}

	/**
	 * Get absolute path to template for ACF block from block object.
	 *
	 * @param string $name Name of the block.
	 *
	 * @return string Path to the template file, if it exists. Otherwise, empty string.
	 */
	public function render_template_path( $name ) {

		$relative_path = "/partials/blocks/{$name}.php";

		if ( file_exists( get_theme_file_path( $relative_path ) ) ) {

			return get_theme_file_path( $relative_path );
		}

		return '';
	}
}
