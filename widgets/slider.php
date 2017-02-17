<?php
/* 
Plugin Name: Slider 
Description: Slider by selecting categories.
Version: 1.0 
Author: Stefan Naumovski 
*/    
add_action( 'widgets_init', 'slider_widget' );

function slider_widget() {register_widget( 'slider_sci1' );}

class slider_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */

	function __construct() {
		parent::__construct(
				'slider_widget_sci1', 	//Widget ID
				__('Slider', 'science-magazine'), // Name
				array( 'description' => '', ) // Args
		);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
			$defaults = array( 'title' => 'Image Slider', 'number' => 3, 'slider_control' => 'on', 'widget_size' => 'one-part', 'categories' => 0, 'subtitle'=>'on');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			
			$title = $instance['title'];
			$number = $instance['number'];
			$categories = $instance['categories'];
			$slider_control = $instance['slider_control'];		
			$widget_size = $instance['widget_size'];
			$subtitle = $instance['subtitle'];
			
		
		$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);		
			echo $args['before_widget'];
			if ( ! empty( $title ) ){
				echo $args['before_title'];		
					if($categories != 0){echo '<a href='.esc_url(get_category_link( $categories )).'>';}		
				echo esc_html($title); 			
					if($categories != 0){echo '</a>';}
				echo $args['after_title'];}
			?>

<div class="slider-container">
	<div class="wide-slider <?php echo esc_attr(get_option('sci1_slider_picker'));?>">
		<ul class="slides">
			<?php if($slider_control == 'on'){$number = '5';}
			$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number)); while($sci1_posts->have_posts()) : $sci1_posts->the_post();?>
			<li <?php post_class((is_sticky()?'sticky':'')); ?>>
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php if( $widget_size == 'one-part' ) {the_post_thumbnail('mediumimagefeatured');} elseif( $widget_size == 'two-parts' ){the_post_thumbnail('hugeimagefeatured');} elseif ( $widget_size == 'three-parts' ){the_post_thumbnail('slider-three');}elseif ( $widget_size == 'four-parts' ){the_post_thumbnail('slider-four');} ?>
				</a>
				<?php } ?>
				<div class="slider-text-box">
					<div class="slide-date">
						<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
					</div>
					<!--slide-date-->
					<div class="slide-title">
						<h2>
							<a href="<?php the_permalink(); ?>">
							<?php the_title(); ?>
							</a>
						</h2>
					</div>
					<!--slide-title-->
					<?php if($subtitle) { ?>
					<div class="slide-excerpt-wrap">
						<div class="slide-excerpt">
							<?php  $sci1_subtitle = get_post_meta(get_the_ID(), 'sci1_sub_title', true); if(empty($sci1_subtitle)) { echo excerpt(22); }  else { echo esc_html($sci1_subtitle);}  ?>
						</div>
					</div>
					<?php } ?>
				</div>
				<!--slider-text-box-->
			</li>
			<?php endwhile; ?>
		</ul>
	</div>
	<!--flexslider-->
</div>
<!--slider-container-->
<?php if($slider_control == 'on'){ ?>
<div class="wide-slider-control">
	<ul>
		<?php $sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => '5')); while($sci1_posts->have_posts()) : $sci1_posts->the_post();?>
		<li <?php post_class((is_sticky()?'sticky':'')); ?>>
			<div class="wide-slider-thumb">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="#" title="<?php the_title(); ?>">
				<?php if( $widget_size == 'one-part' ) {the_post_thumbnail('mediumimagefeatured');} elseif( $widget_size == 'two-parts' ){the_post_thumbnail('hugeimagefeatured');} elseif ( $widget_size == 'three-parts' ){the_post_thumbnail('slider-three');}elseif ( $widget_size == 'four-parts' ){the_post_thumbnail('slider-four');} ?>
				</a>
				<?php } ?>
			</div>
			<!---wide-slider-thumb-->
		</li>
		<?php endwhile; ?>
	</ul>
</div>
<!--wide-slider-control-->
<?php } ?>
<?php	
	/* After widget. */	
				
		echo $args['after_widget'];
	}
	
	/* Widget settings. */
	
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;	
		
		/* Strip tags. */
					
		$instance['title'] = $new_instance['title'];
		$instance['number'] = $new_instance['number'];
		$instance['categories'] = $new_instance['categories'];
		$instance['slider_control'] = $new_instance['slider_control'];	
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['subtitle'] = $new_instance['subtitle'];	
		return $instance;
	}		
	
		/* Default widget settings. */
		
	function form( $instance ) {	
		$defaults = array( 'title' => 'Image Slider', 'number' => 3, 'slider_control' => 'on', 'widget_size' => 'one-part', 'categories' => 0, 'subtitle'=>'on');
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

<!-- Number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
		<?php _e('Number of slides:', 'science-magazine'); ?>
	</label>
	<input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>

<!-- Category -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('categories')); ?>">
		<?php _e('(Optional)Select Category:', 'science-magazine'); ?>
	</label>
	<select id="<?php echo esc_attr($this->get_field_id('categories')); ?>" name="<?php echo esc_attr($this->get_field_name('categories')); ?>" style="width:100%;">
		<option value='all' <?php if ('all' == (isset($instance['categories']))) echo 'selected="selected"'; ?>>
		<?php _e('All Categories', 'science-magazine'); ?>
		</option>
		<?php $categories = get_categories('hide_empty=0&depth=1&type=post'); ?>
		<?php foreach($categories as $category) { ?>
		<option value='<?php echo esc_attr($category->term_id); ?>' <?php if(isset($instance['categories'])){ if ($category->term_id == $instance['categories']) echo 'selected="selected"';}?>>
		<?php echo esc_html($category->cat_name); ?>
		</option>
		<?php } ?>
	</select>
</p>

<!--slider_control-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'slider_control' )); ?>">
		<?php _e('Show control thumbs:', 'science-magazine');?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'slider_control' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'slider_control' )); ?>" <?php checked( (bool) $instance['slider_control'], true ); ?> />
</p>

<!--Subtitle-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>">
		<?php _e('Show Subtitle:', 'science-magazine');?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'subtitle' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'subtitle' )); ?>" <?php checked( (bool) $instance['subtitle'], true ); ?> />
</p>

<?php }} ?>