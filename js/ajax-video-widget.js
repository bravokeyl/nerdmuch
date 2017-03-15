jQuery(document).ready(function($) {
    			$('.tv-featured').on('click', '.tv-ajax-carousel-title a, .tv-ajax-carousel-image a', function(e){		
						e.preventDefault();
						
						var id = $(this).attr('data-number');
						var widget_size = $(this).attr('data-widget-size');
						var widgid = $(this).parents('.widget_tv_widget_ajax_sci1').attr('id');
						var widgid = '#'+widgid;
						
						jQuery.ajax({						
							type : "POST",
							url: sci1_live_video_ajax.sci1_live_video_ajaxurl,
							data: {"action": "sci1_live_video", the_id: id, widget_size: widget_size, },
							success : function(response) {
					
								
								$(widgid).find('.tv-big li').html(response);
								if ($('#fullwidth').length) {          
				                    $('#fullwidth').masonry().masonry('reloadItems');
				                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 500);
				                }
								return false;											
							}
						});
											
					});	
})