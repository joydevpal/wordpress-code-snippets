<?php

/**
 * Disable all types of wordpress updates and notifications
 */

// Disable all updates aia filter
add_filter( 'automatic_updater_disabled', '__return_true' );
 
// Core updates via filter
add_filter( 'auto_update_core', '__return_false' );
 
// Disable development updates 
add_filter( 'allow_dev_auto_core_updates', '__return_false' );
 
// Disable minor updates
add_filter( 'allow_minor_auto_core_updates', '__return_false' );
 
// Disable major updates      
add_filter( 'allow_major_auto_core_updates', '__return_false' );

// Disable theme updates  
add_filter( 'auto_update_theme', '__return_false' );

// Disable theme update notifications
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );

// Disable plugin update notifications
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );