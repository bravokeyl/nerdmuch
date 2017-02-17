<?php 
/**
 * Science Magazine Floater Share buttons
**/ 
?>
<?php

function floating_share_icons(){?>
<div class="floating-share-icons">
	<ul>
		<li>
			<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="blank" class="fb-social-float-icon" title="<?php _e('Share this post on Facebook', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
			</a>
		</li>
		<li>
			<a href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>" target="_blank"  class="twitter-social-float-icon" title="<?php _e('Share this post on Twitter', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
			</a>
		</li>
		<li>
			<a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank" class="google-social-float-icon" title="<?php _e('Share this post on Google Plus', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
			</a>
		</li>
		<li>
			<a href="http://pinterest.com/pin/create/button/?media=<?php $pinimg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID()), 'hugeimagefeatured' ); echo esc_url($pinimg[0]); ?>&amp;url=<?php the_permalink(); ?>&amp;is_video=false&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="pinterest-social-float-icon" title="<?php _e('Share this post on Pinterest', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
			</a>
		</li>
		<li>
			<a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="reddit-social-float-icon" title="<?php _e('Share this post on Reddit', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
			</a>
		</li>
	</ul>
</div>
<!-- floating-share-icons -->
<?php }


function menu_share_icons(){
	if(get_option('sci1_instagram')||get_option('sci1_youtube')||get_option('sci1_google')||get_option('sci1_pinterest')||get_option('sci1_twitter')||get_option('sci1_facebook')) { ?>		
		<div class="content-social">
			<ul>
				<?php if(get_option('sci1_facebook')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_facebook')); ?>" class="fb-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<?php if(get_option('sci1_twitter')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_twitter')); ?>" class="twitter-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<?php if(get_option('sci1_pinterest')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_pinterest')); ?>" class="pinterest-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<?php if(get_option('sci1_google')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_google')); ?>/posts" class="google-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<?php if(get_option('sci1_youtube')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_youtube')); ?>" class="youtube-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<?php if(get_option('sci1_instagram')) { ?>
				<li>
					<a href="<?php echo esc_url(get_option('sci1_instagram')); ?>" class="instagram-social-icon" target="_blank">
					</a>
				</li>
				<?php } ?>
				<li>
					<a href="<?php bloginfo('rss_url'); ?>" class="rss-social-icon">
					</a>
				</li>
			</ul>
		</div>
		<!--content-social-->
<?php }} 





function post_share_icons(){

				$sci1_share_post = get_option('sci1_share_post'); if ($sci1_share_post == "true") { ?>


				<div class="share-post">
					<div class="share-title">
						<?php echo esc_html(get_option('sci1_share_this_article')); ?>
					</div>
					<ul>
						<li>
							<a href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" target="blank" class="fb-share-icon" title="<?php _e('Share this post on Facebook', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
							</a>
						</li>
						<li>
							<a href="https://twitter.com/intent/tweet?original_referer=<?php the_permalink(); ?>&amp;text=<?php the_title(); ?>&amp;tw_p=tweetbutton&amp;url=<?php the_permalink(); ?>" target="_blank"  class="twitter-share-icon" title="Share this post on Twitter" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
							</a>
						</li>
						<li>
							<a href="https://plusone.google.com/_/+1/confirm?hl=en-US&amp;url=<?php the_permalink(); ?>" target="_blank" class="google-share-icon" title="<?php _e('Share this post on Google Plus', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
							</a>
						</li>
						<li>
							<a href="http://pinterest.com/pin/create/button/?media=<?php $pinimg = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'hugeimagefeatured' ); echo esc_url($pinimg[0]); ?>&amp;url=<?php the_permalink(); ?>&amp;is_video=false&amp;description=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="pinterest-share-icon" title="<?php _e('Share this post on Pinterest', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
							</a>
						</li>
						<li>
							<a href="http://www.reddit.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php echo urlencode(get_the_title()); ?>" target="_blank" class="reddit-share-icon" title="<?php _e('Share this post on Reddit', 'science-magazine'); ?>" onclick="window.open(this.href,'window','width=640,height=480,resizable,scrollbars,toolbar,menubar') ;return false;" >
							</a>
						</li>
					</ul>
				</div>
				<!--share-post-->
				<?php }
} ?>