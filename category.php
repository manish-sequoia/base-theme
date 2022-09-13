<?php
/**
 * The template for displaying Blog category.
 *
 * @package Base-Theme
 */

get_header();

$base_theme_queried_object    = get_queried_object();
$base_theme_queried_object_id = get_queried_object_id();
$base_theme_category_image    = get_field( 'image_cat', $base_theme_queried_object );
?>
<div class="grid-container">
	<div class="grid-x grid-margin-x">
		<div class="cell small-12 medium-8 large-8">
			<div id="primary">
				<main id="main" class="site-main" role="main">
					<div class="tagList">
						<?php
						$base_theme_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'base-theme' ) );
						if ( $base_theme_tags_list ) {
							/* translators: 1: list of tags. */
							printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'base-theme' ) . '</span>', $base_theme_tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
						}
						?>
					</div>
					<?php if ( have_posts() ) { 
						$base_theme_medium_block = '';
						if ( ! empty( $base_theme_category_image ) ) {
							$base_theme_medium_block = 'medium-8';
						}
						?>
						<header class="page-header">
							<div class="grid-x grid-margin-x">
								<div class="cell small-12 <?php echo esc_attr( $base_theme_medium_block ); ?> ">
									<?php
									the_archive_title( '<h1 class="page-title">', '</h1>' );
									the_archive_description( '<div class="taxonomy-description">', '</div>' );
									?>
								</div>
								
								<?php 
								if ( ! empty( $base_theme_category_image ) ) { ?>
									<div class="cell small-12 medium-4">
										<?php
											echo wp_get_attachment_image( $base_theme_category_image, 'full' );

										?>
									</div>
								<?php } ?>
							</div>
						</header><!-- .page-header -->

						<hr />

						<div class="subcategory_block">

							<strong><?php esc_html_e( 'Sub Category: ', 'base-theme' ); ?></strong>

							<?php
							$base_theme_sub_categories = get_terms(
								array(
									'taxonomy' => Base_Theme\Inc\Taxonomies\Taxonomy_Sub_Category::SLUG,
								)
							);

							if ( ! is_wp_error( $base_theme_sub_categories ) && ! empty( $base_theme_sub_categories ) ) {

								foreach ( $base_theme_sub_categories as $base_theme_sub_category ) {

									$base_theme_sub_category_link = get_term_link( $base_theme_sub_category );

									if ( ! is_wp_error( $base_theme_sub_category_link ) && ! empty( $base_theme_sub_category_link ) ) {

										add_filter( 'term_link', 'base_theme_term_link', 10, 3 );

										printf(
											'<a href="%1$s">%2$s</a> |  ',
											esc_url( $base_theme_sub_category_link ),
											esc_html( $base_theme_sub_category->name )
										);

										remove_filter( 'term_link', 'base_theme_term_link' );
									}
								}
							}
							?>
						</div>

						<?php

						$i = 1;

							/* Start the Loop */
						while ( have_posts() ) {

							the_post();

							/*
							 * Include the Post-Format-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
							 */
							get_template_part( 'template-parts/category', 'content' );

							if ( 0 === $i % 4 ) {

								echo '<hr />';

								base_theme_display_advert( 'advert-archive-listing' );
							}

							$i++;
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
