// Custom Script

(function ($){

	$(document).ready(function() {

		// window width
		var screen_width = $( window ).width();

		// Toggle Menu
		$( '.menu-trigger' ).click(function(){
			if( $('body').hasClass( 'show_header' ) ){
				$('body').removeClass( 'show_header' );
				$( '.menu-trigger .dashicons' ).removeClass( 'dashicons-no-alt' );
				$( '.menu-trigger .dashicons' ).addClass( 'dashicons-menu' );
			}else{
				$('body').addClass( 'show_header' );
				$( '.menu-trigger .dashicons' ).addClass( 'dashicons-no-alt' );
				$( '.menu-trigger .dashicons' ).removeClass( 'dashicons-menu' );
			}
		});

		// Hide the menu-trigger when hover on menu item
		$( '.genesis-nav-menu li' ).mouseover(function(){
			$( '.menu-trigger' ).css({ "opacity":"0", "visibility":"hidden" });
		});
		$( '.genesis-nav-menu li' ).mouseout(function(){
			$( '.menu-trigger' ).css({ "opacity":"1", "visibility":"visible" });
		});

		// Add indicator to menu item
		$('.nav-secondary .menu li, .nav-primary .menu li').each(function(){
			if( jQuery(this).children('ul.sub-menu').length > 0 ){
				jQuery(this).children('a').after('<span class="indicator"><i class="indicator_close fa fa-plus"></i><i class="indicator_open fa fa-minus"></i></span>');	
			}
		});

		$('.nav-secondary .menu li span.indicator, .nav-primary .menu li span.indicator').click(function(){
			if( $(this).children('i.indicator_close').is(':visible') ){
				$(this).children('i.indicator_close').hide();
				$(this).children('i.indicator_open').show();
				$(this).parent('li').children('ul.sub-menu').addClass('mobile_style');
			}else{
				$(this).children('i.indicator_close').show();
				$(this).children('i.indicator_open').hide();
				$(this).parent('li').children('ul.sub-menu').removeClass('mobile_style');
			}			
		});		
	
        //nice scroll
        $("html, .zp_portfolio_container").niceScroll({ autohidemode:"leave" });
        if( screen_width <= 1024 ){
        	$(".site_header").niceScroll({ autohidemode:"leave" });
        }

        //Accordion
		$( '.accordion_header' ).click( function(){
			
			if( $(this).parent( '.accordion_item' ).hasClass( 'active' ) ){
				$( '.accordion_item .accordion_content' ).slideUp();
				$(this).parent( '.accordion_item' ).removeClass( 'active' );
				$(this).parent( '.accordion_item' ).children( '.accordion_content' ).slideUp(500);
			}else{
				$( '.accordion_item .accordion_content' ).slideUp();
				$( '.accordion_item' ).removeClass( 'active' );
				$(this).parent( '.accordion_item' ).addClass( 'active' );
				$(this).parent( '.accordion_item' ).children( '.accordion_content' ).slideDown();
			}
		});

		//Toggle
		$( '.toggle_header' ).click( function(){			
			if( $(this).parent( '.toggle_item' ).hasClass( 'active' ) ){
				$(this).parent( '.toggle_item' ).removeClass( 'active' );
				$(this).parent( '.toggle_item' ).children( '.toggle_content' ).slideUp(500);
			}else{
				$(this).parent( '.toggle_item' ).addClass( 'active' );
				$(this).parent( '.toggle_item' ).children( '.toggle_content' ).slideDown();
			}
		});

		//Tabs
		$( '.tab_content .tab_pane' ).hide();
		var tab_active = $( '.tab_nav li.active a' ).attr('href');
		$( '.tab_content '+tab_active ).show();
		$( '.tab_nav li a' ).click( function(e){
			e.preventDefault();
			var tab_id = $(this).attr( 'href' );

			$( '.tab_nav li' ).removeClass( 'active' );
			$( this ).parent( 'li' ).addClass( 'active' );
			$( '.tab_content .tab_pane' ).hide();
			$( tab_id ).show();
		});
    });

	$( window ).load(function() {
		$( '.content_loader' ).fadeOut();
		$( 'main.content' ).fadeIn();
	});

})(jQuery);