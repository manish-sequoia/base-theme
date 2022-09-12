<?php
/**
 * Featured block.
 *
 * @package Base-Theme
 */

$base_theme_related_posts = base_theme_get_related_posts();

if ( ! empty( $base_theme_related_posts ) ) {

	foreach ( $base_theme_related_posts as $base_theme_related_post ) {

		echo get_the_post_thumbnail( $base_theme_related_post, 'full' );

		printf(
			'<a href="%1$s">%2$s</a>',
			esc_url( get_permalink( $base_theme_related_post ) ),
			esc_html( get_the_title( $base_theme_related_post ) )
		);
	}
}
