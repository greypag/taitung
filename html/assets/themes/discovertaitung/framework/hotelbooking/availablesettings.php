<?php
function dt_theme_hb_available_page() { ?>

    <div id="wrapper" class="wrap">
    	<h2><?php _e('Hotels Rooms Available Settings', 'iamd_text_domain'); ?></h2>
        <div class="updated settings-error dt-update-notice" id="setting-error-settings_updated" style="display:none;"><p><strong></strong></p></div>
        
        <form id="frmavailablesettings" name="frmavailablesettings" method="post" action="<?php echo get_admin_url()."admin.php?page=availablesettings"; ?>">
        	<?php $hb_available_settings = get_option('hb_available_settings'); ?>
        	<table class="form-table">
				<tbody>
					<tr>
						<th scope="row"><label for="cmbhotels"><?php _e('Select Hotel', 'iamd_text_domain'); ?></label></th>
						<td><select id="cmbhotels" name="cmbhotels">
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
						<th scope="row"><label for="roomtype"><?php _e('Select Room Type', 'iamd_text_domain'); ?></label></th>
						<td><select id="roomtype" name="roomtype"></select>&nbsp;&nbsp;<a href="javascript:void(0);" title="<?php _e('Clear Unavailable Dates', 'iamd_text_domain'); ?>" class="clear-unavailable"><?php _e('Clear Dates', 'iamd_text_domain'); ?></a></td>
					</tr>
                    <tr>
						<th scope="row"><label for="dpformat"><?php _e('Set Unavailable Dates for above Room Type', 'iamd_text_domain'); ?></label></th>
						<td><div id="rangeInlinePicker"></div><textarea id="txtseldates" name="txtseldates" style="display:none;"></textarea></td>
                    </tr>
				</tbody>
			</table>
            <p class="submit"><input type="submit" value="<?php _e('Save Changes', 'iamd_text_domain'); ?>" class="button button-primary save-unavailable" id="submit" name="submit"></p>
        </form>
    </div><?php

}?>