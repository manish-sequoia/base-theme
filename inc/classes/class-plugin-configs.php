<?php
/**
 * Third-party Plugin Config.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Plugin_Configs\ACF_Advert_Block;
use Base_Theme\Inc\Plugin_Configs\ACF_Featured_Story;
use Base_Theme\Inc\Plugin_Configs\ACF_Hero_Block;
use Base_Theme\Inc\Plugin_Configs\ACF_Latest_Stories_By_Category;
use Base_Theme\Inc\Plugin_Configs\ACF_Popular_Posts;
use Base_Theme\Inc\Plugin_Configs\ACF_Read_This;
use Base_Theme\Inc\Traits\Singleton;

use Base_Theme\Inc\Plugin_Configs\ACF;

/**
 * Class Plugin_Configs
 */
class Plugin_Configs {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		ACF::get_instance();
		ACF_Advert_Block::get_instance();
		ACF_Hero_Block::get_instance();
		ACF_Latest_Stories_By_Category::get_instance();
		ACF_Featured_Story::get_instance();
		ACF_Popular_Posts::get_instance();
		ACF_Read_This::get_instance();
	}

}
