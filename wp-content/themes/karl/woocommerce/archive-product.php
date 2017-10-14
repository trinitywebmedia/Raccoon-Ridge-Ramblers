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

add_action( 'genesis_before_loop', 'zp_archive_product_loop' );
function zp_archive_product_loop() {
	global $shop_page_id;

	// enable portfolio title
	$shop_archive_layout = genesis_get_option( 'zp_shop_layout', ZP_SETTINGS_FIELD );

	if( $shop_archive_layout == 'one_row' ){
		$rows = '1';
	}else if( $shop_archive_layout == 'two_rows' ){
		$rows = '2';
	}else if( $shop_archive_layout == 'three_rows' ){
		$rows = '3';
	}else{
		$rows = '1';
	}

	echo '<div class="zp_shop_container zp_shop_archive" data-title="1">';
		echo '<div class="zp_shop_wrap">';
			do_action( 'woocommerce_before_main_content' );

			// get page option
			$overlay = $overlay_opacity = $bg_color = $text_color = $img = '';
		
			$overlay = ( get_post_meta( $shop_page_id, 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $shop_page_id, 'overlay_color', true ).';' : 'background-color: #000000;';
			$overlay_opacity = ( get_post_meta( $shop_page_id, 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( $shop_page_id, 'overlay_opacity', true ).';' : 'opacity: 0.4;';
			$bg_color = ( get_post_meta( $shop_page_id, 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $shop_page_id, 'bg_color', true ).';' : 'background-color: #333333;';
			$text_color = ( get_post_meta( $shop_page_id, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $shop_page_id, 'text_color', true ).';' : 'color: #fff;';

			$img = wp_get_attachment_image_src( get_post_thumbnail_id( $shop_page_id ), 'full' );

			echo '<div class="zp_shop_header" style="'.$text_color.'">';
				if( $img ){
					echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
				}else{
					echo '<div class="post_image_holder" style="'.$bg_color.'"></div>';
				}
				echo '<header class="entry-header">';
					if ( apply_filters( 'woocommerce_show_page_title', true ) ) :
						echo '<h1 class="page-title">'.woocommerce_page_title( false ).'</h1>';
					endif;
					do_action( 'woocommerce_archive_description' );
				echo '</header>';
			echo '</div>';
					
			echo '<div class="zp_shop_content" data-row="'.$rows.'">';					
				if ( have_posts() ) : 
						do_action( 'woocommerce_before_shop_loop' );
						
						woocommerce_product_loop_start();
						woocommerce_product_subcategories();

						while ( have_posts() ) : the_post();
							wc_get_template_part( 'content', 'product_custom' );
						endwhile;

						zp_product_load_more_block();

						woocommerce_product_loop_end();

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