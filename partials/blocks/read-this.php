<?php
/**
 * Read this block.
 *
 * @package Base-Theme
 */

$base_theme_featured_story = get_field( 'read_this_article' );

if ( ! empty( $base_theme_featured_story ) ) {
	?>

	<div class="read-this-article">

		<h3><?php esc_html_e( 'Also Read: ', 'base-theme' ); ?></h3>

		<a class="read-this-article-link"
			href="<?php echo esc_url( get_permalink( $base_theme_featured_story ) ); ?>"
			title="<?php echo esc_attr( get_the_title( $base_theme_featured_story ) ); ?>"
		>
			<h3><?php echo esc_html( get_the_title( $base_theme_featured_story ) ); ?></h3>
		</a>
	</div>

	<?php
}
