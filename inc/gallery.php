<?php 
/**
 * Science Magazine gallery
**/ 
?>
<?php 


//=======gallery metabox===========

// Adds a box to the Posts edit screens. 
add_action( 'add_meta_boxes_post', 'sci1_gallery_add_meta_boxes' );

// Saves the meta box custom data. 
add_action( 'save_post', 'sci1_gallery_save_postdata', 10, 2 );

//Adds a box to the Post edit screens.
function sci1_gallery_add_meta_boxes() {
    $post_types = get_post_types( array('public' => true), 'names' );
    $excluded_post_types = array('attachment');
    
    foreach ($post_types as $post_type) {
        if (!in_array($post_type, $excluded_post_types)) {
		
        	add_meta_box(
        		'sci1-gallery-metabox',
        		__('Gallery', 'science-magazine'),
        		'sci1_gallery_render_meta_box',
        		$post_type,
        		'normal',
        		'high'
        	);
        }
    }
}


//Render the meta box.

 
function sci1_gallery_render_meta_box( $post ) {
	
	wp_nonce_field( basename( __FILE__ ), 'sci1-gallery-image-nonce' );	

	$galimage = get_post_meta( $post->ID, 'sci1_gallery_image', true );
	$gallerycriteria = apply_filters('sci1_gallery_image_criteria', array());
    $galleryimage = array();
    foreach ($gallerycriteria as $item) {
        $galleryimage[] = array( 'sci1_gallery_image' => $item);
    }?>

<table id="sci1-image-field-table" class="sci1-image-field-table" width="100%">
	<thead>
		<tr>
			<th width="100%"><?php _e('Gallery images', 'science-magazine'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if ( !empty($galimage) ) : ?>
		<?php foreach ( $galimage as $item ) { $thumbnail_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'smallthumb');?>
		<tr class="sci1-image-field">
			<th><?php _e('Image Selection', 'science-magazine'); ?></th>
			<td><img class="gallery-image-preview" src="<?php if( !empty( $item['sci1_gallery_image'] ) ) echo esc_url($thumbnail_image[0]); ?>"/></td>
			<td><input class="sci1_gallery_image" type="text" name="sci1_gallery_image[]" value="<?php if( !empty( $item['sci1_gallery_image'] ) ) echo esc_url($item['sci1_gallery_image']) ; ?>"/></td>
			<td><input type= "button" class="button gallery_image_button" name="gallery_image_button" value="<?php _e('Choose Image', 'science-magazine'); ?>" /></td>
			<td><a class="button remove-row" href="#">
				<?php _e('Delete', 'science-magazine'); ?>
				</a></td>
		</tr>
		<?php } else : ?>
		<tr class="sci1-image-field">
			<th><?php _e('Image Selection', 'science-magazine'); ?></th>
			<td><img class="gallery-image-preview" src="" alt="" border=3 height=100 width=100></td>
			<td><input class="sci1_gallery_image" type="text" name="sci1_gallery_image[]"/></td>
			<td><input type= "button" class="button gallery_image_button" name="gallery_image_button" value="<?php _e('Choose Image', 'science-magazine'); ?>" /></td>
			<td><a class="button remove-row" href="#">
				<?php _e('Delete', 'science-magazine'); ?>
				</a></td>
		</tr>
		<?php endif; ?>
		<tr class="sci1-image-field empty-row screen-reader-text">
			<th><?php _e('Image Selection', 'science-magazine'); ?></th>
			<td><img class="gallery-image-preview" src="" ></td>
			<td><input class="sci1_gallery_image" type="text" name="sci1_gallery_image[]"/></td>
			<td><input type= "button" class="button gallery_image_button" name="gallery_image_button" value="<?php _e('Choose Image', 'science-magazine'); ?>" /></td>
			<td><a class="button remove-row" href="#">
				<?php _e('Delete', 'science-magazine');?>
				</a></td>
		</tr>
	</tbody>
</table>
<table width="100%">
	<tr>
		<td width="80%"><a id="add-row-gallery" class="button" href="#">
			<?php _e('Add another', 'science-magazine'); ?>
			</a></td>
	</tr>
</table>
<?php }


// Saves the meta box.

