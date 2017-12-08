<?php
/*
Plugin Name: Bottom Admin Bar
Plugin URI: https://github.com/modshrink/bottom-admin-bar
Description: This plugin will move the admin bar to the bottom of the websites frontend.
Version: 1.4
Author: modshrink, bitstarr
Author URI: https://github.com/modshrink/bottom-admin-bar
Text Domain: bottom-admin-bar
Domain Path: /languages
License: GPL2

Copyright 2014  modshrink  (email : hello@modshrink.com)
Copyright 2017  Sebastian Laube (https://github.com/bitstarr)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

function BottomAdminBar_init() {
    return new BottomAdminBar();
}
add_action( 'init', 'BottomAdminBar_init' );

class BottomAdminBar {

	public function __construct() {
		add_action( 'after_setup_theme', array( &$this, 'show_toolbar_check' ) );
		add_action( 'plugins_loaded', array( &$this, 'load_textdomain' ) );
		add_action( 'get_header', array( &$this, 'remove_admin_bar_css' ) );
		add_action( 'wp_enqueue_scripts', array( &$this, 'admin_bar_script_init'), 11 );
		add_action( 'wp_enqueue_scripts', array( &$this, 'keyboard_shortcut' ), 21 );
	}

	/**
	 * Does the user want to see the admin bar at all?
	 */

	public function show_toolbar_check() {
		wp_get_current_user();
		if ( get_user_option( 'show_admin_bar_front', get_current_user_id() ) !== 'true' ) return;
	}

	/**
	 * Add language support
	 */

	public function load_textdomain() {
		load_plugin_textdomain( 'bottom-admin-bar', false, dirname( plugin_basename( __FILE__ ) ) );
	}

	/**
	 *  Add keyboard shortcut.
	 */

	public function keyboard_shortcut() {
	    if ( is_user_logged_in() ) {
	        wp_register_script( 'ab_shortcut', plugins_url( 'assets/shortcut.js', __FILE__ ), '', '1.4', true );
	        wp_enqueue_script( 'ab_shortcut' );
	    }
	}

	/**
	 *  Enqueue our CSS.
	 */

	public function admin_bar_script_init() {
	    if ( is_user_logged_in() ) {
	        wp_register_style( 'adminBarStyleSheet', plugins_url( 'assets/view.css', __FILE__ ) );
	        wp_enqueue_style( 'adminBarStyleSheet' );
	    }
	}

	/**
	 * Remove default admin bar inline CSS.
	 */

	public function remove_admin_bar_css() {
	    remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}
}
