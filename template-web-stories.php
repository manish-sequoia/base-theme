<?php
/**
 * Template Name: Web Stories
 *
 * @package Base-Theme
 */


get_header();

$base_theme_queried_object = get_queried_object();
$base_theme_category_image = get_field( 'image_cat', $base_theme_queried_object );
?>
	<div class="grid-container">

		<div class="grid-x grid-margin-x">

			<div class="cell small-12 medium-8 large-8">

				<div id="primary">

					<main id="main" class="site-main" role="main">

						<header class="page-header">

							<div class="grid-x grid-margin-x">

								<div class="cell small-12">
									<h3><?php esc_html_e( 'Web Stories', 'base-theme' ); ?></h3>
								</div>

							</div>

						</header><!-- .page-header -->

						<?php
						$story_query_attrs = [
							'view_type'          => 'grid', // Possible values: circles, grid, carousel, list.
							'number_of_columns'  => 2,
							'show_title'         => true,
							'show_author'        => false,
							'show_date'          => true,
							'show_excerpt'       => true,
							'show_archive_link'  => false,
							'sharp_corners'      => false,
							'archive_link_label' => __( 'View all stories', 'base-theme' ),
						];

						$story_query_args  = [ 'posts_per_page' => 8 ];
						$story_query       = new \Google\Web_Stories\Story_Query( $story_query_attrs, $story_query_args );

						$renderer = new Base_Theme\Inc\Web_Stories_Renderer( $story_query );
						echo $renderer->render();
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
