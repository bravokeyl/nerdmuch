<?php   

/* 
Plugin Name: About us
Description: About us widget 
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'about_widget' );

function about_widget() {register_widget( 'about_widget_sci1' );}

class about_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'about_sci1', // Widget ID
			__('About us', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'About us', 'text' =>'write something here...');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			/* Widget settings. */
			
			$title = apply_filters( 'widget_title', $instance['title'] );
			$text = $instance['text'];
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget one-part', $args['before_widget']);
			echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . esc_html($title) . $args['after_title'];
			?>

<div class="about-widget">
	<div class="about-logo">
		<a href="<?php echo esc_url(home_url('/')); ?>">
		<img src="<?php header_image(); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" alt="<?php bloginfo( 'name' ); ?>"/>
		</a>
	</div>
	<!--about-logo-->
	<?php if(get_option('sci1_instagram')||get_option('sci1_youtube')||get_option('sci1_google')||get_option('sci1_pinterest')||get_option('sci1_twitter')||get_option('sci1_facebook')) { ?>
	<div class="about-social">
		<ul>
			<?php if(get_option('sci1_facebook')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_facebook')); ?>" class="fb-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<?php if(get_option('sci1_twitter')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_twitter')); ?>" class="twitter-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<?php if(get_option('sci1_pinterest')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_pinterest')); ?>" class="pinterest-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<?php if(get_option('sci1_google')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_google')); ?>/posts" class="google-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<?php if(get_option('sci1_youtube')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_youtube')); ?>" class="youtube-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<?php if(get_option('sci1_instagram')) { ?>
			<li>
				<a href="<?php echo esc_url(get_option('sci1_instagram')); ?>" class="instagram-social-icon" target="_blank">
				</a>
			</li>
			<?php } ?>
			<li>
				<a href="<?php bloginfo('rss_url'); ?>" class="rss-social-icon">
				</a>
			</li>
		</ul>
	</div>
	<!--content-social-->
	<?php } ?>
	<div class="about-text">
		<?php echo wpautop(esc_html($text)); ?>
	</div>
	<!--about-text-->
</div>
<!--about-widget-->

<?php

			/* After widget. */

			echo $args['after_widget'];
		}
		
			/* Widget settings. */
			
		function update( $new_instance, $old_instance ) {
			$instance = $old_instance;
			
			/* Strip tags. */
			
			$instance['title'] = strip_tags( $new_instance['title'] );
			$instance['text'] = $new_instance['text'];
			
			return $instance;
		}
				
		function form( $instance ) {
			
			/* Default widget settings. */
			
			$defaults = array( 'title' =>'About us', 'text' =>'write something here...');
			$instance = wp_parse_args( (array) $instance, $defaults );
			$text = format_to_edit($instance['text']);
			 ?>

<!-- Widget Title-->

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
</p>
<!-- About text-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'text' )); ?>">
		<?php _e('About us text:', 'science-magazine'); ?>
	</label>
	<textarea class="widefat" rows="16" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>">
<?php echo esc_textarea($text); ?>
</textarea>
</p>
<?php }} ?>