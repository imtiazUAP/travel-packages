<?php

// Enqueing custom CSS file
function enqueue_travel_package_styles()
{
    wp_enqueue_style('travel-package-styles', plugin_dir_url(__FILE__) . '../css/travel-package-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_travel_package_styles');
add_action('admin_enqueue_scripts', 'enqueue_travel_package_styles');

// Enqueing font-awesome icons
function enqueue_plugin_styles() {
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0');
}

add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');

// Enqueing custom javascript for terms and conditions
function enqueue_terms_conditions_tabs_scripts() {
    wp_enqueue_script('terms-conditions-tabs-scripts-script', plugin_dir_url(__FILE__) . '../scripts/javascripts/terms-conditions-tabs-scripts.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_terms_conditions_tabs_scripts');

// Enqueing custom javascript for travel-packages-shortcode
function enqueue_travel_packages_shortcode() {
    wp_enqueue_script('travel-packages-shortcode-script', plugin_dir_url(__FILE__) . '../scripts/javascripts/travel-packages-filter.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_travel_packages_shortcode');

// Enqueue java-scripts for destination meta box
add_action('admin_enqueue_scripts', 'enqueue_travel_destinations_meta_box_scripts');
function enqueue_travel_destinations_meta_box_scripts($hook)
{
    // Enqueue scripts only on the 'post' edit screen
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('travel-destinations-meta-box', plugin_dir_url(__FILE__) . '../scripts/jquery/travel-destinations-meta-box.js', array('jquery'), '1.0', true);
    }
}

// Including Select2 ajax for enabling multi-select of activities
add_action('admin_enqueue_scripts', 'enqueue_travel_package_scripts');
function enqueue_travel_package_scripts($hook)
{
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
        wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13');
        wp_enqueue_script('travel-activities-scripts', plugin_dir_url(__FILE__) . '../scripts/jquery/travel-activities-scripts.js', array('jquery', 'select2'), '1.0', true);
    }
}