<?php
/**
 * The template for displaying product content within loops.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Ensure visibility
if ( ! $product || ! $product->is_visible() ) {
	return;
}


// get page option
$overlay = $overlay_opacity = $bg_color = $text_color = $img = '';

$overlay = ( get_post_meta( $post->ID, 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'overlay_color', true ).';' : 'background-color: #000000;';
$overlay_opacity = ( get_post_meta( $post->ID, 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( $post->ID, 'overlay_opacity', true ).';' : 'opacity: 0.8;';
$bg_color = ( get_post_meta( $post->ID, 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'bg_color', true ).';' : 'background-color: #333333;';
$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

if ( has_post_thumbnail( ) ) {
	$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
}else{
	$img = '';
}
echo '<li class="'.join( " ", get_post_class() ).'" >';
		if( $img ){
			echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
		}else{
			echo '<div class="post_image_holder" style="'.$bg_color.'"></div>';
		}
	echo '<div class="zp_product_content_wrap">';
		echo '<div class="zp_product_content">';
			do_action( 'woocommerce_before_shop_loop_item' );

			echo '<header class="entry-header" style="'.$text_color.'">';
				echo '<a href="'.get_permalink().'">';
					//do_action( 'woocommerce_before_shop_loop_item_title' );
					echo '<h2 class="entry-title" itemprop="headline">'.get_the_title().'</h2>';
					do_action( 'woocommerce_after_shop_loop_item_title' );
				echo '</a>';

				echo sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" data-quantity="%s" class="btn white button %s product_type_%s">%s</a>',
							esc_url( $product->add_to_cart_url() ),
							esc_attr( $product->id ),
							esc_attr( $product->get_sku() ),
							esc_attr( isset( $quantity ) ? $quantity : 1 ),
							$product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
							esc_attr( $product->product_type ),
							esc_html( $product->add_to_cart_text() )
						);
			echo '</header>';
		echo '</div>';
	echo '</div>';
echo '</li>';