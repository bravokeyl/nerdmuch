<?php 
/**
 * Science Magazine meta-fields
**/ 
?>
<?php

//============Video link meta field=================

add_action ( 'load-post.php', 'sci1metabox' );
add_action ( 'load-post-new.php', 'sci1metabox' );

// Meta box setup function.

function sci1metabox() {
	add_action ( 'add_meta_boxes', 'sci1_add_post_meta' );
	add_action ( 'save_post', 'sci1_save_post_meta', 10, 2 );
}

//Display meta box.

function sci1_add_post_meta() {
	add_meta_box ( 'sci1-video-link', __('Featured Video','science-magazine'), 'sci1_video_link_box', 'post', 'normal', 'high' );
}

function sci1_video_link_box($object, $box) {wp_nonce_field( basename( __FILE__ ), 'sci1_video_link_nonce' ); ?>

<p>
	<label for="sci1-video-link">
		<?php _e('Paste a link from Vimeo or Youtube, it will be embeded in the post.', 'science-magazine'); ?>
	</label>
	<input class="widefat" type="text" name="sci1-video-link" id="sci1-video-link" value="<?php echo esc_textarea(get_post_meta( $object->ID, 'sci1_video_link', true )); ?>"size="30" />
</p>

<?php
}

//Save the metabox value.

function sci1_save_post_meta($post_id, $post) {
	if (! isset ( $_POST ['sci1_video_link_nonce'] ) || ! wp_verify_nonce ( $_POST ['sci1_video_link_nonce'], basename ( __FILE__ ) ))
		return $post_id;
	$post_type = get_post_type_object ( $post->post_type );
	if (! current_user_can ( $post_type->cap->edit_post, $post_id ))
		return $post_id;
	$new_meta_value = (isset ( $_POST ['sci1-video-link'] ) ? balanceTags ( $_POST ['sci1-video-link'] ) : '');
	$meta_key = 'sci1_video_link';
	$meta_value = get_post_meta ( $post_id, $meta_key, true );
	if ($new_meta_value && '' == $meta_value)
		add_post_meta ( $post_id, $meta_key, $new_meta_value, true );
	elseif ($new_meta_value && $new_meta_value != $meta_value)
		update_post_meta ( $post_id, $meta_key, $new_meta_value );
	elseif ('' == $new_meta_value && $meta_value)
		delete_post_meta ( $post_id, $meta_key, $meta_value );
}


function user_social_profile_fields($user) {
	
//================Author social links=================
	
	?>
<h3>
	<?php __('Social Profiles', 'science-magazine'); ?>
</h3>
<table class="form-table">
	<tr>
		<th><label for="twitter">
				<?php _e('Twitter', 'science-magazine'); ?>
			</label></th>
		<td><input type="text" name="twitter" id="twitter"value="<?php echo esc_textarea(get_the_author_meta( 'twitter', $user->ID )); ?>"class="regular-text" /></td>
	</tr>
	<tr>
		<th><label for="facebook">
				<?php _e('Facebook', 'science-magazine'); ?>
			</label></th>
		<td><input type="text" name="facebook" id="facebook"value="<?php echo esc_textarea(get_the_author_meta( 'facebook', $user->ID  )); ?>"class="regular-text" /></td>
	</tr>
	<tr>
		<th><label for="google">
				<?php _e('Google+', 'science-magazine'); ?>
			</label></th>
		<td><input type="text" name="google" id="google"value="<?php echo esc_textarea(get_the_author_meta( 'google', $user->ID  )); ?>"class="regular-text" /></td>
	</tr>
	<tr>
		<th><label for="pinterest">
				<?php _e('Pinterest', 'science-magazine'); ?>
			</label></th>
		<td><input type="text" name="pinterest" id="pinterest"value="<?php echo esc_textarea(get_the_author_meta( 'pinterest', $user->ID )); ?>"class="regular-text" /></td>
	</tr>
	<tr>
		<th><label for="instagram">
				<?php _e('Instagram', 'science-magazine'); ?>
			</label></th>
		<td><input type="text" name="instagram" id="instagram" value="<?php echo esc_textarea(get_the_author_meta( 'instagram', $user->ID  )); ?>"class="regular-text" /></td>
	</tr>
</table>
<?php
}
function save_user_social_profile_fields($user_id) {
	
//Save the metabox value.

	if (! current_user_can ( 'edit_user', $user_id ))
		return false;
	
	update_user_meta ( $user_id, 'twitter', $_POST ['twitter'] );
	update_user_meta ( $user_id, 'facebook', $_POST ['facebook'] );
	update_user_meta ( $user_id, 'google', $_POST ['google'] );
	update_user_meta ( $user_id, 'pinterest', $_POST ['pinterest'] );
	update_user_meta ( $user_id, 'instagram', $_POST ['instagram'] );
}
add_action ( 'show_user_profile', 'user_social_profile_fields' );
add_action ( 'edit_user_profile', 'user_social_profile_fields' );

