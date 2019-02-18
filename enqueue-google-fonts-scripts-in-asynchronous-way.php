<?php

/**
 * Enqueue google fonts scripts in asynchronous way (required for google page speed)
 */

function enqueue_google_fonts() { ?>
    <script>
	WebFontConfig = {
	    google: { families: [ 'Montserrat:300,400,500,600,700,800', 'Roboto:300,400,500,700' ] }
	};
	(function() {
	    var wf = document.createElement('script');
	    wf.src = 'https://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
	    wf.type = 'text/javascript';
	    wf.async = 'true';
	    var s = document.getElementsByTagName('script')[0];
	    s.parentNode.insertBefore(wf, s);
	})(); </script>
	<?php
}
add_action('wp_footer', 'enqueue_google_fonts');