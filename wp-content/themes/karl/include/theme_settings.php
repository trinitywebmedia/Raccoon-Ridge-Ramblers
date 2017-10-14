<?php
/**-------------------------------------------------------------------
 * Theme Settings
 --------------------------------------------------------------------*/
 
define( 'ZP_SETTINGS_FIELD', 'zp-settings' );
/**
* zpsettings_default_theme_options function.
*/
function zpsettings_default_theme_options() {
	$options = array(
		'zp_logo' => '',
		'zp_logo_height' => 64,
		'zp_logo_width' => 180,
		'zp_default_overlay' => '',
		'zp_default_opacity' => '',
		'zp_default_text' => '',
		'zp_default_bg' => '',
		'zp_blog_layout' => 'two_rows',
		'zp_shop_layout' => 'one_row'


	);
	
	return apply_filters( 'zpsettings_default_theme_options', $options );
}
/**
* zpsettings_sanitize_inputs function.
*/ 
add_action( 'genesis_settings_sanitizer_init', 'zpsettings_sanitize_inputs' );
function zpsettings_sanitize_inputs() {
    genesis_add_option_filter( 'one_zero',
		ZP_SETTINGS_FIELD,
			array(
			)
		);
	genesis_add_option_filter( 'no_html',
		ZP_SETTINGS_FIELD,
			array(
				'zp_logo_height',
				'zp_logo_width',
				'zp_logo',
				'zp_default_overlay',
				'zp_default_opacity',
				'zp_default_text',
				'zp_default_bg',
				'zp_blog_layout',
				'zp_shop_layout'
			)
		);
		
	genesis_add_option_filter( 'requires_unfiltered_html',
		ZP_SETTINGS_FIELD,
			array(				
			)
		);
}
/**
* zpsettings_register_settings function.
*/
add_action( 'admin_init', 'zpsettings_register_settings' );
function zpsettings_register_settings() {
	register_setting( ZP_SETTINGS_FIELD, ZP_SETTINGS_FIELD );
	
	add_option( ZP_SETTINGS_FIELD, zpsettings_default_theme_options() );
	
	if ( genesis_get_option( 'reset', ZP_SETTINGS_FIELD ) ) {
		update_option( ZP_SETTINGS_FIELD, zpsettings_default_theme_options() );
		genesis_admin_redirect( ZP_SETTINGS_FIELD, array( 'reset' => 'true' ) );
		exit;
	}
}
/**
* zpsettings_theme_settings_notice function.
*/
add_action( 'admin_notices', 'zpsettings_theme_settings_notice' );
function zpsettings_theme_settings_notice() {
	if ( ! isset( $_REQUEST['page'] ) || $_REQUEST['page'] != ZP_SETTINGS_FIELD )
		return;
	if ( isset( $_REQUEST['reset'] ) && 'true' == $_REQUEST['reset'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings reset.', 'karl' ) . '</strong></p></div>';
	elseif ( isset( $_REQUEST['settings-updated'] ) && 'true' == $_REQUEST['settings-updated'] )
		echo '<div id="message" class="updated"><p><strong>' . __( 'Settings saved.', 'karl' ) . '</strong></p></div>';
}
/**
* zpsettings_theme_options function.
*/
add_action( 'admin_menu', 'zpsettings_theme_options' );
function zpsettings_theme_options() {
	global $_zpsettings_settings_pagehook;
	
	$_zpsettings_settings_pagehook = add_submenu_page( 'genesis', 'Karl Settings', 'Karl Settings', 'edit_theme_options', ZP_SETTINGS_FIELD, 'zpsettings_theme_options_page' );
	
	//add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_styles' );
	add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_scripts' );
	add_action( 'load-'.$_zpsettings_settings_pagehook, 'zpsettings_settings_boxes' );
}
/**
* zpsettings_settings_scripts function.
* This function enqueues the scripts needed for the ZP Settings settings page.
*/
function zpsettings_settings_scripts() {
	global $_zpsettings_settings_pagehook, $post;
	
	if( is_admin() ){
		
		
		wp_register_script( 'zp_image_upload', get_stylesheet_directory_uri() .'/include/upload/image-upload.js', array('jquery','media-upload','thickbox') );
		wp_enqueue_script('jquery');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
		wp_enqueue_script( 'common' );
		wp_enqueue_script( 'wp-lists' );
		wp_enqueue_script( 'postbox' );
		wp_enqueue_media();
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		
		wp_enqueue_media( array( 'post' => $post ) );
		wp_enqueue_script('zp_image_upload');		
	}
}
/**
* zpsettings_settings_boxes function.
*
* This function sets up the metaboxes to be populated by their respective callback functions.
*
*/
function zpsettings_settings_boxes() {
	global $_zpsettings_settings_pagehook;
	
	add_meta_box( 'zpsettings_blog_settings', __( 'Blog Settings', 'karl' ), 'zpsettings_blog_settings', $_zpsettings_settings_pagehook, 'main' ,'high');

	if ( class_exists( 'Woocommerce' ) ) {
		add_meta_box( 'zpsettings_shop_settings', __( 'Shop Layout Settings', 'karl' ), 'zpsettings_shop_settings', $_zpsettings_settings_pagehook, 'main' ,'high');
	}

	add_meta_box( 'zpsettings_default_settings', __( 'Default Header BG Settings', 'karl' ), 'zpsettings_default_settings', $_zpsettings_settings_pagehook, 'main' ,'high');
	add_meta_box( 'zpsettings_general_settings', __( 'General Settings', 'karl' ), 'zpsettings_general_settings', $_zpsettings_settings_pagehook, 'main' ,'high');
	//add_meta_box( 'zpsettings_portfolio_archive_settings', __( 'Portfolio Archive Settings', 'karl' ), 'zpsettings_portfolio_archive_settings', $_zpsettings_settings_pagehook, 'main' ,'high');
}
/**
* zpsettings_home_settings function.
*
* Callback function for the ZP Settings Social Sharing metabox.
*
*/
function zpsettings_blog_settings() { ?>
    <p class="zp_blog_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_one_row.png'; ?>" alt="One Row"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_blog_layout]" id="one_row" value="one_row" <?php checked( 'one_row', genesis_get_option( 'zp_blog_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <p class="zp_blog_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_two_row.png'; ?>" alt="Two Rows"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_blog_layout]" id="two_rows" value="two_rows" <?php checked( 'two_rows', genesis_get_option( 'zp_blog_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <p class="zp_blog_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_three_row.png'; ?>" alt="Three Rows"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_blog_layout]" id="three_rows" value="three_rows" <?php checked( 'three_rows', genesis_get_option( 'zp_blog_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <br class="clear">
<?php }

