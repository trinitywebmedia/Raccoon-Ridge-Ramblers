<?php 
// ZP Custom Post Types and Post Meta Initialization
function zp_custom_post_type() {
	if ( ! class_exists( 'Super_CPT' ) )
		return;

	$page_meta = new Super_Custom_Post_Meta( 'page' );
				
	$page_meta->add_meta_box( array(	
		'id' => 'home_box_1',
		'name' => 'Home Box 1',		
		'context' => 'normal',		
		'priority' => 'high',
		'fields' => array(		
			'enable_box1' => array( 'label' => '', 'type' => 'checkbox', 'data-desc' => __( 'Enable this box','karl') ),
			'box_height1' => array( 'label' => '', 'type' => 'select', 'options' => array( 'box_full' => 'Full', 'box_one_half' => 'One-Half', 'box_one_third' => 'One-Third' ), 'data-desc' => __( 'Select box height.','karl') ),
			'box_width1' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box width in percentage. Example: 50 for 50%','karl') ),
			'box_bgimage1' => array( 'label' => '', 'type' => 'media', 'data-desc' => __( 'Set box background image','karl') ),
			'box_bgcolor1' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_textcolor1' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box text color','karl') ),
			'box_bgcolor1' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_overlaycolor1' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box overlay color','karl') ),
			'box_overlayopac1' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box overlay opacity. Max value is 1. Example: 0.5','karl') ),
			'box_content1' => array( 'label' => '', 'type' => 'wysiwyg', 'data-desc' => __( 'Add box content','karl') ),
		)	
	) );

	$page_meta->add_meta_box( array(	
		'id' => 'home_box_2',
		'name' => 'Home Box 2',		
		'context' => 'normal',		
		'priority' => 'high',
		'fields' => array(		
			'enable_box2' => array( 'label' => '', 'type' => 'checkbox', 'data-desc' => __( 'Enable this box','karl') ),
			'box_height2' => array( 'label' => '', 'type' => 'select', 'options' => array( 'box_full' => 'Full', 'box_one_half' => 'One-Half', 'box_one_third' => 'One-Third' ), 'data-desc' => __( 'Select box height.','karl') ),
			'box_width2' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box width in percentage. Example: 50 for 50%','karl') ),
			'box_bgimage2' => array( 'label' => '', 'type' => 'media', 'data-desc' => __( 'Set box background image','karl') ),
			'box_bgcolor2' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_textcolor2' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box text color','karl') ),
			'box_bgcolor2' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_overlaycolor2' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box overlay color','karl') ),
			'box_overlayopac2' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box overlay opacity. Max value is 1. Example: 0.5','karl') ),
			'box_content2' => array( 'label' => '', 'type' => 'wysiwyg', 'data-desc' => __( 'Add box content','karl') ),
		)	
	) );

	$page_meta->add_meta_box( array(	
		'id' => 'home_box_3',
		'name' => 'Home Box 3',		
		'context' => 'normal',		
		'priority' => 'high',
		'fields' => array(		
			'enable_box3' => array( 'label' => '', 'type' => 'checkbox', 'data-desc' => __( 'Enable this box','karl') ),
			'box_height3' => array( 'label' => '', 'type' => 'select', 'options' => array( 'box_full' => 'Full', 'box_one_half' => 'One-Half', 'box_one_third' => 'One-Third' ), 'data-desc' => __( 'Select box height.','karl') ),
			'box_width3' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box width in percentage. Example: 50 for 50%','karl') ),
			'box_bgimage3' => array( 'label' => '', 'type' => 'media', 'data-desc' => __( 'Set box background image','karl') ),
			'box_bgcolor3' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_textcolor3' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box text color','karl') ),
			'box_bgcolor3' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_overlaycolor3' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box overlay color','karl') ),
			'box_overlayopac3' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box overlay opacity. Max value is 1. Example: 0.5','karl') ),
			'box_content3' => array( 'label' => '', 'type' => 'wysiwyg', 'data-desc' => __( 'Add box content','karl') ),
		)	
	) );

	$page_meta->add_meta_box( array(	
		'id' => 'home_box_4',
		'name' => 'Home Box 4',		
		'context' => 'normal',		
		'priority' => 'high',
		'fields' => array(		
			'enable_box4' => array( 'label' => '', 'type' => 'checkbox', 'data-desc' => __( 'Enable this box','karl') ),
			'box_height4' => array( 'label' => '', 'type' => 'select', 'options' => array( 'box_full' => 'Full', 'box_one_half' => 'One-Half', 'box_one_third' => 'One-Third' ), 'data-desc' => __( 'Select box height.','karl') ),
			'box_width4' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box width in percentage. Example: 50 for 50%','karl') ),
			'box_bgimage4' => array( 'label' => '', 'type' => 'media', 'data-desc' => __( 'Set box background image','karl') ),
			'box_bgcolor4' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_textcolor4' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box text color','karl') ),
			'box_bgcolor4' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box background color','karl') ),
			'box_overlaycolor4' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set box overlay color','karl') ),
			'box_overlayopac4' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set box overlay opacity. Max value is 1. Example: 0.5','karl') ),
			'box_content4' => array( 'label' => '', 'type' => 'wysiwyg', 'data-desc' => __( 'Add box content','karl') ),
		)	
	) );
	
	$page_meta->add_meta_box( array(	
		'id' => 'page_description',
		'name' => 'Page Description',		
		'context' => 'side',		
		'priority' => 'high',
		'fields' => array(		
			'page_desc' => array( 'label' => '', 'type' => 'textarea', 'data-desc' => __( 'Set page description','karl') )
		)	
	) );

	$page_meta->add_meta_box( array(	
		'id' => 'page_option',
		'name' => 'Page Option',		
		'context' => 'side',		
		'priority' => 'high',
		'fields' => array(		
			'overlay_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set overlay color','karl') ),
			'overlay_opacity' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set overlay opacity. Example: 0.5','karl') ),
			'text_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set text color','karl') ),
			'bg_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set background color','karl') ),
		)	
	) );

	// Post Metabox
	$post_meta = new Super_Custom_Post_Meta( 'post' );
	$post_meta->add_meta_box( array(	
		'id' => 'post_option',
		'name' => 'Post Option',		
		'context' => 'side',		
		'priority' => 'high',
		'fields' => array(		
			'overlay_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set overlay color','karl') ),
			'overlay_opacity' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set overlay opacity. Example: 0.5','karl') ),
			'text_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set text color','karl') ),
			'bg_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set background color','karl') ),
		)	
	) );

	/// Product Metabox
	$product_meta = new Super_Custom_Post_Meta( 'product' );
	$product_meta->add_meta_box( array(	
		'id' => 'product_option',
		'name' => 'Product Option',		
		'context' => 'side',		
		'priority' => 'high',
		'fields' => array(		
			'overlay_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set overlay color','karl') ),
			'overlay_opacity' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set overlay opacity. Example: 0.5','karl') ),
			'text_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set text color','karl') ),
			'bg_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set background color','karl') ),
		)	
	) );

