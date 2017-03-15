var $ = jQuery.noConflict();
$(document).ready(function() {
			$('.yesido').on('click', function(){
				$('.warrning-button').fadeOut( 'slow' );
			});

        $('#widget-layout-dropdown').change(function(){
            $(this).find("option:selected").each(function(){
                    var rank_list = $(this).parent().children().index(this);
                    $('.layout-images li').hide();
                    $('.layout-images li').eq(rank_list).fadeIn(400);          
                    
            });
        }).change();


	
});