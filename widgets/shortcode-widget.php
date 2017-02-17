<?php   

/* 
Plugin Name: Shortcode widget
Description: Shortcode widget with different sizes
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'shortcode_widget' );

function shortcode_widget() {register_widget( 'shortcode_widget_sci1' );}

class shortcode_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'shortcode_widget_sizes_sci1', // Widget ID
			__('Shortcode Widget or Row Holder', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Shortcode Widget', 'text' =>'', 'widget_size' => 'one-part', 'vertical_margin' => 0);
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			/* Widget settings. */
			
			$title = $instance['title'];
			$widget_size = $instance['widget_size'];
			$text = do_shortcode(apply_filters( 'shortcode_widget_sci1', empty( $instance['text'] ) ? '' : $instance['text'], $instance ));
			$vertical_margin = $instance['vertical_margin'];

			
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);	
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . esc_html($title) . $args['after_title'];
			?>

<div class="shortcode-widget-box" style="margin-top:<?php echo esc_attr($vertical_margin);?>">
	<?php echo wp_kses_post($text);?>
</div>	
<!--shortcode-widget-box-->

<?php

			/* After widget. */

			echo $args['after_widget'];
		}
		
			/* Widget settings. */
			
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			/* Strip tags. */
			
			$instance['title'] = $new_instance['title'];
			$instance['text'] = $new_instance['text'];
			$instance['widget_size'] = $new_instance['widget_size'];
			$instance['vertical_margin'] = $new_instance['vertical_margin'];
			
			return $instance;
		}
				
		function form( $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Shortcode widget', 'text' =>'', 'widget_size' => 'one-part', 'vertical_margin' => 0);
			$instance = wp_parse_args( (array) $instance, $defaults );
			$text = $instance['text'];
			 ?>

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
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'vertical_margin' )); ?>">
		<?php _e('Vertical margin:(optional if you want to push eg.10px)', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'vertical_margin' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'vertical_margin' )); ?>" value="<?php echo esc_textarea($instance['vertical_margin']); ?>" style="width:90%;" />
</p>
<!-- Shortcode-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>">
		<?php _e('Add your shortcode here:', 'science-magazine');?>
	</label>
	<textarea class="widefat" rows="6" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>">
<?php echo esc_textarea($text); ?>
</textarea>
</p>

<?php }} ?>