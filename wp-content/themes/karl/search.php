<?php
/**
* Search Template
*/


remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_search_template' );
function zp_search_template(){
	global $post;

	// Add portfolio archive script
	echo '<script type="text/javascript">
		jQuery( document ).ready( function($){
			var screen_height = $(window).height();
	
			$( ".zp_search_header" ).css({ "height": screen_height+"px" });
		});

	</script>';

	echo '<div class="zp_page_container zp_search_page" >';
		echo '<div class="zp_page_wrap">';
				
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
				
				echo '<div class="zp_page_header zp_search_header" style="'.$default_text_color.'"><div class="zp_search_default_wrap">';

					echo $default_overlay_markup;
					echo '<header class="entry-header"><h1 class="entry-title" itemprop="headline">'.__( 'Search Result for', 'karl' ).' "'.get_search_query().'"</h1></header>';					
					echo genesis_search_form();					
				echo '</div></div>';

				echo '<div class="zp_page_content">';
					if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							printf( '<div %s>', genesis_attr( 'entry' ) );
							echo '<h2 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h2>';
							printf( '<div %s>', genesis_attr( 'entry-content' ) );
								echo '<p>'.get_the_excerpt().'</p>';
							echo '</div>';
							echo '</div>';
						endwhile; //* end of one post
						do_action( 'genesis_after_endwhile' );
					else:
						printf( '<div %s>', genesis_attr( 'entry' ) );
							echo '<h2 class="entry-title" itemprop="headline">'.__( 'Search Not Found', 'karl' ).'</h2>';
							printf( '<div %s>', genesis_attr( 'entry-content' ) );
								echo '<p>'.__( 'Sorry, no content matched your criteria.', 'karl' ).'</p>';	
							echo '</div>';
							echo '</div>';
					endif;

				echo '</div>';			

		echo '</div>';
	echo '</div>';
}
genesis();
