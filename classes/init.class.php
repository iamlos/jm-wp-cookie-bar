<?php
namespace TokenToMe\wp_cookies;

if ( ! defined( 'WPCB_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class Init {

	/**
	 * Handle activation
	 */
	public static function activate() {
		if ( is_multisite() && ! is_plugin_active_for_network( 'jm-wp-cookie-bar/jm-wp-cookie-bar.php' ) ) {
			// For regular options.
			global $wpdb;
			$blog_ids = $wpdb->get_col( "SELECT blog_id FROM {$wpdb->blogs}" );
			foreach ( $blog_ids as $blog_id ) {
				switch_to_blog( $blog_id );
				self::on_activation();
				restore_current_blog();
			}
		} else {
			self::on_activation();
		}

	}

	public static function on_activation() {

		$opts = get_option( 'jm_wpcb' );

		if ( ! is_array( $opts ) ) {
			update_option( 'jm_wpcb', self::get_default_options() );
		}
	}

	/*
	* Default options
	*/

	public static function get_default_options() {
		return array(
			'cookieBargaID'     => '',
		);
	}
}
