<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Base-Theme
 */

?>

<aside id="secondary" role="complementary">
	<?php base_theme_display_advert( 'before-sidebar' ); ?>
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php base_theme_display_advert( 'after-sidebar' ); ?>
</aside><!-- #secondary -->
