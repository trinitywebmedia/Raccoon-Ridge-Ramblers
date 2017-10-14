(function ($){

	var screen_height = $(window).height();
	var screen_width = $(window).width();	
	var num_items = $("#infinite-content article.type-post").length;
	var set_height = $("#infinite-content").data('row');
	var nonce = $('.load_more_label').attr('data-nonce');
	var type = $('.load_more_label').attr('data-type');
	var value = $('.load_more_label').attr('data-value');
	var item_height = screen_height / set_height;
	var w = i = 0;
	
	num_col = Math.floor( num_items / set_height );
	if( ( num_items % set_height ) != 0 ){
		num_col = num_col + 1;
	}

	if( screen_width > 768 ){
		label_width = screen_width / 3;
	}else{
		label_width = screen_width / 2;
	}
	width = ( label_width * ( Math.floor(num_col) ) );

	if(  screen_width > 599 ){
		$( ".content-sidebar-wrap" ).css({ "width": ( width + 18 )+"px", "height": screen_height+"px" });
		$( "#infinite-content" ).css({ "width": width+"px", "height": screen_height+"px" });
		$( "#infinite-content article.type-post" ).css({ "width": label_width+"px", "height": item_height+"px" });

		$(".site-inner").niceScroll({ autohidemode:"leave" });
	}else{
		$( ".content-sidebar-wrap" ).css({ "width": "100%", "height":"100%" });
		$( "#infinite-content" ).css({ "width": "100%", "height": "100%" });
		$( "#infinite-content article.type-post" ).css({ "width": "100%", "height": "600px" });

		$(".site-inner").niceScroll({ autohidemode:"leave" });
	}	

	if(  screen_width > 599 ){
		$('#infinite-content article.type-post').each(function(){		
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
		var offset = $('#infinite-content article.type-post').length-1;
		$.ajax({
			type : "post",
			context: this,
			dataType : "json",
			url : zp_load_more.ajaxurl,
			data : {action: "zp_load_posts",offset:offset,nonce:nonce, type:type, value:value },
			beforeSend: function(data) {
				// here u can do some loading animation...
				$('.load_more_posts .load_more_wrap .load_more_label').text( zp_load_more.loading );
			},
			success: function(response) {
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
				var num_items = jQuery("#infinite-content article.type-post").length;
				var set_height = jQuery("#infinite-content").data('row');
				var item_height = screen_height / set_height;
				var w = i = 0;
				
				num_col = Math.floor( num_items / set_height );
				if( ( num_items % set_height ) != 0 ){
					num_col = num_col + 1;
				}

				if( screen_width > 768 ){
					label_width = screen_width / 3;
				}else{
					label_width = screen_width / 2;
				}
				width = ( label_width * ( Math.floor(num_col) ) );

				if(  screen_width > 599 ){
					$( ".content-sidebar-wrap" ).css({ "width": ( width + 18 )+"px", "height": screen_height+"px" });
					$( "#infinite-content" ).css({ "width": width+"px", "height": screen_height+"px" });
					$( "#infinite-content article.type-post" ).css({ "width": label_width+"px", "height": item_height+"px" });

					$(".site-inner").niceScroll({ autohidemode:"leave" });
				}else{
					$( ".content-sidebar-wrap" ).css({ "width": "100%", "height":"100%" });
					$( "#infinite-content" ).css({ "width": "100%", "height": "100%" });
					$( "#infinite-content article.type-post" ).css({ "width": "100%", "height": "600px" });

					$(".site-inner").niceScroll({ autohidemode:"leave" });
				}	

				if(  screen_width > 599 ){
					$('#infinite-content article.type-post').each(function(){		
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