function zpsettings_shop_settings() { ?>
    <p class="zp_shop_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_one_row.png'; ?>" alt="One Row"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_shop_layout]" id="one_row" value="one_row" <?php checked( 'one_row', genesis_get_option( 'zp_shop_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <p class="zp_shop_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_two_row.png'; ?>" alt="Two Rows"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_shop_layout]" id="two_rows" value="two_rows" <?php checked( 'two_rows', genesis_get_option( 'zp_shop_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <p class="zp_shop_layout_selector"><label class="box"><img src="<?php echo get_stylesheet_directory_uri().'/images/portfolio_three_row.png'; ?>" alt="Three Rows"><br> <input type="radio" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_shop_layout]" id="three_rows" value="three_rows" <?php checked( 'three_rows', genesis_get_option( 'zp_shop_layout', ZP_SETTINGS_FIELD ) ); ?> ></label></p>
    <br class="clear">
<?php }

function zpsettings_default_settings() { ?>  
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_overlay]"><?php _e( 'Default Overlay Color', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_default_overlay', ZP_SETTINGS_FIELD ); ?>" class="default_overlay" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_overlay]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_overlay]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_opacity]"><?php _e( 'Default Overlay Opacity. Example 0.5', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_default_opacity', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_opacity]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_opacity]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_text]"><?php _e( 'Default Text Color.', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_default_text', ZP_SETTINGS_FIELD ); ?>" class="default_text"  id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_text]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_text]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_color]"><?php _e( 'Default BG Color.', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_default_color', ZP_SETTINGS_FIELD ); ?>" class="default_color"  id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_color]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_color]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_bg]"><?php _e( 'Default BG Image.', 'karl' ); ?></label>
    <input type="text" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_bg]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_default_bg]" value="<?php echo  genesis_get_option( 'zp_default_bg', ZP_SETTINGS_FIELD ); ?>" />    
    <input id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Image', 'karl' ); ?>" /> 
	<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Image', 'karl' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'zp_default_bg', ZP_SETTINGS_FIELD ); ?>" />
	</span>
    </p>
	<p><span class="description"><?php _e( 'Default BG settings for search and 404 page.','karl' ); ?></span></p>    
<?php }

function zpsettings_general_settings() { ?>
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]"><?php _e( 'Upload Custom Logo.', 'karl' ); ?></label>
    <input type="text" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo]" value="<?php echo  genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" />    
    <input id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Logo', 'karl' ); ?>" /> 
	<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Logo', 'karl' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'zp_logo', ZP_SETTINGS_FIELD ); ?>" />
	</span>
    </p>
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]"><?php _e( 'Custom Logo Width in pixel. e.g. 200', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_logo_width', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_width]">
	</p> 
    
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]"><?php _e( 'Custom Logo Height in pixel. e.g. 200', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_logo_height', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_height]">
	</p>       
	<p><span class="description"><?php _e( 'This is the general settings.','karl' ); ?></span></p>    
<?php }

