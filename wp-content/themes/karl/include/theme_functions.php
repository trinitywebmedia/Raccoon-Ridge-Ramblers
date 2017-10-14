<?php 
/** 
 * Themes' Helper Functions
 */

/**
 * Add Load More Post functionality
 * using AJAX
 */
add_action( "wp_ajax_zp_load_posts", "zp_load_more_posts" );
add_action( "wp_ajax_nopriv_zp_load_posts", "zp_load_more_posts" );

function zp_load_more_posts() {
	global $post;

	//verifying nonce here
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "zp_load_posts" ) ) {
		exit("You should not be here.");
	}

	$offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
	$posts_per_page = 4;

	// Get type
	$type = isset($_REQUEST['type'])?$_REQUEST['type']:'';

	// Get value
	$value = isset($_REQUEST['value'])?$_REQUEST['value']:'';

	
	ob_start();

	if( $type == 'category' ){
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			'category_name' => $value,
		);
	}elseif( $type == 'date' ){
		$date_val = explode(",",$value );
		$year = ( $date_val[0] != '' ) ? $date_val[0]: 0;
		$month = ( $date_val[1] != '' ) ? $date_val[1]: 0;
		$day = ( $date_val[2] != '' ) ? $date_val[2]: 0;


		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			'date_query' => array(
				array(
					'year'  => $year,
					'month' => $month,
					'day'   => $day,
				),
			)
		);
	}elseif( $type == 'tag' ){
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			 'tag' => $value
		);
	}elseif( $type == 'author' ){
		$args = array(
			'post_type'		=> 'post',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			'author' => $value
		);
	}else{
		$args = array(
			'post_type'		=> 'post',
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
					printf( '<article %s>', genesis_attr( 'entry' ) );

						$overlay = ( get_post_meta( get_the_ID(), 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( get_the_ID(), 'overlay_color', true ).';' : 'background-color: #000000;';
						$overlay_opacity = ( get_post_meta( get_the_ID(), 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( get_the_ID(), 'overlay_opacity', true ).';' : 'opacity: 0.4;';
						$bg_color = ( get_post_meta( get_the_ID(), 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( get_the_ID(), 'bg_color', true ).';' : 'background-color: #333333;';
						$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

						// ( has_post_thumbnail( ) ) {
							$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
						//}

						if( $img[0] ){
							echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
						}else{
							echo '<div class="post_image_holder" style="'.$bg_color.';"></div>';
						}
						echo '<header class="entry-header" style="'.$text_color.'"><h2 class="entry-title" itemprop="headline"><a href="'.get_permalink().'" rel="bookmark">'.get_the_title().'</a></h2>';
							echo do_shortcode( '<p class="entry-meta"><span class="date_wrap">'.__( 'Posted on', 'karl' ).' [post_date format="j F Y"] </span><span class="author_wrap">'.__( 'By', 'karl').' [post_author_posts_link] </span><span class="comment_wrap"> [post_comments  more="% '.__( 'Comments' ,'karl').'" one="1 '.__( 'Comment' ,'karl').'" zero="0 '.__( 'Comment' ,'karl').'"] </span></p>' );
						echo '</header>';
					echo '</article>';
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
 * Add Load More Portfolio functionality
 * using AJAX
 */
add_action( "wp_ajax_zp_load_portfolio", "zp_load_more_portfolio" );
add_action( "wp_ajax_nopriv_zp_load_portfolio", "zp_load_more_portfolio" );

function zp_load_more_portfolio() {
	global $post;

	//verifying nonce here
	if ( !wp_verify_nonce( $_REQUEST['nonce'], "zp_load_portfolio" ) ) {
		exit("You should not be here.");
	}

	$offset = isset($_REQUEST['offset'])?intval($_REQUEST['offset']):0;
	$posts_per_page = 4;

	// Get Pre defined category
	$category = isset($_REQUEST['category'])?$_REQUEST['category']:'';
	
	ob_start();

	if( $category != '' ){
		$args = array(
			'post_type'		=> 'portfolio',
			'posts_per_page' => 4,
			'offset' => $offset,
			'post_status' => 'publish',
			'portfolio_category' => $category
		);
	}else{
		$args = array(
			'post_type'		=> 'portfolio',
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


function zp_portfolio_items_term_name( $id ){
	$terms = wp_get_post_terms( $id, 'portfolio_category' );
	$term_string = $term_link = '';
		foreach( $terms as $term ){
			$term_link .= '<a href="'.get_term_link( $term->term_id, 'portfolio_category' ).'">'.$term->name.'</a>';	
		}
	$output = $term_link;

	return $output;	
}