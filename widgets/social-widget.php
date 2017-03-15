<?php   

/* 
Plugin Name: About us
Description: About us widget 
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'social_widget' );

function social_widget() {register_widget( 'social_widget_sci1' );}

class social_widget_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'social_sci1', // Widget ID
			__('Social Widget', 'science-magazine'), // Name
			array( 'description' => '', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public 	function widget($args, $instance){
			
		$defaults = array('title' => 'Social Widget', 
			'widget_style' => 'horizontal-social', 
			'facebook_page_url' => '', 
			'facebook_text' => 'Facebook',
 			'twitter_id' => '', 
			'twitter_text' => 'Twitter', 
			'gplus_id' => '', 
			'gplus_text' => 'Google',
			'yt_id' => '',  
			'yt_text' => 'Youtube', 
			'instagram_id' => '', 
			'instagram_text' => 'Instagram',
			'pinterest' => '', 
			'pinterest_text' =>'Pinterest');

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title		= $instance['title'];
		$widget_style	= $instance['widget_style'];

		$facebook 	= $instance['facebook_page_url'];
		$facebook_text 	= $instance['facebook_text'];	

		$twitter_id 			= $instance['twitter_id'];		
		$twitter_text 	= $instance['twitter_text'];

		$gplus 		= $instance['gplus_id'];
		$gplus_text 	= $instance['gplus_text'];

		$yt 		= $instance['yt_id'];
		$yt_text 		= $instance['yt_text'];

		$instagram_id 		= $instance['instagram_id'];
		$instagram_text 	= $instance['instagram_text'];	

		$pinterest 			= $instance['pinterest'];
		$pinterest_text 	= $instance['pinterest_text'];	
		
		
		$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget one-part' , $args['before_widget']);			
		echo $args['before_widget'];
			if ( ! empty( $title ) )
				echo $args['before_title'] . esc_html($title) . $args['after_title'];
		
		
		
		?>        
		<div class="social-widget <?php echo esc_attr($widget_style);?>">
			<ul>   
				<?php if(!empty($facebook)){ ?>               
					<li>
						<a href="<?php echo esc_url($facebook); ?>" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon fb-widget-icon">
								<span class="fb-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->
						<div class="social-widget-text">						
						<?php echo esc_html($facebook_text); ?>
						</div>
						<!--social-widget-text-->						
						</a>	
					</li>
				<?php } ?>
				<?php if(!empty($twitter_id)){ ?>
					<li>
						<a href="<?php echo esc_url($twitter_id); ?>" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon twitter-widget-icon">
								<span class="twitter-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->
						<div class="social-widget-text">
						<?php echo esc_html($twitter_text); ?>
						</div>
						<!--social-widget-text-->						
						</a>
					</li>
				<?php } ?>
				<?php if(!empty($gplus)){?> 
					<li>
						<a href="<?php echo esc_url($gplus); ?>/posts" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon google-widget-icon">
								<span class="google-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->		
						<div class="social-widget-text">
						<?php echo esc_html($gplus_text); ?>
						</div>
						<!--social-widget-text-->						
						</a>
					</li>
				<?php } ?>
				<?php if(!empty($yt)){?> 
					<li>
						<a href="<?php echo esc_url($yt); ?>" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon youtube-widget-icon">
								<span class="youtube-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->	
						<div class="social-widget-text">
						<?php echo esc_html($yt_text); ?>
						</div>
						<!--social-widget-text-->						
						</a>
					</li>
				<?php } ?>
				<?php if(!empty($instagram_id)){?> 
					<li>
						<a href="<?php echo esc_url($instagram_id); ?>" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon instagram-widget-icon">
								<span class="instagram-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->	
						<div class="social-widget-text">
						<?php echo esc_html($instagram_text); ?>
						</div>
						<!--social-widget-text-->						
						</a>
					</li>
				<?php } ?>
				<?php if(!empty($pinterest)){?> 
					<li>
						<a href="<?php echo esc_url($pinterest); ?>" target="_blank">
						<div class="social-icon-box">
							<div class="social-widget-icon pinterest-widget-icon">
								<span class="pinterest-social-icon"></span>
							</div>
							<!--social-widget-icon-->
						</div>
						<!--social-icon-box-->	
						<div class="social-widget-text">
							<?php echo esc_html($pinterest_text); ?>
						</div>
						<!--social-widget-text-->
						</a>
					</li>
				<?php } ?>
			</ul>
		</div>
<?php

		/* After widget. */

		echo $args['after_widget'];
	}
	
	function update($new_instance, $old_instance){
		$instance 						= $old_instance;
		$instance['title'] 				= $new_instance['title'];
		$instance['widget_style'] 				= $new_instance['widget_style'];
		
		$instance['facebook_page_url'] 	= $new_instance['facebook_page_url'];
		$instance['facebook_text'] 		= $new_instance['facebook_text'];

		$instance['twitter_id'] 		= $new_instance['twitter_id'];
		$instance['twitter_text'] 		= $new_instance['twitter_text'];

		$instance['gplus_id'] 			= $new_instance['gplus_id'];
		$instance['gplus_text'] 		= $new_instance['gplus_text'];

		$instance['yt_id'] 				= $new_instance['yt_id'];
		$instance['yt_text'] 			= $new_instance['yt_text'];
			
		$instance['instagram_id'] 		=	$new_instance['instagram_id'];
		$instance['instagram_text']		=	$new_instance['instagram_text'];
		
		$instance['pinterest'] 		=	$new_instance['pinterest'];
		$instance['pinterest_text']		=	$new_instance['pinterest_text'];
		
		return $instance;
		}
	
	
	/**
	* Creates the edit form for the widget.
	*
	*/
	function form($instance){

$defaults = array('title' => 'Social Widget', 
			'widget_style' => 'horizontal-social', 
			'facebook_page_url' => '', 
			'facebook_text' => 'Facebook',
 			'twitter_id' => '', 
			'twitter_text' => 'Twitter', 
			'gplus_id' => '', 
			'gplus_text' => 'Google',
			'yt_id' => '',  
			'yt_text' => 'Youtube', 
			'instagram_id' => '', 
			'instagram_text' => 'Instagram',
			'pinterest' => '', 
			'pinterest_text' =>'Pinterest');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:100%;" />
</p>
<!-- style -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('widget_style')); ?>">
	<?php _e('Widget style:', 'science-magazine'); ?>
	</label>
	<select name="<?php echo esc_attr($this->get_field_name('widget_style')); ?>" id="<?php echo esc_attr($this->get_field_id('widget_style')); ?>" class="widefat" >
		<?php $options = array('vertical-social', 'horizontal-social');
		foreach ($options as $option) {?>
		<option value='<?php echo esc_attr($option); ?>' <?php if ($option == $instance['widget_style']) echo 'selected="selected"'; ?>><?php echo esc_html($option); ?></option>
		<?php } ?>
	</select>
