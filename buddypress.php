<?php get_header(); ?>

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div id="post-page-title">
			<h1>
				<?php the_title(); ?>
			</h1>
		</div>
		<!--post-page-title-->
		<?php  $sci1_subtitle = get_post_meta(get_the_ID(), 'sci1_sub_title', true); if(empty($sci1_subtitle)) {}  else { echo '<div id="post-page-subtitle">'.esc_html($sci1_subtitle).'</div><!--post-subtitle-->';}  ?>
		<div id="primary">
			<div class="post-page-content-wrapper">
				<div id="post-content" class="content page-content">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
				</div>
			<?php endwhile; endif; ?>
		</div>
	</div>
	<div id="secondary" class="widget-area <?php echo esc_html(get_option('sci1_last_widget_sticky'));?>">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Buddypress Sidebar')): endif; ?>
	</div>
	<!--secondary-->
</div>
<?php get_footer(); ?>