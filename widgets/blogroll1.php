<?php   
/* 
Plugin Name: Blog Posts  1
Description: The blog posts widget displayed in blogroll. 
Version: 1.0 
Author: Stefan Naumovski 
*/    

add_action( 'widgets_init', 'blog_category_widget' );

function blog_category_widget() {register_widget( 'blog_category_sci1' );}

class blog_category_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'blog_category_sci1', // Widget ID
			__('Blogroll 1', 'science-magazine'), // Name
			array( 'description' =>'', ) // Args
			);}
		
		/* Front-end display of widget. */
		
		public function widget( $args, $instance ) {
			
		/* Default widget settings. */
			
			$defaults = array( 'title' => 'Blogroll1', 'number' => 4, 'offset' => 0, 'author' => '0', 'date' => '0', 'widget_size' => 'one-part', 'categories' => '0', 'excerptnumber'=>'30', 'cat_show' => 'on', 'navigation'=>'0', 'auto_load' => '0');
			$instance = wp_parse_args( (array) $instance, $defaults );
			
		/* Widget settings. */
		
			$title = $instance['title'];
			$categories = $instance['categories'];
			$number = $instance['number'];
			$offset = $instance['offset'];
			$excerptnumber = $instance['excerptnumber'];
			$author = $instance['author'];
			$date = $instance['date'];
			$widget_size = $instance['widget_size'];
			$cat_show = $instance['cat_show'];
			$navigation = $instance['navigation'];
			$auto_load = $instance['auto_load'];
			

			
			$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);			
			echo $args['before_widget'];
			if ( ! empty( $title ) ){
				echo $args['before_title'];		
					if($categories != 0){echo '<a href='.esc_url(get_category_link( $categories )).'>';}		
				echo esc_html($title); 			
					if($categories != 0){echo '</a>';}
				echo $args['after_title'];}
			?>

<div class="blog-category">
	<ul>
		<?php 
		
		if($navigation) {
			global $paged;
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }	
			$paged_offset = (($paged-1) * $number) + $offset;

			$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $paged_offset, 'paged'=>$paged ));
			}else{
			$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $offset));
			}
		 while ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
		<li <?php post_class((is_sticky()?'sticky':'')); ?>>		
			<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<?php if($cat_show) { ?>
			<div class="category-icon">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
			<!--featured-category-->
			<?php } ?>
			<div class="blog-post-title-box">
				<div class="blog-post-title">
					<h2>
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
						<?php the_title(); ?>
						</a>
					</h2>
				</div>
				<!--blog-post-title-->
			</div>
			<!--blog-post-title-box-->
			<?php if($author || $date ) { ?>
			<div class="blog-post-date-author">
				<?php if($author) { ?>
				<div class="blog-post-author">
					<?php the_author_posts_link(); ?>
				</div>
				<!--blog-post-author-->
				<?php } ?>
				<?php if($date) { ?>
				<div class="blog-post-date">
					<?php echo esc_html(get_the_date()); ?>
				</div>
				<!--blog-post-date-->
				<?php } ?>
			</div>
			<!--blog-post-date-author-->
			<?php } ?>
			<div class="blog-post-content">
				<?php echo nl2br(excerpt($excerptnumber)); ?>
			</div>
			<!--blog-post-content-->
		</li>
		<?php endwhile; ?>
	</ul>

	<?php if($navigation) { ?>
		<div class="pagination pagination-load-more <?php if($auto_load) {echo esc_attr('auto-load');} ?>">
			<?php 
			$loadmoreword = get_option('sci1_word_load_more');
			next_posts_link(esc_html($loadmoreword), $sci1_posts->max_num_pages);
			wp_reset_postdata();  ?>
		</div>
		<!--pagination-->
	<?php } ?>

</div>
<!--blog-category-->
<?php

	/* After widget. */
	
	echo $args['after_widget'];
	}


	/* Widget settings. */


	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
	/* Strip tags. */
		
		$instance['title'] = $new_instance['title'] ;
		$instance['number'] = $new_instance['number'];
		$instance['offset'] = $new_instance['offset'];
		$instance['excerptnumber'] = $new_instance['excerptnumber'];
		$instance['categories'] = $new_instance['categories'];
		$instance['author'] = $new_instance['author'];
		$instance['date'] = $new_instance['date'];
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['cat_show'] = $new_instance['cat_show'];
		$instance['navigation'] = $new_instance['navigation'];
		$instance['auto_load'] = $new_instance['auto_load'];

		
		return $instance;
	}
	
	
	function form( $instance ) {
		
				/* Default widget settings. */
			$defaults = array( 'title' => 'Blogroll1', 'number' => 4, 'offset' => 0, 'author' => '0', 'date' => '0', 'widget_size' => 'one-part', 'categories' => '0', 'excerptnumber'=>'30', 'cat_show' => 'on', 'navigation'=>'0', 'auto_load' => '0');
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

<!-- Number of posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>">
		<?php _e('Number of posts to show:', 'science-magazine'); ?>
	</label>
	<input type="number" min="1" id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" value="<?php echo esc_attr($instance['number']); ?>" size="3" />
</p>

<!-- Offset posts -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>">
		<?php _e('Forward Posts(offset):', 'science-magazine'); ?>
	</label>
	<input type="number" min="0" id="<?php echo esc_attr($this->get_field_id( 'offset' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'offset' )); ?>" value="<?php echo esc_attr($instance['offset']); ?>" size="3" />
</p>

<!-- Number of words -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'excerptnumber' )); ?>">
		<?php _e('Number of words(max: 120):', 'science-magazine'); ?>
	</label>
	<input type="number" min="0" id="<?php echo esc_attr($this->get_field_id( 'excerptnumber' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'excerptnumber' )); ?>" value="<?php echo esc_attr($instance['excerptnumber']); ?>" size="3" />
</p>

<!-- Author -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'author' )); ?>">
		<?php _e('Show Author:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'author' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author' )); ?>" <?php checked( (bool) $instance['author'], true ); ?> />
</p>

<!-- Date -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'date' )); ?>">
		<?php _e('Show Date:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'date' )); ?>" <?php checked( (bool) $instance['date'], true ); ?> />
</p>

<!-- category show -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'cat_show' )); ?>">
		<?php _e('Show category:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'cat_show' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'cat_show' )); ?>" <?php checked( (bool) $instance['cat_show'], true ); ?> />
</p>

<!-- navigation show -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'navigation' )); ?>">
		<?php _e('Show navigation(load more):', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'navigation' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'navigation' )); ?>" <?php checked( (bool) $instance['navigation'], true ); ?> />
</p>

<!-- auto_load -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'auto_load' )); ?>">
		<?php _e('Auto load more(loads more on scroll):', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'auto_load' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'auto_load' )); ?>" <?php checked( (bool) $instance['auto_load'], true ); ?> />
</p>


<?php }} ?>