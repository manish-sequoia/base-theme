<?php
/**
 * Hero Block
 *
 * @package Base-Theme
 */

$base_theme_get_title       = get_field( 'hero_title' );
$base_theme_get_description = get_field( 'hero_description' );
$base_theme_get_image       = get_field( 'hero_image' );

if ( ! empty( $base_theme_get_image ) ) {
	$base_theme_get_image        = wp_get_attachment_url( $base_theme_get_image, 'full' );
	$base_theme_background_image = ' style="background-image: url( ' . esc_url( $base_theme_get_image ) . ' ); "';
}
?>

<div class="hero-block grid" <?php echo $base_theme_background_image; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
	<?php
	if ( ! empty( $base_theme_get_title ) ) {
		printf( '<h2>%s</h2>', esc_html( $base_theme_get_title ) );
	}

	if ( ! empty( $base_theme_get_description ) ) {
		printf( '<p>%s</p>', esc_html( $base_theme_get_description ) );
	}
	?>
</div>
