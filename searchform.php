<?php 
/**
 * Science Magazine search form
**/ 
?>
<?php 	$sci1_search_translate = get_option('sci1_search_translate'); ?>
<form method="get" id="searchform" action="<?php echo esc_url(home_url('/')); ?>">
		<input type="text" name="s" id="s" value="<?php echo esc_attr($sci1_search_translate); ?>" onfocus="if(this.value !== '') {this.value=''}" onblur="if(this.value == ''){this.value=''}" autocomplete="off" placeholder="<?php echo esc_attr($sci1_search_translate); ?>" />
		
	<button type="submit" class="submit-button">
		<span class="search-menu-icon">
		</span>
	</button>
	<ul class="featured-thumbnails"></ul>
</form>