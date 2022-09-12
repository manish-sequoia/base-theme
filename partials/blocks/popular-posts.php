<?php
/**
 * Popular Posts block.
 *
 * @package Base-Theme
 */

// Invoke the query
$popular_posts = new WP_Query(
	array(
		'meta_key'       => 'wp_post_views_count', // set custom meta key
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
		'posts_per_page' => 4,
	)
);

if ( $popular_posts->have_posts() ) {
	?>

	<h2><?php esc_html_e( 'Popular Posts', 'base-theme' ); ?></h2>

	<ul class="wp-block-latest-posts__list wp-block-latest-posts">

		<?php
		while ( $popular_posts->have_posts() ) {

			$popular_posts->the_post();
			?>

			<li>
				<a class="wp-block-latest-posts__post-title"
					href="<?php the_permalink(); ?>"
					title="<?php the_title(); ?>"
				>
					<?php the_title(); ?>
				</a>
			</li>

			<?php
		}

		wp_reset_postdata();
		?>

	</ul>

	<?php
}