add_action ( 'personal_options_update', 'save_user_social_profile_fields' );
add_action ( 'edit_user_profile_update', 'save_user_social_profile_fields' );

//==================Subtitle====================

    add_action( 'edit_form_after_title', 'sci1_subtitle_meta_box' );
    add_action( 'save_post', 'sci1_save_subtitle_meta_box', 10, 2 );

function sci1_subtitle_meta_box( $object ) { ?>
<?php if( 'post' == $object->post_type || 'page' == $object->post_type) {?>
        <label><?php _e('(optional)Please enter sub title or favorite quote from the text:', 'science-magazine'); ?></label>
        <input name="sci1_sub_title" id="sw_title" style="width: 100%;" value="<?php echo esc_html( get_post_meta( $object->ID, 'sci1_sub_title', true ), 1 ); ?>" />
        <input type="hidden" name="my_meta_box_nonce" value="<?php echo wp_create_nonce( basename( __FILE__ ) ); ?>" />

<?php }}

function sci1_save_subtitle_meta_box( $post_id, $post ) {

    if (! isset ( $_POST ['my_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['my_meta_box_nonce'] , basename( __FILE__ ) ) )
        return $post_id;

    if ( !current_user_can( 'edit_post', $post_id ) )
        return $post_id;

    //Saving 1st Data
    
    $meta_value = get_post_meta( $post_id, 'sci1_sub_title', true );
    $new_meta_value = stripslashes( $_POST['sci1_sub_title'] );

    if ( $new_meta_value && '' == $meta_value )
        add_post_meta( $post_id, 'sci1_sub_title', $new_meta_value, true );

    elseif ( $new_meta_value != $meta_value )
        update_post_meta( $post_id, 'sci1_sub_title', $new_meta_value );

    elseif ( '' == $new_meta_value && $meta_value )
        delete_post_meta( $post_id, 'sci1_sub_title', $meta_value ); 
}
function sci1_subtitle() {
		global $post;
		echo esc_html(get_post_meta($post->ID, 'sci1_sub_title', true));
}



//=======Review metabox===========

// Adds a box to the Posts edit screens. 
add_action( 'add_meta_boxes_post', 'sci1_review_add_meta_boxes' );

// Saves the meta box custom data. 
add_action( 'save_post', 'sci1_review_save_postdata', 10, 2 );

//Adds a box to the Post edit screens.
function sci1_review_add_meta_boxes() {
    $post_types = get_post_types( array('public' => true), 'names' );
    $excluded_post_types = array('attachment');
    
    foreach ($post_types as $post_type) {
        if (!in_array($post_type, $excluded_post_types)) {
		
        	add_meta_box(
        		'sci1-review-metabox',
        		__('Review Item', 'science-magazine'),
        		'sci1_review_render_meta_box',
        		$post_type,
        		'normal',
        		'high'
        	);
        }
    }
}


//Render the meta box.

 
function sci1_review_render_meta_box( $post ) {
	
// Retrieve an existing value from the database.
	$heading = get_post_meta( $post->ID, 'sci1_review_heading', true );
	$image = get_post_meta( $post->ID, 'sci1_review_image', true );
	
	
	
	
	
	$good = get_post_meta( $post->ID, 'sci1_review_good', true );
	
	$goodCriteria = apply_filters('sci1_review_good_criteria', array());
    $goodItems = array();
    foreach ($goodCriteria as $item) {
        $goodItems[] = array( 'sci1_review_good' => $item);
    }
		
	$bad = get_post_meta( $post->ID, 'sci1_review_bad', true );

	$badCriteria = apply_filters('sci1_review_bad_criteria', array());
    $badItems = array();
    foreach ($badCriteria as $item) {
        $badItems[] = array( 'sci1_review_bad' => $item);
    }

	$defaultCriteria = apply_filters('sci1_review_default_criteria', array());
    $defaultItems = array();
    foreach ($defaultCriteria as $item) {
        $defaultItems[] = array( 'sci1_review_item_title' => $item, 'sci1_review_item_score' => '');
    }
	$items     = get_post_meta( $post->ID, 'sci1_review_item', true );
	
	
	
	
	if ( $items == '' ) $items = $defaultItems; 
    
// Add an nonce field so we can check for it later.
	wp_nonce_field( basename( __FILE__ ), 'sci1-review-item-nonce' );
	wp_nonce_field( basename( __FILE__ ), 'sci1-review-heading-nonce' );
	wp_nonce_field( basename( __FILE__ ), 'sci1-review-image-nonce' );
	wp_nonce_field( basename( __FILE__ ), 'sci1-review-bad-nonce' );
	wp_nonce_field( basename( __FILE__ ), 'sci1-review-good-nonce' );
	
?>
<p class="sci1-review-field">
    <div id="post-review-title"><?php _e('Review Item Title', 'science-magazine'); ?></div>
    <input type="text" name="sci1_review_heading" id="sci1_review_heading" value="<?php echo esc_textarea($heading); ?>" />
</p>
<p class="sci1-image-field">
<div id="sci1-image-preview-title"><?php _e('Image Selection', 'science-magazine'); ?></div>
<input type="text" name="sci1_review_image" id="sci1_review_image" value="<?php echo esc_attr($image); ?>"/>
<input type= "button" class="button" name="image_button" id="image_button" value="Choose Image" />
</p>


<div class="sci1-image-preview-wrapper">
    <div id="sci1-image-preview-title"><?php _e('Preview Image', 'science-magazine'); ?></div>
	<img class="sci1-image-preview" src="<?php echo esc_url($image); ?>" width="100%">
</div>



<div class="sci1-good-wrapper">
<!-- Start repeater field good -->
<table id="sci1-review-good" class="sci1-review-good" width="100%">
  <thead>
    <tr>
      <th width="100%"><?php _e('Good', 'science-magazine'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php if ( !empty($good) ) : ?>
    <?php foreach ( $good as $item ) { ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_good[]" value="<?php if( !empty( $item['sci1_review_good'] ) ) echo esc_textarea($item['sci1_review_good']); ?>" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php } ?>
    <?php else : ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_good[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php endif; ?>
    
    <!-- empty hidden -->
    <tr class="empty-row screen-reader-text good">
      <td><input type="text" class="widefat" name="sci1_review_good[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
  </tbody>
</table>
<table width="40%">
  <tr>
    <td width="80%"><a id="add-row-good" class="button" href="#">
      <?php _e('Add another','science-magazine'); ?>
      </a></td>
  </tr>
</table>
</div>

<div class="sci1-bad-wrapper">
<!-- Start repeater field bad -->
<table id="sci1-review-bad" class="sci1-review-bad" width="100%">
  <thead>
    <tr>
      <th width="100%"><?php _e('bad','science-magazine'); ?></th>
    </tr>
  </thead>
  <tbody>
    <?php if ( !empty($bad) ) : ?>
    <?php foreach ( $bad as $item ) { ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_bad[]" value="<?php if( !empty( $item['sci1_review_bad'] ) ) echo esc_textarea($item['sci1_review_bad']) ; ?>" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php } ?>
    <?php else : ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_bad[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php endif; ?>
    
    <!-- empty hidden -->
    <tr class="empty-row screen-reader-text bad">
      <td><input type="text" class="widefat" name="sci1_review_bad[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
  </tbody>
</table>
<table width="100%">
  <tr>
    <td width="80%"><a id="add-row-bad" class="button" href="#">
       <?php _e('Add another','science-magazine'); ?>
      </a></td>
  </tr>
</table>
</div>

<!-- Start repeater field -->
<table id="sci1-review-item" class="sci1-review-item" width="100%">
  <thead>
    <tr>
      <th width="80%"><?php _e('Feature Name', 'science-magazine'); ?></th>
      <th width="10%" class="dynamic-text"><?php _e('Score (1-10)','science-magazine'); ?></th>
      <th width="10%"></th>
    </tr>
  </thead>
  <tbody>
    <?php if ( !empty($items) ) : ?>
    <?php foreach ( $items as $item ) { ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_item_title[]" value="<?php if( !empty( $item['sci1_review_item_title'] ) ) echo esc_textarea($item['sci1_review_item_title']) ; ?>" /></td>
      <td><input type="text" min="1" step="1" autocomplete="off" class="widefat review-score" name="sci1_review_item_score[]" value="<?php if ( !empty ($item['sci1_review_item_score'] ) ) echo esc_textarea($item['sci1_review_item_score']); ?>" /></td>
      <td><a class="button remove-row" href="#">
       <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php } ?>
    <?php else : ?>
    <tr>
      <td><input type="text" class="widefat" name="sci1_review_item_title[]" /></td>
      <td><input type="text" min="1" step="1" autocomplete="off" class="widefat review-score" name="sci1_review_item_score[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
    <?php endif; ?>
    
    <!-- empty hidden -->
    <tr class="empty-row screen-reader-text scores">
      <td><input type="text" class="widefat" name="sci1_review_item_title[]" /></td>
      <td><input type="text" min="1" step="1" autocomplete="off" class="widefat" name="sci1_review_item_score[]" /></td>
      <td><a class="button remove-row" href="#">
        <?php _e('Delete', 'science-magazine'); ?>
        </a></td>
    </tr>
  </tbody>
</table>
<table width="100%">
  <tr>
    <td width="80%"><a id="add-row" class="button" href="#">
     <?php _e('Add another','science-magazine'); ?>
      </a></td>
    <td width="10%"><input type="text" class="widefat sci1-review-total" name="sci1_review_total" value="<?php echo esc_attr(get_post_meta( $post->ID, 'sci1_review_total', true )); ?>" readonly /></td>
    <td width="10%"><?php _e('Total', 'science-magazine'); ?></td>
  </tr>
</table>

<?php
}


	// Saves the meta box.

function sci1_review_save_postdata( $post_id, $post ) {

	if ( !isset( $_POST['sci1-review-item-nonce'] ) || !wp_verify_nonce( $_POST['sci1-review-item-nonce'], basename( __FILE__ ) ) )
		return;

	if ( !isset( $_POST['sci1-review-heading-nonce'] ) || !wp_verify_nonce( $_POST['sci1-review-heading-nonce'], basename( __FILE__ ) ) )
		return;
		
	if ( !isset( $_POST['sci1-review-image-nonce'] ) || !wp_verify_nonce( $_POST['sci1-review-image-nonce'], basename( __FILE__ ) ) )
		return;
		
	if ( !isset( $_POST['sci1-review-good-nonce'] ) || !wp_verify_nonce( $_POST['sci1-review-good-nonce'], basename( __FILE__ ) ) )
		return;
		
	if ( !isset( $_POST['sci1-review-bad-nonce'] ) || !wp_verify_nonce( $_POST['sci1-review-bad-nonce'], basename( __FILE__ ) ) )
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

		'sci1_review_total'    => $_POST['sci1_review_total'],
		'sci1_review_heading'     => $_POST['sci1_review_heading'],
		'sci1_review_image'     => $_POST['sci1_review_image'],
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

	// Repeatable update and delete meta fields method.
	$title = $_POST['sci1_review_item_title'];
	$score  = $_POST['sci1_review_item_score'];

	$old   = get_post_meta( $post_id, 'sci1_review_item', true );
	$new   = array();

	$count = count( $title );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $title[$i] != '' )
			$new[$i]['sci1_review_item_title'] = sanitize_text_field( $title[$i] );
		if ( $score[$i] != '' )
			$new[$i]['sci1_review_item_score'] = sanitize_text_field( $score[$i] );
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'sci1_review_item', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'sci1_review_item', $old );
		
		
	// Repeatable field Good.
	$good = $_POST['sci1_review_good'];
	$old   = get_post_meta( $post_id, 'sci1_review_good', true );
	$new   = array();

	$count = count( $good );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $good[$i] != '' )
			$new[$i]['sci1_review_good'] = sanitize_text_field( $good[$i] );
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'sci1_review_good', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'sci1_review_good', $old );
		
		
	//Repeatable field Bad.
	$bad = $_POST['sci1_review_bad'];
	$old   = get_post_meta( $post_id, 'sci1_review_bad', true );
	$new   = array();

	$count = count( $bad );
	
	for ( $i = 0; $i < $count; $i++ ) {
		if ( $bad[$i] != '' )
			$new[$i]['sci1_review_bad'] = sanitize_text_field( $bad[$i] );
	}

	if ( !empty( $new ) && $new != $old )
		update_post_meta( $post_id, 'sci1_review_bad', $new );
	elseif ( empty($new) && $old )
		delete_post_meta( $post_id, 'sci1_review_bad', $old );

}

function review_scripts($hook) {
	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {
			wp_enqueue_script('sci1review', get_template_directory_uri() . '/js/sci1-post.js', array('jquery'));
			wp_enqueue_style( 'sci1-review-style', get_template_directory_uri() . '/inc/sci1-post-style.css' );
	}
}
add_action( 'admin_enqueue_scripts', 'review_scripts' );




















add_action( 'add_meta_boxes', 'media_size_meta_box' );
add_action( 'save_post', 'media_size_meta_save_postdata' );
function media_size_meta_box() {
    add_meta_box( 
        'media_size_metabox',
        'Media Size',
        'media_size_custom_box',
        'post',
        'side',
        'default'
    );
}

function media_size_custom_box($post){
    wp_nonce_field( 'media_size_meta_field_nonce', 'media_size_meta_nonce' );
    $saved = get_post_meta( $post->ID, 'media_size', true);
    if( !$saved )
        $saved = 'normal';

    $fields = array(
        'fullwidth'  => 'Fullwidth Size',
        'big' => 'Big Size',
        'normal' => 'Normal Size',
        'none' => 'No media',
    );

    foreach($fields as $key => $label){
        printf(
            '<input type="radio" name="media_size" value="%1$s" id="media_size[%1$s]" %3$s />'.
            '<label for="media_size[%1$s]"> %2$s ' .
            '</label><br>',
            $key,
            $label,
            checked($saved, $key, false)
        );
    }
}

function media_size_meta_save_postdata( $post_id ){
      if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
          return;
		if ( ! isset( $_POST['media_size_meta_nonce'] ) ) {
			return;
		}
      if ( !wp_verify_nonce( $_POST['media_size_meta_nonce'], 'media_size_meta_field_nonce' ) )
          return;

      if ( isset($_POST['media_size']) && $_POST['media_size'] != '' ){
            update_post_meta( $post_id, 'media_size', $_POST['media_size'] );
      } 
}