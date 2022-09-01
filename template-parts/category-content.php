<?php
/**
 * Template part for displaying category posts.
 *
 * @package Base-Theme
 */

$base_theme_category_name = get_cat_name( get_queried_object_id() );
?>

<hr />

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="grid-x grid-margin-x">

		<div class="cell small-12 medium-3">
			<?php
			if ( ! is_single() && ! is_page() ) {

				if ( has_post_thumbnail() ) {

					the_post_thumbnail( 'large' );

				} else {

					base_theme_placeholder_image();
				}
			}
			?>
		</div>

		<div class="cell small-12 medium-9">

			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" style="margin-top: 0;"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php if ( 'post' === get_post_type() ) { ?>
					<div class="entry-meta">
						<?php esc_html_e( 'Written by:', 'base-theme' ); ?> <?php base_theme_posted_by(); ?> | <?php base_theme_posted_on(); ?><br>
						<div class="tagList">
							<?php
							$base_theme_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'base-theme' ) );

							if ( $base_theme_tags_list ) {
								/* translators: 1: list of tags. */
								printf( '<span class="tags-links">%s</span>', $base_theme_tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							}
							?>
						</div>
					</div><!-- .entry-meta -->
				<?php } ?>
			</header><!-- .entry-header -->

			<div class="entry-content clearfix">
				<?php
				if ( is_single() || is_page() ) {

					the_content(
						sprintf(
							wp_kses(
							/* translators: %s: Name of current post. */
								__( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'base-theme' ),
								[
									'span' => [
										'class' => [],
									],
								]
							),
							the_title( '<span class="screen-reader-text">"', '"</span>', false )
						)
					);

					wp_link_pages(
						[
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'base-theme' ),
							'after'  => '</div>',
						]
					);

				} else {

					the_excerpt();

				}
				?>
			</div><!-- .entry-content -->

		</div>

	</div>

</article><!-- #post-## -->
