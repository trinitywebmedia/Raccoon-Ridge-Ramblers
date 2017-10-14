<?php
// Start the engine
require_once( get_template_directory() . '/lib/init.php' );

// Localization
load_child_theme_textdomain(  'karl', apply_filters(  'child_theme_textdomain', get_stylesheet_directory(  ) . '/languages', 'karl'  )  );

// Include Theme Settings
require_once (  get_stylesheet_directory(  ) . '/include/theme_settings.php'   );

// Custom Post Type and Post Meta
require_once(  get_stylesheet_directory(  ) . '/include/cpt/super-cpt.php'   );
require_once(  get_stylesheet_directory(  ) . '/include/cpt/zp_cpt.php'   );

// Shortcodes
require_once(  get_stylesheet_directory(  ) . '/include/shortcodes.php' );

// Theme Functions
require_once(  get_stylesheet_directory(  ) . '/include/theme_functions.php' );

if ( class_exists( 'Woocommerce' ) ) {
	// Theme Functions
	require_once(  get_stylesheet_directory(  ) . '/include/woo_functions.php' );
}

// Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Karl' );
define( 'CHILD_THEME_URL', 'http://www.zigzagpress.com/' );

// Add Viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

// Add Viewport meta tag for mobile browsers
add_theme_support( 'genesis-connect-woocommerce' );

// Add support for custom background
add_theme_support( 'custom-background' );

// Add support for html5
add_theme_support( 'html5' );

// Add title tag support
add_theme_support( "title-tag" );

/** Unregister Layout */
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );

//* Set full-width content as the default layout
genesis_set_default_layout( 'full-width-content' );

/** Unregister Sidebar */
unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'sidebar' );
unregister_sidebar( 'header-right' );

/* Secondary Nav */
remove_action( 'genesis_after_header','genesis_do_subnav' );
add_action( 'genesis_before','genesis_do_subnav' );

// Mobile Menu
add_action( 'genesis_before_header', 'zp_mobile_menu' );
function zp_mobile_menu(){
	echo '<div class="menu-trigger"><div class="menu-trigger-wrap"><span class="dashicons dashicons-menu"></span></div></div>';	
}

/** Nav */
remove_action( 'genesis_after_header','genesis_do_nav' );
add_action( 'genesis_header','genesis_do_nav' );


// Custom Logo
add_action(  'wp_head', 'zp_custom_logo'  );
function zp_custom_logo(  ) {
	if (  genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD )  ) { ?>
		<style type="text/css">
			.header-image .site-header .title-area a {
				background-image: url( "<?php echo genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" );
				background-position: center center;
				background-repeat: no-repeat;
				height: <?php echo genesis_get_option( 'zp_logo_height', ZP_SETTINGS_FIELD );?>px;
				width: <?php echo genesis_get_option( 'zp_logo_width', ZP_SETTINGS_FIELD );?>px;
			}
       </style>
	 <?php }
}

// Enqueue Google Font
add_action( 'wp_enqueue_scripts', 'zp_google_font'  );
function zp_google_font( ) {
	$query_args = array(
		'family' => 'Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,900,900italic,700italic|Roboto+Condensed:400,300,300italic,400italic,700,700italic',
		'subset' => 'latin,latin-ext',
	);
	wp_enqueue_style( 'zp_google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
}

// Additional Stylesheets
add_action( 'wp_enqueue_scripts', 'zp_theme_style'  );
function zp_theme_style( ) {
	wp_register_style( 'font-awesome', get_stylesheet_directory_uri( ).'/css/font-awesome.min.css' );
	wp_enqueue_style( 'font-awesome'  );
	wp_enqueue_style( 'dashicons' );

	if ( class_exists( 'Woocommerce' ) ) {
		wp_enqueue_style( 'woo_css', get_stylesheet_directory_uri( ).'/css/wc.css' );
	}
	
	wp_enqueue_style( 'mobile', get_stylesheet_directory_uri( ).'/css/mobile.css' );
	wp_enqueue_style( 'custom', get_stylesheet_directory_uri( ).'/custom.css' );
}

// Theme Scripts
add_action( 'wp_enqueue_scripts', 'zp_theme_js' );
function zp_theme_js( ) {	
	wp_enqueue_script( 'jquery' );
	wp_enqueue_script( 'ScrollTo', get_stylesheet_directory_uri(  ) . '/js/jquery.ScrollTo.min.js',array( 'jquery' ) , '1.4.3.1', true );
	wp_enqueue_script( 'nicescroll', get_stylesheet_directory_uri(  ) . '/js/jquery.nicescroll.min.js',array( 'jquery' ) , '3.6.6', true );
	wp_register_script( 'cycle2', get_stylesheet_directory_uri(  ) . '/js/jquery.cycle2.min.js',array( 'jquery' ) , '2.1.6', true );
	wp_enqueue_script( 'custom', get_stylesheet_directory_uri() . '/js/custom.js','','', true);

	if( is_home() || is_page_template( 'page_blog.php') || is_category() || is_date() || is_tag() || is_author() ){
		wp_enqueue_script( 'post_js', get_stylesheet_directory_uri() . '/js/post.js','','', true);
		wp_localize_script( 'post_js', 'zp_load_more', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'load_posts' => __( 'Load More Posts', 'karl' ), 'loading' => __( 'Loading Posts...', 'karl' ),'end_of_post' => __( 'No More Posts', 'karl' ) ) );
	}

	if( is_post_type_archive( 'portfolio' ) || is_tax( 'portfolio_category' ) ) {
		wp_enqueue_script( 'portfolio_js', get_stylesheet_directory_uri() . '/js/portfolio.js','','', true);
		wp_localize_script( 'portfolio_js', 'zp_load_more', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'load_posts' => __( 'Load More Portfolio', 'karl' ), 'loading' => __( 'Loading Portfolio...', 'karl' ),'end_of_post' => __( 'No More Portfolio', 'karl' ) ) );
	}

	if( is_post_type_archive( 'product' ) || is_tax( 'product_cat' ) ) {
		wp_enqueue_script( 'shop_js', get_stylesheet_directory_uri() . '/js/shop.js','','', true);
		wp_localize_script( 'shop_js', 'zp_load_more', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ), 'load_posts' => __( 'Load More Products', 'karl' ), 'loading' => __( 'Loading Products...', 'karl' ),'end_of_post' => __( 'No More Product', 'karl' ) ) );
	}
}