/*----------------------------------------------------*/
// Add Portfolio Custom Post Type
/*---------------------------------------------------*/
	$portfolio_custom_default = array(
		'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','excerpt','genesis-layouts', 'genesis-seo', 'genesis-cpt-archives-settings' ),
		'menu_icon' =>  get_stylesheet_directory_uri().'/include/cpt/images/portfolio.png',
	);
	
	// register portfolio post type
	$portfolio = new Super_Custom_Post_Type( 'portfolio', 'Portfolio', 'Portfolio',  $portfolio_custom_default );
	$portfolio_category = new Super_Custom_Taxonomy( 'portfolio_category' ,'Portfolio Category', 'Portfolio Categories', 'cat' );
	connect_types_and_taxes( $portfolio, array( $portfolio_category ) );


	$portfolio->add_meta_box( array(	
		'id' => 'portfolio_option',
		'name' => 'Portfolio Option',		
		'context' => 'side',		
		'priority' => 'high',
		'fields' => array(		
			'overlay_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set overlay color','karl') ),
			'overlay_opacity' => array( 'label' => '', 'type' => 'text', 'data-desc' => __( 'Set overlay opacity. Example: 0.5','karl') ),
			'text_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set text color','karl') ),
			'bg_color' => array( 'label' => '', 'type' => 'color', 'data-desc' => __( 'Set background color','karl') ),
		)	
	) );

	
	// manage portfolio columns
	function zp_add_portfolio_columns($columns) {
		return array(
			'cb' => '<input type="checkbox" />',
			'title' => __('Title', 'karl'),
			'portfolio_category' => __('Portfolio Category', 'karl'),
			'author' =>__( 'Author', 'karl'),
			'date' => __('Date', 'karl'),
		);
	}
	
	add_filter('manage_portfolio_posts_columns' , 'zp_add_portfolio_columns');
	
	function zp_custom_portfolio_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'portfolio_category' :
				$terms = get_the_term_list( $post_id , 'portfolio_category' , '' , ',' , '' );
					if ( is_string( $terms ) )
						echo $terms;
					else
						_e( 'Unable to get portfolio category(s)', 'karl' );
					break;
		}			
	}
	add_action( 'manage_posts_custom_column' , 'zp_custom_portfolio_columns', 10, 2 );
}
add_action( 'after_setup_theme', 'zp_custom_post_type' );


