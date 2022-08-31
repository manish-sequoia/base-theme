<?php
/**
 * Latest Stories by Category Widget.
 *
 * @package Base-Theme
 */

if ( is_admin() ) {

	printf( '<h3>%1$s</h3>', esc_html__( 'Latest Stories shown by post current category on the single post page.', 'base-theme' ) );

} elseif ( is_singular( 'post' ) ) {

	global $post;

	$base_theme_current_post_id = $post->ID;

	$base_theme_category_ids = wp_get_post_categories(
		$base_theme_current_post_id,
		array(
			'fields' => 'ids',
			'number' => 1,
		)
	);

	if ( ! is_wp_error( $base_theme_category_ids ) && ! empty( $base_theme_category_ids ) ) {

		$base_theme_query = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 6,
				'cat'            => $base_theme_category_ids[0],
			)
		);

		if ( $base_theme_query->have_posts() ) {
			?>

			<h2><?php esc_html_e( 'Latest Stories by Category', 'base-theme' ); ?></h2>

			<ul class="wp-block-latest-posts__list wp-block-latest-posts">

				<?php

				$base_theme_i = 0;

				while ( $base_theme_query->have_posts() ) {

					$base_theme_query->the_post();

					if ( $base_theme_i >= 5 ) {
						break;
					}

					if ( get_the_ID() === $base_theme_current_post_id ) {
						continue;
					}
					?>

						<li>
							<a class="wp-block-latest-posts__post-title" href="<?php echo esc_url( get_the_permalink() ); ?>">
								<?php the_title(); ?>
							</a>
						</li>

					<?php
					$base_theme_i++;
				}
				?>

			</ul>

			<?php

			wp_reset_postdata();
		}
	}
}
