<?php

/**
 * Setting up the theme.
 */

if (!function_exists('custom_setup')) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function custom_setup()
	{
		/*
		 * Make theme available for translation.
		 */
		load_theme_textdomain('custom', get_template_directory() . '/resources/lang');

		/*
		 * Add default posts and comments RSS feed links to head.
		 */
		add_theme_support('automatic-feed-links');

		/*
		 * Enable plugins to manage the document title.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Title_Tag.
		 */
		add_theme_support('title-tag');

		/*
		 * Register menus
		 *
		 * Navigations should be mentioned into app/navigations.php
		 *
		 * We retrieve the array from this file and we pass it to
		 * wp_nav_menu() core functions
		 *
		 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus.
		 */
		$nav_menus = require get_stylesheet_directory() . '/lib/navigations.php';
		if (is_array($nav_menus) && !empty($nav_menus)) {
			register_nav_menus($nav_menus);
		}

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');
		add_image_size('custom_thumbnail_avatar', 100, 100, true);
		add_image_size('custom_thumbnail_medium', 768, 0, false);
		add_image_size('custom_thumbnail_background', 2000, 9999, false);

		/*
		 * Switch default core markup to output valid HTML5.
		 *
		 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#HTML5.
		 */
		add_theme_support('html5', ['caption', 'comment-form', 'comment-list', 'gallery', 'search-form']);

		/*
		 * Enable support for Post Formats.
		 *
		 * @link http://codex.wordpress.org/Post_Formats.
		 */
		add_theme_support('post-formats', ['aside', 'gallery', 'link', 'image', 'quote', 'video', 'audio']);

		add_post_type_support('page', 'excerpt');

		// Format large.
		add_theme_support('align-wide');
		add_theme_support('responsive-embeds');
		add_theme_support('menus');
		add_theme_support('woocommerce');
		add_theme_support('wp-block-styles');
		add_theme_support('editor-styles');
		add_editor_style('style-editor.css');

		// show for admins only
		if (!current_user_can('administrator') && !is_admin()) {
			show_admin_bar(false);
		}

		// remove junk from head
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'feed_links', 2);
		remove_action('wp_head', 'index_rel_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'feed_links_extra', 3);
		remove_action('wp_head', 'start_post_rel_link', 10, 0);
		remove_action('wp_head', 'parent_post_rel_link', 10, 0);
		remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('admin_print_styles', 'print_emoji_styles');
	}
endif;
add_action('after_setup_theme', 'custom_setup');




// add options pages

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Error 404 Settings',
		'menu_title'	=> 'Error 404',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));


	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));
}



/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function custom_content_width()
{
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters('custom_content_width', 640);
}
add_action('after_setup_theme', 'custom_content_width', 0);




if (!function_exists('custom_enqueue_scripts')) :
	/**
	 * Enqueue scripts and styles.
	 *
	 * @return void
	 */
	function custom_enqueue_scripts()
	{

		$theme = wp_get_theme();

		if (is_singular() && comments_open() && get_option('thread_comments')) {
			wp_enqueue_script('comment-reply');
		}

		//STOP USING GOOGLE FONTS - ADD THEM TO THE THEME

		wp_register_style(
			'custom/style/app',
			get_theme_file_uri('/resources/assets/dist/css/app.css'),
			false,
			$theme->get('Version')
		);

		wp_enqueue_style('custom/style/app');

		wp_enqueue_script(
			'custom/script/app',
			get_theme_file_uri('/resources/assets/dist/js/app.js'),
			array('jquery'),
			$theme->get('Version'),
			true
		);
	}
endif;
add_action('wp_enqueue_scripts', 'custom_enqueue_scripts', 100);



/**
 * Register widget area.
 *
 *  Sidebars are filled at app/sidebars.php
 *
 * We retrieve the array from this file and we loop each sub-array to pass it to
 * register_sidebar() core functions
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function custom_widgets_init()
{

	$sidebars = require get_stylesheet_directory() . '/lib/sidebars.php';

	foreach ($sidebars as $sidebar) {

		if (is_array($sidebar) && !empty($sidebar)) {
			register_sidebar($sidebar);
		}
	}

	unset($sidebar);
}
add_action('widgets_init', 'custom_widgets_init');


function remove_version_info()
{
	return '';
}
add_filter('the_generator', 'remove_version_info');



/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 */
function custom_javascript_detection()
{
	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}
add_action('wp_head', 'custom_javascript_detection', 0);


/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action('add_attachment', 'my_set_image_meta_upon_image_upload');
function my_set_image_meta_upon_image_upload($post_ID)
{

	// Check if uploaded file is an image, else do nothing

	if (wp_attachment_is_image($post_ID)) {

		$my_image_title = get_post($post_ID)->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace('%\s*[-_\s]+\s*%', ' ',  $my_image_title);

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords(strtolower($my_image_title));

		// Set the image Alt-Text
		update_post_meta($post_ID, '_wp_attachment_image_alt', $my_image_title);

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post($my_image_meta);
	}
}


// add post name and post type as css class on body tag
function custom_body_classes($classes)
{
	global $post;
	if (is_singular()) {
		$classes[] = 'page-' . $post->post_name;
		$classes[] = 'post_type-' . $post->post_type;
	}
	global $sitepress;
	if ($sitepress) {
		$classes[] = "lang_" . ICL_LANGUAGE_CODE;
	}

	global $is_lynx, $is_gecko, $is_IE, $is_opera, $is_NS4, $is_safari, $is_chrome, $is_iphone;
	if ($is_lynx) $classes[] = 'lynx';
	elseif ($is_gecko) $classes[] = 'gecko';
	elseif ($is_opera) $classes[] = 'opera';
	elseif ($is_NS4) $classes[] = 'ns4';
	elseif ($is_safari) $classes[] = 'safari';
	elseif ($is_chrome) $classes[] = 'chrome';
	elseif ($is_IE) {
		$classes[] = 'ie';
		if (preg_match('/MSIE ([0-9]+)([a-zA-Z0-9.]+)/', $_SERVER['HTTP_USER_AGENT'], $browser_version))
			$classes[] = 'ie' . $browser_version[1];
	} else $classes[] = 'unknown';
	if ($is_iphone) $classes[] = 'iphone';
	if (stristr($_SERVER['HTTP_USER_AGENT'], "mac")) {
		$classes[] = 'osx';
	} elseif (stristr($_SERVER['HTTP_USER_AGENT'], "linux")) {
		$classes[] = 'linux';
	} elseif (stristr($_SERVER['HTTP_USER_AGENT'], "windows")) {
		$classes[] = 'windows';
	}


	return $classes;
}
add_filter('body_class', 'custom_body_classes');

//add SVG to allowed file uploads
function add_file_types_to_uploads($file_types)
{

	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);

	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');


function custom_sender_email($original_email_address)
{
	return 'info@custom.com';
}
add_filter('wp_mail_from', 'custom_sender_email');


// Function to change sender name
function custom_sender_name($original_email_from)
{
	return "Custom";
}
add_filter('wp_mail_from_name', 'custom_sender_name');