// Post Info
add_filter( 'genesis_post_info', 'zp_custom_post_info' );
function zp_custom_post_info(){
	return '<span class="date_wrap">'.__( 'Posted on', 'karl' ).' [post_date format="j F Y"] </span><span class="author_wrap">'.__( 'By', 'karl').' [post_author_posts_link] </span><span class="comment_wrap"> [post_comments  more="% '.__( 'Comments' ,'karl').'" one="1 '.__( 'Comment' ,'karl').'" zero="0 '.__( 'Comment' ,'karl').'"] </span>';
}

// Post Meta
add_filter( 'genesis_post_meta','zp_custom_post_meta' );
function zp_custom_post_meta(){
	return '[post_categories] [post_tags]';
}

// Custom Read More Text
add_filter(  'excerpt_more', 'zp_read_more_link'  );
add_filter(  'get_the_content_more_link', 'zp_read_more_link'  );
add_filter( 'the_content_more_link', 'zp_read_more_link' );
function zp_read_more_link(  ) {
    return '&hellip; <a class="more-link" href="' . get_permalink(  ) . '"> '.__( 'Read More ','karl' ).'<i class="fa fa-angle-double-right"></i></a>';
}

// Removed Allowed Tags
add_filter( 'comment_form_defaults', 'zp_remove_comment_form_allowed_tags' );
function zp_remove_comment_form_allowed_tags( $defaults ) { 
	$defaults['comment_notes_after'] = '';
	return $defaults;
}

// Remove Site Footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Add Widget Area
genesis_register_sidebar( array(
	'id'			=> 'header-bottom-widget',
	'name'			=> __( 'Header Bottom Widget', 'karl' ),
	'description'	=> __( 'Widget area at the bottom of the header', 'karl' ),
) );

// Add Image Sizes
add_image_size( 'portfolio', '640', '319', true );

// Add Widget area after the header
add_action( 'genesis_header', 'zp_header_bottom_widget', 11 );
function zp_header_bottom_widget(){
	if(is_active_sidebar( 'header-bottom-widget' )){
		echo '<div class="header-bottom-widget">';
			dynamic_sidebar('header-bottom-widget');
		echo '</div>';
	}
}

add_action( 'get_header', 'zp_custom_reset_loop' );
function zp_custom_reset_loop(){
if( is_archive() || is_home() || is_page_template(  'page_blog.php' ) || is_post_type_archive( 'portfolio' ) ){
	// Remove Post Image
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );

	// Remove Post Info
	//remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

	// Remove Post Meta
	remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

	// Add New Image Wrapper
	add_action( 'genesis_entry_header', 'zp_post_image_new_wrapper', 4 );
	
	// Remove Post Content
	remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
}
}
/**
* New Post Image wrapper function
*/
function zp_post_image_new_wrapper(){
	global $post;
	$img = array();

	if ( ! is_singular() && genesis_get_option( 'content_archive_thumbnail' ) && !is_post_type_archive( 'portfolio' ) ) {

		$overlay = ( get_post_meta( get_the_ID(), 'overlay_color', true ) != ''  ) ? 'background-color: '.get_post_meta( get_the_ID(), 'overlay_color', true ).';' : 'background-color: #000000;';
		$overlay_opacity = ( get_post_meta( get_the_ID(), 'overlay_opacity', true ) != ''  ) ? 'opacity: '.get_post_meta( get_the_ID(), 'overlay_opacity', true ).';' : 'opacity: 0.8;';
		$bg_color = ( get_post_meta( get_the_ID(), 'bg_color', true ) != ''  ) ? 'background-color: '.get_post_meta( get_the_ID(), 'bg_color', true ).';' : 'background-color: #333333;';
		

		$img = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );

		if( $img[0] ){
			echo '<div class="post_image_overlay" style="'.$overlay.$overlay_opacity.'"></div><div class="post_image_holder" style="background-image: url('.$img[0].')"></div>';
		}else{
			echo '<div class="post_image_holder" style="'.$bg_color.';"></div>';
		}
	}

}

