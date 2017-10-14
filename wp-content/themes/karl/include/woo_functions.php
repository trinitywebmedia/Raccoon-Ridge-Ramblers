<?php
/*--------------------------------------------
	Woocommerce Hooks and Functions
--------------------------------------------*/

// Remove Woo style
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// Related columns and number of items
add_filter( 'woocommerce_output_related_products_args', 'zp_related_products_args' );
function zp_related_products_args( $args ) {
	$args['posts_per_page'] = 3;
	$args['columns'] = 3;
	return $args;
}

// Cross Sells number of items
add_filter( 'woocommerce_cross_sells_columns', 'zp_cross_sells' );
function zp_cross_sells( $columns ) {
	return 3;
}

/**
* Product Archive and Taxonomy Load More block
*/

function zp_product_load_more_block( $slug = '' ){
	echo '<li class="product type-product load_more_posts"><span class="load_more_wrap"><span class="load_more_label" data-nonce="'.wp_create_nonce('zp_load_products').'" data-category="'.$slug.'">'.__( 'Load More Product', 'karl' ).'</span></span></li>';
}


/**
 * Add Load More Product functionality
 * using AJAX
 */
add_action( "wp_ajax_zp_load_products", "zp_load_more_products" );
add_action( "wp_ajax_nopriv_zp_load_products", "zp_load_more_products" );

function zp_load_more_products() {
	global $post;

	//verifying nonce here
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "zp_load_products" ) ) {
		exit("You should not be here.");
	}

	$offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
	$posts_per_page = 4;

	// Get Pre defined category
	$category = isset($_REQUEST['category'])?$_REQUEST['category']:'';
	
	ob_start();


	if( $category != '' ){
		$args = array(
			'post_type'		=> 'product',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			'product_cat' => $category
		);
	}else{
		$args = array(
			'post_type'		=> 'product',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish'
		);
	}
	
	$posts_query = new WP_Query( $args );
	
	// Get the total number of Posts
	$count_posts = wp_count_posts( 'post' )->publish;
		
	if ( $posts_query->have_posts() && (( $count_posts < $posts_per_page ) || ( $posts_per_page != -1 ) ) ) {
		$result['have_posts'] = true;
			if ( $posts_query->have_posts() ):
				while ( $posts_query->have_posts() ) : $posts_query->the_post();
					wc_get_template_part( 'content', 'product_custom' );
				endwhile;
			endif;
			wp_reset_postdata();

		$result['html'] = ob_get_clean();
	} else {
		//no posts found
		$result['have_posts'] = false;
	}
	
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		$result = json_encode($result);
		echo $result;
	}else {
		header("Location: ".$_SERVER["HTTP_REFERER"]);
	}
	die();
}

/**
 * Product Cart Contents
*/
add_filter('woocommerce_add_to_cart_fragments', 'zp_add_to_cart_fragment');
function zp_add_to_cart_fragment( $fragments ) {
	global $woocommerce;

	$link = $woocommerce->cart->get_cart_url();
	$total = $woocommerce->cart->cart_contents_count;
	$total = ( $total > 0 ) ? $total : 0;

	ob_start();
	?>
	<li class="right zp_cart_item"><a href="<?php echo $link; ?>" class="external" ><i class="fa fa-shopping-cart"></i>( <?php echo $total; ?> )</a></li>
	<?php

	$fragments['li.zp_cart_item'] = ob_get_clean();

	return $fragments;
}