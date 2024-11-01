<?php
/*
Plugin Name: Unique Cursor
Plugin URI: http://wordpress.org/plugins/
Description: Add an unique cursor to your unique theme
Author: sAlex
Author URI: http://codecanyon.net/user/sAlex
Version: 1.0
*/
if ( !function_exists( 'add_action' ) ) {
	echo 'Can\'t be called directly';
	exit;
}

define('UNIQUE_CURSOR_URL', plugin_dir_url( __FILE__ ));

#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_install() { 			#install plugin
#-------------------------------------------------------------------------------------------
	
    $option = get_option('UNIQUE_CURSOR');
    if (false === $option) {
					
	$option = array();
	$option['cursor_id'] = 0;
	$option['locked'] = true;
	$option['cursor'] = "";
	$option['cursor_enabled'] = true;
	$option['version'] = 1.0;
	
	add_option('UNIQUE_CURSOR', $option);
    }
}	
#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_reinstall() { 			#update plugin
#-------------------------------------------------------------------------------------------
	
}				
#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_uninstaller() {		#uninstall plugin
#-------------------------------------------------------------------------------------------
    //delete_option('UNIQUE_CURSOR');
}				
#-------------------------------------------------------------------------------------------
function build_nw_menu() {					#build admin menu
#-------------------------------------------------------------------------------------------
   $page = add_menu_page(__('Unique Cursor','pulse-notify'), __('Unique Cursor','unique-cursor'), 'manage_options', 'unique-cursor', 'UNIQUE_CURSOR_bootPage', 'div');
	add_action( 'admin_print_styles-'.$page, 'UNIQUE_CURSOR_includeCSS');
	add_action( 'admin_print_scripts-'.$page, 'UNIQUE_CURSOR_includeJS');
   	wp_register_style('UNIQUE_CURSOR_admin', UNIQUE_CURSOR_URL.'css/admin.css');
    wp_enqueue_style( 'UNIQUE_CURSOR_admin');
}
#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_includeJS(){  					#add files
#-------------------------------------------------------------------------------------------
 global $wp_version;
	if($wp_version <= 3.2) {
		wp_deregister_script('jquery'); 
		wp_register_script('jquery', 'http://code.jquery.com/jquery-1.7.2.min.js', false, '1.5.2');
	}
	
	wp_register_script('UNIQUE_CURSOR_bootstrap', UNIQUE_CURSOR_URL.'js/bootstrap.js'); 
	wp_register_script('UNIQUE_CURSOR_bootstrap_modal', UNIQUE_CURSOR_URL.'js/bootstrap-modal.js'); 
	wp_register_script('UNIQUE_CURSOR_bootstrap_transition', UNIQUE_CURSOR_URL.'js/bootstrap-transition.js');
	wp_register_script('UNIQUE_CURSOR_script', UNIQUE_CURSOR_URL.'js/script.js');  
    
	wp_enqueue_script('jquery');
	
    wp_enqueue_script( 'UNIQUE_CURSOR_bootstrap');
    wp_enqueue_script( 'UNIQUE_CURSOR_bootstrap_transition');
    wp_enqueue_script( 'UNIQUE_CURSOR_bootstrap_modal');
    wp_enqueue_script( 'UNIQUE_CURSOR_script');
	}
#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_includeCSS(){  					#add files
#-------------------------------------------------------------------------------------------
   wp_register_style('UNIQUE_CURSOR_style', UNIQUE_CURSOR_URL.'css/style.css');
    wp_register_style('UNIQUE_CURSOR_bootstrap', UNIQUE_CURSOR_URL.'css/bureau.css');
	
    wp_enqueue_style( 'UNIQUE_CURSOR_style');
    wp_enqueue_style( 'UNIQUE_CURSOR_bootstrap'); 
}
#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_bootPage() {  					#settings page
#-------------------------------------------------------------------------------------------

	require_once(dirname(__FILE__).'/includes/markup/mk-boot-page.php');
}

#-------------------------------------------------------------------------------------------
function UNIQUE_CURSOR_init() {  					#spy logic
#-------------------------------------------------------------------------------------------
	$option = get_option('UNIQUE_CURSOR');
	if(isset($option['cursor_enabled']) && $option['cursor_enabled']){
		wp_enqueue_style(
			'UNIQUE_CURSOR_cursor',
			UNIQUE_CURSOR_URL.'css/cursor.css'
		);
	    $body_css = "
	            body{
	                    cursor: url(".$option['cursor']."), auto !important;
	            }";
	    wp_add_inline_style( 'UNIQUE_CURSOR_cursor', $body_css );
	}
	
}

#check for update

#register hooks
register_activation_hook( __FILE__, 'UNIQUE_CURSOR_install'); 
register_deactivation_hook( __FILE__, 'UNIQUE_CURSOR_uninstaller'); 
#build admin menu
add_action('admin_menu', 'build_nw_menu');
#run main logic
add_action('admin_init', 'UNIQUE_CURSOR_reinstall');
add_action('wp_enqueue_scripts', 'UNIQUE_CURSOR_init');
?>