<?php
/**
 * The template for displaying all single posts.
 *
 * @package Base-Theme
 */

get_header();
?>
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12 medium-8 large-8">

				<?php bt_display_advert( 'before-content' ); ?>

				<div id="primary">
					<main id="main" class="site-main" role="main">

						<?php
						while ( have_posts() ) {

							the_post();

							if ( is_singular( 'post' ) ) {

								get_template_part( 'template-parts/content', 'single' );

							} else {

								get_template_part( 'template-parts/content', get_post_format() );

							}

							the_post_navigation();

							// If comments are open, or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {

								comments_template();

							}
						} // End of the loop.
						?>
					</main><!-- #main -->
				</div><!-- #primary -->

				<?php bt_display_advert( 'after-content' ); ?>

			</div>
			<div class="cell small-12 medium-4 large-4">
				<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
<?php
get_footer();
