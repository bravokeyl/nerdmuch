<?php   

/* 
Plugin Name: Custom Title Widget
Description: Custom Title Widget
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'custom_title_widget' );

function custom_title_widget() {register_widget( 'custom_title_widget_sci1' );}

class custom_title_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'custom_title_widget_sizes_sci1', // Widget ID
			__('Title combination for blocks', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Title Widget', 'subtitle' =>'', 'widget_size' => 'one-part', 'link' => '', 'right_text' => '');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			/* Widget settings. */
			
			$title = $instance['title'];
			$widget_size = $instance['widget_size'];
			$subtitle = $instance['subtitle'];
			$right_text = $instance['right_text'];
			$link = $instance['link'];

			
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);	
			echo $args['before_widget'];
		if ( ! empty( $title ) || ! empty( $subtitle ) || ! empty( $right_text )){
			echo $args['before_title'];
			if ( ! empty( $title ) ){
				if (!empty($link)){echo '<a href="'.esc_url($link).'">';}
					echo '<div class="combination-title">'.esc_html($title).'</div>';
				if (!empty($link)){echo '</a>';}
			 }

			if ( ! empty( $subtitle ) ){
				echo '<div class="combination-title-subtitle">'.esc_html($subtitle).'</div>'; 
			 }

			if ( ! empty( $right_text ) ){
				if (!empty($link)){echo '<a href="'.esc_url($link).'">';}
					echo '<div class="combination-title-right-text">'.esc_html($right_text).'</div>';
				if (!empty($link)){echo '</a>';}
			 }
			echo $args['after_title'];
		}

			/* After widget. */

			echo $args['after_widget'];
		}
		
			/* Widget settings. */
			
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			/* Strip tags. */
			
			$instance['title'] = $new_instance['title'];
			$instance['subtitle'] = $new_instance['subtitle'];
			$instance['link'] = $new_instance['link'];
			$instance['right_text'] = $new_instance['right_text'];
			$instance['widget_size'] = $new_instance['widget_size'];
			
			return $instance;
		}
				
		function form( $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'Title Widget', 'subtitle' =>'', 'widget_size' => 'one-part', 'link' => '', 'right_text' => '');
			$instance = wp_parse_args( (array) $instance, $defaults );
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


<!-- subtitle-->

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>">
		<?php _e('Subtitle:(optional)', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" value="<?php echo esc_textarea($instance['subtitle']); ?>" style="width:100%;" />
</p>

<!--right_text-->

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'right_text' )); ?>">
		<?php _e('Right side text:(optional)', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'right_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'right_text' )); ?>" value="<?php echo esc_textarea($instance['right_text']); ?>" style="width:100%;" />
</p>

<!--link-->

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>">
		<?php _e('Link to:(optional, just paste your link.)', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" value="<?php echo esc_url($instance['link']); ?>" style="width:100%;" />
</p>


<?php }} ?>