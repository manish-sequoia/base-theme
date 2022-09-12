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

			<div class="cell small-12">
				<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<nav id="site-navigation" class="primary-navigation" style="justify-content: center;margin-top: 80px;margin-bottom: 50px;"
						role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'base-theme' ); ?>"
					>
						<?php
						wp_nav_menu(
							[
								'theme_location' => 'primary',
								'menu_id'        => 'primary-menu',
								'menu_class'     => 'primary-menu menu',
								'depth'          => 3,
								'fallback_cb'    => false,
							]
						);
						?>
					</nav><!-- #site-navigation -->
				<?php } ?>
			</div>

			<div class="cell" style="margin-bottom: 50px;">
				<div class="site-info text-center"><?php base_theme_copyright_text(); ?></div><!-- .site-info -->
			</div>
		</div>
	</div>

</footer><!-- #colophon -->


<?php base_theme_display_advert( 'after-footer' ); ?>

<?php
$popup_advert = base_theme_display_advert( 'popup-advert', false );

if ( ! empty( $popup_advert ) ) {
	?>

	<!-- The Modal -->
	<div id="popup_advert_modal" class="modal">

		<!-- Modal content -->
		<div class="modal-content">

			<span id="popup_advert_close" class="close">&times;</span>

			<?php echo wp_kses_post( $popup_advert ); ?>

		</div>

	</div>

	<?php
}
?>

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
