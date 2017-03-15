<?php 
/**
 * Science Magazine Latest Posts Button
**/ 
?>
<?php 

function latests_posts_button(){?>
	<div class="latests-posts-button-number">	
		<?php		
		$duration = get_option('sci1_header_button_time');	
		if( $duration == 'week'){					
				$week = date('W');
				$header_counter_button = array('w' => $week, 'posts_per_page' => -1, 'post_type' => 'post');		
		} elseif ($duration == 'year'){
				$year = date('Y');
				$header_counter_button = array('year'     => $year, 'posts_per_page' => -1, 'post_type' => 'post');	
		} elseif($duration == 'month'){	
				$month = date('m');
				$header_counter_button = array('monthnum'     => $month, 'posts_per_page' => -1, 'post_type' => 'post');
		}elseif($duration == 'forever'){
				$header_counter_button = array( 'posts_per_page' => -1, 'post_type' => 'post');	
		}
		$the_query = new WP_Query( $header_counter_button );

		if($the_query->have_posts()){
			echo esc_html($the_query->post_count);
		}		
		?>
	</div>
	<div class="latests-posts-button-title">
		<?php echo esc_html(get_option('sci1_new_articles_menu_translate'));?>
	</div>

<?php }

function latests_posts_menu(){?>

<ul>
	<?php $sci1_args = array('posts_per_page' => 7, 'post_type' => 'post');
		$sci1_posts = new WP_Query($sci1_args); $date_latest_posts = '';
	while ( $sci1_posts->have_posts()) : $sci1_posts->the_post();?>
	<li>
		<div class="latest-posts-menu-text">		
				<?php 
			
				if(get_option('sci1_header_button_date_show') != 'false'){			
					$date_latest_posts1 = get_the_date();				
				if ($date_latest_posts != $date_latest_posts1) {
					$date_latest_posts = $date_latest_posts1; ?>
					<span class="latest-posts-menu-date">
						<?php echo esc_html($date_latest_posts);?>
					</span>
				<?php }	}?>
				<?php if(get_option('sci1_header_button_category_show') != 'false'){?>						
				<span class="category-icon">
				<?php	
				$category = get_the_category(); if($category[0]){echo '<a href="'.esc_url(get_category_link($category[0]->term_id )).'" title="'.esc_attr($category[0]->cat_name).'">'.esc_html($category[0]->cat_name).'</a>';}
				 ?>	
				</span>	
				<?php } ?>
				
			<div class="latest-posts-menu-title">
				<a href="<?php the_permalink(); ?>">
				<?php the_title(); ?>
				</a>
			</div>
			<!--latest-posts-menu-title-->
			<?php if(get_option('sci1_header_button_author_show') != 'false'){?>
			<div class="latest-posts-menu-author">
					<?php the_author_posts_link(); ?>
			</div>
			<!--latest-posts-menu-author-->
			<?php } ?>
		</div>
		<!--latest-posts-menu-text-->
	</li>
	<?php endwhile; ?>
	<li>
		<div class="latest-posts-menu-link category-icon">
		<a href="<?php echo esc_attr(get_permalink( get_option( 'page_for_posts' ) )); ?>">
			<?php echo esc_html(get_option('sci1_new_articles_menu_translate'));?>
		</a>
		</div>
	</li>
</ul>


<?php }
?>