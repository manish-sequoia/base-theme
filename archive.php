<?php
/**
 * The template for displaying archive pages.
 *
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
						<?php if ( have_posts() ) { ?>

							<header class="page-header">
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .page-header -->

							<?php
							/* Start the Loop */
							while ( have_posts() ) {

								the_post();

								/*
								 * Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );

							}
							?>

						<?php } else { ?>

							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php } ?>

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