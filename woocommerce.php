<?php 
/**
 * Science Magazine page
**/ 
?>
<?php get_header(); ?>

<div id="main">
<div id="primary">
	<?php woocommerce_content(); ?>
</div>
<div id="secondary">
	<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Woocommerce Sidebar')): endif; ?>
</div>
<!--secondary-->

<div class="fullwidth">
	<div class="home-widget four-parts">
		<h3>
			<span class="widget-title">
			Top Rated Products
			</span>
		</h3>
		<div class="blog-category">
			<ul>
				<?php
			add_filter( 'posts_clauses',  array( WC()->query, 'order_by_rating_post_clauses' ) );
            $args = array( 'post_type' => 'product', 'stock' => 1, 'posts_per_page' => 4, 'order' => 'ASC' );
            $loop = new WP_Query( $args );
            while ( $loop->have_posts() ) : $loop->the_post(); global $product; ?>
				<li>
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
					<div class="blog-post-date-author">
						<div class="blog-post-author">
							<?php echo wp_kses_post($product->get_rating_html()); ?>
						</div>
						<!--blog-post-author-->
						<div class="blog-post-date">
							<?php echo esc_html(get_the_date()); ?>
						</div>
						<!--blog-post-date-->
					</div>
					<!--blog-post-date-author-->
					<div class="blog-post-content">
						<?php echo excerpt(50); ?>
					</div>
					<!--blog-post-content-->			
				</li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
</div>
<?php get_footer(); ?>