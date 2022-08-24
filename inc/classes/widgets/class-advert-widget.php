<?php
/**
 * Advert widget.
 *
 * @package Base-Theme
 */

namespace Base_Theme\Inc\Widgets;

use Base_Theme\Inc\Post_Types\Post_Type_Adverts;
use Base_Theme\Inc\Traits\Singleton;

/**
 * Advert widget class.
 */
class Advert_Widget extends \WP_Widget {

	use Singleton;

	/**
	 * Constructor.
	 */
	public function __construct() {

		/**
		 * constructor.
		 *
		 * @param string $id_base         Optional. Base ID for the widget, lowercase and unique. If left empty,
		 *                                a portion of the widget's PHP class name will be used. Has to be unique.
		 * @param string $name            Name for the widget displayed on the configuration page.
		 * @param array  $widget_options  Optional. Widget options. See wp_register_sidebar_widget() for
		 *                                information on accepted arguments. Default empty array.
		 */
		parent::__construct(
			'bt_advert_widget', // Base ID
			__( 'Advert Widget', 'base-theme' ), // Name
			array(
				'description' => __( 'An Advert Widget.', 'base-theme' ),
				'classname' => 'bt-advert'
			)
		);
	}

	/**
	 * Echoes the widget content.
	 *
	 * Subclasses should override this function to generate their widget code.
	 *
	 * @param array $args     Display arguments including 'before_title', 'after_title',
	 *                        'before_widget', and 'after_widget'.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	public function widget( $args, $instance ) {

		echo $args['before_widget'];

		if ( ! empty( $instance['ad'] ) ) {

			echo apply_filters( 'the_content', get_the_content( null, null, $instance['ad'] ) );
		}

		echo $args['after_widget'];
	}

	/**
	 * Outputs the settings update form.
	 *
	 * @since 2.8.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {

		$ad_id = '';

		if ( isset($instance['ad']) ) {
			$ad_id = $instance['ad'];
		}

		$query = new \WP_Query(
			[
				'post_type'      => Post_Type_Adverts::SLUG,
				'post_status'    => 'publish',
				'fields'         => 'ids',
				'posts_per_page' => -1,
			]
		);

		$select_options = [];

		if ( $query->have_posts() ) {

			foreach ( $query->posts as $post_id ) {

				$select_options[ $post_id ] = get_the_title( $post_id );
			}

			wp_reset_postdata();
		}

		if ( ! empty( $select_options ) ) {

			?>
			<p>
				<label for="<?php echo $this->get_field_id( 'ad' ); ?>"><?php esc_html_e( 'Select Ad', 'base-theme' ); ?></label>
				<select class="widefat" id="<?php echo $this->get_field_id( 'ad' ); ?>" name="<?php echo $this->get_field_name( 'ad' ); ?>">
					<?php foreach ( $select_options as $select_option_key => $select_option ) { ?>
						<option value="<?php echo esc_attr( $select_option_key ); ?>" <?php selected( $ad_id, $select_option_key ); ?>>
							<?php echo esc_html( $select_option ); ?>
						</option>
					<?php } ?>
				</select>
			</p>
			<?php
		}
	}

	/**
	 * Updates a particular instance of a widget.
	 *
	 * This function should check that `$new_instance` is set correctly. The newly-calculated
	 * value of `$instance` should be returned. If false is returned, the instance won't be
	 * saved/updated.
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            WP_Widget::form().
	 * @param array $old_instance Old settings for this instance.
	 *
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {

		$instance = array();

		$instance['ad'] = ( ! empty( $new_instance['ad'] ) ) ? $new_instance['ad'] : '';

		return $instance;
	}
}
