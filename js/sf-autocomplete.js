jQuery(document).ready(function($) {
	        //search


	$('#main-nav .search-menu-icon').not( '.submit-button .search-menu-icon' ).on('click', function(e){
		e.preventDefault();
		$('.search-box').toggleClass('active');
		$( ".search-box #s" ).focus();
	});

	$('.close-search-box').on('click', function(e){
		e.preventDefault();
		$('.search-box').removeClass('active');
	});


	$(document).on( 'click', function(e){
	if($(e.target).hasClass('search-box')){
	    if (e.pageX + 100 - $('.search-box #s').offset().left < 0 || e.pageX - 100 - $('.search-box #s').offset().left > 590) {
	      $('.search-box').removeClass('active');
	    }  
	}      
	});
	$("#s").on("input", function(e){
		$('.search-box .featured-thumbnails li').remove();
		e.preventDefault();	
		var search_word = $(this).val();
		

			jQuery.ajax({						
				type : "POST",
				url: stepfoxcomplete.stepfoxcompleteurl,
				data: {"action": "stepfox_search", search_this: search_word},
				success : function(response) {				
					
					$('.search-box').find('.featured-thumbnails').html(response);
					return false;											
				}
			});
								
	});	
});