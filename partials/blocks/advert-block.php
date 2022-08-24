<?php
/**
 * Advert block widget.
 *
 * @package Base-Theme
 */

$advert = get_field( 'advert' );

if ( ! empty( $advert ) ) {

	if ( is_admin() ) {

		printf( '<h3>[%1$s]</h3>', esc_html__( 'Advert Block', 'base-theme' ) );

	} else {

		echo apply_filters( 'the_content', get_the_content( null, null, $advert ) );
	}
}
