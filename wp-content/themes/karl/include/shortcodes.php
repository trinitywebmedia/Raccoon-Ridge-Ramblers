<?php
/**-------------------------------------------------------------------
 * Theme Shortcodes
 --------------------------------------------------------------------*/

 
/**
 *	Column Shortcodes
 */
if ( !function_exists( 'zp_column_wrapper' ) ){
	function zp_column_wrapper( $atts, $content = null ){
		extract( shortcode_atts( array(
		), $atts, 'column_wrapper' ));
		
		return '<div class="column_wrapper">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'column_wrapper', 'zp_column_wrapper' );
}
if (!function_exists('zp_one_third')) {
	function zp_one_third( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'align' => ''
		), $atts, 'one_third' ));
		
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}

	   return '<div class="zp_column zp_one_third '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode('one_third', 'zp_one_third');
}
if ( !function_exists( 'zp_one_half' ) ){
	function zp_one_half( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => ''
		), $atts, 'one_half'));
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}

		return '<div class="zp_column zp_one_half '.$align.'">'.do_shortcode($content).'</div>';
	}
	add_shortcode( 'one_half', 'zp_one_half' );
}
if ( !function_exists( 'zp_one_fourth' ) ){
	function zp_one_fourth( $atts, $content = null ){
		extract( shortcode_atts( array(
			'align' => '',
		), $atts, 'one_fourth' ));
		
		if( $align == 'center' ){
			$align = 'text-center';
		}elseif ( $align == 'right' ){
			$align = 'text-right';	
		}else{
			$align = 'text-left';	
		}
		return '<div class="zp_column zp_one_fourth '.$align.'">'.do_shortcode($content).'</div>'; 
	}
	add_shortcode( 'one_fourth', 'zp_one_fourth' );
}

/**
 *	Services
 */
