<?php 
/* Science Magazine page template
 * Template Name: Alternative Homepage
 * Description :Alternative Homepage
 */
?>
<?php get_header(); ?>

<div id="main">
	<div id="fullwidth" class="widget-area">
		<?php $sidebarname = get_the_title();if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('page-'.esc_html($sidebarname))): endif; ?>
	</div>
</div>
<?php get_footer(); ?>