/**
* Add New Archive defaults
*/
add_filter( 'genesis_cpt_archive_settings_defaults', 'zp_portfolio_archive_defaults' );
function zp_portfolio_archive_defaults( $defaults ){

	$new_args = array(
		'enable_title'    => true,
		'portfolio_archive_layout'  => 'one_row',
		'overlay_color'    => '',
		'overlay_opacity' => '',
		'text_color'    => '',
		'bg_color'      => '',
		'bg_image'  => ''
	);

	return wp_parse_args( $new_args, $defaults );
}

/**
* Sanitize new default arguments
*/
add_action( 'genesis_settings_sanitizer_init', 'zp_portfolio_archive_defaults_sanitize' );
function zp_portfolio_archive_defaults_sanitize(){
	genesis_add_option_filter(
		'no_html',
		'genesis-cpt-archive-settings-portfolio',
		array(
			'portfolio_archive_layout',
			'overlay_color',
			'overlay_opacity',
			'text_color',
			'bg_image',
			'bg_color'
		)
	);
	genesis_add_option_filter(
		'one_zero',
		'genesis-cpt-archive-settings-portfolio',
		array(
			'enable_title'
		)
	);
}

/**
* Add Additional portfolio archive settings 
*/

add_action( 'genesis_cpt_archives_settings_metaboxes', 'zp_add_portfolio_archive' );
function zp_add_portfolio_archive( $hook ){

	if( $hook != 'portfolio_page_genesis-cpt-archive-portfolio' )
		return;

	add_meta_box( 'genesis-cpt-archives-portfolio-settings', __( 'Portfolio Archive Settings', 'karl' ), 'portfolio_archive_settings', $hook, 'main' );
}

