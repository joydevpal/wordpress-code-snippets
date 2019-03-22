<?php

/**+
 * Replace "howdy" text with "Welcome" text in admin area
 * Place the code in functions.php
 */

function replace_howdy_message($translated_text, $text, $domain) {
    $new_message = str_replace('Howdy', 'Welcome', $text);
    return $new_message;
}
add_filter('gettext', 'replace_howdy_message', 10, 3);