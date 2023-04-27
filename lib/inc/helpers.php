<?php

/**
 * custom Helper Functions
 */

/**
 * Returns the full path to the main template file.
 *
 * @package custom
 * @since 1.0
 * @return string
 */
function custom_template_path()
{
	return custom_Wrapping::$main_template;
}



/**
 * Returns the full path to an asset of the theme.
 *
 * @param string $file The asset name to load.
 */
function custom_asset($file)
{
	return get_template_directory() . '/resources/assets/' . $file;
}
