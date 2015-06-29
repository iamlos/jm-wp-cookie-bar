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
		add_filter( 'body_class', array( __CLASS__, 'class_names' ) );
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts' ) );
	}

	static function scripts() {

		wp_register_style( 'wp-cookiebar-style', WPCB_CSS_URL . 'basic-style.css' );

		$opts = get_option( 'jm_wpcb' );
		if ( 'yes' === $opts['cookieBarStyle'] ) {
			wp_enqueue_style( 'wp-cookiebar-style' );
		}

		wp_enqueue_script( 'wp-cookiebar-lib', WPCB_JS_URL . 'jquery.cookiebar.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'wp-cookiebar', WPCB_JS_URL . 'cookiebar.js', array( 'wp-cookiebar-lib' ), null, true );

		// support SSL
		$is_ssl = is_ssl() ? 'https://' : 'http://';

		//data to be passed
		$opts      = get_option( 'jm_wpcb' );
		$class     = sanitize_html_class( $opts['closeClass'] );
		$mess      = esc_textarea( strip_tags( $opts['cookieBarText'] ) );
		$expire    = (int) $opts['cookieBarExpire'];
		$posi      = $opts['cookieBarPosition'];
		$linkRules = esc_url( $opts['cookieRulesUrl'] );
		$gaID      = sanitize_text_field( $opts['gaID'] );


		$args = array(
			'closeClass'    => $class,
			'mess'          => $mess,
			'expire'        => $expire,
			'posi'          => $posi,
			'linkRules'     => $linkRules,
			'textlinkRules' => __( 'Read more', 'jm-wpcb' ),
			'yes'           => __( 'Yes', 'jm-wpcb' ),
			'no'            => __( 'No', 'jm-wpcb' ),
			'gaID'          => $gaID,
		);

		wp_localize_script( 'wp-cookiebar', '_wpcb__obj', $args );

	}

	static function class_names( $classes ) {
		// add 'class-name' to the $classes array
		$classes[] = 'wpcb-cookie-bar';

		// return the $classes array
		return $classes;
	}
}