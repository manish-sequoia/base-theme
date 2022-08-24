<?php
/**
 * Advert block widget.
 *
 * @package Base-Theme
 */

$base_theme_advert = get_field( 'advert' );

if ( ! empty( $base_theme_advert ) ) {

	if ( is_admin() ) {

		printf( '<h3>[%1$s]</h3>', esc_html__( 'Advert Block', 'base-theme' ) );

	} else {

		echo wp_kses_post(
			apply_filters(
				'the_content', // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound
				get_the_content( null, null, $base_theme_advert )
			)
		);
	}
}
