<?php
/**
 * Hero Block
 *
 * @package Base-Theme
 */

$get_hero_title_val       =  get_field( 'hero_title' );
$get_hero_description_val =  get_field( 'hero_description' );
$get_hero_image_val       =  get_field( 'hero_image' );

if (! empty ( $get_hero_image_val ) ){
      $hero_bg_image_html = esc_html__( 'style = background:url('. esc_url( $get_hero_image_val ). ')' );
}
?>

<div class="hero-block grid" <?php echo $hero_bg_image_html; ?> >
      <?php
            if ( ! empty ( $get_hero_title_val ) ) {
                  printf( '<h2>%s</h2>', esc_html__( $get_hero_title_val ) );
            }
            if ( ! empty ( $get_hero_description_val ) ) {
                  printf( '<p>%s</p>', esc_html__( $get_hero_description_val ) );
            } 
      ?>
</div>
