<?php
/**
 * Hero Block
 *
 * @package Base-Theme
 */


$get_hero_title_val = get_field( 'hero_title' );
$get_hero_description_val = get_field( 'hero_description' );
$get_hero_image_val = get_field( 'hero_image' );
?>

<div class="hero-block grid" style="background: url('<?php echo esc_url( $get_hero_image_val ); ?>')">
      <h2> <?php echo esc_html ( $get_hero_title_val ); ?> </h2>
      <p> <?php echo esc_html ( $get_hero_description_val ); ?> </p>
</div>