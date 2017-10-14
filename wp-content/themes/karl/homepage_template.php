<?php
/**
 * Template Name: Homepage
 */

/** Force full width layout */
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

//* Remove standard post content output
remove_action( 	'genesis_loop', 'genesis_do_loop'  );
add_action( 'genesis_loop', 'zp_homepage_template'  );
function zp_homepage_template() {
	global $post;

	echo '<script>
			jQuery(document).ready( function($) {
			var screen_height = $(window).height();
			var box_one_third = screen_height / 3;
			var box_one_half = screen_height / 2;

			$( ".home_box_widget.box_full" ).css({"height": screen_height+"px"});
			$( ".home_box_widget.box_one_half" ).css({"height": box_one_half+"px"});
			$( ".home_box_widget.box_one_third" ).css({"height": box_one_third+"px"});
			
			});
			</script>';
	echo '<div class="home_box_container">';

	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$image_url = wp_get_attachment_url(  get_post_thumbnail_id(  $post->ID  )  );
		$i=1;

		while( $i < 5 ){
			$enable_box = $overlay = $box_overlaycolor = $box_overlayopac = '';

			$enable_box = get_post_meta( $post->ID, 'enable_box'.$i, true );
			$box_height = get_post_meta( $post->ID, 'box_height'.$i, true );
			$box_width = get_post_meta( $post->ID, 'box_width'.$i, true );
			$box_bgimage = get_post_meta( $post->ID, 'box_bgimage'.$i, true );
			$box_bgcolor = get_post_meta( $post->ID, 'box_bgcolor'.$i, true );
			$box_textcolor = get_post_meta( $post->ID, 'box_textcolor'.$i, true );
			$box_bgcolor = get_post_meta( $post->ID, 'box_bgcolor'.$i, true );
			$box_content = get_post_meta( $post->ID, 'box_content'.$i, true );
			$box_overlaycolor = get_post_meta( $post->ID, 'box_overlaycolor'.$i, true );
			$box_overlayopac = get_post_meta( $post->ID, 'box_overlayopac'.$i, true );

			if( $box_bgimage != '' ){
				$bg = 'background-image: url( '.wp_get_attachment_url(  $box_bgimage  ).' ); background-repeat: no-repeat; background-size: cover;';
			}else if( $box_bgcolor != '' ){
				$bg = 'background-color: '.$box_bgcolor.';';
			}else{
				$bg = '';
			}

			$width = ( $box_width != '' ) ? 'width: '.$box_width.'%;' : '';

			$color = ( $box_textcolor != '' ) ? 'color: '.$box_textcolor.';' : '';

			if( $box_overlaycolor != '' ){
				$overlay = '<div class="home_widget_overlay" style="background-color: '.$box_overlaycolor.'; opacity: '.$box_overlayopac.';"></div>';
			}

			if( $enable_box == 1 ){
				echo '<div class="home_box_widget home_box_'.$i.' '.$box_height.'" style="'.$bg.$color.$width.'">'.$overlay.'<div class="home_box"><div class="home_box_wrap">';
					echo do_shortcode( $box_content );
				echo '</div></div></div>';
			}

			$i++;
		}

	endwhile;endif;

	echo '</div>';
}
genesis();