function portfolio_archive_settings(){
?>
	<p>
		<label for="genesis-cpt-archive-settings-portfolio[enable_title]"><input type="checkbox" name="genesis-cpt-archive-settings-portfolio[enable_title]" id="genesis-cpt-archive-settings-portfolio[enable_title]" value="1" <?php checked( genesis_get_option('enable_title', 'genesis-cpt-archive-settings-portfolio' ) ); ?> />
		<?php _e( 'Enable portfolio archive title', 'karl'); ?></label><br />
	</p>

	<p><label for="genesis-cpt-archive-settings-portfolio[portfolio_archive_layout]"><b><?php _e( 'Portfolio Archive Layout', 'karl' ); ?></b></label></p>
	<p class="zp_portfolio_layout_selector">
		<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_one_row.png'; ?>" alt="One Row"><br> <input type="radio" name="genesis-cpt-archive-settings-portfolio[portfolio_archive_layout]" id="one_row" value="one_row" <?php checked( 'one_row', genesis_get_option('portfolio_archive_layout', 'genesis-cpt-archive-settings-portfolio' ) ); ?> ></label>
		<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_two_row.png'; ?>" alt="Two Rows"><br> <input type="radio" name="genesis-cpt-archive-settings-portfolio[portfolio_archive_layout]" id="two_rows" value="two_rows" <?php checked( 'two_rows', genesis_get_option('portfolio_archive_layout', 'genesis-cpt-archive-settings-portfolio' ) ); ?> ></label>
		<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_three_row.png'; ?>" alt="Three Rows"><br> <input type="radio" name="genesis-cpt-archive-settings-portfolio[portfolio_archive_layout]" id="three_rows" value="three_rows" <?php checked( 'three_rows', genesis_get_option('portfolio_archive_layout', 'genesis-cpt-archive-settings-portfolio' ) ); ?> ></label>
	</p>
   
   	<p><label for="genesis-cpt-archive-settings-portfolio[overlay_color]"><b><?php _e( 'Portfolio Archive Overlay Color', 'karl' ); ?></b></label></p>
	<p><input type="text" size="30" value="<?php echo genesis_get_option( 'overlay_color', 'genesis-cpt-archive-settings-portfolio' ); ?>" class="portfolio_archive_overlay" id="genesis-cpt-archive-settings-portfolio[overlay_color]" name="genesis-cpt-archive-settings-portfolio[overlay_color]"></p>
	
	<p><label for="genesis-cpt-archive-settings-portfolio[overlay_opacity]"><b><?php _e( 'Portfolio Archive Overlay Opacity', 'karl' ); ?></b></label></p>
	<p><input type="text" size="30" value="<?php echo genesis_get_option( 'overlay_opacity', 'genesis-cpt-archive-settings-portfolio' ); ?>"  id="genesis-cpt-archive-settings-portfolio[overlay_opacity]" name="genesis-cpt-archive-settings-portfolio[overlay_opacity]"></p>
	<p class="description"><?php _e( 'Set overlay opacity. Maximum value is 1. Example: 0.5','' ); ?></p>

	<p><label for="genesis-cpt-archive-settings-portfolio[text_color]"><b><?php _e( 'Portfolio Archive Text Color', 'karl' ); ?></b></label></p>
	<p><input type="text" size="30" value="<?php echo genesis_get_option( 'text_color', 'genesis-cpt-archive-settings-portfolio' ); ?>" class="portfolio_archive_overlay" id="genesis-cpt-archive-settings-portfolio[text_color]" name="genesis-cpt-archive-settings-portfolio[text_color]"></p>

	<p><label for="genesis-cpt-archive-settings-portfolio[bg_color]"><b><?php _e( 'Portfolio Archive BG Color', 'karl' ); ?></b></label></p>
	<p><input type="text" size="30" value="<?php echo genesis_get_option( 'bg_color', 'genesis-cpt-archive-settings-portfolio' ); ?>" class="portfolio_archive_overlay" id="genesis-cpt-archive-settings-portfolio[bg_color]" name="genesis-cpt-archive-settings-portfolio[bg_color]"></p>

	<p><label for="genesis-cpt-archive-settings-portfolio[bg_image]"><?php _e( 'Portfolio Archive BG Image.', 'karl' ); ?></label>
    <input type="text" id="genesis-cpt-archive-settings-portfolio[bg_image]" name="genesis-cpt-archive-settings-portfolio[bg_image]" value="<?php echo  genesis_get_option( 'bg_image', 'genesis-cpt-archive-settings-portfolio' ); ?>" />    
    <input id="zp-settings[zp_logo_upload_button]" name="zp-settings[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Image', 'karl' ); ?>" /> 
	<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Image', 'karl' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'bg_image', 'genesis-cpt-archive-settings-portfolio' ); ?>" />
	</span>
    </p>
<?php
}

