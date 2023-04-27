<?php

/**
 * Navigation Menus
 *
 * The $sidebars array should content each necessary array to create a sidebar.
 *
 * You should just fill the array (or leave an empty array) and custom will do the rest.
 * Note: It is important that this file returns an array.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/*
 * Edit this array to fit your needs.
 */
$sidebars = array(
	// Default sidebar.
	array(
		'name'          => __('Default Sidebar', 'custom'),
		'id'            => 'sidebar-1',
		'description'   => __('Add widgets here to appear in your site.', 'custom'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget__title">',
		'after_title'   => '</h2>',
	),
	// Add some other sidebar here.
);

// Don't touch this line.
return $sidebars;
