<?php
/**
 * Hero Block
 *
 * @package Base-Theme
 */


$get_hero_title_val       =  get_field( 'hero_title' );
$get_hero_description_val =  get_field( 'hero_description' );
$get_hero_image_val       =  get_field( 'hero_image' );
if ( empty ( $get_hero_image_val ) ){
      $get_hero_image_val       = '';
}
?>

<div class="hero-block grid" style="background: url('<?php echo esc_url( $get_hero_image_val ); ?>')">
      <?php if ( ! empty ( $get_hero_title_val ) ) {
		printf(
			'<h2>%s</h2>',
			$get_hero_title_val // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	} ?>
      <?php if ( ! empty ( $get_hero_description_val ) ) {
		printf(
			'<p>%s</p>',
			$get_hero_description_val // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		);
	} ?>
</div>