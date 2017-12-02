<?php
function dt_theme_hb_service_page() {
	
	if(isset($_REQUEST['submit']) == 'Save Changes') {
		
		$a = array('hb-hotel-id' => $_REQUEST['cmbserhotels'], 'hb-service-name' => $_REQUEST['servicename'], 'hb-service-des' => $_REQUEST['description'], 'hb-service-price' => $_REQUEST['sprice']);
		$opts = get_option('hb_service_settings');
		
		if($opts == NULL) {
			$hb_service_settings[1] = $a;
			update_option('hb_service_settings', $hb_service_settings);
		} else {
			array_push($opts, $a);
			update_option('hb_service_settings', $opts);
		}
		
		$text = __('Settings saved.', 'iamd_text_domain');
	}
	
	if(isset($_REQUEST['delete']) == 'Delete') {
		
		$sids = $_REQUEST['service'];
		if($sids != ""):
			$opts = get_option('hb_service_settings');
			foreach($sids as $sid):
				unset($opts[$sid]);
			endforeach;
			update_option('hb_service_settings', $opts);
			
			$text = __('Settings deleted.', 'iamd_text_domain');
		endif;			
	} ?>
    
    <div id="wrapper" class="wrap">
    	<h2><?php _e('Hotels Additional Services', 'iamd_text_domain'); ?></h2>
        <?php if(!empty($text)) echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>'.$text.'</strong></p></div>'; ?>
        
        <form id="frmservicesettings" name="frmservicesettings" method="post" action="<?php echo get_admin_url()."admin.php?page=servicesettings";?>">
        	<table class="form-table">
				<tbody>
                	<tr>
						<th scope="row"><label for="cmbhotels"><?php _e('Hotel', 'iamd_text_domain'); ?></label></th>
						<td><select id="cmbserhotels" name="cmbserhotels">
                        		<option value=""><?php _e('Choose Hotel', 'iamd_text_domain'); ?></option><?php
								$args = array('post_type' => 'dt_hotels', 'posts_per_page' => -1, 'order' => 'ASC');
								$the_query = new WP_Query($args);
								if($the_query->have_posts()):
									while($the_query->have_posts()): $the_query->the_post();
										?><option value="<?php the_ID(); ?>"><?php the_title(); ?></option><?php
									endwhile;
								endif;
								wp_reset_query($the_query); ?>
                         </select></td>
                    </tr>
					<tr>
						<th scope="row"><label for="servicename"><?php _e('Service Name', 'iamd_text_domain'); ?></label></th>
						<td><input type="text" id="servicename" name="servicename" class="regular-text" required="required" placeholder="<?php _e('ex: Swimming Pool', 'iamd_text_domain'); ?>" /></td>
					</tr>
					<tr>
						<th scope="row"><label for="description"><?php _e('Description', 'iamd_text_domain'); ?></label></th>
						<td><textarea id="description" name="description" class="medium-text code" cols="40"></textarea></td>
					</tr>
                	<tr>
						<th scope="row"><label for="sprice"><?php _e('Price', 'iamd_text_domain'); ?>&nbsp;(<?php echo dt_theme_currecy_symbol(); ?>)</label></th>
						<td><input type="text" id="sprice" name="sprice" class="regular-text" required="required" placeholder="120.99" /></td>
					</tr>
				</tbody>
			</table>
            <p class="submit"><input type="submit" value="<?php _e('Save Changes','iamd_text_domain'); ?>" class="button button-primary" id="submit" name="submit"></p>
        </form>
        
        <form method="post" action="" class="dt-sort-table">
            <h3><?php _e('Available Services', 'iamd_text_domain'); ?></h3>
            <label for="quicksearch"></label><input type="text" id="quicksearch" name="quicksearch" placeholder="<?php _e('Type to search', 'iamd_text_domain'); ?>..." />
            <table class="wp-list-table widefat fixed tablesorter dt-sc-tbl-services" style="width:80%" cellspacing="1">
                <thead>
                    <tr>
                        <th class="manage-column column-cb check-column" id="cb" scope="col">
                            <label for="cb-select-all-1" class="screen-reader-text"><?php _e('Select All', 'iamd_text_domain'); ?></label>
                            <input type="checkbox" id="cb-select-all-1">
                        </th>
                        <th scope="col">
                            <span><?php _e('Service Name', 'iamd_text_domain'); ?></span>
                        </th>
                        <th scope="col">
                            <span><?php _e('Hotel', 'iamd_text_domain'); ?></span>
                        </th>
                        <th scope="col">
                            <span><?php _e('Description', 'iamd_text_domain'); ?></span>
                        </th>
                        <th scope="col">
                            <span><?php _e('Price', 'iamd_text_domain'); ?></span>
                        </th>
                    </tr>
                </thead>
                <tbody data-wp-lists="list:service" id="the-list">
                <?php
                    $service_opts = get_option('hb_service_settings');
                    if($service_opts != NULL):
                        foreach($service_opts as $key => $service): ?>
                            <tr class="alternate">
                                <th class="check-column" scope="row">
                                    <label for="cb-select-<?php echo $key; ?>" class="screen-reader-text"><?php _e('Select Service', 'iamd_text_domain'); ?></label>
                                    <input type="checkbox" value="<?php echo $key; ?>" class="administrator" id="service_<?php echo $key; ?>" name="service[]">
                                </th>
                                <td><?php echo $service['hb-service-name']; ?></td>
                                <td><?php echo get_the_title($service['hb-hotel-id']); ?></td>
                                <td><?php echo $service['hb-service-des']; ?></td>
                                <td><?php echo $service['hb-service-price']; ?></td>
                            </tr><?php
                        endforeach;
					else:
						?><tr class="no-items"><td colspan="5" class="colspanchange"><?php _e('No Services found.', 'iamd_text_domain'); ?></td></tr><?php
                    endif; ?>
                </tbody>
            </table>
            <p class="submit"><input type="submit" value="<?php _e('Delete', 'iamd_text_domain'); ?>" class="button button-primary" id="delete" name="delete"></p>
            <div id="pager" class="dt-theme-pager">
                <a href="#" class="first"></a>
                <a href="#" class="prev"></a>
                <input type="text" class="pagedisplay"/>
                <a href="#" class="next"></a>
                <a href="#" class="last"></a>
                <select class="pagesize">
                    <option selected="selected"  value="5">5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option  value="40">40</option>
                </select>
            </div>
		</form>
    </div>
    <?php

}?>