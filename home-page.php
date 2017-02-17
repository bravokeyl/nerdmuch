<?php 
/* Science Magazine page template
 * Template Name: Homepage
 * Description : Homepage
 */
?>
<?php get_header(); ?>
<div id="main" class="front-page">
	<div id="fullwidth" class="widget-area">
		<?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('Homepage')): endif; ?>
	</div>
	<!--fullwidth-->
</div>
<!--main-->
<?php get_footer(); ?>