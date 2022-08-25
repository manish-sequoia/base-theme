<?php
/**
 * The template for displaying the footer.
 * Contains the closing of the #content div and all content after.
 *
 * @package Base-Theme
 */

$base_theme_container_class = 'grid-container';

if ( is_page_template( 'page-templates/fluid-width-template.php' ) ) {
	$base_theme_container_class = 'grid-container fluid';
}
?>

</div><!-- #content -->

<?php base_theme_display_advert( 'before-footer' ); ?>

<footer id="colophon" class="site-footer" role="contentinfo">
	<div class="<?php echo esc_attr( $base_theme_container_class ); ?>">
		<?php if ( is_active_sidebar( 'sidebar-2' ) ) { ?>
			<aside class="grid-x grid-margin-x">
				<div class="cell">
					<?php dynamic_sidebar( 'sidebar-2' ); ?>
				</div>
			</aside>
		<?php } ?>
		<div class="grid-x grid-margin-x">
			<div class="cell">
				<div class="site-info text-center"><?php base_theme_copyright_text(); ?></div><!-- .site-info -->
			</div>
		</div>
	</div>

</footer><!-- #colophon -->

<?php base_theme_display_advert( 'after-footer' ); ?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
