<?php
if ( ! defined( 'WPCB_VERSION' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}
?>
<div class="wrap">
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php if ( isset( $_GET['settings-updated'] ) ) {
		echo "<div class='updated'><p>" . __( 'Settings saved.' ) . "</p></div>";
	} ?>

	<form class="jm-wpcb-form" method="POST" action="options.php">
		<?php settings_fields( WPCB_SLUG ); ?>
		<fieldset>
			<legend><?php _e( 'Options' ); ?></legend>
			<p>
				<label for="cookieBargaID"><?php _e( 'ID Google Analytics', WPCB_SLUG ); ?></label><br/>
				<input id="cookieBargaID" size="25" type="text" name="jm_wpcb[cookieBargaID]" placeholder="UA-000000-01" value="<?php echo strtoupper( sanitize_title_with_dashes( $opts['cookieBargaID'] ) ); ?>" />
			</p>
			<?php submit_button( null, 'primary', '_submit' ); ?>
		</fieldset>
	</form>
</div>