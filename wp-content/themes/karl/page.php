<?php
/**
 * Page Template 
 */

remove_action( 'genesis_after_entry', 'genesis_do_author_box_single', 8 );
remove_action( 'genesis_after_entry', 'genesis_get_comments_template' );
add_action( 'zp_page_after_content', 'genesis_do_author_box_single'  );
add_action( 'zp_page_after_content', 'genesis_get_comments_template' );

// Add page description
add_action( 'genesis_entry_header', 'zp_page_description' );
function zp_page_description(){
	global $post;

	$page_desc  = get_post_meta( $post->ID, 'page_desc', true );

	if( $page_desc != '' ){
		echo '<p>'.$page_desc.'</p>';
	}
}


remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_custom_page_template' );
function zp_custom_page_template(){
	global $post;


	echo '<div class="zp_page_container" >';
		echo '<div class="zp_page_wrap">';
			do_action( 'zp_page_before_content' );
				
				if ( have_posts() ) :

					while ( have_posts() ) : the_post();
						// get page option
						$overlay = $overlay_opacity = $bg_color = $text_color = $img = '';
						
						$overlay = ( get_post_meta( $post->ID, 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'overlay_color', true ).';' : 'background-color: #000000;';
						$overlay_opacity = ( get_post_meta( $post->ID, 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( $post->ID, 'overlay_opacity', true ).';' : 'opacity: 0.4;';
						$bg_color = ( get_post_meta( $post->ID, 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'bg_color', true ).';' : 'background-color: #333333;';
						$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

						if ( has_post_thumbnail( ) ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
						}else{
							$img = '';
						}

						printf( '<article %s>', genesis_attr( 'entry' ) );
							echo '<div class="zp_page_header" style="'.$text_color.'">';
								if( $img ){
									echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
								}else{
									echo '<div class="post_image_holder" style="'.$bg_color.'"></div>';
								}
								do_action( 'genesis_entry_header' );
								do_action( 'zp_after_header' );
							echo '</div>';

							echo '<div class="zp_page_content">';
								printf( '<div %s>', genesis_attr( 'entry-content' ) );
									do_action( 'genesis_entry_content' );									
									do_action( 'genesis_entry_footer' );
								echo '</div>';
								do_action( 'genesis_after_entry_content' );
								do_action( 'zp_single_after_content' );
							echo '</div>';
						echo '</article>';						
					endwhile; //* end of one post
				endif; //* end loop

		echo '</div>';
	echo '</div>';
}

genesis();