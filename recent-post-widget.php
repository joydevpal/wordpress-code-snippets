<?php 
/**
 * Plugin Name: Recent Post Widget
 * Plugin URI: http://joydevpal.com/plugins/recent-post-widget
 * Author: Joydev Pal
 * Author URI: http://joydevpal.com
 * Description: Customized Recent Post Widget for specific design requirements
 * Version: 1.0.0
 * Text Domain: rpw
 */

class Recent_Post_Widget extends WP_Widget {
	
	// Initialize widget
	public function __construct() {
		parent::__construct( 'recent_post_widget', __( 'Recent Posts', 'rpw' ), array( 'desciption' => __( 'Customized recent posts widget for specific design', 'rpw' ) ) );
	}

	// Widget view in the front end
	public function widget( $args, $instance ) {
	    
        $title = apply_filters( 'widget_title', $instance['title'] );
        echo $args['before_widget'];
        
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

		echo '<ul class="recent-blog-widget">';
		$recent_posts = wp_get_recent_posts( array( 'numberposts' => 3 ) );
		foreach( $recent_posts as $recent ){
			$thumbnail_url = wp_get_attachment_image_src( get_post_thumbnail_id( $recent['ID'] ), array( '100', '100' ), true );
    		$thumbnail_url = $thumbnail_url[0];
    		if( !empty( $thumbnail_url ) ) {
    			$thumb = $thumbnail_url;
    		} else {
    			$thumb = '';
    		}
			echo '<li><img src="'. $thumb .'" alt="" /><div class="post-info"><a href="' . get_permalink( $recent["ID"] ) . '">' . wp_trim_words( $recent["post_title"], 5, '...' ) .'</a><span>' . human_time_diff( strtotime( $recent['post_date'] ), current_time( 'timestamp' ) ) . ' ago</span></div></li> ';
		}
		wp_reset_query();
		echo '</ul>';
		
		echo $args['after_widget'];
	}

	// Widget form in the back end
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html( 'Title', 'rpw' );
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title', 'rpw' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}

	// Update widget data from backend
	public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        return $instance;

	}
}

// Register widget to the wordpress
function register_recent_post_widget() {
	register_widget( 'recent_post_widget' );
}
add_action( 'widgets_init', 'register_recent_post_widget' );