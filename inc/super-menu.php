<?php
/**
 * Science Magazine super menu
**/
?>
<?php
class sci1_super_menu extends Walker_Nav_Menu {

	function start_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "\n<ul class=\"menu-links inside-menu\">\n";
	}

	function end_lvl(&$output, $depth = 0, $args = array()) {
		$output .= "</ul>\n";
	}

	function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		global $wp_query;
		$cat = $item->object_id;
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		$class_names = $value = '';
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item ) );
		$class_names = ' class="' . esc_attr ( $class_names ) .' bk-cat-'.$cat.' bk-cat-'.strtolower(esc_attr(sanitize_title($item->title))).'"';
		$output .= $indent . '<li id="menu-item-sci1' . $item->ID . '"' . $value . $class_names . '>';
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . ' title="'.esc_attr($item->title).'" class="menu-link">';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';

		$parent_tax = get_post_meta( $item->menu_item_parent, '_menu_item_object', true );
		$children = get_posts ( array (
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID ,
		) );

		if ($depth == 0 && $item->object == 'category' && ! empty ( $children )) {
			$item_output .= '<div class="sub-menu-wrapper">';
		} elseif (! empty ( $children )) {
			$item_output .= '<div class="sub-meni">';
		} elseif ($depth == 0 && $item->object == 'category' && empty ( $children )) {
			$item_output .= '<div class="sub-menu-wrapper no-children">';
		} elseif ($depth == 1 && $item->object == 'category' && ! empty ( $children ) && $parent_tax == 'category') {
		}
		$item_output .= $args->after;

		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
		$children = get_posts ( array (
				'post_type' => 'nav_menu_item',
				'nopaging' => true,
				'numberposts' => 1,
				'meta_key' => '_menu_item_menu_item_parent',
				'meta_value' => $item->ID ,
		) );
		if (! empty ( $children )||($depth == 0 && $item->object == 'category' && empty ( $children ))) {$output .= '</div><!--kk-->';}
		$output .= "</li>\n";
	}
}
