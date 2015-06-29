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
				<input id="cookieBargaID" size="25" type="text" name="jm_wpcb[cookieBargaID]" placeholder="UA-000000-01" value="<?php esc_attr_e( strip_tags( $opts['gaID'] ) ); ?>" />
			</p>
			<p>
				<label for="closeClass"><?php _e( 'Which CSS class do you want to add to style the close button? (default is .wpcb-close-btn)', WPCB_SLUG ); ?></label><br/>
				<input id="closeClass" type="text" name="jm_wpcb[closeClass]" size="25" value="<?php echo sanitize_html_class( $opts['closeClass'] ); ?>"/>
			</p>
			<p>
				<label for="cookieBarExpire"><?php _e( 'Set the cookie expiration time? (default is 365 days)', WPCB_SLUG ); ?></label><br/>
				<input id="cookieBarExpire" type="number" name="jm_wpcb[cookieBarExpire]" min="365" max="400" value="<?php echo (int) $opts['cookieBarExpire']; ?>"/>
			</p>
			<p>
				<label for="cookieBarText"><?php _e( 'The text to be shown. (120 chars at most)', WPCB_SLUG ); ?></label><br/>
				<textarea id="cookieBarText" maxlenght="120" type="text" rows="8" cols="100" name="jm_wpcb[cookieBarText]"><?php echo esc_textarea( strip_tags( $opts['cookieBarText'] ) ); ?></textarea>
			</p>
			<p>
				<label for="ccookieRulesUrl"><?php _e( 'URL for your cookie rules', WPCB_SLUG ); ?> </label><br/>
				<input id="cookieRulesUrl" type="url" size="100" name="jm_wpcb[cookieRulesUrl]" value="<?php echo esc_url( $opts['cookieRulesUrl'] ); ?>"/>
			</p>
			<p>
				<label for="cookieBarPosition"><?php _e( 'Which position?', WPCB_SLUG ); ?> :</label>
				<select class="styled-select" id="cookieBarPosition" name="jm_wpcb[cookieBarPosition]">
					<option value="top" <?php selected( $opts['cookieBarPosition'], 'top' ); ?> ><?php _e( 'top of the page', WPCB_SLUG ); ?></option>
					<option value="bottom" <?php selected( $opts['cookieBarPosition'], 'bottom' ); ?> ><?php _e( 'bottom of the page', WPCB_SLUG ); ?></option>
				</select>
				<br/><em>(<?php _e( 'Default is top of the page', WPCB_SLUG ); ?>)</em>
			</p>
			<p>
				<label for="cookieBarStyle"><?php _e( 'Include basic styles?', WPCB_SLUG ); ?> </label>
				<select class="styled-select" id="cookieBarStyle" name="jm_wpcb[cookieBarStyle]">
					<option value="yes" <?php selected( $opts['cookieBarStyle'], 'yes' ); ?> ><?php _e( 'yes', WPCB_SLUG ); ?></option>
					<option value="no" <?php selected( $opts['cookieBarStyle'], 'no' ); ?> ><?php _e( 'no', WPCB_SLUG ); ?></option>
				</select>
				<br/><em>(<?php _e( 'Default is yes. Be careful, this could mess up with bar position so do not forget to add required styles in your own stylesheet.', WPCB_SLUG ); ?>)</em>
			</p>
			<?php submit_button( null, 'primary', '_submit' ); ?>
		</fieldset>
	</form>
</div>