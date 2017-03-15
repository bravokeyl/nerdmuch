<?php   
/* 
Plugin Name: Video
Description: Video widget 
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'embed_widget' );

function embed_widget() {register_widget( 'embed_vid_sci1' );}

class embed_vid_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'embed_vid_widget_sci1', // Widget ID
			__('Video', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Video', 'widget_size' => 'one-part');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			$title = apply_filters( 'widget_title', $instance['title'] );
			$link_to_vid = $instance['link_to_vid'];
			$widget_size = $instance['widget_size'];
						
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);			
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . esc_html($title) . $args['after_title'];
			?>

<div class="embed-widget">
	<?php echo '<div class="embed-wrapper">' .wp_oembed_get($link_to_vid, array()). '</div>';?>
</div>
<!--embed-widget-->

<?php

			/* After widget. */

			echo $args['after_widget'];
		}
		
			/* Widget settings. */
			
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			/* Strip tags. */
			
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['link_to_vid'] = strip_tags( $new_instance['link_to_vid'] );
			$instance['widget_size'] = $new_instance['widget_size'];
			
			return $instance;
		}
				
		function form( $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Video', 'widget_size' => 'one-part');
			$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title-->

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
</p>

<!-- widget_size -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'widget_size' )); ?>">
		<?php _e('Widget size:', 'science-magazine'); ?>
	</label>
	<br>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="one-part" <?php checked('one-part', $instance['widget_size']); ?> class="one-part"/>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="two-parts" <?php checked('two-parts', $instance['widget_size']); ?> class="two-parts" />
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="three-parts" <?php checked('three-parts', $instance['widget_size']); ?> class="three-parts"/>
	<input type="radio" name="<?php echo esc_attr($this->get_field_name( 'widget_size' )); ?>" value="four-parts" <?php checked('four-parts', $instance['widget_size']); ?> class="four-parts"/>
</p>

<!-- Link to Video-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'link_to_vid' )); ?>">
		<?php _e('Link your video', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'link_to_vid' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link_to_vid' )); ?>" value="<?php if(isset($instance['link_to_vid'])){ echo esc_attr($instance['link_to_vid']);} ?>" style="width:90%;" />
</p>
<?php }} ?>