/**
* Enqueue color picker on Portfolio Archive
*/
add_action( 'admin_menu', 'portfolio_archive_scripts' );
function portfolio_archive_scripts() {
	add_action( 'load-portfolio_page_genesis-cpt-archive-portfolio', 'portfolio_archive_script' );
}
function portfolio_archive_script(){
	wp_register_script( 'zp_image_upload', get_stylesheet_directory_uri() .'/include/upload/image-upload.js', array('jquery','media-upload','thickbox') );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_media();
	wp_enqueue_script('zp_image_upload');	
}


/*
* Add portfolio category heading options
*
*/
add_action( 'admin_init', 'zp_add_taxonomy_archive_options' );
function zp_add_taxonomy_archive_options(){
	add_action( 'portfolio_category_edit_form', 'zp_taxonomy_archive_options', 9 );
}

function zp_taxonomy_archive_options( $tag ){
	var_dump($tag);
	?>
	<h3><?php echo __( 'Portfolio Category Header Options', 'karl' ); ?></h3>

	<table class="form-table postbox-container">
		<tbody>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[enable_header]"><?php _e( 'Enable Header', 'karl' ); ?></label></th>
				<td>
					<label for="genesis-meta[enable_header]"><input name="genesis-meta[enable_header]" id="genesis-meta[enable_header]" type="checkbox" value="1" <?php checked( get_term_meta( $tag->term_id, 'enable_header', true ) ); ?> />
					<?php _e( 'Enable portfolio category title?', 'karl'); ?></label>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_layout]"><?php _e( 'Portfolio Category Layout', 'karl' ); ?></label></th>
				<td>
					<fieldset class="zp_portfolio_layout_selector_wrap">
						<legend class="screen-reader-text"><?php _e( 'Choose Layout', 'genesis' ); ?></legend>					
						<p class="zp_portfolio_layout_selector">
							<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_one_row.png'; ?>" alt="One Row"><br> <input type="radio" name="genesis-meta[portfolio_category_layout]" id="one_row" value="one_row" <?php checked( 'one_row', get_term_meta( $tag->term_id, 'portfolio_category_layout', true ) ); ?> ></label>
							<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_two_row.png'; ?>" alt="Two Row"><br> <input type="radio" name="genesis-meta[portfolio_category_layout]" id="two_row" value="two_rows" <?php checked( 'two_rows', get_term_meta( $tag->term_id, 'portfolio_category_layout', true ) ); ?> ></label>
							<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_three_row.png'; ?>" alt="Three Row"><br> <input type="radio" name="genesis-meta[portfolio_category_layout]" id="three_row" value="three_rows" <?php checked( 'three_rows', get_term_meta( $tag->term_id, 'portfolio_category_layout', true ) ); ?> ></label>
							
						</p>
					</fieldset>
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_overlay_color]"><?php _e( 'Portfolio Category Overlay', 'karl' ); ?></label></th>
				<td>
					<label for="genesis-meta[overlay_color]"><input name="genesis-meta[portfolio_category_overlay_color]" id="genesis-meta[portfolio_category_overlay_color]" type="text" size="30" value="<?php echo esc_attr(get_term_meta( $tag->term_id, 'portfolio_category_overlay_color', true )); ?>" class="portfolio_archive_overlay" />
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_overlay_opacity]"><?php _e( 'Portfolio Category Opacity', 'karl' ); ?></label></th>
				<td>
					<label for="genesis-meta[portfolio_category_overlay_opacity]"><input name="genesis-meta[portfolio_category_overlay_opacity]" id="genesis-meta[portfolio_category_overlay_opacity]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'portfolio_category_overlay_opacity', true ) ); ?>" />
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_text_color]"><?php _e( 'Portfolio Category Text Color', 'karl' ); ?></label></th>
				<td>
					<label for="genesis-meta[portfolio_category_text_color]"><input name="genesis-meta[portfolio_category_text_color]" id="genesis-meta[portfolio_category_text_color]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'portfolio_category_text_color', true ) ); ?>" class="portfolio_archive_overlay" />
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_bg_color]"><?php _e( 'Portfolio Category BG Color', 'karl' ); ?></label></th>
				<td>
					<label for="genesis-meta[portfolio_category_bg_color]"><input name="genesis-meta[portfolio_category_bg_color]" id="genesis-meta[portfolio_category_bg_color]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'portfolio_category_bg_color', true ) ); ?>" class="portfolio_archive_overlay" />
				</td>
			</tr>
			<tr class="form-field">
				<th scope="row"><label for="genesis-meta[portfolio_category_bg_image]"><?php _e( 'Portfolio Category BG Image', 'karl' ); ?></label></th>
				<td>
					<p><input type="text" id="genesis-meta[portfolio_category_bg_image]" name="genesis-meta[portfolio_category_bg_image]" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'portfolio_category_bg_image', true ) ); ?>" />    
				    <input id="zp-settings[zp_logo_upload_button]" name="zp-settings[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Image', 'karl' ); ?>" /> 
					<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Image', 'karl' ); ?>" /> 
				    <span class="upload_preview" style="display: block;">
						<img style="max-width:100%;" src="<?php echo get_term_meta( $tag->term_id, 'portfolio_category_bg_image', true ); ?>" />
					</span>
				    </p>
				</td>
			</tr>

		</tbody>
	</table>
	<?php
}

