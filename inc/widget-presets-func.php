<?php

function stepfox_demo_available_widgets() {
	global $wp_registered_widget_controls;
	$widget_controls = $wp_registered_widget_controls;
	$available_widgets = array();
	foreach ( $widget_controls as $widget ) {
		if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes
			$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
			$available_widgets[$widget['id_base']]['name'] = $widget['name'];
		}
	}
	return apply_filters( 'stepfox_demo_available_widgets', $available_widgets );
}

function stepfox_demo_remove_inactive_widgets() {
$sidebars_widgets = wp_get_sidebars_widgets();
foreach ( $sidebars_widgets['wp_inactive_widgets'] as $key => $widget_id ) {
	$pieces = explode( '-', $widget_id );
	$multi_number = array_pop( $pieces );
	$id_base = implode( '-', $pieces );
	$widget = get_option( 'widget_' . $id_base );
	unset( $widget[$multi_number] );
	update_option( 'widget_' . $id_base, $widget );
	unset( $sidebars_widgets['wp_inactive_widgets'][$key] );
}

wp_set_sidebars_widgets( $sidebars_widgets );
}

function stepfox_demo_layout($file) {
	global $stepfox_demo_import_results;



	$data = wp_remote_fopen( get_template_directory_uri().'/demos/'.$file.'.wie' );
	$data = json_decode( $data );
	$stepfox_demo_import_results = stepfox_demo_import_data( $data );
}


function stepfox_demo_import_data( $data ) {
	global $wp_registered_sidebars;
	do_action( 'stepfox_demo_before_import' );
	$data = apply_filters( 'stepfox_demo_import_data', $data );
	$available_widgets = stepfox_demo_available_widgets();
	$widget_instances = array();
	foreach ( $available_widgets as $widget_data ) {
		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	}
	$results = array();
	foreach ( $data as $sidebar_id => $widgets ) {
		if ( 'wp_inactive_widgets' == $sidebar_id ) {
			continue;
		}
		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
			$sidebar_available = true;
			$use_sidebar_id = $sidebar_id;
			$sidebar_message_type = 'success';
			$sidebar_message = '';
		} else {
			$sidebar_available = false;
			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
			$sidebar_message_type = 'error';
			$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'science-magazine' );
		}
		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
		$results[$sidebar_id]['message'] = $sidebar_message;
		$results[$sidebar_id]['widgets'] = array();
		foreach ( $widgets as $widget_instance_id => $widget ) {
			$fail = false;
			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
				$fail = true;
				$widget_message_type = 'error';
				$widget_message = __( 'Site does not support widget', 'science-magazine' ); // explain why widget not imported
			}
			$widget = apply_filters( 'stepfox_demo_widget_settings', $widget );
			$widget = json_decode( json_encode( $widget ), true );
			$widget = apply_filters( 'stepfox_demo_widget_settings_array', $widget );
			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
				$sidebars_widgets = get_option( 'sidebars_widgets' );
				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array();
				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
			}
			if ( ! $fail ) {
				$single_widget_instances = get_option( 'widget_' . $id_base );
				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 );
				$single_widget_instances[] = $widget;
					end( $single_widget_instances );
					$new_instance_id_number = key( $single_widget_instances );
					if ( '0' === strval( $new_instance_id_number ) ) {
						$new_instance_id_number = 1;
						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
						unset( $single_widget_instances[0] );
					}
					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
						$multiwidget = $single_widget_instances['_multiwidget'];
						unset( $single_widget_instances['_multiwidget'] );
						$single_widget_instances['_multiwidget'] = $multiwidget;
					}
					update_option( 'widget_' . $id_base, $single_widget_instances );
				$sidebars_widgets = get_option( 'sidebars_widgets' ); 
				$new_instance_id = $id_base . '-' . $new_instance_id_number; 
				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; 
				update_option( 'sidebars_widgets', $sidebars_widgets );
			}
		}
	}
	do_action( 'stepfox_demo_after_import' );
	return apply_filters( 'stepfox_demo_import_results', $results );
}