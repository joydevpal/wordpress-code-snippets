<?php

/**
 * Remove revolution slider metabox from all post types
 * 
 * Instructions: paste the following code into functions.php or plugin files
 */

if ( is_admin() ) {
	function remove_revolution_slider_meta_boxes() {
		if ( is_plugin_active( 'revslider/revslider.php' ) ) {
			$post_types = get_post_types();
			foreach ( $post_types as $post_type ) {
				remove_meta_box( 'mymetabox_revslider_0', $post_type, 'normal' );
			}
		}
	}
	add_action( 'do_meta_boxes', 'remove_revolution_slider_meta_boxes' );
}