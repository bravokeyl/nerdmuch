<?php 
/**
 * Science Magazine archive styles
**/ 
?>
<?php 
function category_post_style1($author_show, $date_show){
?>
<div class="blog-post-image">
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	<?php the_post_thumbnail('smallimagefeatured'); ?>
	</a>
	<?php } ?>
</div>
<!--blog-post-image-->
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
<?php if($author_show == 'true' || $date_show == 'true' ) { ?>
<div class="blog-post-date-author">
	<?php if($author_show == 'true') { ?>
	<div class="blog-post-author">
		<?php the_author_posts_link(); ?>
	</div>
	<!--blog-post-author-->
	<?php } ?>
	<?php if($date_show == 'true') { ?>
	<div class="blog-post-date">
		<?php echo esc_html(get_the_date()); ?>
	</div>
	<!--blog-post-date-->
	<?php } ?>
</div>
<!--blog-post-date-author-->
<?php } ?>
<div class="blog-post-content">
	<?php echo excerpt(50); ?>
</div>
<!--blog-post-content-->							
<?php }
		
function category_post_style2($author_show, $date_show){?>


		<div class="blog-post-image">
				<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail('smallimagefeatured'); ?>
				</a>
				<?php } ?>
			</div>
			<!--blog-post-image-->
			<div class="blogwrap">
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
				<?php if($author_show || $date_show ) { ?>
				<div class="blog-post-date-author">
					<?php if($author_show) { ?>
					<div class="blog-post-author">
						<?php the_author_posts_link(); ?>
					</div>
					<!--blog-post-author-->
					<?php } ?>
					<?php if($date_show) { ?>
					<div class="blog-post-date">
						<?php echo esc_html(get_the_date()); ?>
					</div>
					<!--blog-post-date-->
					<?php } ?>
				</div>
				<!--blog-post-date-author-->
				<?php } ?>
				<div class="blog-post-content">
					<?php echo nl2br(excerpt(50)); ?>
				</div>
				<!--blog-post-content-->
			</div>
			<!-- blogwrap -->






<?php }
function category_post_style3($author_show, $date_show){?>			
		
<div class="img-featured-posts-image">
	<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
	<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
	<?php the_post_thumbnail('mediumimagefeatured');if ( 'video' == get_post_format() ): echo '<span class="play-icon"></span>'; endif; ?>
	</a>
	<?php } ?>
<div class="img-featured-title big">
	<h2>
		<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
		<?php the_title(); ?>
		</a>
	</h2>
	<?php if($author_show == 'true' || $date_show == 'true' ) { ?>
	<div class="author-date">
		<?php if($author_show == 'true') { ?>
		<div class="author">
			<?php the_author_posts_link(); ?>
		</div>
		<!--author-->
		<?php } ?>
		<?php if($date_show == 'true') { ?>
		<div class="date">
			<?php echo esc_html(get_the_date()); ?>
		</div>
		<!--date-->
		<?php } ?>
	</div>
	<!--author-date-->
	<?php } ?>
</div>
<!--img-featured-title-->
</div>
<!--img-featured-posts-image-->
<?php }?>