<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
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
						while ( have_posts() ) {

							the_post();

							get_template_part( 'template-parts/content', 'page' );

							// If comments are open, or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {

								comments_template();

							}
						} // End of the loop.
						?>

					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
			<div class="cell small-12 medium-4 large-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
