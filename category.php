<?php
/**
 * The template for displaying Blog category.
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
                    <div class="tagList">
                        <?php
							$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'base-theme' ) );
							if ( $tags_list ) {
								/* translators: 1: list of tags. */
								printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'base-theme' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
                        ?>
                    </div>
					<?php if ( have_posts() ) { ?>

						<header class="page-header">
                            <div class="bt-category-flex">
                                <div class="bt-cat-column">
                                    <?php
                                    	the_archive_title( '<h1 class="page-title">', '</h1>' );
                                        the_archive_description( '<div class="taxonomy-description">', '</div>' );
                                    ?>
                                </div>
								<div class="bt-cat-column">
									<?php echo wp_get_attachment_image( $base_theme_category_image, 'full' ); ?>
								</div>
                            </div>
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
							get_template_part( 'template-parts/category', 'content' );

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
