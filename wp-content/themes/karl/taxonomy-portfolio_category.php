<?php 
/* 
 * Portfolio Archive Page
 *
 */

// Add body class to section template
add_filter( 'body_class', 'zp_portfolio_template_class' );
function zp_portfolio_template_class( $classes ){
	$classes[] = 'zp_portfolio_template';	
	return $classes;
}

// Remove Header meta
remove_action( 'genesis_before_loop', 'genesis_do_taxonomy_title_description', 15 );
remove_action( 'genesis_before_loop', 'genesis_do_cpt_archive_title_description' );


remove_action(	'genesis_loop', 'genesis_do_loop' );
add_action(	'genesis_loop', 'zp_custom_portfolio_archive_page' );
function zp_custom_portfolio_archive_page(){
	global $post;

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	if ( ! $term || ! isset( $term->meta ) )
		return;

	$headline = $intro_text = '';

	// enable portfolio title
	$enable_title = get_term_meta( $term->term_id, 'enable_header', true );
	$portfolio_tax_layout = get_term_meta( $term->term_id, 'portfolio_category_layout', true);

	if( $portfolio_tax_layout == 'one_row' ){
		$rows = '1';
	}else if( $portfolio_tax_layout == 'two_rows' ){
		$rows = '2';
	}else if( $portfolio_tax_layout == 'three_rows' ){
		$rows = '3';
	}else{
		$rows = '1';
	}
	
	if ( get_term_meta( $term->term_id, 'headline', true ) ) {
		$headline = sprintf( '<h1 %s>%s</h1>', genesis_attr( 'archive-title' ), strip_tags( get_term_meta( $term->term_id, 'headline', true ) ) );
	} else {
		if ( genesis_a11y( 'headings' ) ) {
			$headline = sprintf( '<h1 %s>%s</h1>', genesis_attr( 'archive-title' ), strip_tags( $term->name ) );
		}
	}

	if ( get_term_meta( $term->term_id, 'intro_text', true ) )
		$intro_text = '<p>'.get_term_meta( $term->term_id, 'intro_text', true ).'</p>';

	if ( $headline || $intro_text )
		printf( '<div %s>%s</div>', genesis_attr( 'taxonomy-archive-description' ), $headline . $intro_text );


	// Get header style values
	$portfolio_category_overlay_color = ( get_term_meta( $term->term_id, 'portfolio_category_overlay_color', true )  != ''  ) ? 'background-color: '.get_term_meta( $term->term_id, 'portfolio_category_overlay_color', true ).';' : 'background-color: #000000;';
	$portfolio_category_overlay_opacity = ( get_term_meta( $term->term_id, 'portfolio_category_overlay_opacity', true )  != ''  ) ? 'opacity: '.get_term_meta( $term->term_id, 'portfolio_category_overlay_opacity', true ).';' : 'opacity: 0.8;';
	$portfolio_category_bg_color = ( get_term_meta( $term->term_id, 'portfolio_category_bg_color', true ) != ''  ) ? 'background-color: '.get_term_meta( $term->term_id, 'portfolio_category_bg_color', true ).';' : 'background-color: #333333;';
	$portfolio_category_text_color = ( get_term_meta( $term->term_id, 'portfolio_category_text_color', true ) != ''  ) ? 'color: '.get_term_meta( $term->term_id, 'portfolio_category_text_color', true ).';' : 'color: #fff;';
	$portfolio_category_bg_image = ( get_term_meta( $term->term_id, 'portfolio_category_bg_image', true ) != ''  ) ? 'background-image: url( '.get_term_meta( $term->term_id, 'portfolio_category_bg_image', true ).' );' : '';

	if( $portfolio_category_bg_image == '' ){
		$header_overlay_markup =  '<div class="portfolio_header_holder" style="'.$portfolio_category_bg_color.'"></div>';
	}else{
		$header_overlay_markup =  '<div class="portfolio_header_overlay" style="'.$portfolio_category_overlay_color.$portfolio_category_overlay_opacity.'"></div><div class="portfolio_header_holder" style="'.$portfolio_category_bg_image.'; background-size: cover; background-repeat: no-repeat; "></div>';
	}


	echo '<div class="zp_portfolio_container" >';
		echo '<div class="zp_portfolio_wrap" data-title="'.$enable_title.'">';
			if( $enable_title ){
				echo '<div class="portfolio_header_label" style="'.$portfolio_category_text_color.'">'.$header_overlay_markup.'<div class="portfolio_header_wrap">'.$headline.$intro_text.'</div></div>';
			}
			echo '<div class="portfolio_item_list" data-row="'.$rows.'">';
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						$overlay = $overlay_opacity = $bg_color = $text_color = '';

						$overlay = ( get_post_meta( $post->ID, 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'overlay_color', true ).';' : 'background-color: #000000;';
						$overlay_opacity = ( get_post_meta( $post->ID, 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( $post->ID, 'overlay_opacity', true ).';' : 'opacity: 0.7;';
						$bg_color = ( get_post_meta( $post->ID, 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'bg_color', true ).';' : 'background-color: #333333;';
						$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

						if ( has_post_thumbnail( ) ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
						}

						printf( '<article %s>', genesis_attr( 'entry' ) );
							echo '<div class="zp_portfolio_header">';
								if( $img[0] ){
									echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
								}else{
									echo '<div class="post_image_holder" style="'.$bg_color.';"></div>';
								}
								echo '<header class="entry-header" style="'.$text_color.'">';
									do_action( 'portfolio_before_title' );
									echo '<h2 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h2>';
									echo '<span class="portfolio_tags">'.zp_portfolio_items_term_name(  $post->ID ).'</span>';
									do_action( 'portfolio_after_title' );
								echo '</header>';
							echo '</div>';							
						echo '</article>';						
					endwhile;
				endif;
				echo '<article class="portfolio type-portfolio load_more_posts"><span class="load_more_wrap"><span class="load_more_label" data-nonce="'.wp_create_nonce('zp_load_portfolio').'" data-category="'.$term->slug.'" >'.__( 'Load More Portfolio', 'karl' ).'</span></span></article>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
genesis();