<?php
/* 
Plugin Name: Big Featured Images
Description:  One column image featured category
Version: 1.0 
Author: Stefan Naumovski 
*/    
add_action( 'widgets_init', 'img_feat_widget' );

function img_feat_widget() {register_widget( 'img_feat_cat_sci1' );}

class img_feat_cat_sci1 extends WP_Widget {
	
	/* Register widget with WordPress. */
	
	function __construct() {
		parent::__construct(
			'img_featured_category_sci1', // Widget ID
			__('Big Featured Images', 'science-magazine'),  //Name
			array( 'description' => '',) // Args
		);}
		
		/* Front-end display of widget. */
		
	public function widget( $args, $instance ) {
	
		/* Default widget settings. */

		$defaults = array('title' => 'Big Featured Images', 'number' => 2, 'review' => 0, 'widget_size' => 'one-part', 'offset' => 0, 'categories' => 0, 'author' => 'on', 'date' => 'on', 'cat_show' => 'on', 'display_text'=>'on', 'navigation'=> '0', 'auto_load' => '0');
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$title = $instance['title'];
		$categories = $instance['categories'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$review = $instance['review'];
		$widget_size = $instance['widget_size'];
		$author = $instance['author'];
		$date = $instance['date'];
		$cat_show = $instance['cat_show'];
		$display_text = $instance['display_text'];
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

<div class="img-featured-category big">
	<ul class="img-featured">
		<?php 
if($navigation) {
			global $paged;
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
				elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
				else { $paged = 1; }	
				$paged_offset = (($paged-1) * $number) + $offset;
								if($review) {$sci1_posts = new WP_Query(array(  'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array('post-format-aside'))),'posts_per_page' => $number, 'offset' => $paged_offset, 'paged'=>$paged  ));
							}else{$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $paged_offset, 'paged'=>$paged ));}	
			}else{
					if($review) {$sci1_posts = new WP_Query(array(  'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array('post-format-aside'))),'posts_per_page' => $number, 'offset' => $offset ));}
		else
		{$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $offset  ));}	
}

		while
			 ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
		<li <?php post_class((is_sticky()?'sticky':'')); ?>>
			<div class="img-featured-posts-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('mediumimagefeatured');if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>'; endif; ?>
				</a>
				<?php }else{ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/fallback/big.jpg"/>
				<?php if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>';endif;  ?>
				</a>
				<?php } ?>
			<?php if($review) { ?>
			<div class="img-featured-review-score">
				<?php echo esc_html(get_post_meta( get_the_ID(), 'sci1_review_total', true )); ?>
			</div>
			<!--review-score-->
			<?php } ?>
			<?php if($cat_show) { ?>
			<div class="img-featured-category-link">
				<?php $category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';} ?>
			</div>
			<!--featured-category-->
			<?php } ?>
			<div class="img-featured-title">
				<h2>
					<a href="<?php the_permalink(); ?>">
					<?php the_title(); ?>
					</a>
				</h2>
				<?php if($author || $date ) { ?>
				<div class="author-date">
					<?php if($author) { ?>
					<div class="author">
						<?php the_author_posts_link(); ?>
					</div>
					<!--author-->
					<?php } ?>
					<?php if($date) { ?>
					<div class="date">
						<?php echo esc_html(get_the_date()); ?>
					</div>
					<!--date-->
					<?php } ?>
				</div>
				<!--author-date-->
				<?php } 
				if($display_text) { ?>
				<div class="img-featured-text">
					<?php echo excerpt(14); ?>
				</div>
				<!--img-featured-text-->
				<?php } ?>
			</div>
			<!--img-featured-title-->
			</div>
			<!--img-featured-posts-image-->
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
<!--featured-category-->

<?php

		/* After widget. */

		echo $args['after_widget'];
	}
	
		/* Widget settings. */
		
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		
		/* Strip tags. */
		
		$instance['title'] = $new_instance['title'];
		$instance['number'] =$new_instance['number'];
		$instance['offset'] = $new_instance['offset'];
		$instance['categories'] = $new_instance['categories'];
		$instance['review'] = $new_instance['review'];
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['author'] = $new_instance['author'];
		$instance['date'] = $new_instance['date'];	
		$instance['cat_show'] = $new_instance['cat_show'];	
		$instance['display_text'] = $new_instance['display_text'];
		$instance['navigation'] = $new_instance['navigation'];
		$instance['auto_load'] = $new_instance['auto_load'];	

		return $instance;
	}

	function form( $instance ) {
		
		/* Default widget settings. */

		$defaults = array('title' => 'Big Featured Images', 'number' => 2, 'review' => 0, 'widget_size' => 'one-part', 'offset' => 0, 'categories' => 0, 'author' => 'on', 'date' => 'on', 'cat_show' => 'on', 'display_text'=>'on', 'navigation' => 0, 'auto_load' => '0');
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

<!-- review -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'review' )); ?>">
		<?php _e('Filter reviews:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'review' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'review' )); ?>" <?php checked( (bool) $instance['review'], true ); ?> />
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

<!-- text -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'display_text' )); ?>">
		<?php _e('Show content text:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'display_text' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'display_text' )); ?>" <?php checked( (bool) $instance['display_text'], true ); ?> />
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