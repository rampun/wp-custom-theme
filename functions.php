<?php

/**
 * custom files includes
 *
 * The $includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 */

$includes = array(
	'lib/inc/class-custom-wrapping.php', // Theme wrapper class.
	'lib/inc/helpers.php',               // Helper functions.
	'lib/inc/setup.php',                 // Theme setup.
	'lib/inc/template-tags.php',         // Custom template tags functions.
	'lib/inc/hooks.php',        		// Custom Hooks
);

foreach ($includes as $file) {

	$filepath = locate_template($file);

	if (!$filepath) {
		/* translators: %s: Failed included file. */
		trigger_error(sprintf(esc_html_x('Error locating %s for inclusion', 'custom'), $file), E_USER_ERROR);
	}

	require_once $filepath;
}

unset($file, $filepath);
