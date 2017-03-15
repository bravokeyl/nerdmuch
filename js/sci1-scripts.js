jQuery(document).ready(
    function($) {
        "use strict";

        $(window).load(function() {
        $('#main').fadeTo(1000, 1);
        });
        $('.slide-title, .slide-excerpt, .slide-date, .top-menu-posts li, .super-slider .super-slider-category, .super-slider .super-slider-title, .super-slider .author-date').addClass(widget_fx);
        $('.blog-post-image img, .img-featured-posts-image img, .featured-posts-image img, .small-image img, .tv-big-image img, .multi-category-image img').wrap("<div class='" + image_effect + "'></div>");
        $('#secondary .home-widget').each(function() {
            $(this).removeClass('two-parts three-parts four-parts').addClass('one-part')
        });

        //wp-widgets width
        $('.widget_text, .widget_recent_comments, .widget_recent_entries, .widget_calendar, .widget_nav_menu, .widget_pages, .widget_archive, .widget_links, .widget_meta, .widget_tag_cloud, .widget_rss, .widget_search, .widget_categories, .woocommerce, .widget[id*=bbp_], .widget[id*=bp_]').each(function() {
            $(this).closest('.home-widget').addClass('one-part');
        });


        jQuery('.home .home-widget.one-part').first().addClass('bk-no bk-one-fea-widget');
        jQuery('.home .home-widget.four-parts').first().addClass('bk-no bk-four-fea-widget');

            //Masonry script
            if ($('#fullwidth').length) {
                var fullwidthmas = $('#fullwidth').masonry({
                    columnWidth: function(containerWidth) {
                        return containerWidth / 4;
                    },
                    itemSelector: '.home-widget:not(.bk-no)',
                    animationOptions: {
                        duration: 1
                    }
                });
                fullwidthmas.imagesLoaded(function() {
                    setTimeout(function() {
                        fullwidthmas.masonry();
                        setTimeout(function() {
                            fullwidthmas.masonry();
                        }, 1500);
                    }, 10);
                });
                $(window).load(function() {
                    $('.trending-posts ul, .newsroll ul.one-parts-height').height('20px');
                    $('.newsroll ul.two-parts-height').height((((($('#main').width() - 20) * 0.25 ) - 20 ) / 0.9));
                setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 10);
                });
                $(window).resize(function() {
                    setTimeout(function() {
                        $('.trending-posts ul, .newsroll ul.one-parts-height').height('20px');
                        $('.newsroll ul.two-parts-height').height((((($('#main').width() - 20) * 0.25 ) - 20 ) / 0.9));
                        fullwidthmas.masonry();
                        setTimeout(function() {
                            fullwidthmas.masonry();
                        }, 1500);
                    }, 10);
                });
            }


        //responsive widgets layout
        function checkWidth() {
            if ($('#fullwidth').length) {
            var fullsize = $('#main').width();

            if(fullsize < 984 && fullsize > 631){
                if ($('#fullwidth').hasClass('tablet-response')){
                }else{
                var divClone = $('#fullwidth .one-part').clone().addClass('clone-masonry-res');
                $('#fullwidth .one-part').hide();
                divClone.appendTo('#fullwidth');
                $('#fullwidth').addClass('tablet-response');
                  }
                }
            else if(fullsize < 631){
                if ($('#fullwidth').hasClass('tablet-response')){
                    $( ".clone-masonry-res" ).remove();
                    $('#fullwidth .one-part').show();
                    $('#fullwidth').removeClass('tablet-response');
                }
                }
            else if (fullsize > 984){
                if ($('#fullwidth').hasClass('tablet-response')){
                    $( ".clone-masonry-res" ).remove();
                    $('#fullwidth .one-part').show();
                    $('#fullwidth').removeClass('tablet-response');
                }
                }


                setTimeout(function() {
                    $('.trending-posts ul, .newsroll ul.one-parts-height').height('20px');
                    $('.newsroll ul.two-parts-height').height((((($('#main').width() - 20) * 0.25 ) - 20 ) / 0.9));
                    $('#fullwidth').masonry().masonry('reloadItems');
                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 1500);
                }, 100);

            }}
            checkWidth();
            $(window).resize(checkWidth);

        //ticker

        function tick() {
            var first_tick = $("ul.ticker-list li:first").width();
            $("ul.ticker-list li:first").animate({
                marginLeft: -first_tick
            }, 800, function() {
                $(this).detach().appendTo("ul.ticker-list").removeAttr("style");
                var first_tick = $("ul.ticker-list li:first").width();
            });
        }

        function tak() {
            var last_tick = $("ul.ticker-list li:last-child").width();
            $("ul.ticker-list li:first").animate({
                marginLeft: last_tick
            }, 800, function() {
                $("ul.ticker-list li:last-child").detach().prependTo("ul.ticker-list");
                $("ul.ticker-list li").removeAttr("style");
                var last_tick = $("ul.ticker-list li:last-child").width();
            });
        }
        $('.ticker-right').click(function() {
            tick();
        });
        $('.ticker-left').click(function() {
            tak();
        });

        var interval = setInterval(tick, 5000);

        $('ul.ticker-list li, .ticker-left, .ticker-right').hover(function() {
            clearInterval(interval);
        }, function() {
            interval = setInterval(tick, 5000);
        });

 		$(window).load(function() {
        function ticket_width() {
            $('#ticker-list-box').css('width', $('#ticker').width() - $('.ticker-heading').outerWidth() - 20);
        }
        ticket_width();
        $(window).resize(ticket_width);
		});

        //share-icons

        function sharewidthresponsive() {
            var sharewidthfull = $('.share-post').outerWidth(true);
            var sharewidth = $('.share-title').outerWidth(true);
            $('.share-post ul').css('width', sharewidthfull - sharewidth - 2);
        };
        sharewidthresponsive();
        $(window).resize(sharewidthresponsive);

        //fixed-menu
        var aboveHeight = $('#nav-wrapper').offset().top - $('#wpadminbar').height();
        $(window).scroll(function() {
            if ($(window).scrollTop() > aboveHeight) {
                $('.show-menu').addClass('fixed-menu').trigger('menuchanged');
            } else {
                $('.show-menu').removeClass('fixed-menu').trigger('menuchanged');
            }
        });


        //fixed-floating-share
        if ($('.floating-share-icons').length) {
        $('.floating-share-icons').height($('#post-content').height() + $('.title-and-subtitle-wrap').height());
        $(window).scroll(function() {
        $('.floating-share-icons').height($('#post-content').height() + $('.title-and-subtitle-wrap').height());
        var above = ($('.floating-share-icons').offset().top) - ($('#wpadminbar').height() + $('#nav-wrapper .fixed-menu').height());

            if ($(window).scrollTop() - above + 20 > 0 && ($(window).scrollTop() - above) - ($('.title-and-subtitle-wrap').height() + $('#post-content').height() - $('.floating-share-icons ul').height() - $('#wpadminbar').height() + 20) < 0){

                    $('.floating-share-icons ul').css('position','fixed').css('top', $('#nav-wrapper .fixed-menu').height() + $('#wpadminbar').height() + 20).css('bottom', 'auto');

            } else if ($(window).scrollTop() - above > 0 && ($(window).scrollTop() - above) - ($('.title-and-subtitle-wrap').height() + $('#post-content').height() - $('.floating-share-icons ul').height() - $('#wpadminbar').height() - 20) > 0) {

                    $('.floating-share-icons ul').css('position','absolute').css('top','auto').css('bottom', -20);
            }else{
                $('.floating-share-icons ul').css('position','absolute').css('top', 0).css('bottom', 'auto');
            }
        });
        }


        //sidebar height

        function sidebarheight() {
            $(window).load(function() {
                var fullsize = $('#wrapper').width();
                var primaryheight = $('#primary').height();
                if (fullsize > 1024) {
                    $('#secondary').css('min-height', primaryheight);
                } else {
                    $('#secondary').css('min-height', 0);
                }

            });
        }
		$(window).load(function() {
			setTimeout(function() {
                         sidebarheight();
                    }, 500);

		});
        $(window).resize(sidebarheight);

        //fixed-sidebar-last widget

        $(window).load(function() {
            if ($('#secondary.stickylastwidget .home-widget:last-child').length) {

                var widgetaboveHeight = $('#secondary .home-widget:last-child ').offset().top - ($('#wpadminbar').height() + $('#nav-wrapper .show-menu').height());
                if ($('#navigation').hasClass('show-menu')) {
                    $('#secondary .home-widget:last-child').addClass('navigation-has-menu');
                }

                var primaryheight = $('#primary').height();
                var secondaryheight = 0;
                $('#secondary .home-widget').each(function() {
                    secondaryheight = $(this).height();
                });


                //fixed widget in #secondary area
                $(window).scroll(function() {

                    if (primaryheight - secondaryheight < 0) {
                        $('#secondary .fixed-widget').css('position', 'relative');
                        $('#secondary .home-widget:last-child ').css('top', '0');

                    } else {
                        if ($(window).scrollTop() > widgetaboveHeight && primaryheight > $('#secondary').height()) {
                            $('#secondary .home-widget:last-child').addClass('fixed-widget');
                        } else {
                            $('#secondary .home-widget:last-child ').removeClass('fixed-widget');
                        }

                        if ($('#footer').offset().top - ($(window).scrollTop() + $('.fullwidth ').not('.popular-part').height() + $('#secondary .home-widget:last-child').height() + $('#navigation.fixed-menu').height() + $('.footer-advert').outerHeight() + 80) < 0) {
                            $('#secondary .home-widget:last-child ').css('top', $('#footer').offset().top - ($(window).scrollTop() + $('.fullwidth ').not('.popular-part').height() + $('#secondary .home-widget:last-child').height() + $('.footer-advert').outerHeight() + 80));
                        } else {
                            $('#secondary .home-widget:last-child ').css('top', '')
                        }
                    }
                });
            };
        });

        function fixedwidgetwidth() {
            var secondarywidth = $('#secondary').width();
            $('#secondary .home-widget:last-child ').css('max-width', secondarywidth);
        }
        fixedwidgetwidth();
        $(window).resize(fixedwidgetwidth);




        //scroll effects

        $(window).scroll(function() {
            var sci1top = $(this).scrollTop();
            var sci1height = $(this).height();
            var sci1bottom = sci1top + sci1height;


            $('#fullwidth .home-widget').each(function() {

                var geget = $(this).offset().top;
                if (sci1bottom > geget && geget > sci1height) {
                    $(this).find('.widget').addClass(widget_fx);
                }

            });


        });

        $(window).load(function() {
            $('.score-line').each(function() {
                    $(this).find('.score-width').addClass('active');
            });
        });



        //carousel
        if ($('.carousel').length) {
            $(window).load(function() {
                $('.carousel').each(function() {

                    function normalcarousel_grid() {
                        return (window.innerWidth < 700) ? carousel_700 :
                            (window.innerWidth < 1024) ? carousel_1024 : carouselitems;
                    }

                    var resizeTimer
                    $(window).resize(function(){
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                    if ($(window).width() < 700 || $(window).width() > 1024 || $(window).width() < 1024 || $(window).width() > 700) {
                          $('.carousel').trigger('res_change');
                    }
                    }, 10);

                    });

                    $('.carousel').on('res_change', function(){
                            $('.carousel').each(function() {
                                $(this).removeData("flexslider");
                                    $(this).flexslider({
                                        animation: 'slide',
                                        itemWidth: 210,
                                        itemMargin: 20,
                                        minItems: normalcarousel_grid(),
                                        maxItems: normalcarousel_grid(),
                                        move: normalcarousel_grid(),
                                        slideshow: false,
                                        controlNav: false,
                                        directionNav: true,
                                        start: function(slider) {
                                            slider.fadeTo(1000, 1);
                                            slider.removeClass('loading');
                                        }
                                    });
                            });
                     });

                    var widget_size = $(this).closest('.home-widget');
                    if ($(widget_size).hasClass('one-part')) {
                        var carouselitems = 1;
                        var carousel_1024 = 1;
                        var carousel_700 = 1;
                    } else if ($(widget_size).hasClass('two-parts')) {
                        var carouselitems = 2;
                        var carousel_1024 = 2.5;
                        var carousel_700 = 1;
                    } else if ($(widget_size).hasClass('three-parts')) {
                        var carouselitems = 3;
                        var carousel_1024 = 2.5;
                        var carousel_700 = 1;
                    } else if ($(widget_size).hasClass('four-parts')) {
                        var carouselitems = 4;
                        var carousel_1024 = 2.5;
                        var carousel_700 = 1;
                    }
                    $(this).flexslider({
                        animation: 'slide',
                        itemWidth: 210,
                        itemMargin: 20,
                        minItems: normalcarousel_grid(),
                        maxItems: normalcarousel_grid(),
                        move: normalcarousel_grid(),
                        slideshow: false,
                        controlNav: false,
                        directionNav: true,
                        start: function(slider) {
                            slider.fadeTo(1000, 1);
                            slider.removeClass('loading');
                        }
                    });
                });
            });
        }


        //tv-widget carousel
        if ($('.tv-ajax-carousel').length) {
            $(window).load(function() {
                $('.tv-ajax-carousel').each(function() {
                    function ajaxcarousel_grid() {
                        return (window.innerWidth < 700) ? carousel_700 :
                            (window.innerWidth < 1024) ? carousel_1024 : carouselitems;
                    }

                    var resizeTimer
                    $(window).resize(function(){
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                    if ($(window).width() < 700 || $(window).width() > 1024 || $(window).width() < 1024 || $(window).width() > 700) {
                          $('.tv-ajax-carousel').trigger('res_change');
                    }
                    }, 10);

                    });

                    $('.tv-ajax-carousel').on('res_change', function(){
                            $('.tv-ajax-carousel').each(function() {
                                $(this).removeData("flexslider");
                                    $(this).flexslider({
                                        animation: 'slide',
                                        itemWidth: 210,
                                        itemMargin: 20,
                                        minItems: ajaxcarousel_grid(),
                                        maxItems: ajaxcarousel_grid(),
                                        move: ajaxcarousel_grid(),
                                        slideshow: false,
                                        controlNav: false,
                                        directionNav: true,
                                        start: function(slider) {
                                            slider.fadeTo(1000, 1);
                                            slider.removeClass('loading');
                                        }
                                    });
                            });
                     });


                    var widget_size = $(this).closest('.home-widget');
                    if ($(widget_size).hasClass('one-part')) {
                        var carouselitems = 2;
                        var carousel_1024 = 2;
                        var carousel_700 = 2;
                    } else if ($(widget_size).hasClass('two-parts')) {
                        var carouselitems = 3;
                        var carousel_1024 = 3;
                        var carousel_700 = 2;
                    } else if ($(widget_size).hasClass('three-parts')) {
                        var carouselitems = 4;
                        var carousel_1024 = 3;
                        var carousel_700 = 2;
                    } else if ($(widget_size).hasClass('four-parts')) {
                        var carouselitems = 6;
                        var carousel_1024 = 3;
                        var carousel_700 = 2;
                    }
                    $(this).flexslider({
                        animation: 'slide',
                        itemWidth: 210,
                        itemMargin: 20,
                        minItems: ajaxcarousel_grid(),
                        maxItems: ajaxcarousel_grid(),
                        move: ajaxcarousel_grid(),
                        slideshow: false,
                        controlNav: false,
                        directionNav: true,
                        start: function(slider) {
                            slider.fadeTo(1000, 1);
                            slider.removeClass('loading');
                        }
                    });
                });
               });

        }


        //video type page carousel
        if ($('.tv-carousel').length) {
            var tv_carousel;



            $(window).load(function() {
                function tv_carousel_grid() {
                    return (window.innerWidth < 700) ? 3 :
                        (window.innerWidth < 1024) ? 4 : 5;
                }
                $('.tv-carousel').flexslider({
                    animation: 'slide',
                    itemWidth: 210,
                    itemMargin: 15,
					useCSS: false,
                    minItems: tv_carousel_grid(),
                    maxItems: tv_carousel_grid(),
                    move: tv_carousel_grid(),
                    slideshow: false,
                    controlNav: false,
                    directionNav: true,
                    start: function(slider) {
                        tv_carousel = slider;
                    },
                    after: function(slider) {
                        tv_carousel.resize();
                    }
                });

                $(window).resize(function() {
                    var gridSize = tv_carousel_grid();
                    tv_carousel.vars.minItems = gridSize;
                    tv_carousel.vars.maxItems = gridSize;
                });


            });
        }


        //type pages ajax
        $('.term-post-format-video').on('click', '.ajax', function(e) {
            e.preventDefault();
            var post_id = $(this).attr("data-number");

            jQuery.ajax({
                post: post_id,
                type: "POST",
                data: {
                    id: post_id
                },
                success: function(output) {
                    $(".tv-video-wrapper").replaceWith($('.tv-video-wrapper', output));
                    $(".tv-format-title").replaceWith($('.tv-format-title', output));
                    $(".tv-format-subtitle").replaceWith($('.tv-format-subtitle', output));
                }
            });
        });



        $(window).load(function() {
            $('.term-post-format-gallery').on('click', '.ajax', function(e) {
                e.preventDefault();
                var post_id = $(this).attr("data-number");

                jQuery.ajax({
                    post: post_id,
                    type: "POST",
                    data: {
                        id: post_id
                    },
                    success: function(output) {
                        $(".tv-video-wrapper").replaceWith($('.tv-video-wrapper', output));
                        $(".tv-format-title").replaceWith($('.tv-format-title', output));
                        $(".tv-format-subtitle").replaceWith($('.tv-format-subtitle', output));
                        $('.post-page-gallery-thumbnails').flexslider({
                            animation: 'slide',
                            controlNav: false,
                            animationLoop: false,
                            slideshow: false,
                            itemWidth: 166,
                            itemMargin: 0,
                            minItems: 4,
                            maxItems: 4,
                            move: 4,
                            directionNav: true,
                            asNavFor: '.post-page-gallery-slider',
                            start: function(slider) {
                                slider.fadeTo(1000, 1);
                                slider.removeClass('loading');
                            }
                        });

                        $('.post-page-gallery-slider').flexslider({
                            animation: slide_picker,
                            controlNav: false,
                            animationLoop: false,
                            slideshow: false,
                            sync: '.post-page-gallery-thumbnails',
                            start: function(slider) {
                                slider.fadeTo(1000, 1);
                                slider.removeClass('loading');
                            }
                        });
                    }
                });
            });
        });

        $('.term-post-format-video, .term-post-format-gallery').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            $('.tv-page-widget').append('<div class="more-posts"></div>');
            $('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $('.more-posts').load(link + ' .tv-page-widget li, .pagination', function() {
                $('.more-posts li').hide().detach().appendTo('.tv-page-widget ul').fadeIn(500);
                $('.more-posts .pagination').detach().appendTo('.tv-page-widget');
                $('.more-posts').remove();
                $('.load-content').remove();

            });
        });

        $('.archive #primary, .blog #primary').on('click', '.pagination a', function(e) {
            e.preventDefault();
            var link = $(this).attr('href');

            $('#blog-list').append('<div class="more-posts"></div>');
            $('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $('.more-posts').load(link + ' #blog-list li, .pagination', function() {
                $('.more-posts li').hide().detach().appendTo('#blog-list ul').fadeIn(500);
                $('.more-posts .pagination').detach().appendTo('#blog-list');
                $('.more-posts').remove();
                $('.load-content').remove();

            });
        });


        //keyboard navigation next prev
        $(document).keydown(function(e) {
            var url = false;
            if (e.which == 37) { // Left arrow key code
                url = $('.previous-title a').attr('href');
            } else if (e.which == 39) { // Right arrow key code
                url = $('.next-title a').attr('href');
            }
            if (url) {
                window.location = url;
            }
        });

        //menu button for responsive mobile


        $("#mob-menu .mob-menu-button").click(function() {
            $("#main-nav ul, #navigation").toggleClass("active");
            $('#mob-menu').toggleClass("active");
            $('body').toggleClass("mob-menu-active");

        });


        //super slider

        function superslidermargin() {
            $('.fullwidth-ticker, .fullwidth-image, .fullwidth-super-slider').css('max-width', $(window).width());
            $('.fullwidth-ticker, .fullwidth-image, .fullwidth-super-slider').css('margin-left', -($('#main').offset().left + 10));
        };
        superslidermargin();
        $(window).load(function() {superslidermargin();});
        $(window).resize(superslidermargin);






        if ($('.super-slider').length) {
            $(window).load(function() {
                $('.super-slider').flexslider({
                    animation: slide_picker,
                    useCSS: false,
                    slideshowSpeed: 6000,
                    controlNav: true,
                    directionNav: true,
                    pauseOnHover: true,
                    //easing: 'easeOutElastic',
                    start: function(slider) {
                        $('.loading').fadeTo(1000, 1);
                        slider.removeClass('loading');
                    },
                });
            });
}




        //wide slider


        $(window).load(function() {
            $('.wide-slider').each(function() {


                var widget_id = $(this).closest('.widget').attr('id');
                var widget_id_p = '#' + widget_id;
                var widget_id_x = '.' + widget_id;
                $(widget_id_p).find('.wide-slider-control li').addClass(widget_id);

                $(this).flexslider({
                    animation: slide_picker,
                    slideshowSpeed: 8000,
                    manualControls: $(widget_id_x),
                    controlNav: true,
                    directionNav: true,
                    pauseOnHover: true,
                    start: function(slider) {
                        $('.slider-container').fadeTo("fast", 1);
                        $('.wide-slider-control').fadeTo("fast", 1);
                    }
                });
            });
        });

        //Gallery slider
        $(window).load(function() {
            $('.post-page-gallery-thumbnails').flexslider({
                animation: 'slide',
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 166,
                itemMargin: 0,
                minItems: 4,
                maxItems: 4,
                move: 4,
                directionNav: true,
                asNavFor: '.post-page-gallery-slider',
                start: function(slider) {
                    slider.fadeTo(1000, 1);
                    slider.removeClass('loading');
                }
            });

            $('.post-page-gallery-slider').flexslider({
                animation: slide_picker,
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: '.post-page-gallery-thumbnails',
                start: function(slider) {
                    slider.fadeTo(1000, 1);
                    slider.removeClass('loading');
                }

            });
        });

        //super-menu scripts
        $('#header .menu-item-has-children').append('<span class="subsignmeni"></span>');
        function mobile_menu_sub(){
                    if ($(window).width() < 700) {
                         $('.subsignmeni').off().on('click' , function() {
                            $(this).prev('.sub-menu-wrapper, .sub-meni').slideToggle(100).toggleClass('mob-cat');
                        });
                }
        }
        mobile_menu_sub();
        $(window).resize(mobile_menu_sub);


    function hover_intent_menu(){
		function mousein_triger(){
        if ($(window).width() > 700) {
			$(".menu-item").removeClass("active");
			$(this).addClass("active");
			$(this).find('.sub-menu-wrapper').css('visibility', 'hidden').show();
			$(this).find('.sub-menu-wrapper').height($(this).find('.sub-menu').height());
            $(this).find('.sub-menu-wrapper').css('min-height', $(this).find('.menu-links.inside-menu').outerHeight());
			$(this).find('.sub-menu-wrapper').css('visibility', 'visible').hide();
			$(this).children('.sub-menu-wrapper, .sub-meni').fadeIn(150);
		}else{
            $('.menu-item').removeClass('active');
            $('.sub-menu-wrapper').removeAttr( 'style' );
        }}
		function mouseout_triger() {
        if ($(window).width() > 700){
            $(this).children('.sub-menu-wrapper, .sub-meni').fadeOut(150);
		}}
		var settings = {
			sensitivity: 4,
			interval: 150,
			timeout: 300,
			over: mousein_triger,
			out:mouseout_triger

		};
		$('.menu-item').not( '.inside-menu .menu-item' ).hoverIntent( settings );


        var settings1 = {
            sensitivity: 4,
            interval: 0,
            timeout: 300,
            over: mousein_triger,
            out:mouseout_triger

        };

        $( '.inside-menu .menu-item' ).hoverIntent( settings1 );
        }


        hover_intent_menu();
        $(window).resize(hover_intent_menu);


