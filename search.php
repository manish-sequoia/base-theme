<?php
/**
 * The template for displaying search results pages.
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
							?>

							<header class="page-header">
								<h1 class="page-title">
									<?php
									/* translators: %s: search phrase */
									printf( esc_html__( 'Search Results for: %s', 'base-theme' ), '<span>' . get_search_query() . '</span>' );
									?>
								</h1>
							</header><!-- .page-header -->

							<?php
							/* Start the Loop */
							while ( have_posts() ) {

								the_post();

								/**
								 * Run the loop for the search to output the results.
								 * If you want to overload this in a child theme then include a file
								 * called content-search.php and that will be used instead.
								 */
								get_template_part( 'template-parts/content', 'search' );

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
