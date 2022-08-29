<?php
/**
 * Core Web Vitals.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Base_Theme\Inc\Traits\Singleton;

/**
 * Class Web_Vitals
 */
class Web_Vitals {

	use Singleton;

	/**
	 * Construct method.
	 */
	protected function __construct() {

		$this->setup_hooks();

	}

	/**
	 * To register action/filter.
	 *
	 * @return void
	 */
	protected function setup_hooks() {

		/**
		 * Filters
		 */
		add_filter( 'xmlrpc_enabled', '__return_false' );
		add_filter( 'pre_option_enable_xmlrpc', '__return_false' );
		add_filter( 'wp_headers', [ $this, 'remove_x_pingback' ], 10, 1 );
		add_filter( 'pings_open', '__return_false', PHP_INT_MAX );
		add_filter( 'wp_get_attachment_image_attributes', [ $this, 'base_theme_get_attachment_image_attributes' ], 12, 2 );
		add_filter( 'the_content', [ $this, 'base_theme_decoding_attribute_for_image' ], 10 );
		add_filter( 'wp_resource_hints', [ $this, 'remove_dns_prefetch' ], 10, 2 );

		/**
		 * Remove actions.
		 */
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_action( 'wp_head', 'rsd_link' );
		remove_action( 'wp_head', 'wlwmanifest_link' );
		remove_action( 'wp_head', 'wp_generator' );
		remove_action( 'wp_head', 'wp_shortlink_wp_head' );
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

	}

	/**
	 * Set decoding attribute for images.
	 *
	 * @param array    $attr       Image attributes.
	 * @param \WP_Post $attachment Image attachment post.
	 *
	 * @return array
	 */
	public function base_theme_get_attachment_image_attributes( $attr, $attachment ) {

		if ( empty( $attr['alt'] ) ) {

			$attr['alt'] = get_the_title( $attachment->ID );

		}

		if ( ! isset( $attr['decoding'] ) || empty( $attr['decoding'] ) ) {

			if ( isset( $attr['loading'] ) && 'lazy' === $attr['loading'] ) {

				$attr['decoding'] = 'async';

			}
		}

		return $attr;

	}

	/**
	 * Filter post content for img tag with missing decoding and alt attribute value.
	 *
	 * @param string $content Post Content.
	 *
	 * @filter the_content
	 *
	 * @return mixed
	 */
	public function base_theme_decoding_attribute_for_image( $content ) {

		// Get all images from the content editor.
		preg_match_all( '/<img (.*?)>/', $content, $images );

		if ( ! is_null( $images ) ) {

			foreach ( $images[1] as $index => $value ) {

				// Add dynamic ALT text for image if missing.
				$regex_alt_pattern = '/alt="(.*?)"/m';

				preg_match_all( $regex_alt_pattern, $value, $alt_matches, PREG_SET_ORDER, 0 );

				if ( empty( $alt_matches[0][1] ) ) {

					global $post;

					$new_img_alt = str_replace( 'alt="', 'alt="' . get_the_title( $post->ID ) . '', $images[0][ $index ] );
					$content     = str_replace( $images[0][ $index ], $new_img_alt, $content );

				}

				// Regex pattern for loading attribute.
				$loading_pattern = '/loading="(.*?)"/m';

				preg_match_all( $loading_pattern, $value, $loading, PREG_SET_ORDER, 0 );

				// Regex pattern for decoding attribute.
				$decoding_pattern = '/decoding="(.*?)"/m';

				preg_match_all( $decoding_pattern, $value, $decoding, PREG_SET_ORDER, 0 );

				// Add decoding attribute only if loading lazy attribute is present.
				if ( isset( $loading[0] ) && ! empty( $loading[0][1] ) && 'lazy' === $loading[0][1] ) {

					if ( empty( $decoding[0][1] ) ) {

						$new_img = str_replace( '<img', '<img decoding="async"', $images[0][ $index ] );
						$content = str_replace( $images[0][ $index ], $new_img, $content );

					}
				}
			}
		}

		return $content;

	}

	/**
	 * Disables pingback headers
	 *
	 * @param array $headers The headers.
	 *
	 * @return array
	 */
	public function remove_x_pingback( $headers ) {

		unset( $headers['X-Pingback'] );

		return $headers;
	}

	/**
	 * Removes emoji DNS prefetch hints
	 *
	 * @param array  $hints The hints.
	 * @param string $relation_type The type of hint.
	 *
	 * @return array
	 */
	public function remove_dns_prefetch( $hints, $relation_type ) {

		if ( 'dns-prefetch' === $relation_type ) {

			$matches = preg_grep( '/emoji|googlesyndication/', $hints );

			return array_diff( $hints, $matches );

		}

		return $hints;

	}

}