//autoload for all
$(window).scroll(function() {
    $('.auto-load').each(function() {
                var loadHeight = $(this).offset().top;
                if ($(window).scrollTop() > loadHeight - $(window).height() ) {
                   $(this).find('a').trigger( "click" );
                }
            });
    });



//load more for blogroll1
 if ($('.widget_blog_category_sci1 .pagination').length) {

        $('.widget_blog_category_sci1').off().on('click', '.pagination a', function(e) {
            e.preventDefault();

            var parent = $(this).parents('.widget_blog_category_sci1').attr('id');
            parent = '#' + parent;
            var link = $(this).attr('href');

            $(parent+'.widget_blog_category_sci1').append('<div class="more-posts"></div>');
            $(parent).find('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $(parent).find('.more-posts').load(link + ' '+ parent +' .blog-category li, '+ parent +' .pagination', function() {
                $(parent).find('.more-posts li').hide().detach().appendTo(parent+' .blog-category ul').fadeIn(1000);
                $(parent).find('.more-posts .pagination').detach().appendTo(parent+' .blog-category');
                $(parent).find('.more-posts').remove();
                $(parent).find('.load-content').remove();
                if ($('#fullwidth').length) {
                    $('#fullwidth').masonry().masonry('reloadItems');
                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 500);
                }
            });
        });
    }


