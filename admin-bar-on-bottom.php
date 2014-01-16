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
add_action( 'add_admin_bar_menus', 'parent_menu_item', 10 );

function admin_bar_style_init() {
     wp_register_style( 'adminBarStyleSheet', plugins_url('css/view.css', __FILE__) );
     wp_register_script( 'adminBarJavaScript', plugins_url('js/admin-bar-on-bottom.js', __FILE__), array('jquery') );
     wp_enqueue_style( 'adminBarStyleSheet' );
     wp_enqueue_script( 'adminBarJavaScript' );
}

function remove_admin_bar_css() {
    remove_action('wp_head', '_admin_bar_bump_cb');

}

function parent_menu_item() {
    global $wp_admin_bar;
    $wp_admin_bar->add_menu( 
        array( 
            'id'        => 'parent_id_name',
            'meta'     => array( 'html' => '',
                                 'class' => 'admin-bar-fold',
                                 'onclick' => '',
                                 'target' => '',
                                 'title' => ''
                                ),
            'title'     => __( '', '' ),
            'href'      => '#'
        ) 
    );
}