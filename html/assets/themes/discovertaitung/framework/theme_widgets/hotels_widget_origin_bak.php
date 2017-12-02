<?php
/** Hotels Widget
  * Objective:
  *		1.To list out posts
**/
class MY_Hotels_Widget extends WP_Widget {
	#1.constructor
	function __construct() {
		$widget_options = array("classname"=>'widget_recent_entries', 'description'=>'To list out hotels');
		parent::__construct(false,IAMD_THEME_NAME.__(' Hotels','iamd_text_domain'),$widget_options);
	}

	#2.widget input form in back-end
	function form($instance) {
		$instance = wp_parse_args( (array) $instance,array('title'=>'','_post_count'=>'','_enabled_image'=>'') );
		$title = strip_tags($instance['title']);
		$_post_count = !empty($instance['_post_count']) ? strip_tags($instance['_post_count']) : "-1";
		$_hotel_categories = !empty($instance['_hotel_categories']) ? $instance['_hotel_categories']: array();
		$_enabled_image = isset($instance['_enabled_image']) ? (bool) $instance['_enabled_image'] : false; ?>

        <!-- Form -->
        <p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','iamd_text_domain');?>
		   <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>"
            type="text" value="<?php echo esc_attr($title); ?>" /></label></p>

	    <p><label for="<?php echo $this->get_field_id('_hotel_categories'); ?>">
			<?php _e('Choose the categories you want to display (multiple selection possible)','iamd_text_domain');?></label>
            <select class="widefat" id="<?php echo $this->get_field_id('_hotel_categories').'[]';?>"
            	name="<?php echo $this->get_field_name('_hotel_categories').'[]';?>" multiple="multiple">
                <option value=""><?php _e("Select",'iamd_text_domain');?></option>
           	<?php $cats = get_categories('taxonomy=hotel_entries&hide_empty=1');
			foreach ($cats as $cat):
				$id = esc_attr($cat->term_id);
				$selected = ( in_array($id,$_hotel_categories)) ? 'selected="selected"' : '';
				$title = esc_html($cat->name);
				echo "<option value='{$id}' {$selected}>{$title}</option>";
			endforeach;?>
            </select></p>

        <p><input type="checkbox"  id="<?php echo $this->get_field_id('_enabled_image');?>" name="<?php echo $this->get_field_name('_enabled_image');?>"
	         <?php checked($_enabled_image); ?> /> <?php _e("Show Image",'iamd_text_domain');?></p>

	    <p><label for="<?php echo $this->get_field_id('_post_count'); ?>"><?php _e('No.of hotels to show:','iamd_text_domain');?></label>
		   <input id="<?php echo $this->get_field_id('_post_count'); ?>" name="<?php echo $this->get_field_name('_post_count'); ?>" value="<?php echo $_post_count?>" /></p>
        <!-- Form end-->
<?php
	}
	#3.processes & saves the twitter widget option
	function update( $new_instance,$old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['_hotel_categories'] = $new_instance['_hotel_categories'];
		$instance['_post_count'] = strip_tags($new_instance['_post_count']);
		$instance['_enabled_image'] = !empty($new_instance['_enabled_image']) ? 1 : 0;
	return $instance;
	}

	#4.output in front-end
	function widget($args, $instance) {
		extract($args);
		global $post;
		$title = empty($instance['title']) ?	'' : strip_tags($instance['title']);
		$_post_count = (int) $instance['_post_count'];
		$_enabled_image = isset($instance['_enabled_image']) ? $instance['_enabled_image']:0;

		$_hotel_categories = "";
		if(!empty($instance['_hotel_categories']) && is_array($instance['_hotel_categories'])):
			$_hotel_categories =  array_filter($instance['_hotel_categories']);
		elseif(!empty($instance['_hotel_categories'])):
			$_hotel_categories = explode(",",$instance['_hotel_categories']);
		endif;

		$arg = array('posts_per_page' => $_post_count ,'post_type' => 'dt_hotels');
		$arg = empty($_hotel_categories) ? $arg : array(
											'posts_per_page'=> $_post_count,
											'tax_query'		=> array(array( 'taxonomy'=>'hotel_entries', 'field'=>'id', 'operator'=>'IN', 'terms'=>$_hotel_categories ) ));

		echo $before_widget;
 	    echo $before_title.$title.$after_title;

		echo "<div class='recent-posts-widget'><ul>";
			 query_posts($arg);
			 if( have_posts()) :
			 while(have_posts()):
			 	the_post();
				$title = get_the_title();
				echo "<li>";
					if(1 == $_enabled_image):
						$image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'my-post-thumb',false);
						$image = ( $image != false)? $image[0] : "http".dt_theme_ssl()."://placehold.it/100x80";
						echo "<a href='".get_permalink()."' class='thumb'>";
						echo "<img src='$image' alt='{$title}'/>";
						echo "</a>";
					endif;
					$hotel_meta = get_post_meta(get_the_id() ,'_hotel_settings', true);

					echo "<h6><a href='".get_permalink()."'>{$title}, <sub>".@$hotel_meta['hotel_add']."</sub></a></h6>";
					//RATING CALCULATION...
					$arr_rate = dt_theme_comment_rating_count(get_the_ID());
					$all_avg = dt_theme_comment_rating_average(get_the_ID());
					echo '<div class="star-rating-wrapper"><div class="star-rating"><span style="width:'.(($all_avg/5)*100).'%"></span></div>('.count($arr_rate).__(' Ratings', 'iamd_text_domain').')</div>';
					echo '<a href="'.get_permalink().'#hotel_map_'.get_the_id().'" class="map-marker"> <span class="red"></span>'.__('View on Map', 'iamd_text_domain').'</a>';
				echo "</li>";
			 endwhile;
			 else:
			 	echo "<li><h6>".__('No Hotels found','iamd_text_domain')."</h6></li>";
			 endif;
			 wp_reset_query();
	 	echo "</ul></div>";
		echo $after_widget;
	}
}?>
