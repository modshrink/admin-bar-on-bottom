<?php
/*
Plugin Name: Admin Bar on Bottom
Plugin URI: https://github.com/modshrink/admin-bar-on-bottom
Description: Move admin bar to bottom.
Version: 0.0.1
Author: mayoibi
Author URI: http://www.modshrink.com/
*/

add_action( 'wp_enqueue_scripts', 'admin_bar_style_init' );
add_action( 'get_header','remove_admin_bar_css' );

function admin_bar_style_init() {
     wp_register_style( 'adminBarStyleSheet', plugins_url('css/view.css', __FILE__) );
     wp_enqueue_style( 'adminBarStyleSheet' );
}

function remove_admin_bar_css() {
    remove_action('wp_head', '_admin_bar_bump_cb');

}
 