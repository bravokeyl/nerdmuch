<?php 
/**
 * Science Magazine footer
**/ 
?>
</section>
<!--wrapper-->
<footer id="footer">
	<div class="footer-wrap">
				<?php if(get_option('sci1_instagram')||get_option('sci1_youtube')||get_option('sci1_google')||get_option('sci1_pinterest')||get_option('sci1_twitter')||get_option('sci1_facebook')) { ?>		
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
		<?php } ?>		
		<nav id="bottom-menu">
			<?php if ( has_nav_menu( 'bottom-menu' ) ) {wp_nav_menu(array('theme_location' => 'bottom-menu', 'depth' => 1));} else { echo '<span class="add-menu">ADD MENU</span>';}?>
		</nav>
		<!--bottom-menu-->	
	</div>
	<!--footer-wrap-->
	<div class="copyright">
		<div class="copyright-text">
			<?php echo esc_html(get_option('sci1_copyright')); ?>
		</div>
		<!--copyright-text-->
	</div>
	<!--copyright-->
</footer>
<!--footer-->
<?php wp_footer(); ?>
<script type="text/javascript">ggv2id='a47ff7de';</script>
<script type="text/javascript" src="//g2.gumgum.com/javascripts/ggv2.js"></script>
</body></html>