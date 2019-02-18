<?php

/**
 * Register html5shiv and respond js in wordpress website
 */

function wpdemo_enqueue_scripts() {
    wp_enqueue_script( 'wpdemo-respond', 'https://oss.maxcdn.com/respond/1.4.2/respond.min.js', array(), '1.4.2', false );
    wp_script_add_data( 'wpdemo-respond', 'conditional', 'lt IE 9' );
 
    wp_enqueue_script( 'wpdemo-html5shiv', 'https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js', array(), '3.7.2', false );
    wp_script_add_data( 'wpdemo-html5shiv', 'conditional', 'lt IE 9' );
}
add_action( 'wp_enqueue_scripts', 'wpdemo_enqueue_scripts' );