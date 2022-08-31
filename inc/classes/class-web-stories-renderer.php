<?php
/**
 * Web Stories.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc;

use Google\Web_Stories\Interfaces\Renderer;
use Google\Web_Stories\Story_Query;

/**
 * Class Web_Stories_Renderer
 *
 * Custom Renderer implementation.
 */
class Web_Stories_Renderer implements Renderer {

	/**
	 * Current Story in the loop.
	 *
	 * @var array Story data.
	 */
	private $current_story = null;

	/**
	 * Story posts.
	 *
	 * @var array An array of story posts.
	 */
	protected $stories = [];

	/**
	 * Constructor
	 *
	 * @param Story_Query $query Story_Query instance.
	 */
	public function __construct( Story_Query $query ) {
		$this->stories = $query->get_stories();
	}

	/**
	 * Initialization actions.
	 */
	public function init(): void {
	}

	/**
	 * Return the stories' markup as string which needs to be echoed further.
	 *
	 * @param array $args Rendering args like height, width etc.
	 *
	 * @return string
	 */
	public function render( array $args = array() ): string {
		ob_start();

		?>
		<div class="web-stories">

			<div class="web-stories__inner-wrapper">

				<div class="web-stories-list">

					<?php

					if ( ! empty( $this->stories ) ) {

						foreach ( $this->stories as $story ) {

							$this->current_story = $story;

							$this->render_single_story_content();
						}
					}
					?>

				</div>

			</div>

		</div>
		<?php

		return ob_get_clean();
	}

	/**
	 * Render single story markup inside the method itself.
	 *
	 * @return void
	 */
	public function render_single_story_content(): void {

		?>

		<article id="post-<?php echo esc_attr( $this->current_story->ID ); ?>" class="web-story">

			<hr />

			<div class="grid-x grid-margin-x">

				<div class="cell small-12 medium-3">
					<?php echo wp_kses_post( get_the_post_thumbnail( $this->current_story->ID, 'full' ) ); ?>
				</div>

				<div class="cell small-12 medium-9">

					<header class="entry-header">

						<h2 class="entry-title" style="margin-top: 0;">
						<?php
						printf(
							'<a href="%1$s" rel="bookmark">%2$s</a>',
							esc_url( get_permalink( $this->current_story->ID ) ),
							esc_html( $this->current_story->post_title )
						);
						?>
						</h2>

					</header><!-- .entry-header -->

					<div class="entry-content clearfix">
						<?php echo esc_html( wp_strip_all_tags( $this->current_story->post_excerpt ) ); ?>
					</div><!-- .entry-content -->

				</div>

			</div>

		</article><!-- #post-## -->

		<?php
	}
}
