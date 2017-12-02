<?php
function dt_theme_hb_general_page() {
	
	if(!empty($_POST['submit'])) {
		
		$hb_general_settings = array();
		$hb_general_settings['hb-general-currency'] = $_REQUEST['currency'];
		$hb_general_settings['hb-general-paypalsadbox'] = $_REQUEST['paypalsandbox'];
		$hb_general_settings['hb-general-paypalapiuname'] = $_REQUEST['paypalapiuname'];
		$hb_general_settings['hb-general-paypalapipass'] = $_REQUEST['paypalapipass'];
		$hb_general_settings['hb-general-paypalapisign'] = $_REQUEST['paypalapisign'];
		$hb_general_settings['hb-general-paypalreturn'] = $_REQUEST['paypalreturn'];
		$hb_general_settings['hb-general-paypalcancel'] = $_REQUEST['paypalcancel'];
		$hb_general_settings['hb-general-enabledepositdue'] = !empty( $_REQUEST['enabledepositdue'] ) ? $_REQUEST['enabledepositdue'] : '';
		$hb_general_settings['hb-general-depositpercent'] = $_REQUEST['depositpercent'];
		
		update_option('hb_general_settings', $hb_general_settings);
		
		$text = __('Settings saved.', 'iamd_text_domain');
	} ?>
    
    <div id="wrapper" class="wrap">
    	<h2><?php _e('Hotels General Settings', 'iamd_text_domain'); ?></h2>
        <?php if(!empty($text)) echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>'.__('Settings saved.', 'iamd_text_domain').'</strong></p></div>'; ?>
        
        <form id="frmgeneralsettings" name="frmgeneralsettings" method="post" action="<?php echo get_admin_url()."admin.php?page=generalsettings";?>">
        	<?php $hb_general_settings = get_option('hb_general_settings'); ?>
        	<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="currency"><?php _e('Currency', 'iamd_text_domain'); ?></label></th>
						<td><select id="currency" name="currency"><?php
                        	$currency_code_options = get_dt_theme_hb_currencies();
							foreach ( $currency_code_options as $code => $name ) {
								$currency_code_options[ $code ] = $name . ' (' . get_dt_theme_hb_currency_symbol( $code ) . ')';
							}
							foreach( $currency_code_options as $code => $name ) {
								?><option value="<?php echo $code; ?>" <?php selected($code, $hb_general_settings['hb-general-currency']); ?>><?php echo $name; ?></option><?php
							}
						?></select></td>
					</tr>
                    <tr>
						<th scope="row"><label for="paypalsandbox"><?php _e('PayPal Sandbox', 'iamd_text_domain'); ?><br />(<?php _e('Test PayPal', 'iamd_text_domain'); ?>)</label></th>
						<td><select id="paypalsandbox" name="paypalsandbox"><?php
							$psandbox = array('false' => 'No', 'true' => 'Yes');
							foreach($psandbox as $key => $ps) {
								?><option value="<?php echo $key; ?>" <?php selected($key, $hb_general_settings['hb-general-paypalsadbox']); ?>><?php echo $ps; ?></option><?php
							}
                        ?></select></td>
                    </tr>
                	<tr>
						<th scope="row"><label for="paypalapiuname"><?php _e('PayPal API UserName', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-paypalapiuname']; ?>" id="paypalapiuname" name="paypalapiuname" /></td>
					</tr>
                    
                	<tr>
						<th scope="row"><label for="paypalapipass"><?php _e('PayPal API Password', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-paypalapipass']; ?>" id="paypalapipass" name="paypalapipass" /></td>
					</tr>
                    
                	<tr>
						<th scope="row"><label for="paypalapisign"><?php _e('PayPal API Signature', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-paypalapisign']; ?>" id="paypalapisign" name="paypalapisign" /></td>
					</tr>
                    <tr>
						<th scope="row"><label for="paypalreturn"><?php _e('PayPal Return URL', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-paypalreturn']; ?>" id="paypalreturn" name="paypalreturn" placeholder="http://example.com/return/"></td>
					</tr>
                	<tr>
						<th scope="row"><label for="paypalcancel"><?php _e('PayPal Cancel URL', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-paypalcancel']; ?>" id="paypalcancel" name="paypalcancel" placeholder="http://example.com/cancel/"></td>
					</tr>
                	<tr>
						<th scope="row"><label for="enabledepositdue"><?php _e('Enable Deposit Due', 'iamd_text_domain'); ?></label></th>
						<td><input type="checkbox" value="true" <?php if($hb_general_settings['hb-general-enabledepositdue']) echo 'checked="checked"'; ?> id="enabledepositdue" name="enabledepositdue" /></td>
					</tr>
                	<tr>
						<th scope="row"><label for="depositpercent"><?php _e('Deposit Due (%)', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" class="regular-text" value="<?php echo $hb_general_settings['hb-general-depositpercent']; ?>" id="depositpercent" name="depositpercent" placeholder="15" /></td>
					</tr>
				</tbody>
			</table>
            <p class="submit"><input type="submit" value="<?php _e('Save Changes', 'iamd_text_domain'); ?>" class="button button-primary" id="submit" name="submit"></p>
        </form>
    </div>
    <?php
}?>