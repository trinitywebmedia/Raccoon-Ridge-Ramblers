<?php
/**
* 404 Page
*/ 
 
remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_404_page_template' );
function zp_404_page_template(){
	global $post;

	$img = '';

	echo '<div class="zp_page_container" >';
		echo '<div class="zp_page_wrap">';
			
			// get page option
			$overlay = $overlay_opacity = $bg_color = $text_color = '';
			$overlay = $overlay_opacity = $bg_color = $text_color = '';
			$default_overlay = ( genesis_get_option( 'zp_default_overlay', ZP_SETTINGS_FIELD )  != ''  ) ? 'background-color: '.genesis_get_option( 'zp_default_overlay', ZP_SETTINGS_FIELD ).';' : 'background-color: #000000;';
			$default_overlay_opacity = ( genesis_get_option( 'zp_default_opacity', ZP_SETTINGS_FIELD ) != ''  ) ? 'opacity: '.genesis_get_option( 'zp_default_opacity', ZP_SETTINGS_FIELD ).';' : 'opacity: 0.4;';
			$default_bg_color = ( genesis_get_option( 'zp_default_color', ZP_SETTINGS_FIELD ) != ''  ) ? 'background-color: '.genesis_get_option( 'zp_default_color', ZP_SETTINGS_FIELD ).';' : 'background-color: #333333;';
			$default_text_color = ( genesis_get_option( 'zp_default_text', ZP_SETTINGS_FIELD ) != ''  ) ? 'color: '.genesis_get_option( 'zp_default_text', ZP_SETTINGS_FIELD ).';' : 'color: #fff;';
			$default_bg_image = ( genesis_get_option( 'zp_default_bg', ZP_SETTINGS_FIELD ) != ''  ) ? 'background-image: url( '.genesis_get_option( 'zp_default_bg', ZP_SETTINGS_FIELD ).' );' : '';

			if( $default_bg_image == '' ){
				$default_overlay_markup =  '<div class="search_default_holder" style="'.$default_bg_color.'"></div>';
			}else{
				$default_overlay_markup =  '<div class="search_default_overlay" style="'.$default_overlay.$default_overlay_opacity.'"></div><div class="search_default_holder" style="'.$default_bg_image.'; background-size: cover; background-repeat: no-repeat; "></div>';
			}
			

			printf( '<article %s>', genesis_attr( 'entry' ) );
				echo '<div class="zp_page_header" style="'.$default_text_color.'"><div class="zp_404_default_wrap">';
					echo $default_overlay_markup;
					echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">'.__( '404 - Page Not Found', 'karl' ).'</h1></header>';
				echo '</div></div>';

				echo '<div class="zp_page_content">';
					printf( '<div %s>', genesis_attr( 'entry-content' ) );									
						echo apply_filters( 'genesis_404_entry_content', '<p>' . sprintf( __( 'The page you are looking for no longer exists. Perhaps you can return back to the site\'s <a href="%s">homepage</a> and see if you can find what you are looking for. Or, you can try finding it by using the search form below.', 'karl' ), trailingslashit( home_url() ) ) . '</p>' );

						get_search_form();
						
					echo '</div>';
				echo '</div>';
			echo '</article>';						

		echo '</div>';
	echo '</div>';
}

genesis();