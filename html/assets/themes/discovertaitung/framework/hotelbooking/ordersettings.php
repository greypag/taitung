<?php
function dt_theme_hb_order_page() {
	
	if(isset($_REQUEST['delete']) == 'Delete') {
		
		$oids = $_REQUEST['order'];
		if($oids != ""):
			$orders = get_option('hb_order_settings');
			foreach($oids as $oid):
				unset($orders[$oid]);
			endforeach;
			update_option('hb_order_settings', $orders);
			
			$text = __('Orders deleted.', 'iamd_text_domain');
		endif;			
	} ?>
    
    <div id="wrapper" class="wrap">
    	<h2><?php _e('Hotels Order Details', 'iamd_text_domain'); ?></h2>
        <?php if(!empty($text)) echo '<div class="updated settings-error" id="setting-error-settings_updated"><p><strong>'.$text.'</strong></p></div>'; ?>
        
        <form method="post" action="" class="dt-sort-table" style="margin-top:20px;">
            <label for="quicksearch"><?php _e('Submitted Orders', 'iamd_text_domain'); ?>: </label><input type="text" id="quicksearch" name="quicksearch" placeholder="<?php _e('Type to search', 'iamd_text_domain'); ?>..." />
            <table class="wp-list-table widefat fixed tablesorter dt-sc-tbl-orders" style="width:100%" cellspacing="1">
                <thead>
                    <tr>
                        <th class="manage-column column-cb check-column" id="cb" scope="col">
                            <label for="cb-select-all-1" class="screen-reader-text"><?php _e('Select All', 'iamd_text_domain'); ?></label>
                            <input type="checkbox" id="cb-select-all-1">
                        </th>
                        <th scope="col"><span><?php _e('Payer ID', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('First Name', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Last Name', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Email', 'iamd_text_domain'); ?></span></th>
                        <th scope="col" style="width:6%;"><span><?php _e('Country', 'iamd_text_domain'); ?></span></th>
                        <th scope="col" style="width:6%;"><span><?php _e('Amount', 'iamd_text_domain'); ?></span></th>
						<th scope="col"><span><?php _e('Hotel', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Room', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Service IDs', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Check In', 'iamd_text_domain'); ?></span></th>
                        <th scope="col"><span><?php _e('Check Out', 'iamd_text_domain'); ?></span></th>
                        <th scope="col" style="width:6%;"><span><?php _e('Adults', 'iamd_text_domain'); ?></span></th>
                        <th scope="col" style="width:6%;"><span><?php _e('Childs', 'iamd_text_domain'); ?></span></th>
						<th scope="col" style="width:6%;"><span><?php _e('Deposit (%)', 'iamd_text_domain'); ?></span></th>
						<th scope="col" style="width:6%;"><span><?php _e('Net Amount', 'iamd_text_domain'); ?></span></th>
                    </tr>
                </thead>
                <tbody data-wp-lists="list:service" id="the-list">
                <?php
                    $order_details = get_option('hb_order_settings');
                    if($order_details != NULL):
                        foreach($order_details as $key => $order): ?>
                            <tr class="alternate">
                                <th class="check-column" scope="row">
                                    <label for="cb-select-<?php echo $key; ?>" class="screen-reader-text"><?php _e('Select Order', 'iamd_text_domain'); ?></label>
                                    <input type="checkbox" value="<?php echo $key; ?>" class="administrator" id="order_<?php echo $key; ?>" name="order[]">
                                </th>
                                <td><?php echo $order['Payer_ID']; ?></td>
                                <td><?php echo $order['First_Name']; ?></td>
                                <td><?php echo $order['Last_Name']; ?></td>
                                <td><?php echo $order['Email']; ?></td>
                                <td><?php echo $order['Country']; ?></td>
                                <td><?php echo $order['Amount']; ?></td>
                                <td><?php echo get_the_title($order['Hotel_ID']); ?></td>
                                <td><?php echo get_the_title($order['Room_ID']); ?></td>
                                <td><?php echo $order['Service_IDs']; ?></td>
                                <td><?php echo $order['Check_In']; ?></td>
                                <td><?php echo $order['Check_Out']; ?></td>
                                <td><?php echo $order['Adults']; ?></td>
								<td><?php echo $order['Childs']; ?></td>
								<td><?php echo $order['Deposit_Due']; ?></td>
								<td><?php echo $order['Net_Amount']; ?></td>
                            </tr><?php
                        endforeach;
					else:
						?><tr class="no-items"><td colspan="16" class="colspanchange"><?php _e('No Orders found.', 'iamd_text_domain'); ?></td></tr><?php
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