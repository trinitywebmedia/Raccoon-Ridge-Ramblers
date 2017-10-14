jQuery( function( $ ){
	$( '.postbox-container' ).on( 'click', '.remove_button', function(e) {
		$(this).parents( 'p' ).find( 'input[type="text"]' ).val( '' );
		$(this).parents( 'p' ).find( '.button' ).show();
		$( this ).parents( 'p' ).find( '.upload_preview img' ).attr( 'src', '' );
	});
	$( '.postbox-container' ).on( 'click', '.upload_button', function() {
		console.log('here');
		var old_send_to_editor = wp.media.editor.send.attachment;
		var input = this;
		wp.media.editor.send.attachment = function( props, attachment ) {
			//props.size = 'medium';
			props = wp.media.string.props( props, attachment );
			props.align = null;
			$(input).parents( 'p' ).find( 'input[type="text"]' ).val( props.src );
			$( input ).parents( 'p' ).find( '.upload_preview img' ).attr( 'src', props.src );
			wp.media.editor.send.attachment = old_send_to_editor;
		}
		wp.media.editor.open( input );
	} );

	//COlorpicker
	$( '.portfolio_archive_overlay, .portfolio_archive_text, .portfolio_archive_color, .default_overlay, .default_text, .default_color' ).wpColorPicker();

	// Portfolio layout Selector
	$( '.zp_portfolio_layout_selector label' ).each(function(){
		if( $(this).find( 'input[type="radio"]' ).is(':checked') ){			
			var id_test = $(this).find( 'input[type="radio"]' ).attr( 'id' );
			$( '#'+id_test ).parent('.box').addClass('selected');
		}
	});

	$(".zp_portfolio_layout_selector").on("change.zp_portfolio_layout_selector", "label", function( event ){
		var selectedClass = "selected";
		$('input[name="' + jQuery(event.target).attr("name") + '"]').parent("label").removeClass(selectedClass), jQuery(event.currentTarget).addClass(selectedClass);
	});

	// Blog Layout Selector
	$( '.zp_blog_layout_selector' ).each(function(){
		if( $(this).find( 'input[type="radio"]' ).is(':checked') ){			
			var id_test = $(this).find( 'input[type="radio"]' ).attr( 'id' );
			$( '#'+id_test ).parent('.box').addClass('selected');
		}
	});

	$(".zp_blog_layout_selector").on("change.genesis.zp_blog_layout_selector", "label", function( event ){
		var selectedClass = "selected";
		$('input[name="' + jQuery(event.target).attr("name") + '"]').parent("label").removeClass(selectedClass), jQuery(event.currentTarget).addClass(selectedClass);
	});

	// Shop Layout Selector
	$( '.zp_shop_layout_selector' ).each(function(){
		if( $(this).find( 'input[type="radio"]' ).is(':checked') ){			
			var id_test = $(this).find( 'input[type="radio"]' ).attr( 'id' );
			$( '.zp_shop_layout_selector #'+id_test ).parent('.box').addClass('selected');
		}
	});

	$(".zp_shop_layout_selector").on("change.zp_shop_layout_selector", "label", function( event ){
		var selectedClass = "selected";
		$('input[name="' + jQuery(event.target).attr("name") + '"]').parent("label").removeClass(selectedClass), jQuery(event.currentTarget).addClass(selectedClass);
	});
} );
