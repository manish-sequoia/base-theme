<?php
/**
 * ACF Popular Posts.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Plugin_Configs;

use \Base_Theme\Inc\Traits\Singleton;

/**
 * Class Popular Posts Block.
 */
class ACF_Popular_Posts {

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

		add_action( 'wp_head', [ $this, 'track_post_views' ] );

		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10 );

	}

	/**
	 * Register Block.
	 */
	public function block() {

		if ( function_exists( 'acf_register_block_type' ) ) {

			$settings = [
				'name'        => 'bt_popular_posts',
				'title'       => __( 'Popular Posts', 'base-theme' ),
				'description' => __( 'Show list of popular posts.', 'base-theme' ),
				'category'    => 'posts',
				'icon'        => 'admin-post',
				'keywords'    => [
					'popular-posts',
					'popular',
					'posts',
				],
				'mode'        => 'auto',
				'supports'    => [
					'align'    => false,
					'mode'     => false,
					'multiple' => true,
					'jsx'      => false,
				],
			];

			$settings['render_template'] = base_theme_render_template_path( 'popular-posts' );

			acf_register_block_type( $settings );
		}
	}

	/**
	 * Positron functions and definitions
	 */
	public function set_post_views( $post_id ) {

		$count_key = 'wp_post_views_count';
		$count     = get_post_meta( $post_id, $count_key, true );

		if ( '' === $count ) {

			$count = 0;

			delete_post_meta( $post_id, $count_key );

			add_post_meta( $post_id, $count_key, $count );

		} else {

			$count++;

			update_post_meta( $post_id, $count_key, $count );
		}
	}

	public function track_post_views( $post_id ) {

		if ( ! is_single() ) {
			return;
		}

		if ( empty ( $post_id ) ) {
			global $post;
			$post_id = $post->ID;
		}

		$this->set_post_views( $post_id );
	}
}