/**
* Add new terms
*/
add_filter( 'genesis_term_meta_defaults', 'zp_portfolio_category_terms' );
function zp_portfolio_category_terms( $args ){
	$args['enable_header'] = 0;
	$args['portfolio_category_layout'] = 'one_row';
	$args['portfolio_category_overlay_color'] = '';
	$args['portfolio_category_overlay_opacity'] = '';
	$args['portfolio_category_text_color'] = '';
	$args['portfolio_category_bg_color'] = '';
	$args['portfolio_category_bg_image'] = '';
	return $args;
}

/**
* Enqueue Dependent Script and CSS
*/
function zp_load_script_portfolio_category() {

	$screen = get_current_screen();
	$post_taxonomy = $screen->taxonomy ;
 
	if( $post_taxonomy != 'portfolio_category' ) 
		return;
 
	wp_register_script( 'zp_image_upload', get_stylesheet_directory_uri() .'/include/upload/image-upload.js', array('jquery','media-upload','thickbox') );
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
	wp_enqueue_media();
	wp_enqueue_script('zp_image_upload');
}
add_action('admin_enqueue_scripts', 'zp_load_script_portfolio_category');


/*
* Add Product Category and Product Tag option
*/

if ( class_exists( 'Woocommerce' ) ) {
	/*
	* Add portfolio category heading options
	*
	*/
	add_action( 'admin_init', 'zp_product_taxonomy_options' );
	function zp_product_taxonomy_options(){
		add_action( 'product_cat_edit_form', 'zp_taxonomy_product_options', 9 );
	}

	function zp_taxonomy_product_options( $tag ){
		?>
		<h3><?php echo __( 'Product Category Header Options', 'karl' ); ?></h3>

		<table class="form-table postbox-container">
			<tbody>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[enable_header]"><?php _e( 'Enable Header', 'karl' ); ?></label></th>
					<td>
						<label for="genesis-meta[enable_header]"><input name="genesis-meta[enable_header]" id="genesis-meta[enable_header]" type="checkbox" value="1" <?php checked( get_term_meta( $tag->term_id, 'enable_header', true) ); ?> />
						<?php _e( 'Enable product category title?', 'karl'); ?></label>
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_layout]"><?php _e( 'Product Category Layout', 'karl' ); ?></label></th>
					<td>
						<fieldset class="zp_portfolio_layout_selector_wrap">
							<legend class="screen-reader-text"><?php _e( 'Choose Layout', 'genesis' ); ?></legend>					
							<p class="zp_portfolio_layout_selector">
								<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_one_row.png'; ?>" alt="One Row"><br> <input type="radio" name="genesis-meta[product_category_layout]" id="one_row" value="one_row" <?php checked( 'one_row', get_term_meta( $tag->term_id, 'product_category_layout', true) ); ?> ></label>
								<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_two_row.png'; ?>" alt="Two Row"><br> <input type="radio" name="genesis-meta[product_category_layout]" id="two_row" value="two_rows" <?php checked( 'two_rows', get_term_meta( $tag->term_id, 'product_category_layout', true) ); ?> ></label>
								<label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_three_row.png'; ?>" alt="Three Row"><br> <input type="radio" name="genesis-meta[product_category_layout]" id="three_row" value="three_rows" <?php checked( 'three_rows', get_term_meta( $tag->term_id, 'product_category_layout', true) ); ?> ></label>
								
							</p>
						</fieldset>
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_overlay_color]"><?php _e( 'Product Category Overlay', 'karl' ); ?></label></th>
					<td>
						<label for="genesis-meta[overlay_color]"><input name="genesis-meta[product_category_overlay_color]" id="genesis-meta[product_category_overlay_color]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_category_overlay_color', true) ); ?>" class="portfolio_archive_overlay" />
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_overlay_opacity]"><?php _e( 'Product Category Opacity', 'karl' ); ?></label></th>
					<td>
						<label for="genesis-meta[product_category_overlay_opacity]"><input name="genesis-meta[product_category_overlay_opacity]" id="genesis-meta[product_category_overlay_opacity]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_category_overlay_opacity', true) ); ?>" />
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_text_color]"><?php _e( 'Product Category Text Color', 'karl' ); ?></label></th>
					<td>
						<label for="genesis-meta[product_category_text_color]"><input name="genesis-meta[product_category_text_color]" id="genesis-meta[product_category_text_color]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_category_text_color', true) ); ?>" class="portfolio_archive_overlay" />
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_bg_color]"><?php _e( 'Product Category BG Color', 'karl' ); ?></label></th>
					<td>
						<label for="genesis-meta[product_category_bg_color]"><input name="genesis-meta[product_category_bg_color]" id="genesis-meta[product_category_bg_color]" type="text" size="30" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_category_bg_color', true) ); ?>" class="portfolio_archive_overlay" />
					</td>
				</tr>
				<tr class="form-field">
					<th scope="row"><label for="genesis-meta[product_category_bg_image]"><?php _e( 'Product Category BG Image', 'karl' ); ?></label></th>
					<td>
						<p><input type="text" id="genesis-meta[product_category_bg_image]" name="genesis-meta[product_category_bg_image]" value="<?php echo esc_attr( get_term_meta( $tag->term_id, 'product_category_bg_image', true) ); ?>" />    
					    <input id="zp-settings[zp_logo_upload_button]" name="zp-settings[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Image', 'karl' ); ?>" /> 
						<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Image', 'karl' ); ?>" /> 
					    <span class="upload_preview" style="display: block;">
							<img style="max-width:100%;" src="<?php echo get_term_meta( $tag->term_id, 'product_category_bg_image', true); ?>" />
						</span>
					    </p>
					</td>
				</tr>

			</tbody>
		</table>
		<?php
	}

	/**
	* Add new terms
	*/
	add_filter( 'genesis_term_meta_defaults', 'zp_product_category_terms' );
	function zp_product_category_terms( $args ){
		$args['enable_header'] = 0;
		$args['product_category_layout'] = 'one_row';
		$args['product_category_overlay_color'] = '';
		$args['product_category_overlay_opacity'] = '';
		$args['product_category_text_color'] = '';
		$args['product_category_bg_color'] = '';
		$args['product_category_bg_image'] = '';
		return $args;
	}

	/**
	* Enqueue Dependent Script and CSS
	*/
	add_action('admin_enqueue_scripts', 'zp_load_script_product_category');
	function zp_load_script_product_category() {

		$screen = get_current_screen();
		$post_taxonomy = $screen->taxonomy ;
	 
		if( $post_taxonomy != 'product_cat' ) 
			return;
	 
		wp_register_script( 'zp_image_upload', get_stylesheet_directory_uri() .'/include/upload/image-upload.js', array('jquery','media-upload','thickbox') );
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_media();
		wp_enqueue_script('zp_image_upload');
	}

}
