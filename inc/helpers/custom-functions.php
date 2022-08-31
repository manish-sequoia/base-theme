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

				$post_id = get_the_ID();

				$start_date_time   = get_field( 'advert_start_date_time', $post_id );
				$end_date_time     = get_field( 'advert_end_date_time', $post_id );
				$current_date_time = strtotime( 'now' );

				$default_ad = get_field( 'default_ad', $post_id );

				$show_content = false;

				if ( empty( $start_date_time ) && empty( $end_date_time ) ) {

					$show_content = true;

				} elseif ( ! empty( $start_date_time ) && empty( $end_date_time ) ) {

					if ( $current_date_time > strtotime( $start_date_time ) ) {

						$show_content = true;
					}
				} elseif ( empty( $start_date_time ) && ! empty( $end_date_time ) ) {

					if ( $current_date_time < strtotime( $end_date_time ) ) {

						$show_content = true;
					}
				} elseif ( ! empty( $start_date_time ) && ! empty( $end_date_time ) ) {

					if (
						$current_date_time > strtotime( $start_date_time ) &&
						$current_date_time < strtotime( $end_date_time )
					) {

						$show_content = true;
					}
				}

				if ( $display ) {

					printf( '<div class="bt-advert %1$s">', esc_attr( $location ) );

					if ( $show_content ) {
						the_content();
					} else {
						echo wp_kses_post( $default_ad );
					}

					echo '</div>';

				} else {

					$default_content = $default_ad;

					if ( $show_content ) {

						$default_content = apply_filters( 'the_content', get_the_content() ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
					}

					$content .= sprintf(
						'<div class="bt-advert %1$s">%2$s</div>',
						esc_attr( $location ),
						wp_kses_post( $default_content )
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

	global $post;

	if ( is_admin() ) {

		return $content;
	}

	if ( ! is_single() ) {

		return $content;
	}

	if ( 'bt-adverts' === $post->post_type ) {

		return $content;
	}

	/**-----------------------------------------------------------------------------
	 *
	 *  Wptexturize is applied to the $content. This inserts p tags that will help to
	 *  split the text into paragraphs. The text is split into paragraphs after each
	 *  closing p tag. Remember, each double break constitutes a paragraph.
	 *
	 * @todo If you really need to delete the attachments in paragraph one, you want
	 *        to do it here before you start your foreach loop
	 *
	 *------------------------------------------------------------------------------*/
	$closing_p  = '</p>';
	$paragraphs = explode( $closing_p, wptexturize( $content ) );

	/**-----------------------------------------------------------------------------
	 *
	 *  The amount of paragraphs is counted to determine add frequency. If there are
	 *  less than four paragraphs, only one ad will be placed. If the paragraph count
	 *  is more than 4, the text is split into two sections, $first and $second according
	 *  to the midpoint of the text. $totals will either contain the full text (if
	 *  paragraph count is less than 4) or an array of the two separate sections of
	 *  text
	 *
	 * @todo Set paragraph count to suite your needs
	 *
	 *------------------------------------------------------------------------------*/
	$count = count( $paragraphs );

	if ( 4 >= $count ) {

		$totals = array( $paragraphs );

	} else {

		$midpoint = floor( $count / 2 );
		$first    = array_slice( $paragraphs, 0, $midpoint );

		if ( 1 === $count % 2 ) {

			$second = array_slice( $paragraphs, $midpoint, $midpoint, true );

		} else {

			$second = array_slice( $paragraphs, $midpoint, $midpoint - 1, true );

		}

		$totals = [ $first, $second ];
	}

	$new_paras = [];

	foreach ( $totals as $key_total => $total ) {

		/**-----------------------------------------------------------------------------
		 *
		 *  This is where all the important stuff happens
		 *  The first thing that is done is a work count on every paragraph
		 *  Each paragraph is also checked if the following tags, a, li and ul exists
		 *  If any of the above tags are found or the text count is less than 10, 0 is
		 *  returned for this paragraph. ($p will hold these values for later checking)
		 *  If none of the above conditions are true, 1 will be returned. 1 will represent
		 *  paragraphs that qualify for add insertion, and these will determine where an ad
		 *  will go
		 *  returned for this paragraph. ($p will hold these values for later checking)
		 *
		 * @todo You can delete or add rules here to your liking
		 *
		 *------------------------------------------------------------------------------*/
		$p = [];

		foreach ( $total as $key_paras => $paragraph ) {

			if ( preg_match( '~<(?:img|ul|li|blockquote)[ >]~', $paragraph ) ) {

				$p[ $key_paras ] = 0;

			} else {

				$p[ $key_paras ] = 1;

			}
		}

		/**-----------------------------------------------------------------------------
		 *
		 *  Return a position where an add will be inserted
		 *  This code checks if there are two adjacent 1's, and then return the second key
		 *  The ad will be inserted between these keys
		 *  If there are no two adjacent 1's, "no_ad" is returned into array $m
		 *  This means that no ad will be inserted in that section
		 *
		 *------------------------------------------------------------------------------*/
		$m = [];

		foreach ( $p as $key => $value ) {

			if ( 1 === $value && array_key_exists( $key - 1, $p ) && $p[ $key ] === $p[ $key - 1 ] && ! $m ) {

				$m[] = $key;

			} elseif ( ! array_key_exists( $key + 1, $p ) && ! $m ) {

				$m[] = 'no-ad';

			}
		}

		/**-----------------------------------------------------------------------------
		 *
		 *  Use two different ads, one for each section
		 *  Only ad1 is displayed if there is less than 4 paragraphs
		 *
		 * @todo Replace "PLACE YOUR ADD NO 1 HERE" with your add or code. Leave p tags
		 * @todo I will try to insert widgets here to make it dynamic
		 *
		 *------------------------------------------------------------------------------*/
		if ( 0 === $key_total ) {

			$ad = array( 'ad1' => base_theme_insert_post_ads( $content ) );

		} else {

			$ad = array( 'ad2' => base_theme_insert_post_ads( $content ) );

		}

		/**-----------------------------------------------------------------------------
		 *
		 *  This code loops through all the paragraphs and checks each key against $mail
		 *  and $key_para
		 *  Each paragraph is returned to an array called $new_paras. $new_paras will
		 *  hold the new content that will be passed to $content.
		 *  If a key matches the value of $m (which holds the array key of the position
		 *  where an ad should be inserted) an add is inserted. If $m holds a value of
		 *  'no_ad', no ad will be inserted
		 *
		 *------------------------------------------------------------------------------*/
		foreach ( $total as $key_para => $para ) {

			if ( ! in_array( 'no_ad', $m, true ) && $key_para === $m[0] ) {

				$new_paras[ key( $ad ) ] = $ad[ key( $ad ) ];
				$new_paras[ $key_para ]  = $para;

			} else {

				$new_paras[ $key_para ] = $para;

			}
		}
	}

	$contents = '';

	/**-----------------------------------------------------------------------------
	 *
	 *  $content should be a string, not an array. $new_paras is an array, which will
	 *  not work. $new_paras are converted to a string with implode, and then passed
	 *  to $content which will be our new content
	 *
	 *------------------------------------------------------------------------------*/
	if ( ! empty( $new_paras ) ) {

		$contents = implode( ' ', $new_paras );
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

	return base_theme_display_advert( 'repeat-after-2-paragraphs', false );
}
