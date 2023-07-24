<?php
/*
Plugin Name: Travel Packages
Plugin URI: https://imtiaz.cloud
Description: Display travel packages on your website.
Version: 1.3
Author: Imtiaz Ahmed
Author URI: https://imtiaz.cloud
License: GPL2
*/

// Enqueueing all the css, jquery and javascript files
require_once plugin_dir_path(__FILE__) . 'includes/enqueue.php';

// Keeping country names and activities names as global variable
require_once plugin_dir_path(__FILE__) . 'includes/globals.php';

// Register the travel packages custom post type
function travel_packages_custom_post_type()
{
    $labels = array(
        'name' => __('Travel Packages', 'travel-packages'),
        'singular_name' => __('Travel Package', 'travel-packages'),
        'menu_name' => __('Travel Packages', 'travel-packages'),
        'name_admin_bar' => __('Travel Package', 'travel-packages'),
        'add_new' => __('Add New', 'travel-packages'),
        'add_new_item' => __('Add New Travel Package', 'travel-packages'),
        'new_item' => __('New Travel Package', 'travel-packages'),
        'edit_item' => __('Edit Travel Package', 'travel-packages'),
        'view_item' => __('View Travel Package', 'travel-packages'),
        'all_items' => __('All Travel Packages', 'travel-packages'),
        'search_items' => __('Search Travel Packages', 'travel-packages'),
        'parent_item_colon' => __('Parent Travel Packages:', 'travel-packages'),
        'not_found' => __('No travel packages found.', 'travel-packages'),
        'not_found_in_trash' => __('No travel packages found in Trash.', 'travel-packages')
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'publicly_queryable' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'query_var' => true,
        'rewrite' => array('slug' => 'travel-package'),
        'capability_type' => 'post',
        'has_archive' => true,
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title', 'editor', 'thumbnail', 'custom-fields'),
        'register_meta_box_cb' => 'add_travel_package_meta_boxes'
    );

    register_post_type('travel-package', $args);
}
add_action('init', 'travel_packages_custom_post_type');

// // Elementor theme special: Register the custom page template for package detail page
// function custom_register_template($templates)
// {
//     $templates['package-detail-template.php'] = 'Package Detail Template';
//     return $templates;
// }
// add_filter('theme_page_templates', 'custom_register_template', 10, 4);

// Set the template for the "Travel Detail" page
function travel_packages_set_page_template($template)
{
    if (is_page_template('package-detail-template.php')) {
        $template = plugin_dir_path(__FILE__) . '/public/package-detail-template.php';
    }
    return $template;
}
add_filter('template_include', 'travel_packages_set_page_template');

// Create travel detail page and assign template with activating the plugin
function create_travel_detail_page()
{
    // Check if the travel detail page already exists
    $existing_page = get_page_by_path('travel-detail');

    // Only create the page if it doesn't exist
    if (!$existing_page) {
        $page_args = array(
            'post_title' => 'Travel Detail',
            'post_name' => 'travel-detail',
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => '',
        );

        // Insert the page into the database
        $page_id = wp_insert_post($page_args);

        // Assign the custom template to the page
        if ($page_id !== 0) {
            update_post_meta($page_id, '_wp_page_template', 'package-detail-template.php');
        }
    }
}
// This hook will execute when the plugin will activate
register_activation_hook(__FILE__, 'create_travel_detail_page');

// shortcode for showing travel-packages on wordpress page
require_once plugin_dir_path(__FILE__) . 'public/travel-packages-shortcode.php';

// metabox field and save function for package detail
// save function for includes and excludes
// save function for terms and conditions
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/package-details.php';

// metabox field and save function for travel destinations
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/travel-destinations.php';

// metabox field and save function for travel activities
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/activities.php';

// metabox field for package gallery photos
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/gallery-photos.php';

// metabox field for package includes and excludes
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/includes-excludes.php';

// metabox field for package terms and conditions
require_once plugin_dir_path(__FILE__) . 'admin/metaboxes/terms-conditions.php';

// Hook: Add meta boxes for travel package creating
add_action('add_meta_boxes', 'add_travel_package_meta_boxes');
function add_travel_package_meta_boxes()
{
    add_meta_box(
        'travel-package-details',
        __('Travel Package Details', 'travel-packages'),
        'render_travel_package_details_meta_box',
        'travel-package',
        'normal',
        'high'
    );

    add_meta_box(
        'travel_destinations_meta_box',
        // Unique ID
        'Travel Destinations',
        // Box title
        'render_travel_destinations_meta_box',
        // Callback function
        'travel-package',
        // Post type
        'normal',
        // Position
        'default' // Priority
    );

    add_meta_box(
        'travel_package_activities_meta_box',
        'Activities',
        'render_travel_package_activities_meta_box',
        'travel-package',
        'normal',
        'default'
    );

    add_meta_box(
        'travel_package_photos_meta_box',
        'Gallery Photos',
        'render_travel_package_photos_meta_box',
        'travel-package',
        'normal',
        'default'
    );

    add_meta_box(
        'package_include_exclude_meta_box',
        'Package Includes & Excludes',
        'render_package_include_exclude_meta_box',
        'travel-package',
        'normal',
        'default'
    );

    add_meta_box(
        'terms_conditions_meta_box',
        'Terms and Conditions',
        'render_terms_conditions_meta_box',
        'travel-package',
        'normal',
        'low'
    );
}