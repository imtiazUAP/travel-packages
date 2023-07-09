<?php
/*
Plugin Name: Travel Packages
Plugin URI: https://imtiaz.cloud
Description: Display travel packages on your website.
Version: 1.2
Author: Imtiaz Ahmed
Author URI: https://imtiaz.cloud
License: GPL2
*/

// Register the travel packages custom post type
// Define a global variable
global $countries;
$countries = array(
    'Australia',
    'Bangladesh',
    'Belgium',
    'Bhutan',
    'Brazil',
    'Cambodia',
    'Cameroon',
    'Canada',
    'China',
    'Egypt',
    'India',
    'Indonesia',
    'Malaysia',
    'Nepal',
    'Netherlands',
    'New Zealand',
    'Pakistan',
    'Portugal',
    'Qatar',
    'Russia',
    'Saudi Arabia',
    'Singapore',
    'Sri Lanka',
    'Switzerland',
    'Thailand',
    'Turkey',
    'United Arab Emirates',
    'United Kingdom',
    'United States of America'
);
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
}

function render_travel_package_details_meta_box($post)
{
    // Retrieve the current values of the custom attributes
    $country = get_post_meta($post->ID, 'country', true);
    $cost2pax = get_post_meta($post->ID, 'cost2pax', true);
    $cost4pax = get_post_meta($post->ID, 'cost4pax', true);
    $cost6pax = get_post_meta($post->ID, 'cost6pax', true);
    $cost8pax = get_post_meta($post->ID, 'cost8pax', true);
    $duration = get_post_meta($post->ID, 'duration', true);
    $end_date = get_post_meta($post->ID, 'end_date', true);
    $map_url = get_post_meta($post->ID, 'map_url', true);
    $package_includes = get_post_meta($post->ID, 'package_includes', true);
    $package_excludes = get_post_meta($post->ID, 'package_excludes', true);
    $photos = get_post_meta($post->ID, 'photos', true);

    // Output the HTML form fields for each custom attribute
    ?>
    <div style="display: flex; flex-wrap: wrap;">
        <div style="flex-basis: 50%;">
            <label for="country"><Strong>
                    <?php _e('Country:', 'travel-packages'); ?>
                </Strong></label>
            <select id="country" name="country" class="custom-attribute-select">
                <option value="">
                    <?php _e('Select Country', 'travel-packages'); ?>
                </option>
                <?php
                global $countries;
                foreach ($countries as $country_name) {
                    $selected = ($country === strtolower($country_name)) ? 'selected' : '';
                    echo '<option value="' . esc_attr(strtolower($country_name)) . '" ' . $selected . '>' . esc_html($country_name) . '</option>';
                }
                ?>
            </select>
        </div>

        <div style="flex-basis: 50%;">
            <label for="duration"><Strong>
                    <?php _e('Duration:', 'travel-packages'); ?>
                </Strong></label>
            <input type="text" id="duration" name="duration" placeholder="4 Nights 5 Days"
                value="<?php echo esc_attr($duration); ?>">
        </div>
    </div>

    <hr class="clear-line">

    <div>
        <label for="cost"><Strong>Costs:</Strong></label>
    </div>


    <div style="padding-left:40px; padding-bottom:10px;">
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex-basis: 50%;">
                <label for="cost2pax">
                    <?php _e('2 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost2pax" name="cost2pax" value="<?php echo esc_attr($cost2pax); ?>">
            </div>
            <div style="flex-basis: 50%;" class="cost">
                <label for="cost4pax">
                    <?php _e('4 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost4pax" name="cost4pax" value="<?php echo esc_attr($cost4pax); ?>">
            </div>
        </div>
    </div>
    <div style="padding-left:40px; padding-bottom:10px;">
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex-basis: 50%;" class="cost">
                <label for="cost6pax">
                    <?php _e('6 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost6pax" name="cost6pax" value="<?php echo esc_attr($cost6pax); ?>">
            </div>
            <div style="flex-basis: 50%;" class="cost">
                <label for="cost8pax">
                    <?php _e('8 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost8pax" name="cost8pax" value="<?php echo esc_attr($cost8pax); ?>">
            </div>
        </div>
    </div>

    <hr class="clear-line">

    <div>
        <label for="cost"><Strong>Map URL:</Strong></label>
    </div>

    <div style="padding-left:40px; padding-right:40px; padding-bottom:10px;">
        <textarea id="map_url" name="map_url" class="custom-textarea"
            style="display: inline-block; width: 100%; height: 50px;"><?php echo esc_textarea($map_url); ?></textarea>
    </div>

    <hr class="clear-line">

    <div style="display: flex;">
        <div style="width: 50%; margin-right: 10px;">
            <label for="package_includes">
                <?php _e('Package Includes:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($package_includes, 'package_includes', array('textarea_name' => 'package_includes')); ?>
        </div>
        <div style="width: 50%;">
            <label for="package_excludes">
                <?php _e('Package Excludes:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($package_excludes, 'package_excludes', array('textarea_name' => 'package_excludes')); ?>
        </div>
    </div>

    <hr class="clear-line">
    <!-- // TODO - START -->
    <div>
        <label for="photos">
            <?php _e('Photos:', 'travel-packages'); ?>
        </label>
        <input type="file" id="photos" name="photos[]" multiple>
        <?php
        if ($photos) {
            echo '<ul>';
            foreach ($photos as $photo) {
                echo '<li><img src="' . esc_url($photo) . '" alt="Package Photo" style="max-width: 200px; max-height: 200px;"></li>';
            }
            echo '</ul>';
        }
        ?>
    </div>
    <!-- // TODO - END -->
    <?php
}

function save_travel_package_details($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (isset($_POST['country'])) {
        update_post_meta($post_id, 'country', sanitize_text_field($_POST['country']));
    }

    if (isset($_POST['cost2pax'])) {
        update_post_meta($post_id, 'cost2pax', sanitize_text_field($_POST['cost2pax']));
    }
    if (isset($_POST['cost4pax'])) {
        update_post_meta($post_id, 'cost4pax', sanitize_text_field($_POST['cost4pax']));
    }
    if (isset($_POST['cost6pax'])) {
        update_post_meta($post_id, 'cost6pax', sanitize_text_field($_POST['cost6pax']));
    }
    if (isset($_POST['cost8pax'])) {
        update_post_meta($post_id, 'cost8pax', sanitize_text_field($_POST['cost8pax']));
    }


    if (isset($_POST['duration'])) {
        update_post_meta($post_id, 'duration', sanitize_text_field($_POST['duration']));
    }

    if (isset($_POST['map_url'])) {
        update_post_meta($post_id, 'map_url', sanitize_text_field($_POST['map_url']));
    }

    if (isset($_POST['package_includes'])) {
        update_post_meta($post_id, 'package_includes', wp_kses_post($_POST['package_includes']));
    }

    if (isset($_POST['package_excludes'])) {
        update_post_meta($post_id, 'package_excludes', wp_kses_post($_POST['package_excludes']));
    }
    // TODO - START
    if (isset($_FILES['photos'])) {
        var_dump('---------- photos available in files');
        $photo_urls = array();

        $photo_files = $_FILES['photos'];

        foreach ($photo_files['name'] as $key => $photo_name) {
            $photo_tmp = $photo_files['tmp_name'][$key];
            $photo_type = $photo_files['type'][$key];
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['path'];
            $upload_url = $upload_dir['url'];

            $photo_path = $upload_path . '/' . $photo_name;
            $photo_url = $upload_url . '/' . $photo_name;

            move_uploaded_file($photo_tmp, $photo_path);

            $photo_urls[] = $photo_url;
        }
        var_dump($photo_urls);
        exit;

        update_post_meta($post_id, 'photos', $photo_urls);
    } else {
        var_dump('---------- photos not available in files');
        // exit;
    }
    // TODO - END
}
add_action('save_post_travel-package', 'save_travel_package_details');

// Enqueing CSS file to show the travel packages
function enqueue_travel_package_styles()
{
    wp_enqueue_style('travel-package-styles', plugin_dir_url(__FILE__) . 'css/travel-package-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_travel_package_styles');

// Shortcode for displaying travel packages
function travel_packages_shortcode($atts)
{
    global $countries;
    $atts = shortcode_atts(
        array(
            'limit' => -1,
        ), $atts);

    $args = array(
        'post_type' => 'travel-package',
        'posts_per_page' => $atts['limit'],
    );

    $packages = new WP_Query($args);

    ob_start();

    if ($packages->have_posts()) {
        $package_count = 0;
        ?>
        <div class="travel-package-search-box">
            <form id="package-filter-form" style="display: flex;">
                <div style="flex-basis: 82%;">
                    <select id="country-filter" name="country-filter" style="height: 50px;">
                        <option value="" disabled selected>Select a Country</option>
                        <option value="">All Country</option>
                        <?php
                        foreach ($countries as $index => $country) {
                            $selected = '';
                            if (isset($_GET['country-filter']) && $_GET['country-filter'] === $country) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div style="flex-basis: 15%; margin-left: auto;">
                    <div style="position: relative; display: inline-block;">
                        <span class="fa fa-search"
                            style="color: white; position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></span>
                        <input type="submit" value="Find Packages"
                            style="height: 50px; padding-right: 30px; padding-left: 35px; width: 100%;">
                    </div>
                </div>
            </form>
        </div>
        <?php
        echo '<div class="travel-package-grid">';

        // Apply filter based on selected country
        if (isset($_GET['country-filter']) && !empty($_GET['country-filter'])) {
            $args['meta_key'] = 'country';
            $args['meta_value'] = $_GET['country-filter'];
        }

        $packages = new WP_Query($args);

        while ($packages->have_posts()) {
            $packages->the_post();

            $package_image = get_the_post_thumbnail_url(get_the_ID(), 'large');
            $package_description = wp_trim_words(get_the_content(), 20);

            // Retrieve the value of the cost2pax custom attribute
            $duration = get_post_meta(get_the_ID(), 'duration', true);
            $country = get_post_meta(get_the_ID(), 'country', true);

            $cost2pax = get_post_meta(get_the_ID(), 'cost2pax', true);
            $cost4pax = get_post_meta(get_the_ID(), 'cost4pax', true);

            // Add a CSS class to control the number of packages per row based on device screen size
            $package_count++;
            $package_class = ($package_count % 3 === 0) ? 'travel-package-item last-in-row' : 'travel-package-item';
            $package_class .= ' ' . (wp_is_mobile() ? 'mobile-view' : 'desktop-view');

            ?>
            <div class="<?php echo $package_class; ?>">
                <a
                    href="<?php echo esc_url(add_query_arg('package_id', get_the_ID(), get_permalink(get_page_by_path('travel-detail')))); ?>">
                    <div class="travel-package-thumbnail">
                        <?php if ($package_image) { ?>
                            <img src="<?php echo $package_image; ?>" alt="<?php the_title_attribute(); ?>" />
                        <?php } ?>
                        <div class="thumbnail-overlay">
                            <div style="display: flex;">
                                <div class="travel-package-duration-thumb" style="width: 50%;">
                                    <i class="fa-regular fa-clock"></i>
                                    <?php echo $duration; ?>
                                </div>
                                <div class="travel-package-country" style="width: 50%;">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <?php echo ucfirst($country); ?>
                                </div>
                            </div>
                            <hr class="clear-line-white">
                            <div class="travel-package-cost2pax" style="display: flex;">
                                <div style="width: 50%;">
                                    <i class="fas fa-user-friends"></i>
                                    <?php echo $cost2pax; ?> p.person
                                </div>
                                <div style="width: 50%;">
                                    <i class="fas fa-user"></i><strong>x4</strong>
                                    <?php echo $cost4pax; ?> p.person
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
                <div class="travel-package-thumbnail-title">
                    <i class="fa-thin fa-hat-beach"></i><a
                        href="<?php echo esc_url(add_query_arg('package_id', get_the_ID(), get_permalink(get_page_by_path('travel-detail')))); ?>"><?php the_title(); ?></a>
                </div>
                <script>
                    // Handle form submission dynamically
                    document.getElementById('package-filter-form').addEventListener('submit', function (event) {
                        event.preventDefault(); // Prevent form submission
                        var countryFilter = document.getElementById('country-filter').value;
                        var url = new URL(window.location.href);
                        url.searchParams.set('country-filter', countryFilter);
                        window.location.href = url.href; // Redirect to filtered URL
                    });
                </script>
            </div>

            <?php
        }

        echo '</div>';
    } else {
        echo 'No travel packages found.';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('travel_packages', 'travel_packages_shortcode');

// Register the custom page template for package detail
function custom_register_template($templates)
{
    $templates['package-detail-template.php'] = 'Package Detail Template';

    return $templates;
}

// Elementor theme special: Hook into the 'theme_page_templates' filter to register the template
add_filter('theme_page_templates', 'custom_register_template', 10, 4);

// Set the template for the "Travel Detail" page
function travel_packages_set_page_template($template)
{
    if (is_page_template('package-detail-template.php')) {
        $template = plugin_dir_path(__FILE__) . 'package-detail-template.php';
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