//load more for blogroll2
 if ($('.widget_blog_category_two_sci1 .pagination').length) {

        $('.widget_blog_category_two_sci1').off().on('click', '.pagination a', function(e) {
            e.preventDefault();

            var parent = $(this).parents('.widget_blog_category_two_sci1').attr('id');
            parent = '#' + parent;
            var link = $(this).attr('href');

            $(parent+'.widget_blog_category_two_sci1').append('<div class="more-posts"></div>');
            $(parent).find('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $(parent).find('.more-posts').load(link + ' '+ parent +' .blogroll2 li, '+ parent +' .pagination', function() {
                $(parent).find('.more-posts li').hide().detach().appendTo(parent+' .blogroll2 ul').fadeIn(1000);
                $(parent).find('.more-posts .pagination').detach().appendTo(parent+' .blogroll2');
                $(parent).find('.more-posts').remove();
                $(parent).find('.load-content').remove();
                if ($('#fullwidth').length) {
                    $('#fullwidth').masonry().masonry('reloadItems');
                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 500);
                }
            });
        });
    }


//load more for featured big images
 if ($('.widget_img_featured_category_sci1 .pagination').length) {

        $('.widget_img_featured_category_sci1').off().on('click', '.pagination a', function(e) {
            e.preventDefault();

            var parent = $(this).parents('.widget_img_featured_category_sci1').attr('id');
            parent = '#' + parent;
            var link = $(this).attr('href');

            $(parent+'.widget_img_featured_category_sci1').append('<div class="more-posts"></div>');
            $(parent).find('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $(parent).find('.more-posts').load(link + ' '+ parent +' .img-featured-category.big li, '+ parent +' .pagination', function() {
                $(parent).find('.more-posts li').hide().detach().appendTo(parent+' .img-featured-category.big ul').fadeIn(1000);
                $(parent).find('.more-posts .pagination').detach().appendTo(parent+' .img-featured-category.big');
                $(parent).find('.more-posts').remove();
                $(parent).find('.load-content').remove();
                if ($('#fullwidth').length) {
                    $('#fullwidth').masonry().masonry('reloadItems');
                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 500);
                }
            });
        });
    }

