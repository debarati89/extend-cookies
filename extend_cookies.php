<?php
/*
Plugin Name: Extend Cookies
Plugin URI: http://wordpress.org/plugins/#/
Description: Extend Cookies plugin will let you extend the lifetime of existing cookies.
Author: Debarati Datta.
Version: 0.2.9
Author URI: https://github.com/debarati89/
*/
global $adv_db_version;
$adv_db_version = '1.0';

function extend_cookies_activate() {

    global $wpdb;
    global $cookie_db_version;
    $main_table_name = $wpdb->prefix . 'extend_cookies';
    $charset_collate = $wpdb->get_charset_collate();

    $cookieTableSql = "CREATE TABLE $main_table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        cookies_name tinytext NOT NULL,
        cookies_expiry text NOT NULL,
        UNIQUE KEY id (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $cookieTableSql);
   

    add_option( 'cookie_db_version', $cookie_db_version );

  /* activation code here */
}
register_activation_hook( __FILE__, 'extend_cookies_activate' );



function extend_cookies_deactivate() {

echo "You have successfully activated this plugin";
  /* deactivation code here */
}
register_deactivation_hook( __FILE__, 'extend_cookies_deactivate' );



function cookies_enqueue_style() {
    wp_enqueue_style( 'bootstrap', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css', false ); 
}

function cookies_enqueue_script() {
    wp_enqueue_script( 'bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', false );
    wp_enqueue_script( 'jQuery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false );
    wp_enqueue_script( 'cookie-js', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js', false );
    
}

add_action( 'admin_enqueue_scripts', 'cookies_enqueue_style' );
add_action( 'admin_enqueue_scripts', 'cookies_enqueue_script' );
/**
 * Load media files needed for Uploader
 */
function cookies_load_wp_media_files() {
  wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'cookies_load_wp_media_files' );
add_action('admin_menu', 'extend_cookies_setup_menu');
 
function extend_cookies_setup_menu(){
        add_menu_page( 'Cookies Management', 'Cookies Management', 'manage_options', 'cookies', 'cookies_init' );
}
 
include('extend_cookies_init.php');
