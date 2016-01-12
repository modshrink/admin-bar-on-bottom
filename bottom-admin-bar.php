<?php
/*
Plugin Name: Bottom Admin Bar
Plugin URI: https://github.com/modshrink/bottom-admin-bar
Description: While you are logged in to WordPress, this plugin will move to the bottom the admin bar that is displayed on the web site.
Version: 1.1
Author: modshrink
Author URI: http://www.modshrink.com/
Text Domain: bottom-admin-bar
Domain Path: /languages
License: GPL2

Copyright 2014  modshrink  (email : hello@modshrink.com)

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

$BottomAdminBar = new BottomAdminBar();


class BottomAdminBar {
    
  public function __construct() {
    
    $show_admin_bar_front = get_user_meta(get_current_user_id(), 'show_admin_bar_front', 1);

    if($show_admin_bar_front == 'true'){
      add_action( 'plugins_loaded', array(&$this, 'myplugin_init') );
      add_action( 'wp_enqueue_scripts', array(&$this, 'admin_bar_script_init'), 11 );
      add_action( 'get_header', array(&$this, 'remove_admin_bar_css') );
      add_action( 'wp_head', array(&$this, 'my_admin_bar_bump_cb') );
      add_action( 'wp_foot', array(&$this, 'keyboard_shortcut') );
    }
  }

  /**
   * Load plugin textdomain.
   */

  public function myplugin_init() {
    load_plugin_textdomain( 'bottom-admin-bar', false, dirname( plugin_basename( __FILE__ ) ) ); 
  }

  /**
   *  Override default admin bar CSS.
   */

  public function admin_bar_script_init() {
    if ( is_user_logged_in() ) {
      wp_register_style( 'adminBarStyleSheet', plugins_url('css/view.css', __FILE__) );
      wp_enqueue_style( 'adminBarStyleSheet' );
      wp_enqueue_script( 'jquery' );
    }
  }

  /**
   * Remove default admin bar inline CSS.
   */

  public function remove_admin_bar_css() {
    remove_action('wp_head', '_admin_bar_bump_cb');
  }

  /**
   * Rewrite admin bar inline CSS.
   */

  public function my_admin_bar_bump_cb() {
    if ( is_user_logged_in() ) {
      echo "<style type=\"text/css\" media=\"screen\">";
      echo "html { padding-bottom: 32px !important; }";
      echo "* html body { padding-bottom: 32px !important; }";
      echo "@media screen and ( max-width: 782px ) {";
      echo "html { padding-bottom: 46px !important; }";
      echo "* html body { padding-bottom: 46px !important; }";
      echo "}";
      echo "</style>";
    }
  }

  /**
   * Add keyboard shortcut.
   */

  public function keyboard_shortcut() {
    if ( is_user_logged_in() ) { ?>
      <script type="text/javascript">
        jQuery(document).ready(function($){
          $("body").keydown( function ( event ){
            if( event.shiftKey === true && event.which === 65 ){
              $("#wpadminbar").slideToggle();
            }
          });
        });
      </script>
  <?php }
  }

}
