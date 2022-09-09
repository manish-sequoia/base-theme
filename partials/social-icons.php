<?php
/**
 * Social Share Template.
 *
 * @package Base-Theme
 */

$article_id = get_the_ID();

if ( isset( $args['article_id'] ) && ! empty( $args['article_id'] ) ) {

	$article_id = $args['article_id'];

}

if ( empty( $article_id ) ) {
	return;
}

$article_link  = get_the_permalink( $article_id );
$article_title = get_the_title( $article_id );
print_r(rawurlencode($article_link));
$social_icons = array(
	array(
		'link'       => 'https://www.linkedin.com/shareArticle?mini=true&ro=false&url=' . rawurlencode( $article_link ) . '&title=' . rawurlencode( $article_title ),
		'link-title' => __( 'LinkedIn', 'base-theme' ),
		'link-class' => 'social-icon-bg social-linkedin-icon',
            'link-icons' => 'dashicons dashicons-linkedin',
	),
	array(
		'link'       => 'https://twitter.com/share?url=' . rawurlencode( $article_link ) . '&text=' . rawurlencode( $article_title ) . '&via=_base-theme',
		'link-title' => __( 'Tweet', 'base-theme' ),
		'link-class' => 'social-icon-bg social-twitter-icon',
            'link-icons' => 'dashicons dashicons-twitter',
	),
	array(
		'link'       => 'https://www.facebook.com/sharer.php?u=' . rawurlencode( $article_link ) . '&t=' . rawurlencode( $article_title ),
		'link-title' => __( 'Facebook', 'base-theme' ),
		'link-class' => 'social-icon-bg social-facebook-icon',
            'link-icons' => 'dashicons dashicons-facebook-alt',
	),
	array(
		'link'       => $article_link,
		'link-title' => __( 'Copy Link', 'base-theme' ),
		'link-class' => 'social-icon-bg social-link-icon base-theme-copy-link',
            'link-icons' => 'dashicons dashicons-admin-links',
	),
);

?>
<div class="social-media">
	<ul>
		<?php
		foreach ( $social_icons as $social_icon ) {
			printf(
				'<li><a class="%1$s" href="%2$s" title="%3$s" target="_blank" rel="nofollow"><span class="%4$s"></span></a></li>',
				esc_attr( $social_icon['link-class'] ),
				esc_url( $social_icon['link'] ),
				esc_attr( $social_icon['link-title'] ),
				esc_html( $social_icon['link-icons'] )
			);
		}
		?>
	</ul>
</div>
