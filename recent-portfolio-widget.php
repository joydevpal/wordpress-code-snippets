<?php 
/**
 * Plugin Name: Recent Portfolio Widget
 * Plugin URI: http://joydevpal.com
 * Author: Joydev Pal
 * Author URI: http://joydevpal.com
 * Description: Customized Recent Portfolio Widget.
 * Version: 1.0.0
 * Text Domain: rpw
 */

class Recent_Portfolio_Widget extends WP_Widget {

	// initialize widget
	public function __construct() {
		parent::__construct( 'recent_portfolio_widget', __( 'Recent Portfolio', 'rpw' ), array( 'desciption' => __( 'Customized Recent portfolio widget', 'rpw' ) ) );
	}

	// widget front end
	public function widget( $args, $instance ) {
	    
        $title = apply_filters( 'widget_title', $instance['title'] );
        $items = apply_filters( 'portfolio_items', $instance['per_page'] );
        
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        echo '<ul class="recent-portfolio-widget">';
        
		$query = new WP_Query( array( 'post_type' => 'portfolio', 'posts_per_page' => $items ) );
		
		if( $query->have_posts() ) {
			while( $query->have_posts() ) {
				$query->the_post();

				$thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), array( '100', '100' ), true );
				$thumbnail_url = $thumbnail_url[0];
				if( !empty( $thumbnail_url ) ) {
					$thumb = $thumbnail_url;
				} else {
					$thumb = '';
				}
				echo '<li><a href="' . get_permalink() . '"><img src="'. $thumb .'" alt="" /></a></li> ';
			}
			wp_reset_postdata();
		}

		echo '</ul>';
		
		echo $args['after_widget'];
	}

	// widget form in admin
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html( 'Title', 'anblik' );
		$per_page = ! empty( $instance['per_page'] ) ? $instance['per_page'] : '9';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title', 'anblik' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'per_page' ) ); ?>">
				<?php esc_attr_e( 'No. of Items', 'anblik' ); ?>
			</label>
			<input type="number" min="1" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'per_page' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'per_page' ) ); ?>" value="<?php echo esc_attr( $per_page ); ?>">
		</p>
	<?php
	}

	// update widget form in admin
	public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['per_page'] = ( ! empty( $new_instance['per_page'] ) ) ? strip_tags( $new_instance['per_page'] ) : '';
		
		return $instance;
	}
}

// register recent portfolio widget
function register_recent_portfolio_widget() {
	register_widget( 'recent_portfolio_widget' );
}
add_action( 'widgets_init', 'register_recent_portfolio_widget' );