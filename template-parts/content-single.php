<?php
/**
 * Template part for displaying single posts.
 *
 * @package Base-Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php base_theme_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content clearfix">

		<?php base_theme_display_advert( 'before-content-image' ); ?>

		<?php the_post_thumbnail( 'full' ); ?>

		<?php base_theme_display_advert( 'after-content-image' ); ?>

		<?php the_content(); ?>
		<?php
		wp_link_pages(
			[
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'base-theme' ),
				'after'  => '</div>',
			]
		);
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php base_theme_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->

