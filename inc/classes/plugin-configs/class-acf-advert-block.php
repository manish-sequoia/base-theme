<?php
/**
* ACF Plugin Config.
*
* @package Base-Theme
*/

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class ACF
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
	 * Register Theme setting page with ACF.
	 */
	public function advert_block() {

		if ( function_exists( 'acf_register_block_type' ) ) {

			$settings = array(
				'name'        => 'bt_advert_block',
				'title'       => __( 'Advert Block', 'base-theme' ),
				'description' => __( 'Advert Block to display ads on the front-end side.', 'base-theme' ),
				'category'    => 'advert',
				'icon'        => 'megaphone',
				'keywords'    => array(
					'advert',
					'ad',
					'advertisement',
				),
				'mode'        => 'auto',
				'supports'    => array(
					'align'    => true,
					'mode'     => true,
					'multiple' => true,
					'jsx'      => false,
				),
			);

			$settings['render_template'] = $this->render_template_path( 'advert-block' );

			acf_register_block_type( $settings );
		}
	}

	/**
	 * Get absolute path to template for ACF block from block object.
	 *
	 * @param  string $name Name of the block.
	 *
	 * @return string Path to the template file, if it exists. Otherwise, empty string.
	 */
	function render_template_path( $name ) {

		$relative_path = "/partials/blocks/{$name}.php";

		if ( file_exists( get_theme_file_path( $relative_path ) ) ) {

			return get_theme_file_path( $relative_path );
		}

		return '';
	}
}
