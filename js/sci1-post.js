var $ = jQuery.noConflict();
$(document).ready(function() {

    $( "#sci1-review-metabox" ).hide();
	$( "#sci1-video-link" ).hide();
	$( "#sci1-gallery-metabox" ).hide();
	
	
    if( $( "input#post-format-aside" ).is(':checked') ){
        $( "#sci1-review-metabox" ).show();
    } 
	if( $( "input#post-format-video" ).is(':checked') ){
		$( "#sci1-video-link" ).show();
	}else 
	if($( "input#post-format-gallery" ).is(':checked') ){
		$( "#sci1-gallery-metabox" ).show();
	}
	
	
	    // If post format is selected
	
	
    $( "input#post-format-aside" ).click( function() {
        if( $( "input#post-format-aside" ).is(':checked') ){
            $( "#sci1-review-metabox" ).show(500);
			$( "#sci1-video-link" ).hide();
			$( "#sci1-gallery-metabox" ).hide();
        }});

    $( "input#post-format-video" ).click( function() {
        if( $( "input#post-format-video" ).is(':checked') ){
			$( "#sci1-video-link" ).show(500);
            $( "#sci1-review-metabox" ).hide();
			$( "#sci1-gallery-metabox" ).hide();
        }});		

    $( "input#post-format-0" ).click( function() {
        if( $( "input#post-format-0" ).is(':checked') ){
			$( "#sci1-video-link" ).hide();
            $( "#sci1-review-metabox" ).hide();
			$( "#sci1-gallery-metabox" ).hide();
        }});
		
	$( "input#post-format-gallery" ).click( function() {
        if( $( "input#post-format-gallery" ).is(':checked') ){
			$( "#sci1-video-link" ).hide();
            $( "#sci1-review-metabox" ).hide();
			$( "#sci1-gallery-metabox" ).show(500);
        }});				


	/**
	 * Repeatable field
	 */
	$('#add-row').on('click', function(e) {
		e.preventDefault();
		var row = $('.empty-row.screen-reader-text.scores').clone(true);
		row.removeClass('empty-row screen-reader-text scores');
		row.insertBefore('#sci1-review-item tbody>tr:last');
		row.find("[name='sci1_review_item_score[]']").addClass('review-score');
		$.review_total();
	});
	
	$('#add-row-good').on('click', function(e) {
		e.preventDefault();
		var row = $('.empty-row.screen-reader-text.good').clone(true);
		row.removeClass('empty-row screen-reader-text good');
		row.insertBefore('#sci1-review-good tbody>tr:last');
	});

	$('#add-row-bad').on('click', function(e) {
		e.preventDefault();
		var row = $('.empty-row.screen-reader-text.bad').clone(true);
		row.removeClass('empty-row screen-reader-text bad');
		row.insertBefore('#sci1-review-bad tbody>tr:last');
	});
	
	$('#add-row-gallery').on('click', function(e) {
		e.preventDefault();
		var row = $('.empty-row.sci1-image-field').clone(true);
		row.removeClass('empty-row screen-reader-text');
		row.insertBefore('#sci1-image-field-table tbody>tr:last');
	});


	$('.remove-row').on('click', function(e) {
		e.preventDefault();
		$(this).parents('tr').remove();
		$.review_total();
	});

	/**
	 * Review total
	 */
	$.extend({
		
		review_total: function(){
			$('.review-score').on( 'change', function () {
				
				var sum   = 0,
					value = 0,
					input = $('.review-score').length;
					
				$('.review-score').each(function () {
					value = Number($(this).val());
					if (!isNaN(value)) sum += value / input;
				});				
				$('.sci1-review-total').val( Math.round(sum * 10) / 10 );
				
			});
			
		},
			
	});
	
	$.review_total();
	
	
	
	

	var custom_uploader;
 
 
    $('#image_button').click(function(e) {
 
        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#sci1_review_image').val(attachment.url);
			$(".sci1-image-preview").attr('src',attachment.url);
			
        });
        custom_uploader.open();
 
    });
	
	
	    $('.gallery_image_button').click(function(e) {
			var voa = $(this).parents('.sci1-image-field');
			voa.addClass('active-image');

        e.preventDefault();
 
        //If the uploader object has already been created, reopen the dialog
        if (custom_uploader) {
            custom_uploader.open();
            return;
        }
 
        //Extend the wp.media object
        custom_uploader = wp.media.frames.file_frame = wp.media({
            title: 'Choose Image',
            button: {
                text: 'Choose Image'
            },
            multiple: false
        });
 
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
            attachment = custom_uploader.state().get('selection').first().toJSON();
            $('.active-image .sci1_gallery_image').val(attachment.url);
			$('.active-image .gallery-image-preview').attr('src',attachment.url);
			$('.sci1-image-field').removeClass('active-image');
			
        });
        custom_uploader.open();

    });
	
});