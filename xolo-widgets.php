<?php
/*
Plugin Name: Xolo Widgets
Plugin URI: 
Description: Xolo Widget gives you a collection of widgets in  fastest way to add more widgets into your WordPress website.
Version: 1.0
Author: xolosoftware
Author URI: https://profiles.wordpress.org/xolosoftware/
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Text Domain: xolo-widgets
*/

/**
 * Exit if accessed directly.
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

/**
 * Set constants.
 */
define( 'XOLO_WIDGETS_FILE', __FILE__ );
define( 'XOLO_WIDGETS_BASE', plugin_basename( XOLO_WIDGETS_FILE ) );
define( 'XOLO_WIDGETS_DIR', plugin_dir_path( XOLO_WIDGETS_FILE ) );
define( 'XOLO_WIDGETS_URI', plugins_url( '/', XOLO_WIDGETS_FILE ) );
define( 'XOLO_WIDGETS_VER', '1.0' );
define( 'XOLO_WIDGETS_TEMPLATE_DEBUG_MODE', false );

require_once XOLO_WIDGETS_DIR . 'classes/class-xolo-widgets.php';
