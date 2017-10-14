<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 *
 */

/** Remove default Genesis loop */
remove_action( 'genesis_loop', 'genesis_do_loop' );

/** Remove WooCommerce breadcrumbs */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/** Uncomment the below line of code to add back WooCommerce breadcrumbs */
//add_action( 'genesis_before_loop', 'woocommerce_breadcrumb', 10, 0 );

/** Remove Woo #container and #content divs */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

// Remove Ordering and result count
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

// Remove navigation
remove_action( 'woocommerce_after_shop_loop', 'woocommerce_pagination', 10 );

// Remove Product Image
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Remove Sale Flash
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );


/** Get Shop Page ID */
// @TODO Retained for backwards compatibility with < 1.6.0 WooC installs
global $shop_page_id;
$shop_page_id = get_option( 'woocommerce_shop_page_id' );


add_filter( 'genesis_pre_get_option_site_layout', 'genesiswooc_archive_layout' );
function genesiswooc_archive_layout( $layout ) {

	global $shop_page_id;

	//$layout = get_post_meta( $shop_page_id, '_genesis_layout', true );

	return 'full-width-content';
}

add_action( 'genesis_before_loop', 'zp_taxonomy_product_loop' );
function zp_taxonomy_product_loop() {
	global $post;

	$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

	$enable_title = get_term_meta( $term->term_id, 'enable_header', true );
	$product_tax_layout = get_term_meta( $term->term_id, 'product_category_layout', true );

	if( $product_tax_layout == 'one_row' ){
		$rows = '1';
	}else if( $product_tax_layout == 'two_rows' ){
		$rows = '2';
	}else if( $product_tax_layout == 'three_rows' ){
		$rows = '3';
	}else{
		$rows = '1';
	}

	echo '<div class="zp_shop_container zp_shop_archive" data-title="'.$enable_title.'">';
		echo '<div class="zp_shop_wrap">';
			do_action( 'woocommerce_before_main_content' );

			// get page option
			$product_category_overlay_color = ( get_term_meta( $term->term_id, 'product_category_overlay_color', true )  != ''  ) ? 'background-color: '.get_term_meta( $term->term_id, 'product_category_overlay_color', true ).';' : 'background-color: #000000;';
			$product_category_overlay_opacity = ( get_term_meta( $term->term_id, 'product_category_overlay_opacity', true )  != ''  ) ? 'opacity: '.get_term_meta( $term->term_id, 'product_category_overlay_opacity', true ).';' : 'opacity: 0.8;';
			$product_category_bg_color = ( get_term_meta( $term->term_id, 'product_category_bg_color', true ) != ''  ) ? 'background-color: '.get_term_meta( $term->term_id, 'product_category_bg_color', true ).';' : 'background-color: #333333;';
			$product_category_text_color = ( get_term_meta( $term->term_id, 'product_category_text_color', true ) != ''  ) ? 'color: '.get_term_meta( $term->term_id, 'product_category_text_color', true ).';' : 'color: #fff;';
			$product_category_bg_image = ( get_term_meta( $term->term_id, 'product_category_bg_image', true ) != ''  ) ? 'background-image: url( '.get_term_meta( $term->term_id, 'product_category_bg_image', true ).' );' : '';

			if( $product_category_bg_image == '' ){
				$header_overlay_markup =  '<div class="portfolio_header_holder" style="'.$product_category_bg_color.'"></div>';
			}else{
				$header_overlay_markup =  '<div class="portfolio_header_overlay" style="'.$product_category_overlay_color.$product_category_overlay_opacity.'"></div><div class="portfolio_header_holder" style="'.$product_category_bg_image.'; background-size: cover; background-repeat: no-repeat; "></div>';
			}

			if( $enable_title ){
				echo '<div class="zp_shop_header" style="'.$product_category_text_color.'">';
					echo $header_overlay_markup;
					echo '<header class="entry-header">';
						echo '<h1 class="page-title">'.single_term_title( "", false ).'</h1>';
						echo '<p class="term-description">'.get_term_meta( $term->term_id, 'intro_text', true ).'</p>';
					echo '</header>';
				echo '</div>';
			}
					
			echo '<div class="zp_shop_content" data-row="'.$rows.'">';					
				if ( have_posts() ) : 
						do_action( 'woocommerce_before_shop_loop' );
						
						woocommerce_product_loop_start();
						woocommerce_product_subcategories();

						while ( have_posts() ) : the_post();
							wc_get_template_part( 'content', 'product_custom' );
						endwhile;

						zp_product_load_more_block($term->slug );

						woocommerce_product_loop_end( );

						do_action( 'woocommerce_after_shop_loop' );

				elseif ( ! woocommerce_product_subcategories( array( 'before' => woocommerce_product_loop_start( false ), 'after' => woocommerce_product_loop_end( false ) ) ) ) :
					wc_get_template( 'loop/no-products-found.php' );
				endif;
					do_action( 'woocommerce_after_main_content' );
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
genesis();