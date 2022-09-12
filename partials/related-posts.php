<?php
/**
 * Featured block.
 *
 * @package Base-Theme
 */

$base_theme_related_posts = base_theme_get_related_posts();

if ( ! empty( $base_theme_related_posts ) ) {
	?>

	<div class="grid-x grid-margin-x">

		<div class="cell small-12">
			<h2><?php esc_html_e( 'Related Articles', 'base-theme' ); ?></h2>
		</div>

		<?php

		$related_post_count = 0;

		foreach ( $base_theme_related_posts as $base_theme_related_post ) {

			if ( $base_theme_related_post->ID === get_the_ID() ) {
				continue;
			}
			?>

			<div class="cell small-12 medium-4">

				<?php
				echo get_the_post_thumbnail( $base_theme_related_post, 'full' );

				printf(
					'<h4><a href="%1$s">%2$s</a></h4>',
					esc_url( get_permalink( $base_theme_related_post ) ),
					esc_html( $base_theme_related_post->post_title )
				);
				?>

			</div>

			<?php

			$related_post_count++;

			if ( $related_post_count >= 3 ) {
				break;
			}
		}
		?>

	</div>
	<?php
}
