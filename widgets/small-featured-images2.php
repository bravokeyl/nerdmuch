<?php

add_action( 'widgets_init', 'small_img_widgets2' );

function small_img_widgets2() {register_widget( 'small_img_cat_sci1s2' );}

class small_img_cat_sci1s2 extends WP_Widget {

	/* Register widget with WordPress. */

	function __construct() {
		parent::__construct(
			'small_img_category_sci1s2', // Widget ID
			__('Small featured images 2', 'science-magazine'), //Name
			array( 'description' => '', ) // Args
		);}

		/* Front-end display of widget. */

	public function widget( $args, $instance ) {
		/* Default widget settings. */

		$defaults = array( 'title' => 'Small featured images', 'number' => 4, 'review' => 0, 'widget_size' => 'one-part', 'categories' => 0, 'tags' => 0, 'author' => 'on', 'offset' => 0);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];
		$categories = $instance['categories'];
		$tags = $instance['tags'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$review = $instance['review'];
		$widget_size = $instance['widget_size'];
		$author = $instance['author'];

		$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget '. esc_attr($widget_size) , $args['before_widget']);
		echo $args['before_widget'];
		if ( ! empty( $title ) ){
			echo $args['before_title'];
				if($categories != 0){echo '<a href='.esc_url(get_category_link( $categories )).'>';}
			echo esc_html($title);
				if($categories != 0){echo '</a>';}
			echo $args['after_title'];}
			?>

<div id="small-wrapper">
	<ul class="small-category">
		<?php if($review) {
			$sci1_posts = new WP_Query(array(  'tax_query' => array(array('taxonomy' => 'post_format', 'field' => 'slug', 'terms' => array('post-format-aside'))),'posts_per_page' => $number, 'offset' => $offset ));}
		else
		{
			$bkargs = array(
				'post_type' => 'post',
				'posts_per_page' => $number,
				'offset' => $offset,
				'tax_query' => array(
					array(
						'taxonomy' => 'post_tag',
						'field'    => 'term_id',
						'terms'    => $tags,
					),
				),
			);
			$sci1_posts = new WP_Query( $bkargs );
			//$sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $offset ));
		}
		while
			 ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
		<li <?php post_class((is_sticky()?'sticky':'')); ?>>
			<div class="small-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>'; endif; ?>
				</a>
				<?php }else{ ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<img src="<?php echo esc_url(get_template_directory_uri()); ?>/images/fallback/small.jpg"/>
				<?php if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>';endif;  ?>
				</a>
				<?php } ?>
			</div>
			<!---small-image-->
			<div class="small-text">
				<?php if($review) { ?>
				<div class="small-review-score">
					<?php echo esc_html(get_post_meta( get_the_ID(), 'sci1_review_total', true )); ?>
				</div>
				<!--small-review-score-->
				<?php } ?>
				<div class="small-title">
					<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_title(); ?>
					</a>
				</div>
				<!--small-title-->
				<?php if($author) { ?>
				<div class="small-author">
					<?php echo esc_html(get_option('sci1_word_before_author')); ?>
					<?php the_author_posts_link(); ?>
				</div>
				<!--small-author-->
				<?php } ?>
			</div>
			<!--small-text-->
		</li>
		<?php endwhile; ?>
	</ul>
</div>
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
		$instance['offset'] = $new_instance['offset'];
		$instance['tags'] = $new_instance['tags'];
		$instance['review'] = $new_instance['review'];
		$instance['widget_size'] = $new_instance['widget_size'];
		$instance['author'] = $new_instance['author'];

		return $instance;
	}

	function form( $instance ) {

		/* Default widget settings. */

		$defaults = array( 'title' => 'Small featured images', 'number' => 4, 'review' => 0, 'widget_size' => 'one-part', 'categories' => 0, 'author' => 'on', 'offset' => 0);
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


<!-- Tag -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('tags')); ?>">
		<?php _e('(Optional)Select Tag:', 'science-magazine'); ?>
	</label>
	<select id="<?php echo esc_attr($this->get_field_id('tags')); ?>" name="<?php echo esc_attr($this->get_field_name('tags')); ?>" style="width:100%;">
		<option value='all' <?php if ('all' == (isset($instance['tags']))) echo 'selected="selected"'; ?>>
		<?php _e('All Tags', 'science-magazine'); ?>
		</option>
		<?php $tags = get_tags('hide_empty=0&type=post'); ?>
		<?php foreach($tags as $tag) { ?>
		<option value='<?php echo esc_attr($tag->term_id); ?>' <?php if(isset($instance['tags'])){ if ($tag->term_id == $instance['tags']) echo 'selected="selected"';}?>>
		<?php echo esc_html($tag->name); ?>
		</option>
		<?php } ?>
	</select>
</p>

<!-- Author -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'author' )); ?>">
		<?php _e('Show Author:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'author' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'author' )); ?>" <?php checked( (bool) $instance['author'], true ); ?> />
</p>

<!-- review -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'review' )); ?>">
		<?php _e('Filter reviews:', 'science-magazine'); ?>
	</label>
	<input type="checkbox" id="<?php echo esc_attr($this->get_field_id( 'review' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'review' )); ?>" <?php checked( (bool) $instance['review'], true ); ?> />
</p>
<?php }} ?>
