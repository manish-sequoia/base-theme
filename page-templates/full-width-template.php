<?php
/**
 * Template Name: Full Width Template
 *
 * Template Post Type: post, page
 *
 * Used for showing full width template
 *
 * @package Base-Theme
 */

get_header();
?>
	<div class="grid-container">
		<div class="grid-x grid-margin-x">
			<div class="cell small-12">
				<div id="primary">
					<main id="main" class="site-main" role="main">
						<?php
						while ( have_posts() ) {
							the_post();

							if ( is_singular( 'post' ) ) {

								get_template_part( 'template-parts/content', 'single' );

							} else {

								get_template_part( 'template-parts/content', 'page' );

							}
						}
						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div>
		</div>
	</div>
<?php
get_footer();