function sci1_gallery_save_postdata( $post_id, $post ) {
	
	if ( !isset( $_POST['sci1-gallery-image-nonce'] ) || !wp_verify_nonce( $_POST['sci1-gallery-image-nonce'], basename( __FILE__ ) ) )
		return;	
		
	// If this is an autosave, our form has not been submitted, so we don't want to do anything. 
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
		return $post_id;

	// Check the user's permissions.
	if ( 'page' == $_POST['post_type'] ) {
		if ( ! current_user_can( 'edit_page', $post_id ) )
			return $post_id;
	} else {
		if ( ! current_user_can( 'edit_post', $post_id ) )
			return $post_id;
	}

	$meta = array(
		'sci1_gallery_image'    => $_POST['sci1_gallery_image']
	);

	foreach ( $meta as $meta_key => $new_meta_value ) {

		// Get the meta value of the custom field key. 4
		$meta_value = get_post_meta( $post_id, $meta_key, true );

		//If there is no new meta value but an old value exists, delete it.
		if ( current_user_can( 'delete_post_meta', $post_id, $meta_key ) && '' == $new_meta_value && $meta_value )
			delete_post_meta( $post_id, $meta_key, $meta_value );

		// If a new meta value was added and there was no previous value, add it. 
		elseif ( current_user_can( 'add_post_meta', $post_id, $meta_key ) && $new_meta_value && '' == $meta_value )
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );

		// If the new meta value does not match the old value, update it. 
		elseif ( current_user_can( 'edit_post_meta', $post_id, $meta_key ) && $new_meta_value && $new_meta_value != $meta_value )
			update_post_meta( $post_id, $meta_key, $new_meta_value );
	}

	
	//Repeatable field
	$galimage = $_POST['sci1_gallery_image'];
	$old   = get_post_meta( $post_id, 'sci1_gallery_image', true );
	$new   = array();

	$count = count( $galimage );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $galimage[$i] != '' )
			$new[$i]['sci1_gallery_image'] = sanitize_text_field( $galimage[$i] );
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'sci1_gallery_image', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'sci1_gallery_image', $old );

}


function sci1_gallery() {
	
	global $post;
	
	$galimage = get_post_meta( $post->ID, 'sci1_gallery_image', true );
	  if ( $galimage ) {  
	  echo '<div class="post-page-gallery-slider loading '.esc_attr(get_option('sci1_slider_picker')).'"><ul class="slides">';
	  						
		  foreach( $galimage as $item ) {	
		  
		  $sci1_post_media_size = get_post_meta( get_the_ID(), 'media_size', true); if(empty($sci1_post_media_size)){$sci1_post_media_size = 'normal';}
		  if ($sci1_post_media_size == "big") {
		  $slider_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'slider-four');
		  } else {
		  $slider_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'slider-three');  
		  }
		  $caption = get_post(get_attachment_id_from_src ($item['sci1_gallery_image']));
		  
		  echo '<li>';
		  echo '<img src="'.esc_url($slider_image[0]).'" alt="">';
		 if(!empty($caption->post_excerpt)) {echo '<div class="caption-gallery-slider">'.esc_html($caption->post_excerpt).'</div>';}		  
		  echo '</li>';	
		  }
	  
	  echo '</ul></div>';
		echo '<div class="post-page-gallery-thumbnails loading"><ul class="slides">';	  
	  		foreach( $galimage as $item ) {	
	 
		  $thumbnail_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'smallimagefeatured');
		  
		  echo '<li>';
		  echo '<img src="'.esc_url($thumbnail_image[0]).'" alt="">';
		  echo '</li>';	
		  }	  
	  echo '</ul></div>';
  }
}

function sci1_gallery_tax($postID) {
	
	$galimage = get_post_meta( $postID, 'sci1_gallery_image', true );
	  if ( $galimage ) {
	  echo '<div class="post-page-gallery-slider loading '.esc_attr(get_option('sci1_slider_picker')).'"><ul class="slides">';
	  						
		  foreach( $galimage as $item ) {	

		  $slider_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'slider-four');
		  $caption = get_post(get_attachment_id_from_src ($item['sci1_gallery_image']));
		  
		  echo '<li>';
		  echo '<img src="'.esc_url($slider_image[0]).'" alt="">';
		  if(!empty($caption->post_excerpt)) {echo '<div class="caption-gallery-slider">'.esc_html($caption->post_excerpt).'</div>';}
		  echo '</li>';	
		  }
		  
	  echo '</ul></div>';
		echo '<div class="post-page-gallery-thumbnails loading"><ul class="slides">';	  
	  		foreach( $galimage as $item ) {	
				 
		  $thumbnail_image = wp_get_attachment_image_src(get_attachment_id_from_src ($item['sci1_gallery_image']), 'smallimagefeatured');
		  		  
		  echo '<li>';
		  echo '<img src="'.esc_url($thumbnail_image[0]).'" alt="">';
		  echo '</li>';	
		  }	  
	  echo '</ul></div>';
  }
}