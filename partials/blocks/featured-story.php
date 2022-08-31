<?php
/**
 * Featured block.
 *
 * @package Base-Theme
 */

$featured_post = get_field( 'featured_post' );

if ( ! empty( $featured_post ) ) {
	?>

	<h3><?php echo esc_html( get_the_title( $featured_post ) ); ?></h3>

	<?php echo get_the_post_thumbnail( $featured_post, 'full' ); ?>

	<?php remove_filter( 'excerpt_more', array( Base_Theme\Inc\BASE_THEME::get_instance(), 'add_read_more_link' ) ); ?>
	<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt( $featured_post ) ) ); ?></p>
	<?php add_filter( 'excerpt_more', array( Base_Theme\Inc\BASE_THEME::get_instance(), 'add_read_more_link' ) ); ?>

	<?php
}
