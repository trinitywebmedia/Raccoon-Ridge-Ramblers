(function ($){

	var screen_height = $(window).height();
	var screen_width = $(window).width();
	var nonce = $('.load_more_label').attr('data-nonce');
	var category = $('.load_more_label').attr('data-category');
	var set_height = $( ".zp_shop_content" ).data( "row" );
	var set_title = $( ".zp_shop_container" ).data( "title" );
	var w = i = 0;

	item_height = screen_height / set_height;

	var num_items = jQuery(".zp_shop_content li.type-product").length;
	num_col = Math.floor( num_items / set_height );
	if( ( num_items % set_height ) != 0 ){
		num_col = num_col + 1;
	}

	if( screen_width > 768 ){
		label_width = screen_width / 3;
	}else{
		label_width = screen_width / 2;
	}
	cover_label = screen_width / 2;
	
	if( set_title == 1 ){
		width = ( label_width * ( Math.floor(num_col) ) ) + cover_label;
	}else{
		width = ( label_width * ( Math.floor(num_col) ) );
	}

	if(  screen_width > 599 ){
		$( ".zp_shop_content li.type-product" ).css({ "width": label_width+"px" });
		$( ".zp_shop_wrap" ).css({ "width": (width + 18)+"px", "height": screen_height+"px" });
		$( ".zp_shop_content" ).css({ "height": screen_height+"px", "width": ( label_width * num_col  )+"px" });
		$( ".zp_shop_header" ).css({ "height": screen_height+"px", "width":cover_label+"px" });
		$( ".zp_shop_content li.type-product" ).css({ "height": item_height+"px" });
	}else{
		$( ".zp_shop_content li.type-product" ).css({ "width": "100%" });
		$( ".zp_shop_wrap" ).css({ "width": "100%", "height": "100%" });
		$( ".zp_shop_content" ).css({ "height": "100%", "width": "100%" });
		$( ".zp_shop_header" ).css({ "height": "600px", "width": "100%" });
		$( ".zp_shop_content li.type-product" ).css({ "height": "600px" });
	}

	$(".site-inner").niceScroll({ autohidemode:"leave" });

	if(  screen_width > 599 ){
		$('.zp_shop_content li.type-product').each(function(){		
			i++;
			if( set_height == 2 ){
				if( i % set_height == 0  ){
					$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+item_height+"px, 0px)", "top":"0", "left": "0" });
					w +=  label_width;
				}else{
					$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,0px, 0px)", "top":"0", "left": "0" });
				}
			}

			if( set_height == 3 ){
				if( i % set_height == 0  ){
					$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+(item_height*2)+"px, 0px)", "top":"0", "left": "0" });
					w +=  label_width;
				}else if( i % set_height == 2 ){
					$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+item_height+"px, 0px)", "top":"0", "left": "0" });
				}else{
					$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,0px, 0px)", "top":"0", "left": "0" });
				}
			}

		});
	}


	$('.load_more_posts .load_more_wrap').on( 'click', function( event ) {
		var offset = $('.zp_shop_content li.type-product').length-1;
		$.ajax({
			type : "post",
			context: this,
			dataType : "json",
			url : zp_load_more.ajaxurl,
			data : {action: "zp_load_products",offset:offset,nonce:nonce, category:category },
			beforeSend: function(data) {
				// here u can do some loading animation...
				$('.load_more_posts .load_more_wrap .load_more_label').text( zp_load_more.loading );
			},
			success: function(response) {
				console.log( response['have_posts']  );
				if (response['have_posts'] == 1){//if have posts:
					$('.load_more_posts .load_more_wrap .load_more_label').text( zp_load_more.load_posts );
					var newElems = jQuery(response['html'].replace(/(\r\n|\n|\r)/gm, ''));
					jQuery('.load_more_posts').before( newElems );
				} else {
					//end of posts (no posts found)
					$('.load_more_posts .load_more_wrap .load_more_label').addClass('end_of_posts').text(zp_load_more.end_of_post);
				}
			},
			complete: function(){
		    	var screen_height = $(window).height();
				var screen_width = $(window).width();
				var nonce = $('.load_more_label').attr('data-nonce');
				var set_height = $( ".zp_shop_content" ).data( "row" );
				var w = i = 0;

				item_height = screen_height / set_height;

				var num_items = jQuery(".zp_shop_content li.type-product").length;
				num_col = Math.floor( num_items / set_height );
				if( ( num_items % set_height ) != 0 ){
					num_col = num_col + 1;
				}

				if( screen_width > 768 ){
					label_width = screen_width / 3;
				}else{
					label_width = screen_width / 2;
				}
				cover_label = screen_width / 2;
				if( set_title == 1 ){
					width = ( label_width * ( Math.floor(num_col) ) ) + cover_label;
				}else{
					width = ( label_width * ( Math.floor(num_col) ) );
				}

				if(  screen_width > 599 ){
					$( ".zp_shop_content li.type-product" ).css({ "width": label_width+"px" });
					$( ".zp_shop_wrap" ).css({ "width": (width + 18)+"px", "height": screen_height+"px" });
					$( ".zp_shop_content" ).css({ "height": screen_height+"px", "width": ( label_width * num_col  )+"px" });
					$( ".zp_shop_header" ).css({ "height": screen_height+"px", "width":cover_label+"px" });
					$( ".zp_shop_content li.type-product" ).css({ "height": item_height+"px" });
				}else{
					$( ".zp_shop_content li.type-product" ).css({ "width": "100%" });
					$( ".zp_shop_wrap" ).css({ "width": "100%", "height": "100%" });
					$( ".zp_shop_content" ).css({ "height": "100%", "width": "100%" });
					$( ".zp_shop_header" ).css({ "height": "600px", "width": "100%" });
					$( ".zp_shop_content li.type-product" ).css({ "height": "600px" });
				}

				$(".site-inner").niceScroll({ autohidemode:"leave" });

				if(  screen_width > 599 ){
					$('.zp_shop_content li.type-product').each(function(){		
						i++;
						if( set_height == 2 ){
							if( i % set_height == 0  ){
								$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+item_height+"px, 0px)", "top":"0", "left": "0" });
								w +=  label_width;
							}else{
								$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,0px, 0px)", "top":"0", "left": "0" });
							}
						}

						if( set_height == 3 ){
							if( i % set_height == 0  ){
								$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+(item_height*2)+"px, 0px)", "top":"0", "left": "0" });
								w +=  label_width;
							}else if( i % set_height == 2 ){
								$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,"+item_height+"px, 0px)", "top":"0", "left": "0" });
							}else{
								$(this).css({"position":"absolute", "transform":"translate3d("+w+"px,0px, 0px)", "top":"0", "left": "0" });
							}
						}

					});
				}

		    }
		});
	});

})(jQuery);