function zpsettings_portfolio_archive_settings() { ?>  
    <p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_overlay]"><?php _e( 'Portfolio Archive Overlay Color', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_archive_overlay', ZP_SETTINGS_FIELD ); ?>" class="portfolio_archive_overlay" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_overlay]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_overlay]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_opacity]"><?php _e( 'Portfolio Archive Overlay Opacity. Example 0.5', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_archive_opacity', ZP_SETTINGS_FIELD ); ?>" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_opacity]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_opacity]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_text]"><?php _e( 'Portfolio Archive Text Color.', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_archive_text', ZP_SETTINGS_FIELD ); ?>" class="portfolio_archive_text"  id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_text]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_text]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_color]"><?php _e( 'Portfolio Archive BG Color.', 'karl' ); ?></label>
	<input type="text" size="30" value="<?php echo genesis_get_option( 'zp_portfolio_archive_color', ZP_SETTINGS_FIELD ); ?>" class="portfolio_archive_color"  id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_color]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_color]">
	</p>
	<p><label for="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_bg]"><?php _e( 'Portfolio Archive BG Image.', 'karl' ); ?></label>
    <input type="text" id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_bg]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_portfolio_archive_bg]" value="<?php echo  genesis_get_option( 'zp_portfolio_archive_bg', ZP_SETTINGS_FIELD ); ?>" />    
    <input id="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" name="<?php echo ZP_SETTINGS_FIELD; ?>[zp_logo_upload_button]" type="button" class="button upload_button" value="<?php _e( 'Upload Image', 'karl' ); ?>" /> 
	<input name="zp_remove_button" type="button"  class="button remove_button" value="<?php _e( 'Remove Image', 'karl' ); ?>" /> 
    <span class="upload_preview" style="display: block;">
		<img style="max-width:100%;" src="<?php echo genesis_get_option( 'zp_portfolio_archive_bg', ZP_SETTINGS_FIELD ); ?>" />
	</span>
    </p>
	<p><span class="description"><?php _e( 'This is the portfolio archive settings.','karl' ); ?></span></p>    
<?php }


/* Replace the 'Insert into Post Button inside Thickbox'
------------------------------------------------------------ */
function zp_replace_thickbox_text($translated_text, $text ) {	
	if ( 'Insert into Post' == $text ) {
		$referer = strpos( wp_get_referer(), ZP_SETTINGS_FIELD );
		if ( $referer != '' ) {
			return __('Insert Image!', 'karl' );
		}
	}
	return $translated_text;
}
/* Hook to filter Insert into Post Button in thickbox
------------------------------------------------------------ */
function zp_change_insert_button_text() {
		add_filter( 'gettext', 'zp_replace_thickbox_text' , 1, 2 );
}
add_action( 'admin_init', 'zp_change_insert_button_text' );
/**
 * zpsettings_settings_layout_columns function.
 *
 * This function sets the column layout to one for the ZP Settings settings page.
 *
 */
add_filter( 'screen_layout_columns', 'zpsettings_settings_layout_columns', 10, 2 );
function zpsettings_settings_layout_columns( $columns, $screen ) {
	global $_zpsettings_settings_pagehook;
	if ( $screen == $_zpsettings_settings_pagehook ) {
		$columns[$_zpsettings_settings_pagehook] = 2;
	}
	return $columns;
}
/**
 * zpsettings_theme_options_page function.
 *
 * This function displays the content for the ZP Settings settings page, builds the forms and outputs the metaboxes.
 *
 */
function zpsettings_theme_options_page() { 
	global $_zpsettings_settings_pagehook, $screen_layout_columns;
	
	$screen = get_current_screen();
	$width = "width: 100%;";
	$hide2 = $hide3 = " display: none;";
	?>	
	<div id="zpsettings" class="wrap genesis-metaboxes">
		<form method="post" action="options.php">
			<?php wp_nonce_field( 'closedpostboxes', 'closedpostboxesnonce', false ); ?>
			<?php wp_nonce_field( 'meta-box-order', 'meta-box-order-nonce', false ); ?>
			<?php settings_fields( ZP_SETTINGS_FIELD ); ?>
			
			<h2 style="width: 100%; margin-bottom: 10px;" ><?php _e( 'Karl Settings', 'karl' ); ?>
                <span style="float: right; text-align: center;"><input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'karl' ) ?>" style="vertical-align: top;" />
                <input type="submit" class="button genesis-h2-button" name="<?php echo ZP_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'karl' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset?', 'karl' ) ); ?>');" /></span>
            </h2>
            
       		<div class="metabox-holder">
				<div class="postbox-container" style="<?php echo $width; ?>">
					<?php do_meta_boxes( $_zpsettings_settings_pagehook, 'main', null ); ?>
				</div>
			</div>
            <div class="bottom-buttons">
                <input type="submit" class="button-primary genesis-h2-button" value="<?php _e( 'Save Settings', 'karl' ) ?>" />
                <input type="submit" class="button genesis-h2-button" name="<?php echo ZP_SETTINGS_FIELD; ?>[reset]" value="<?php _e( 'Reset Settings', 'karl' ); ?>" onclick="return genesis_confirm('<?php echo esc_js( __( 'Are you sure you want to reset?', 'karl' ) ); ?>');" />            
            </div>            
		</form>
     </div>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready( function($) {
			// close postboxes that should be closed
			$('.if-js-closed').removeClass('if-js-closed').addClass('closed');
			// postboxes setup
			postboxes.add_postbox_toggles('<?php echo $_zpsettings_settings_pagehook; ?>');
		});
		//]]>
	</script>
	<style type="text/css">
	span.upload_preview {
	    width: 200px;
	    height: auto;
	}
	</style>
<?php }