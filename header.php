<?php
/**
 * The header for our theme.
 *
 * Displays all the <head> section and everything up till <div id="content">
 *
 * @package Base-Theme
 */

$base_theme_container_class = 'grid-container';

if ( is_page_template( 'page-templates/fluid-width-template.php' ) ) {
	$base_theme_container_class = 'grid-container fluid';
}
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
}
?>

<div id="page" class="hfeed site">

	<?php bt_display_advert( 'before-header' ); ?>

	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'base-theme' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="<?php echo esc_attr( $base_theme_container_class ); ?>">
			<div class="grid-x grid-margin-x align-middle">
				<div class="cell small-12 medium-shrink">
					<div class="site-branding">
						<?php
						if ( get_theme_mod( 'custom_logo' ) ) {
							the_custom_logo();
							base_theme_site_title( 'screen-reader-text' );
						} else {
							base_theme_site_title();
						}

						base_theme_site_description();
						?>
					</div><!-- .site-branding -->
				</div>
				<div class="cell small-12 medium-auto">
					<?php if ( has_nav_menu( 'primary' ) ) { ?>
					<nav id="site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'base-theme' ); ?>">
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
			</div>
		</div>
	</header><!-- #masthead -->

	<?php bt_display_advert( 'after-header' ); ?>

	<div id="content" class="site-content">
