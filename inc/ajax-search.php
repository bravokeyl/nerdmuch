<?php 
/**
 * Science Magazine stepfoxajaxsearch
**/ 
?>
<?php


function stepfox_search_scripts() {
	wp_enqueue_script( 'sf-autocomplete', get_template_directory_uri() . '/js/sf-autocomplete.js', array( 'jquery'));
	wp_localize_script( 'sf-autocomplete', 'stepfoxcomplete', array( 'stepfoxcompleteurl' => admin_url( 'admin-ajax.php' ) ) );

}
add_action( 'wp_enqueue_scripts', 'stepfox_search_scripts' );


add_action( 'wp_ajax_stepfox_search', 'stepfox_search' );
add_action( 'wp_ajax_nopriv_stepfox_search', 'stepfox_search' );


function stepfox_search_function() {
		$search_this = esc_textarea($_POST['search_this']);
		if(!empty($search_this)){
         global $wpdb;       
         $sci1_posts = $wpdb->get_results(
                "
                SELECT * FROM $wpdb->posts
                WHERE post_title LIKE '%$search_this%'
                AND post_title IS NOT NULL
                AND post_status = 'publish'
                AND post_type = 'post'
                ORDER BY (post_title LIKE '$search_this%') DESC, 
         		post_title ASC
                LIMIT 4; 
                "
         ); 
     if ( $sci1_posts ){global $post; foreach ( $sci1_posts as $post ){setup_postdata ( $post );?>
	<li class="widgetfx-7">
		<div class="featured-posts-image">
			<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallthumb'); ?>
			</a>
			<?php } ?>
		</div>
		<!---featured-posts-image-->
		<div class="featured-posts-text">
			<div class="featured-posts-title">
				<a href="<?php the_permalink(); ?>">
				<?php echo wp_trim_words( esc_html(get_the_title()), 10 ); ?>
				</a>
			</div>
			<!--featured-posts-title-->
		</div>
		<!--featured-posts-text-->
	</li>
	<?php }}}}
	
function stepfox_search(){
	ob_start ();
	stepfox_search_function();
	$response = ob_get_contents();
	ob_end_clean();
	echo wp_kses_post($response);
	die();
}
	?>