if ( !function_exists( 'zp_services_wrap' )){
	function zp_services_wrap( $atts, $content = null ){
		extract( shortcode_atts( array(
			'class' => ''
		), $atts, 'services_wrap' ));
		return '<div class="zp_services_wrapper '.$class.'">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'services_wrap', 'zp_services_wrap' );
	
}
if ( !function_exists( 'zp_services' )){
	function zp_services( $atts, $content = null ){
		extract( shortcode_atts( array(
			'columns' => '',
			'align' => '',
			'image' => '',
			'title' => ''
		), $atts, 'services' ));

		if( $align != '' ){
			$align = 'zp_'.$align;
		}
		if( $image != '' ){
			$image = '<img src="'.$image.'" />';
		}

		if( $title != '' ){
			$title = '<h4>'.$title.'</h4>';
		}

		if( $columns != '' ){
			$columns = 'zp_'.$columns;
		}

		return '<div class="zp_services zp_column '.$columns.' '.$align.'">'.$image.$title.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'services', 'zp_services' );
	
}

/**
 *	Testimonial
 */
if ( !function_exists( 'zp_testimonial_wrapper' )){
	function zp_testimonial_wrapper( $atts, $content = null ){
		extract( shortcode_atts( array(
			'class' => ''
		), $atts, 'testimonial_wrap' ));

		wp_enqueue_script( 'cycle2' );
		return '<div class="testimonial_wrapper '.$class.' cycle-slideshow" data-cycle-log="false" data-cycle-slides=".testimonial_item" data-cycle-auto-height="calc" data-cycle-center-horz="true" data-cycle-center-vert="true" data-cycle-swipe="true" data-cycle-paused="true" data-cycle-timeout=1000" data-cycle-fx="fade">'.do_shortcode( $content ).'<div class="cycle-prev"><span class="dashicons dashicons-arrow-left-alt"></span></div>/<div class="cycle-next"><span class="dashicons dashicons-arrow-right-alt"></span></div></div>';		
	}
	add_shortcode( 'testimonial_wrap','zp_testimonial_wrapper' );
}
if ( !function_exists( 'zp_testimonial_item' )){
	function zp_testimonial_item( $atts, $content = null ){
		extract( shortcode_atts( array(
			'author' => '',
			'message' => ''
		), $atts, 'testimonial_item' ));

		return '<div class="testimonial_item"><div class="testimonial_content"><p>'.$message.'</p></div><h4>'.$author.'</h4></div>';		
	}
	add_shortcode( 'testimonial_item','zp_testimonial_item' );
}

/**
 *	Button Shortcode
 */
if (!function_exists( 'zp_button' )){
	function zp_button( $atts, $content = null ){
		extract( shortcode_atts( array(
			'link' => '',
			'class' => '',
			'target' => ''
		),$atts, 'button' ));
		
		return '<a class="btn '.$class.' " href="'.esc_url( $link ).'" target="'.$target.'">'.$content.'</a>';		
	}
	
	add_shortcode( 'button', 'zp_button');
}
/**
 *	Accordion
 */
if ( !function_exists( 'zp_accordion_wrap' ) ){
	function zp_accordion_wrap( $atts, $content = null ){
		extract( shortcode_atts( array(
		),$atts, 'accordion_wrap' ));

		return ' <div class="accordion_wrap">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'accordion_wrap', 'zp_accordion_wrap' );
}
if ( !function_exists( 'zp_accordion' )){
	function zp_accordion( $atts, $content = null ){
		extract( shortcode_atts( array(
			'title' => '',
			'active' => ''
		), $atts, 'accordion_item' ));

		if( $active == 'true' ){
			$active = 'active';
		}

		return '<div class="accordion_item '.$active.'"><div class="accordion_header"><h4 class="accordion_title">'.$title.'<span class="dashicons dashicons-plus"></span></h4></div><div class="accordion_content"><div class="accordion_body">'.do_shortcode($content).'</div></div></div>';
	}
	
	add_shortcode( 'accordion_item', 'zp_accordion' );
}

/**
 *	Toggle
 */
if ( !function_exists( 'zp_toggle_wrap' ) ){
	function zp_toggle_wrap( $atts, $content = null ){
		extract( shortcode_atts( array(
		),$atts, 'toggle_wrap' ));

		return ' <div class="toggle_wrap">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'toggle_wrap', 'zp_toggle_wrap' );
}
if ( !function_exists( 'zp_toggle' )){
	function zp_toggle( $atts, $content = null ){
		extract( shortcode_atts( array(
			'title' => '',
			'active' => ''
		), $atts, 'toggle_item' ));

		if( $active == 'true' ){
			$active = 'active';
		}

		return '<div class="toggle_item '.$active.'"><div class="toggle_header"><h4 class="toggle_title">'.$title.'<span class="dashicons dashicons-plus"></span></h4></div><div class="toggle_content"><div class="toggle_body">'.do_shortcode($content).'</div></div></div>';
	}
	
	add_shortcode( 'toggle_item', 'zp_toggle' );
}

/**
 * Tabs
 */
if( !function_exists( 'zp_tabs' )){
	function zp_tabs( $atts, $content = null ){
		extract( shortcode_atts( array(
			'ids' => '',
			'nav' => ''
		), $atts, 'tab' ) );
		
		$ids_array = explode( ',',str_replace( " ", "", $ids ) );
		$nav_array = explode( ',',$nav );
		$output = '';
		
		$output .= '<div class="tab_container">';
		$output .= '<ul class="tab_nav">';
		for( $i=0; $i < count( $nav_array ); $i++ ){
			if( $i == 0 ){
				$output .= '<li class="active"><a href="#'.$ids_array[$i].'">'.$nav_array[$i].'</a></li>';
			}else{
				$output .= '<li><a href="#'.$ids_array[$i].'">'.$nav_array[$i].'</a></li>';
			}				
		}
		$output .= '</ul>';
		
		$output .= '<div class="tab_content"><p>'.do_shortcode( $content ).'</p></div>';
		$output .= '</div>';
		return $output;
	}
	add_shortcode( 'tab', 'zp_tabs' );
}
if( !function_exists( 'zp_tabpane' )){
	function zp_tabpane( $atts, $content = null ){
		extract( shortcode_atts( array(
			'id' => ''
		), $atts, 'tabpane' ) );
		
		return '<div class="tab_pane" id="'.$id.'">'.do_shortcode( $content ).'</div>';
	}
	add_shortcode( 'tabpane', 'zp_tabpane' );
}

/**
 *	hr
 */
if (!function_exists( 'zp_hr' )){
	function zp_hr( $atts, $content = null ){
		extract( shortcode_atts( array(
			'class' => ''
		),$atts, 'hr' ));		
		return '<hr class="'.$class.'" >';		
	}	
	add_shortcode( 'hr', 'zp_hr');
}

/**
 *	Drop Cap
 */
if (!function_exists( 'zp_drop_cap' )){
	function zp_drop_cap( $atts, $content = null ){
		extract( shortcode_atts( array(
		),$atts, 'dropcap' ));		
		return '<span class="dropcap" >'.$content.'</span>';
	}	
	add_shortcode( 'dropcap', 'zp_drop_cap');
}