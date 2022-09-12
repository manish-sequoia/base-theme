<?php
/**
 * Featured block.
 *
 * @package Base-Theme
 */

$base_theme_featured_story = get_field( 'featured_post' );

if ( ! empty( $base_theme_featured_story ) ) {
	?>

	<h3><?php echo esc_html( get_the_title( $base_theme_featured_story ) ); ?></h3>

	<?php echo get_the_post_thumbnail( $base_theme_featured_story, 'thumbnail' ); ?>

	<?php remove_filter( 'excerpt_more', array( Base_Theme\Inc\BASE_THEME::get_instance(), 'add_read_more_link' ) ); ?>
	<p><?php echo esc_html( wp_strip_all_tags( get_the_excerpt( $base_theme_featured_story ) ) ); ?></p>
	<?php add_filter( 'excerpt_more', array( Base_Theme\Inc\BASE_THEME::get_instance(), 'add_read_more_link' ) ); ?>

	<?php
}
