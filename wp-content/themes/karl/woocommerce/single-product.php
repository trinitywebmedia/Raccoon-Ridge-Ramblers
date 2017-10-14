<?php
/**
 * This template displays the single Product
 *
 * @version 1.6.4
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

// Custom Layout
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
//remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product', 'wc_print_notices', 10 );

add_action( 'woocommerce_single_zp_header', 'woocommerce_template_single_title' );
//add_action( 'woocommerce_single_zp_header', 'woocommerce_template_single_rating');
add_action( 'woocommerce_single_zp_header', 'woocommerce_template_single_meta' );
add_action( 'zp_single_product_content', 'wc_print_notices', 10 );


add_action( 'genesis_loop', 'zp_single_product_loop' );
function zp_single_product_loop() {
	global $post;

	echo '<div class="zp_single_container" >';
		echo '<div class="zp_single_wrap">';
			do_action( 'woocommerce_before_main_content' );

			// Let developers override the query used, in case they want to use this function for their own loop/wp_query
			$wc_query = false;

			// Added a hook for developers in case they need to modify the query
			$wc_query = apply_filters( 'gencwooc_custom_query', $wc_query );

			if ( ! $wc_query) {

				global $wp_query;

				$wc_query = $wp_query;
			}

			if ( $wc_query->have_posts() ) while ( $wc_query->have_posts() ) : $wc_query->the_post(); ?>

				<?php do_action('woocommerce_before_single_product'); ?>

				<div itemscope itemtype="http://schema.org/Product" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
					$overlay = $overlay_opacity = $bg_color = $text_color = $img = '';

					// get page option
					$overlay = ( get_post_meta( $post->ID, 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'overlay_color', true ).';' : 'background-color: #000000;';
					$overlay_opacity = ( get_post_meta( $post->ID, 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( $post->ID, 'overlay_opacity', true ).';' : 'opacity: 0.4;';
					$bg_color = ( get_post_meta( $post->ID, 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( $post->ID, 'bg_color', true ).';' : 'background-color: #333333;';
					$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

					if ( has_post_thumbnail( ) ) {
						$img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
					}

					?>
					<div class="zp_single_header" style="<?php echo $text_color; ?>">
						<?php
						if( $img != '' ){
							echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
						}else{
							echo '<div class="post_image_holder" style="'.$bg_color.';"></div>';
						}
						?>
						<header class="entry-header">
							<?php do_action( 'woocommerce_single_zp_header' ); ?>
							<?php do_action( 'woocommerce_before_single_product_summary' ); ?>
						</header>									
					</div>
					<div class="zp_single_content">
						<?php do_action( 'zp_single_product_content' ); ?>
						<div class="summary">								
							<?php do_action( 'woocommerce_single_product_summary'); ?>					
						</div>
						<?php do_action( 'woocommerce_after_single_product_summary' ); ?>
					</div>
				</div>

				<?php do_action( 'woocommerce_after_single_product' );

			endwhile;

			do_action( 'woocommerce_after_main_content' );
		echo '</div>';
	echo '</div>';
}

genesis();