/* Display Category/Taxonomy Title */
function zp_portfolio_archive_template_items( $query ) {
    if ( is_admin() || ! $query->is_main_query() )
        return;

    if ( is_post_type_archive( 'portfolio' ) ) {
        $query->set( 'posts_per_page', -1 );
        return;
    }
}
//add_action( 'pre_get_posts', 'zp_portfolio_archive_template_items', 1 );

/**
* Add Blog Navigation
*/
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'zp_add_blog_nav' );
function zp_add_blog_nav(){
	if( is_home() || is_page_template( 'page_blog.php' ) || is_category() || is_date() || is_tag() || is_author() ){
		if( is_category() ){
			$category = get_category(get_query_var('cat'));
			$type = 'category';
			$value = $category->slug;
		}elseif( is_date() ){
			$year     = get_query_var('year');
			$monthnum = get_query_var('monthnum');
			$day      = get_query_var('day');
			$type = 'date';
			$value = $year.','.$monthnum.','.$day;
		}elseif( is_tag() ){
			$tag = get_queried_object();
			$type = 'tag';
			$value = $tag->slug;
		}elseif( is_author() ){
			$author = get_user_by( 'slug', get_query_var( 'author_name' ) );
			$type = 'author';
			$value = $author->ID;
		}else{
			$type = '';
			$value = '';
		}


		echo '<article class="type-post load_more_posts"><span class="load_more_wrap"><span class="load_more_label" data-nonce="'.wp_create_nonce('zp_load_posts').'" data-type="'.$type.'" data-value="'.$value.'" >'.__( 'Load More Posts', 'karl' ).'</span></span></article>';
	}else{
		genesis_prev_next_posts_nav();
	}
}

/**
* Add ID to the main content
*/
add_filter( 'genesis_attr_content', 'zp_main_attributes_content' );
function zp_main_attributes_content( $attributes ) {
	// blog layout
	$layout = genesis_get_option( 'zp_blog_layout', ZP_SETTINGS_FIELD );
	switch( $layout ){
		case 'one_row': $layout = 1; break;
		case 'two_rows': $layout = 2; break;
		case 'three_rows': $layout = 3; break;
		default: $layout = 2; break;
	}

	if( is_home() || is_page_template( 'page_blog.php' ) || is_category() || is_date() || is_tag() || is_author() ){
		$attributes['id'] = 'infinite-content';
		$attributes['data-row'] = $layout;
	}
	return $attributes;
}

/**
* Add attribute to the entry_header
*/
add_filter( 'genesis_attr_entry-header', 'zp_entry_header_attributes' );
function zp_entry_header_attributes( $attributes ) {
	global $post;

	$text_color = ( get_post_meta( $post->ID, 'text_color', true ) != ''  ) ? 'color: '.get_post_meta( $post->ID, 'text_color', true ).';' : 'color: #fff;';

	if( is_home() || is_page_template( 'page_blog.php' ) || is_category() || is_date() || is_tag() || is_author() ){
		$attributes['style'] = $text_color;
		}
	return $attributes;
}

/**
* Add Body Class to blog pages
*/
add_filter( 'body_class', 'zp_blog_page_body_class' );
function zp_blog_page_body_class( $classes ) {
	if( is_home() || is_page_template( 'page_blog.php' ) || is_category() || is_date() || is_tag() || is_author() ){
		$classes[] = 'zp_blog_page';
	}
	return $classes;
}

/**
* Add Content Loader
*/
add_action( 'genesis_before_content', 'zp_content_loader' );
function zp_content_loader(){
	echo '<div class="content_loader"><div class="line-scale-pulse-out"><div></div><div></div><div></div><div></div><div></div></div></div>';
}

/**
* Add search and cart in Nav areas
*/
add_filter( 'wp_nav_menu_items', 'zp_theme_nav_extras', 10, 2 );
function zp_theme_nav_extras( $menu, $args ) {
	global $woocommerce, $post;
	$cart_nav_icon_item = '';
	if ( 'primary' !== $args->theme_location )
		return $menu;

	if (class_exists( 'Woocommerce' )) {
		$link = $woocommerce->cart->get_cart_url();
		$total = $woocommerce->cart->cart_contents_count;
		$total = ( $total > 0 ) ? $total : 0;
		$cart_nav_icon_item .= '<li class="right zp_cart_item"><a href="'.$link.'" class="external"><i class="fa fa-shopping-cart"></i>( '.$total.' )</a></li>';
	}
	$menu .= $cart_nav_icon_item;
	return $menu;
}

/**
 * Include Custom Theme Function
 *
 * Write all your custom functions in this file
 */ 
require_once (  get_stylesheet_directory(  ) . '/include/custom_functions.php'   );