//load more for featured huge images
 if ($('.widget_huge_img_featured_category_sci1 .pagination').length) {

        $('.widget_huge_img_featured_category_sci1').off().on('click', '.pagination a', function(e) {
            e.preventDefault();

            var parent = $(this).parents('.widget_huge_img_featured_category_sci1').attr('id');
            parent = '#' + parent;
            var link = $(this).attr('href');

            $(parent+'.widget_huge_img_featured_category_sci1').append('<div class="more-posts"></div>');
            $(parent).find('.pagination').replaceWith('<div class="load-content"><div class="load-circle"></div></div>');
            $(parent).find('.more-posts').load(link + ' '+ parent +' .img-featured-category.huge li, '+ parent +' .pagination', function() {
                $(parent).find('.more-posts li').hide().detach().appendTo(parent+' .img-featured-category.huge ul').fadeIn(1000);
                $(parent).find('.more-posts .pagination').detach().appendTo(parent+' .img-featured-category.huge');
                $(parent).find('.more-posts').remove();
                $(parent).find('.load-content').remove();
                if ($('#fullwidth').length) {
                    $('#fullwidth').masonry().masonry('reloadItems');
                    setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');}, 500);
                }
            });
        });
    }



        $(window).load(function() {
            $('.popular-slider').flexslider({
                    animation: 'fade',
                    slideshowSpeed: 6000,
                    animationSpeed: 200,
                    manualControls: '.popular-slider-control li',
                    controlNav: true,
                    directionNav: false,
                    pauseOnHover: true,
            });

            $('.popular-slider-control li').on('mouseover',function(){
                 $(this).trigger('click');
            });
            $('.popular-slider-control li a').on('click',function(){
                window.location = $(this).attr('href');
            });

            var touchmoved;
             $('.popular-slider-control li a').on('touchend', function(e){
                if(touchmoved != true){
                    window.location = $(this).attr('href');
                }
            }).on('touchmove', function(e){
                touchmoved = true;
            }).on('touchstart', function(){
                touchmoved = false;
            });

        });


