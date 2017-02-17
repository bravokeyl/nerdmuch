<?php   
/* 
Plugin Name: Ajax tv widget
Description: Ajax tv widget latest news from video.
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'tv_widget_ajax_latest' );

function tv_widget_ajax_latest() {register_widget( 'tv_widget_ajax_sci1' );}

class tv_widget_ajax_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'tv_widget_ajax_sci1', // Widget ID
			__('TV-Ajax-Widget', 'science-magazine'), // Name
			array( 'description' =>'', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			/* Default widget settings. */
			$defaults = array( 'title' => 'New on Theme TV', 'widget_size' => 'one-part', 'number' => 6);
			$instance = wp_parse_args( (array) $instance, $defaults );
			
			
			$title = $instance['title'];
			$widget_size = $instance['widget_size'];
			$number = $instance['number'];
			
			global $widget_sizeglob;
			$widget_sizeglob = $widget_size;
			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);	
			echo $args['before_widget'];
			?>
	<?php if ( ! empty( $title ) )
				echo '<div class="widget-title"><a href="' . esc_url(get_post_format_link( 'video' )) . '">' . esc_html($title) . '</a></div>'; ?><div class="tv-featured">

	<ul class="tv-big">
		<?php $sci1_posts = new WP_Query(array( 'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-video' ))), 'posts_per_page' => 1, 'ignore_sticky_posts' => 1 )); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post();  ?>
		<li>
			<?php sci1_live_video_get();	?>
		</li>
		<?php endwhile; ?>
	</ul>
	<div class="tv-ajax-carousel">
	<ul class="slides">
		<?php $sci1_posts = new WP_Query(array( 'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array( 'post-format-video' ))), 'ignore_sticky_posts' => 1, 'offset' => 1, 'posts_per_page' => $number )); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
		<li>
			<div class="tv-ajax-carousel-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" data-number="<?php echo esc_js(get_the_ID());?>" data-widget-size="<?php echo esc_js($widget_size);?>">
				<?php the_post_thumbnail('smallimagefeatured');?>
				</a>
				<?php } ?>
			</div>
			<!---tv-ajax-carousel-image-->
				<div class="tv-ajax-carousel-title">
					<a href="<?php the_permalink(); ?>" data-number="<?php echo esc_js(get_the_ID());?>" data-widget-size="<?php echo esc_js($widget_size);?>">
					<?php echo wp_trim_words( esc_html(get_the_title()), 10 ); ?>
					</a>
				</div>
				<!--tv-ajax-carousel-title-->
		</li>
		<?php endwhile; ?>
	</ul>
	</div>
	<!--tv-ajax-carousel-->
</div>
<!--tv-featured-->

<?php

	/* After widget. */
	
	echo $args['after_widget'];
	}


	/* Widget settings. */


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
	/* Strip tags. */
		
		$instance['title'] = $new_instance['title'];
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['number'] = $new_instance['number'];	
		
		return $instance;
	}
	
	
	function form( $instance ) {
		
	/* Default widget settings. */
		
		$defaults = array( 'title' => 'New on Theme TV', 'widget_size' => 'one-part', 'number' => 6);
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

<!-- Maximum number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
		<?php _e('Number of posts to show:', 'science-magazine'); ?>
	</label>
	<input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>

<?php }}

function sci1_live_video_get(){
	global $widget_sizeglob;
	
	$widget_size = (isset($_POST['widget_size']));
	$the_id = (isset($_POST['the_id']));
	if ($widget_size == ''){$widget_size = $widget_sizeglob;}else{$widget_size = $_POST['widget_size'];}
	if ($the_id == ''){$the_id = get_the_ID();}else{$the_id = $_POST['the_id'];}?>	
		
			<div class="tv-widget-video">
				<div class="embed-wrapper">
				<?php echo wp_oembed_get(get_post_meta($the_id, 'sci1_video_link', true));?>
				</div>
			</div>
			<!---tv-widget-video-->
			<div class="featured-posts-text">
				<span class="category-icon">
				<?php $category = get_the_category($the_id); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
				</span>
				<div class="tv-widget-title">
					<a href="<?php the_permalink($the_id); ?>">
					<?php echo esc_html(get_the_title($the_id)); ?>
					</a>
				</div>
				<!--tv-widget-title-->
				<div class="tv-widget-content">
					<?php if( $widget_size == 'one-part'){$sci1_excerpt =	wp_trim_words( get_post_field('post_content', $the_id), 22);echo esc_html($sci1_excerpt);}elseif( $widget_size == 'two-parts'){$sci1_excerpt =	wp_trim_words(get_post_field('post_content', $the_id), 45);echo esc_html($sci1_excerpt);}elseif( $widget_size == 'three-parts'){$sci1_excerpt =	wp_trim_words( get_post_field('post_content', $the_id), 37);echo esc_html($sci1_excerpt);}elseif( $widget_size == 'four-parts'){$sci1_excerpt =	wp_trim_words( get_post_field('post_content', $the_id), 50);echo esc_html($sci1_excerpt);} ?>
				</div>
				<!--tv-widget-content-->
			</div>
			<!--featured-posts-text-->
<?php

 }
 
function sci1_live_video(){
	ob_start ();
	sci1_live_video_get();
	$response = ob_get_contents();
	ob_end_clean();
	echo $response;
	die();
}

add_action('wp_ajax_sci1_live_video', 'sci1_live_video');
add_action('wp_ajax_nopriv_sci1_live_video', 'sci1_live_video');

function sci1_live_video_scripts($hook) {
		wp_enqueue_script( 'live-video', get_template_directory_uri() . '/js/ajax-video-widget.js', array('jquery'));
		wp_localize_script( 'live-video', 'sci1_live_video_ajax', array( 'sci1_live_video_ajaxurl' => admin_url( 'admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'sci1_live_video_scripts'); ?>