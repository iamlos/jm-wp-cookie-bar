<?php
namespace TokenToMe\wp_cookies;

if ( ! defined( 'WPCB_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}

class Main {

	protected static $instance;

	private function __construct() {
	}

	static function _get_instance() {

		if ( ! isset( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
	}

	static function scripts() {

		wp_enqueue_script( 'wp-cookiebar', WPCB_JS_URL . 'cookiebar.js', array(), null, true );

		//data to be passed
		$opts      = get_option( 'jm_wpcb' );
		$gaID      = sanitize_title_with_dashes( $opts['cookieBargaID'] );

		$args = array(
			'gaID'         => sanitize_title_with_dashes( $gaID ),
			'yes'          => __( 'Yes', 'jm-wpcb' ),
			'no'           => __( 'No', 'jm-wpcb' ),
			'explanation'  => __( '<b>Google Analytics</b></span></div><br><div>This website is using Google Analytics. Some data are sent to Google Inc. This is meant to improve your experience. Do you agree ?</div>', 'jm-wpcb' ),
			'confirm_no'   => __( 'You decided to opt out from cookie tracking.', 'jm-wpcb' ),
			'donottrack'   => __( 'DoNotTrack signal is enabled on your browser, do you confirm you want to activate this functionality ?', 'jm-wpcb' ),
			'a_more'       => __( 'Read more and/or opt out', 'jm-wpcb' ),
			'mess'         => __( 'This website is using Google Analytics. By browsing this website you authorize us to send a cookie to your browser.', 'jm-wpcb' ),
			'dnt'          => __( 'You`\'ve enabled DNT, we\'re respecting your choice"', 'jm-wpcb' ),
		);

		wp_localize_script( 'wp-cookiebar', '_wpcb__obj', $args );

	}
}