</p>
<p>
<h3><?php _e('Facebook', 'science-magazine'); ?></h3>
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'facebook_text' )); ?>">
		<?php _e('Facebook Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'facebook_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_text' )); ?>" value="<?php echo esc_textarea($instance['facebook_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'facebook_page_url' )); ?>">
		<?php _e('Facebook page url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'facebook_page_url' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook_page_url' )); ?>" value="<?php echo esc_url($instance['facebook_page_url']); ?>" style="width:100%;" />

</p>	

<p>
<h3><?php _e('Twitter', 'science-magazine'); ?></h3>
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'twitter_text' )); ?>">
		<?php _e('Twitter Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'twitter_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_text' )); ?>" value="<?php echo esc_textarea($instance['twitter_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'twitter_id' )); ?>">
		<?php _e('Twitter page url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'twitter_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter_id' )); ?>" value="<?php echo esc_url($instance['twitter_id']); ?>" style="width:100%;" />
</p>	

<p>
<h3><?php _e('Google plus', 'science-magazine'); ?></h3>
</p>	
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'gplus_text' )); ?>">
		<?php _e('Google Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'gplus_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gplus_text' )); ?>" value="<?php echo esc_textarea($instance['gplus_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'gplus_id' )); ?>">
		<?php _e('Google page url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'gplus_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'gplus_id' )); ?>" value="<?php echo esc_url($instance['gplus_id']); ?>" style="width:100%;" />
</p>

<p>
<h3><?php _e('Youtube', 'science-magazine'); ?></h3>
</p>			
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'yt_text' )); ?>">
		<?php _e('Youtube Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'yt_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'yt_text' )); ?>" value="<?php echo esc_textarea($instance['yt_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'yt_id' )); ?>">
		<?php _e('Youtube page url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'yt_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'yt_id' )); ?>" value="<?php echo esc_url($instance['yt_id']); ?>" style="width:100%;" />
</p>

<p>
<h3><?php _e('Instagram', 'science-magazine'); ?></h3>
</p>			
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'instagram_text' )); ?>">
		<?php _e('Instagram Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'instagram_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram_text' )); ?>" value="<?php echo esc_textarea($instance['instagram_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'instagram_id' )); ?>">
		<?php _e('Instagram url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'instagram_id' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram_id' )); ?>" value="<?php echo esc_url($instance['instagram_id']); ?>" style="width:100%;" />
</p>

<p>
<h3><?php _e('Pinterest', 'science-magazine'); ?></h3>
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'pinterest_text' )); ?>">
		<?php _e('Pinterest Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'pinterest_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest_text' )); ?>" value="<?php echo esc_textarea($instance['pinterest_text']); ?>" style="width:100%;" />
</p>
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>">
		<?php _e('Pinterest page url:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" value="<?php echo esc_url($instance['pinterest']); ?>" style="width:100%;" />
</p>
	
<?php }} ?>