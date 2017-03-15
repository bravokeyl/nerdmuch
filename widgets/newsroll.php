<?php
/*
Plugin Name: Newsroll
Description: Posts widget displayed in newsroll.
Version: 1.0
Author: Stefan Naumovski
*/
add_action ( 'widgets_init', 'sci1_newsroll_widget' );

function sci1_newsroll_widget() {register_widget ( 'sci1_newsroll_sci1' );}

class sci1_newsroll_sci1 extends WP_Widget {

	/* Register widget with WordPress. */

	function __construct() {
		parent::__construct (
		'sci1_newsroll_sci1',	//Widget ID
		__('Newsroll', 'science-magazine'),	// Name
		array( 'description' => '', ) // Args
	);}

		/* Front-end display of widget. */

	public function widget( $args, $instance ) {

		/* Default widget settings. */

		$defaults = array( 'title' => 'Newsroll', 'number' => 3, 'categories' => 0, 'offset' => 0, 'min_height' => 'one-part-height');
		$instance = wp_parse_args( (array) $instance, $defaults );


		$title = $instance['title'];
		$number = $instance['number'];
		$offset = $instance['offset'];
		$categories = $instance['categories'];
		$min_height = $instance['min_height'];



		$args['before_widget'] = str_replace('class="home-widget', 'class="home-widget one-part', $args['before_widget']);
		echo $args['before_widget'];?>
<div class="newsroll">
		<?php
		if ( ! empty( $title ) ){
				if($categories != 0){echo '<a href='.esc_url(get_category_link( $categories )).'>';}
				echo '<div class="newsroll-title">'.esc_html($title).'</div>';
				if($categories != 0){echo '</a>';}
			}
			?>

<ul <?php echo 'class="'.esc_html($min_height).'"'; ?>>
	<?php $sci1_posts = new WP_Query(array( 'cat' => $categories, 'posts_per_page' => $number, 'offset' => $offset )); while ( $sci1_posts->have_posts()) : $sci1_posts->the_post(); ?>
	<li <?php post_class((is_sticky()?'sticky':'')); ?>>
		<div class="newsroll-posts-text">
			<div class="newsroll-posts-title">
				<a href="<?php the_permalink(); ?>">
				<?php echo wp_trim_words( get_the_title(), 10 ); ?>
				</a>
				<span class="newsroll-date">
				<?php echo esc_html(get_the_date()); ?>
				</span>
			</div>
			<!--newsroll-posts-title-->
		</div>
		<!--newsroll-posts-text-->
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
		$instance['categories'] = $new_instance['categories'];
		$instance['min_height'] = $new_instance['min_height'];

		return $instance;
	}


	function form( $instance ) {

		/* Default widget settings. */

		$defaults = array( 'title' => 'Newsroll', 'number' => 3, 'categories' => 0, 'offset' => 0, 'min_height' => 'one-part-height');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

<!-- Widget Title-->
<p>
	<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
		<?php _e('Title:', 'science-magazine'); ?>
	</label>
	<input id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_textarea($instance['title']); ?>" style="width:90%;" />
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



<!-- Min-height -->
<p>
	<label for="<?php echo esc_attr($this->get_field_id('min_height')); ?>">
		<?php _e('(Optional)Widget minimum height:', 'science-magazine');?>
	</label>
	<select name="<?php echo esc_attr($this->get_field_name('min_height')); ?>" id="<?php echo esc_attr($this->get_field_id('min_height')); ?>" class="widefat" >
		<?php $options = array('one-part-height', 'two-parts-height');
		foreach ($options as $option) {?>
		<option value='<?php echo esc_attr($option); ?>' <?php if ($option == $instance['min_height']) echo 'selected="selected"'; ?>><?php echo esc_html($option); ?></option>
		<?php } ?>
	</select>
</p>

<?php }} ?>
