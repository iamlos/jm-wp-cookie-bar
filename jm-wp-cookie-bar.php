<?php
/*
Plugin Name: JM WP Cookie Bar
Plugin URI: http://tweetpress.fr
Description: Because it's mandatory when using Google Analytics. Opt-out included !
Version: 2.0
Author: Julien Maury
Author URI: http://tweetpress.fr
Text Domain: jm-wpcb
Domain Path: /languages
*/
/*
License: GPL v3

JM WP Cookie Bar
Copyright (C) 2014, Julien Maury - contact@tweetpress.fr

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/


defined( 'ABSPATH' ) or die( 'No direct load!' );

define( 'WPCB_VERSION', '1.6' );
define( 'WPCB_DIR', plugin_dir_path( __FILE__ ) );
define( 'WPCB_URL', plugin_dir_url( __FILE__ ) );
define( 'WPCB_CSS_URL', WPCB_URL . 'css/' );
define( 'WPCB_JS_URL', WPCB_URL . 'js/' );
define( 'WPCB_IMG_URL', WPCB_URL . 'assets/img/' );
define( 'WPCB_SLUG', 'jm-wpcb' );
define( 'WPCB_LANG_DIR', dirname( plugin_basename( __FILE__ ) ) . '/languages/' );


//Call modules
if ( is_admin() ) {

	require( WPCB_DIR . '/classes/options.class.php' );
	require( WPCB_DIR . '/classes/init.class.php' );
}

require( WPCB_DIR . '/classes/main.php' );

// Early init
add_action( 'plugins_loaded', '_wpcb_early_init' );
function _wpcb_early_init() {

	if ( is_admin() ) {

		$WPCB_Tool_Page = TokenToMe\wp_cookies\Options::_get_instance();
		$WPCB_Tool_Page->init();

	}

	$WPCB_Main = TokenToMe\wp_cookies\Main::_get_instance();
	$WPCB_Main->init();

	// Language support
	load_plugin_textdomain( 'jm-wpcb', false, WPCB_LANG_DIR );

}

// On activation
register_activation_hook( __FILE__, array( 'TokenToMe\wp_cookies\Init', 'activate' ) );