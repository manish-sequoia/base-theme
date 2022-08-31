<?php
/**
 * Latest Stories by Category Widget.
 *
 * @package Base-Theme
 */

if ( is_admin() ) {

	printf( '<h3>%1$s</h3>', esc_html__( 'Latest Stories shown by post current category on the single post page.', 'base-theme' ) );

} else if ( is_singular( 'post' ) ) {

	global $post;

	$current_post_id = $post->ID;

	$category_ids = wp_get_post_categories( $current_post_id, array( 'fields' => 'ids', 'number' => 1 ) );

	if ( ! is_wp_error( $category_ids ) && ! empty( $category_ids ) ) {

		$query = new WP_Query(
			array(
				'post_type'      => 'post',
				'post_status'    => 'publish',
				'posts_per_page' => 6,
				'cat'            => $category_ids[0],
			)
		);

		if ( $query->have_posts() ) {
			?>

			<h2><?php esc_html_e( 'Latest Stories by Category', 'base-theme' ); ?></h2>

			<ul class="wp-block-latest-posts__list wp-block-latest-posts">

				<?php

				$i = 0;

				while ( $query->have_posts() ) {

					$query->the_post();

					if ( $i >= 5 ) {
						break;
					}

					if ( $current_post_id === get_the_ID() ) {
						continue;
					}
					?>

						<li>
							<a class="wp-block-latest-posts__post-title" href="<?php echo get_the_permalink(); ?>">
								<?php the_title(); ?>
							</a>
						</li>

					<?php
					$i++;
				}
				?>

			</ul>

			<?php

			wp_reset_postdata();
		}
	}
}
