<?php 
/**
 * Science Magazine page
**/ 
?>
<?php get_header(); ?>

<div id="main">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="title-and-subtitle-wrap no-floating-icons">
				<div id="post-page-title">
					<h1>
						<?php the_title(); ?>
					</h1>
				</div>
				<!--post-page-title-->
				<?php  $sci1_subtitle = get_post_meta(get_the_ID(), 'sci1_sub_title', true); if(empty($sci1_subtitle)) {}  else { echo '<div id="post-page-subtitle">'.esc_html($sci1_subtitle).'</div><!--post-subtitle-->';} ?>
		</div>
		<!-- title-and-subtitle -->
	<div id="post-content" class="content fullwidth page-content no-floating-icons">
		<?php the_content(); ?>
		<?php wp_link_pages(); ?>
	</div>
	<?php if (comments_open()){ ?>
	<div class="comments">
		<?php comments_template(); ?>
	</div>
	<!--comments-->
	<?php } ?>
	<?php endwhile; endif; ?>
</div>
<?php get_footer(); ?>