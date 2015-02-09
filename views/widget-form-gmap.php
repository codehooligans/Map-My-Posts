<?php
/**
 * Google Map widget form used in Admin.
 *
 * @package   MapMyPosts
 * @author    Erik Fantasia <erik@aroundthisworld.com>
 * @license   GPL-2.0+
 * @link      http://www.aroundthisworld.com/map-my-posts-wordpress-plugin/
 * @copyright 2013 Erik Fantasia
 */
?>
<p>
	<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'map-my-posts'); ?></label>
	<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" class="widefat" />
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'region' ); ?>"><?php _e('Region:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'region' ); ?>" name="<?php echo $this->get_field_name( 'region' ); ?>">
		<option value="world" <?php selected( $instance["taxonomy"], 'region' ); ?>><?php _e('World', 'map-my-posts'); ?></option>
		<option value="auto" <?php selected( $instance["taxonomy"], 'auto' ); ?>><?php _e('Auto', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e('Taxonomy:', 'map-my-posts'); ?></label>
	<?php
		//$post_type_objects = get_post_types( array( 'show_ui' => true, 'capability_type' => 'post', 'hierarchical' => false ), 'objects' );
		$post_type_objects = get_post_types( array( 'show_ui' => true ), 'objects' );
	
		// Remove the 'attachment' post type. Unlikely there is a need to associate the map to that post type.
		if ( ( isset( $post_type_objects['attachment'] ) ) && ( $post_type_objects['attachment']->_builtin == true ) ) {
			unset($post_type_objects['attachment']);
		}
		//echo "post_type_objects<pre>"; print_r($post_type_objects); echo "</pre>";
		if (!empty($post_type_objects)) {
			?>
			<select class="widefat" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" name="<?php echo $this->get_field_name( 'taxonomy' ); ?>">
			<?php
			
				foreach( $post_type_objects as $post_type_object_key => $post_type_object ) {

					$taxonomy_objects = get_object_taxonomies(  $post_type_object_key, 'objects' );
			
					// Remove the 'attachment' post type. Unlikely there is a need to associate the map to that post type.
					if ( ( isset( $taxonomy_objects['post_format'] ) ) && ( $taxonomy_objects['post_format']->_builtin == true ) ) {
						unset( $taxonomy_objects['post_format'] );
					}
				
					if (!empty($taxonomy_objects)) {
						echo '<optgroup label="'. $post_type_object->label.'">';

						foreach($taxonomy_objects as $taxonomy_object_key => $taxonomy_object) {
							?><option value="<?php echo $taxonomy_object_key ?>" <?php selected( $instance["taxonomy"], $taxonomy_object_key ); ?>><?php echo $taxonomy_object->label ?></option><?php
						}
						echo '</optgroup>';
					}
				}
			?>
			</select>
			<?php
		}
	?>


</p>
<p>
	<label for="<?php echo $this->get_field_id( 'parent' ); ?>"><?php _e('Parent:', 'map-my-posts'); ?></label>
	<input id="<?php echo $this->get_field_id( 'parent' ); ?>" name="<?php echo $this->get_field_name( 'parent' ); ?>" value="<?php echo esc_attr( $instance['parent'] ); ?>" class="widefat" /><br />
	<small><?php _e('Only show items classified under this term. Value can be a term_ID or name. Optional.', 'map-my-posts'); ?></small>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'maptype' ); ?>"><?php _e('Map Type:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'maptype' ); ?>" name="<?php echo $this->get_field_name( 'maptype' ); ?>">
		<option value="roadmap" <?php selected( $instance["maptype"], 'roadmap' ); ?>><?php _e('roadmap', 'map-my-posts'); ?></option>
		<option value="satellite" <?php selected( $instance["maptype"], 'satellite' ); ?>><?php _e('satellite', 'map-my-posts'); ?></option>
		<option value="terrain" <?php selected( $instance["maptype"], 'terrain' ); ?>><?php _e('terrain', 'map-my-posts'); ?></option>
		<option value="hybrid" <?php selected( $instance["maptype"], 'hybrid' ); ?>><?php _e('hybrid', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'maptypecontrol' ); ?>"><?php _e('Map Type Control:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'maptypecontrol' ); ?>" name="<?php echo $this->get_field_name( 'maptypecontrol' ); ?>">
		<option value="false" <?php selected( $instance["maptypecontrol"], 'hide' ); ?>><?php _e('Hide', 'map-my-posts'); ?></option>
		<option value="true" <?php selected( $instance["maptypecontrol"], 'show' ); ?>><?php _e('Show', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'infowindow' ); ?>"><?php _e('Info Window:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'infowindow' ); ?>" name="<?php echo $this->get_field_name( 'infowindow' ); ?>">
		<option value="false" <?php selected( $instance["infowindow"], 'hide' ); ?>><?php _e('Hide', 'map-my-posts'); ?></option>
		<option value="true" <?php selected( $instance["infowindow"], 'show' ); ?>><?php _e('Show', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'target' ); ?>"><?php _e('Link Target:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'target' ); ?>" name="<?php echo $this->get_field_name( 'target' ); ?>">
		<option value="_self" <?php selected( $instance["target"], '_self' ); ?>><?php _e('Same Window (_self)', 'map-my-posts'); ?></option>
		<option value="_blank" <?php selected( $instance["target"], '_blank' ); ?>><?php _e('New Window (_blank)', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'width' ); ?>"><?php _e('Width:', 'map-my-posts'); ?></label>
	<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo esc_attr( $instance['width'] ); ?>" style="width:30px;text-align:center;" /> px
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'height' ); ?>"><?php _e('Height:', 'map-my-posts'); ?></label>
	<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo esc_attr( $instance['height'] ); ?>" style="width:30px;text-align:center;" /> px
</p>