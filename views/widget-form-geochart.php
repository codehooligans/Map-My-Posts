<?php
/**
 * Geochart widget form used in Admin.
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
		<option value="world" <?php selected( $instance["region"], 'region' ); ?>><?php _e('World', 'map-my-posts'); ?></option>
		<option value="auto" <?php selected( $instance["region"], 'auto' ); ?>><?php _e('Auto', 'map-my-posts'); ?></option>
	</select>
	<small><?php _e('Auto region only works when Geochart mode is set to marker.', 'map-my-posts'); ?></small>
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
	<small><?php _e('Only show items classified under this category. Value can be a term_ID or name. Optional.', 'map-my-posts'); ?></small>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'mode' ); ?>"><?php _e('Geochart Mode:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'mode' ); ?>" name="<?php echo $this->get_field_name( 'mode' ); ?>">
		<option value="region" <?php selected( $instance["mode"], 'region' ); ?>><?php _e('region', 'map-my-posts'); ?></option>
		<option value="marker" <?php selected( $instance["mode"], 'marker' ); ?>><?php _e('marker', 'map-my-posts'); ?></option>
	</select>
</p>
<p>
	<label for="<?php echo $this->get_field_id( 'tooltip' ); ?>"><?php _e('Tooltip:', 'map-my-posts'); ?></label>
	<select class="widefat" id="<?php echo $this->get_field_id( 'tooltip' ); ?>" name="<?php echo $this->get_field_name( 'tooltip' ); ?>">
		<option value="false" <?php selected( $instance["tooltip"], 'false' ); ?>><?php _e('Hide', 'map-my-posts'); ?></option>
		<option value="true" <?php selected( $instance["tooltip"], 'true' ); ?>><?php _e('Show', 'map-my-posts'); ?></option>
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