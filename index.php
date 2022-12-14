<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Base-Theme
 */

get_header();
?>
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-8 large-8">
				<div id="primary">
					<main id="main" class="site-main" role="main">

						<?php
						if ( have_posts() ) {

							if ( is_home() && ! is_front_page() ) {
								?>
								<header>
									<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
								</header>
								<?php
							}

							/* Start the Loop */
							while ( have_posts() ) {

								the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/category-content' );

							}
						} else {

							get_template_part( 'template-parts/content', 'none' );

						}
						?>

					</main><!-- #main -->

					<?php base_theme_pagination(); ?>

				</div><!-- #primary -->
			</div>
			<div class="cell small-12 medium-4 large-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
