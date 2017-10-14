jQuery.noConflict();
jQuery(document).ready(function($){

	/* Home Box option*/
	var default_template = $( '#page_template' ).val();
	if( default_template == 'homepage_template.php' ){
		$('#home_box_1').show();
		$('#home_box_2').show();
		$('#home_box_3').show();
		$('#home_box_4').show();
		$('.postarea').hide();
	}else{
		$('#home_box_1').hide();
		$('#home_box_2').hide();
		$('#home_box_3').hide();
		$('#home_box_4').hide();
		$('.postarea').show();
	}
	
	$('#page_template').change(function(){
		var page_template = $(this).val()
		
		if( page_template == 'homepage_template.php' ){
			$('#home_box_1').show();
			$('#home_box_2').show();
			$('#home_box_3').show();
			$('#home_box_4').show();
			$('.postarea').hide();
		}else{
			$('#home_box_1').hide();
			$('#home_box_2').hide();
			$('#home_box_3').hide();
			$('#home_box_4').hide();
			$('.postarea').show();	
		}
	});

	/* Page Option */
	var default_template = $( '#page_template' ).val();
	if( default_template == 'default' || default_template == 'page_archive.php'  ){
		$('#page_option').show();
	}else{
		$('#page_option').hide();
	}
	
	$('#page_template').change(function(){
		var page_template = $(this).val()
		
		if( page_template == 'default' || page_template == 'page_archive.php' ){
			$('#page_option').show();
		}else{
			$('#page_option').hide();
		}
	});
});