<?php
/**
 * Contains custom functions used for the theme
 *
 * @package Base-Theme
 */

use Base_Theme\Inc\Post_Types\Post_Type_Adverts;
use Base_Theme\Inc\Taxonomies\Taxonomy_Advert_Location;

/**
 * Display advert.
 *
 * @param string $location Location slot(Taxonomy Term).
 * @param bool   $display  Display the advert or return the advert markup.
 *
 * @return string Ad content.
 */
function base_theme_display_advert( $location = '', $display = true ) {

	$content = '';

	if ( ! empty( $location ) ) {

		$query = new WP_Query(
			[
				'post_type'      => Post_Type_Adverts::SLUG,
				'post_status'    => 'publish',
				'posts_per_page' => 10,
				'tax_query'      => [ // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
					[
						'taxonomy' => Taxonomy_Advert_Location::SLUG,
						'field'    => 'slug',
						'terms'    => $location,
					],
				],
			]
		);

		if ( $query->have_posts() ) {

			while ( $query->have_posts() ) {

				$query->the_post();

				if ( $display ) {

					printf( '<div class="bt-advert %1$s">', esc_attr( $location ) );

					the_content();

					echo '</div>';

				} else {

					$content .= sprintf(
						'<div class="bt-advert %1$s">%2$s</div>',
						esc_attr( $location ),
						wp_kses_post( apply_filters( 'the_content', get_the_content() ) ) // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					);
				}
			}

			wp_reset_postdata();
		}
	}

	if ( ! $display ) {

		return $content;
	}
}

/**
 * Filter post content to inject ads
 *
 * @param string $content Post content.
 *
 * @return string
 */
function base_theme_in_article_ads( $content ) {

	if ( is_admin() ) {

		return $content;
	}

	if ( ! is_single() ) {

		return $content;
	}

	$closing_p       = '</p>';
	$p_number        = 1;
	$ad_number       = 1;
	$paragraphs      = explode( $closing_p, $content );
	$count_paragraph = count( $paragraphs );
	$contents        = '';

	foreach ( $paragraphs as $paragraph ) {

		$contents .= $paragraph;

		if ( 0 === $p_number % 2 && $p_number < $count_paragraph - 1 ) {

			$contents .= base_theme_insert_post_ads( $paragraph );

			$ad_number++;

		}

		$p_number++;

	}

	return $contents;
}

add_filter( 'the_content', 'base_theme_in_article_ads' );

/**
 * Ad prefixes.
 *
 * @param string $content Post content.
 *
 * @return string
 */
function base_theme_insert_post_ads( $content ) {

	if ( is_admin() ) {

		return $content;

	}

	$ad_code_article = base_theme_display_advert( 'repeat-after-2-paragraphs', false );

	if ( is_single() ) {

		$content = '</p>' . $ad_code_article;

	} else {

		$content = '</p>';

	}

	return $content;
}
