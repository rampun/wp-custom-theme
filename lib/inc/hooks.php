<?php
/*
* Creating a function to create our CPT and its taxonomy
*/

// define translation domain name variable
$domain = 'custom';

add_action('init', 'custom_custom_post_type', 0); // add custom post type
add_action('init', 'custom_add_custom_taxonomy', 0); // add custom taxonomy


/*
* Creating a function to create our CPT and its taxonomy
*/

// define translation domain name variable
$domain = 'custom';

function custom_custom_post_type()
{
    $domain_name = $GLOBALS['domain'];
    $custom_post_type_items = [
        [
            'name'          => 'Custom Post Type',
            'singular_name' => 'Custom Post Type',
            'plural_name'   => 'Custom Post Types',
            'slug'          => 'custom-post-1',
            'description'   => '',
            'dash_icon'     => 'dashicons-universal-access',
            'supports'      => ['title', 'excerpt', 'thumbnail'],
        ]
    ];

    foreach ($custom_post_type_items as $cpt_item) {
        // Set options for Custom Post Type
        $cpt_args = array(
            'label'               => sprintf(__('%s', $domain_name), $cpt_item['plural_name']),
            'description'         => sprintf(__('%s', $domain_name), $cpt_item['description']),
            'labels'              => array(
                'name'                => sprintf(__('%s', $domain_name), $cpt_item['name']),
                'singular_name'       => sprintf(__('%s', $domain_name), $cpt_item['singular_name']),
                'menu_name'           => sprintf(__('%s', $domain_name), $cpt_item['plural_name']),
                'parent_item_colon'   => sprintf(__('Parent %s', $domain_name), $cpt_item['singular_name']),
                'all_items'           => sprintf(__('All %s', $domain_name), $cpt_item['plural_name']),
                'view_item'           => sprintf(__('View %s', $domain_name), $cpt_item['singular_name']),
                'add_new_item'        => sprintf(__('Add %s', $domain_name), $cpt_item['singular_name']),
                'add_new'             => __('Add New', $domain_name),
                'edit_item'           => sprintf(__('Edit %s', $domain_name), $cpt_item['singular_name']),
                'update_item'         => sprintf(__('Update %s', $domain_name), $cpt_item['singular_name']),
                'search_items'        => sprintf(__('Search %s', $domain_name), $cpt_item['singular_name']),
                'not_found'           => __('Not Found', $domain_name),
                'not_found_in_trash'  => __('Not found in Trash', $domain_name),
            ),

            'hierarchical'          => true,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 10,
            'menu_icon'             => sprintf(__('%s', $domain_name), $cpt_item['dash_icon']),
            'show_in_nav_menus'     => true,
            'publicly_queryable'    => true,
            'exclude_from_search'   => false,
            'has_archive'           => false, // does it need an arhive?
            'query_var'             => true,
            'can_export'            => true,
            'rewrite'               => array(
                'slug' => sprintf(__('%s', $domain_name), $cpt_item['slug']),
                'with_front' => FALSE
            ),
            'capability_type'       => 'post',
            'supports'              => $cpt_item['supports'],
            'show_in_rest'          => true,

        );

        // Register Custom Post Type with abouve arguments
        register_post_type(sprintf(__('%s', $domain_name), $cpt_item['slug']), $cpt_args);
        flush_rewrite_rules();
    }
}


/**
 * 
 * Add Custom taxonoy to products
 * 
 */
function custom_add_custom_taxonomy()
{
    $domain_name = $GLOBALS['domain'];
    // Assign the Business Category [custom taxonomy] to Post, Video and Podcast
    $custom_taxonomy = [
        [
            'name'          => 'Custom Taxonmy 1',
            'singular_name' => 'Custom Taxonmy 1',
            'plural_name'   => 'Custom Taxonmy 1',
            'slug'          => 'custom-taxonomy-1'
        ],
        [
            'name'          => 'Custom Taxonomy 2',
            'singular_name' => 'Custom Taxonomy 2',
            'plural_name'   => 'Custom Taxonomy 2',
            'slug'          => 'custom-taxonomy-2'
        ],
    ];
    //set the post types for the taxonomy
    $post_to_assign = ['custom-post-1'];

    foreach ($custom_taxonomy as $ctax) {
        $tax_args = array(
            'hierarchical'      => true,
            'labels'            => array(
                'name'              => sprintf(__('%s', $domain_name), $ctax['plural_name']),
                'singular_name'     => sprintf(__('%s', $domain_name), $ctax['singular_name']),
                'search_items'      =>  sprintf(__('Search %s', $domain_name), $ctax['singular_name']),
                'all_items'         => sprintf(__('All %s', $domain_name), $ctax['plural_name']),
                'parent_item'       => sprintf(__('Parent %s', $domain_name), $ctax['singular_name']),
                'parent_item_colon' => sprintf(__('Parent %s', $domain_name), $ctax['singular_name']),
                'edit_item'         => sprintf(__('Edit  %s', $domain_name), $ctax['singular_name']),
                'update_item'       => sprintf(__('Update  %s', $domain_name), $ctax['singular_name']),
                'add_new_item'      => sprintf(__('Add New  %s', $domain_name), $ctax['singular_name']),
                'new_item_name'     => sprintf(__('New %s', $domain_name), $ctax['singular_name']),
                'menu_name'         => sprintf(__('%s', $domain_name), $ctax['plural_name']),
            ),
            'show_ui'           => true,
            'show_in_rest'      => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array('slug' => $ctax['slug']),
        );

        //call the register_taxonomy function
        register_taxonomy($ctax['slug'], $post_to_assign, $tax_args);
    }
}
