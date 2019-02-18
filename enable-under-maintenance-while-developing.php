<?php

/**
 * Enable under maintenance mode while developing wordpress website
 * 
 * Instructions: paste the following code into functions.php
 */

function wp_maintenance_mode() {
    if (!current_user_can('edit_themes') || !is_user_logged_in()) {
        wp_die("<h1>Under Maintenance</h1><br />Something isn't right, but we're working on it! Check back later.");
    }
}
add_action('get_header', 'wp_maintenance_mode');