if ($('.latest-posts-menu').length) {
    $('.latests-posts-button-number').click(function(e) {
        e.preventDefault();
        $('.latest-posts-menu').slideToggle(400);
    });

    $('.show-menu').on('menuchanged', function () {
        $('.latest-posts-menu').slideUp(400);
    });
}

 //smart ones



        if ($('#fullwidth').length) {
        function smartblocks(){
        setTimeout(function() {

        $('#fullwidth .newsroll').each(function(){
        var $tdiv = $(this).parents('.home-widget');
        var $nex = $('.home-widget').filter(function() {
            return $(this).offset().top >= ($tdiv.offset().top + $tdiv.height()) && $(this).offset().left - $tdiv.offset().left <= 0
        }).eq(0);



        if ($nex.length) {
            var additionHeight = $nex.offset().top - ($tdiv.offset().top + $tdiv.height()) + $tdiv.find('.newsroll ul').height();
            $tdiv.find('.newsroll ul').height(additionHeight);
         }else{
            var $nex = $('#footer');
            var additionHeight = $nex.offset().top - ($tdiv.offset().top + $tdiv.height()) + $tdiv.find('.newsroll ul').height();
            $tdiv.find('.newsroll ul').height(additionHeight - 50 );
         }
        });


        $('#fullwidth .trending-posts').each(function(){
        var $tdiv = $(this).parents('.home-widget');
        var $nex = $('.home-widget').filter(function() {
            return $(this).offset().top >= ($tdiv.offset().top + $tdiv.height()) && $(this).offset().left - $tdiv.offset().left <= 0
        }).eq(0);
        if ($nex.length) {
            var additionHeight = $nex.offset().top - ($tdiv.offset().top + $tdiv.height()) + $tdiv.find('.trending-posts ul').height();
            $tdiv.find('.trending-posts ul').height(additionHeight);
         }else{
            var $nex = $('#footer');
            var additionHeight = $nex.offset().top - ($tdiv.offset().top + $tdiv.height()) + $tdiv.find('.trending-posts ul').height();
            $tdiv.find('.trending-posts ul').height(additionHeight - 50 );
         }
        });

        }, 100);
        }

        $('.newsroll ul.two-parts-height').height($('#main').width() / 2.86 );

        if ($(window).width() < 1024) {
            $('.trending-posts ul, .newsroll ul.one-parts-height, .newsroll ul.two-parts-height').height('320px');
        }else{
             smartblocks();
                 $(window).load(function() {
             setTimeout(function() {$('#fullwidth').masonry().masonry('reloadItems');smartblocks();}, 1000);
             });
        }

        var resizeTimer;

        $(window).on('resize', function(e) {

                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(function() {
                         if ($(window).width() < 1024) {
                            $('.trending-posts ul, .newsroll ul.one-parts-height, .newsroll ul.two-parts-height').height('320px');
                        }else{
                            smartblocks();
                        }
                     }, 100);
        });
        }


    });
