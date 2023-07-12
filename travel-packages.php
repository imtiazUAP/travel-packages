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
    'Afghanistan', 'Albania', 'Algeria', 'Andorra', 'Angola',
    'Antigua and Barbuda', 'Argentina', 'Armenia', 'Australia', 'Austria',
    'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados',
    'Belarus', 'Belgium', 'Belize', 'Benin', 'Bhutan',
    'Bolivia', 'Bosnia and Herzegovina', 'Botswana', 'Brazil', 'Brunei',
    'Bulgaria', 'Burkina Faso', 'Burundi', 'Cabo Verde', 'Cambodia',
    'Cameroon', 'Canada', 'Central African Republic', 'Chad', 'Chile',
    'China', 'Colombia', 'Comoros', 'Congo', 'Costa Rica',
    'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark',
    'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt',
    'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Eswatini',
    'Ethiopia', 'Fiji', 'Finland', 'France', 'Gabon',
    'Gambia', 'Georgia', 'Germany', 'Ghana', 'Greece',
    'Grenada', 'Guatemala', 'Guinea', 'Guinea-Bissau', 'Guyana',
    'Haiti', 'Honduras', 'Hungary', 'Iceland', 'India',
    'Indonesia', 'Iran', 'Iraq', 'Ireland', 'Israel',
    'Italy', 'Jamaica', 'Japan', 'Jordan', 'Kazakhstan',
    'Kenya', 'Kiribati', 'Korea, North', 'Korea, South', 'Kosovo',
    'Kuwait', 'Kyrgyzstan', 'Laos', 'Latvia', 'Lebanon',
    'Lesotho', 'Liberia', 'Libya', 'Liechtenstein', 'Lithuania',
    'Luxembourg', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives',
    'Mali', 'Malta', 'Marshall Islands', 'Mauritania', 'Mauritius',
    'Mexico', 'Micronesia', 'Moldova', 'Monaco', 'Mongolia',
    'Montenegro', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia',
    'Nauru', 'Nepal', 'Netherlands', 'New Zealand', 'Nicaragua',
    'Niger', 'Nigeria', 'North Macedonia', 'Norway', 'Oman',
    'Pakistan', 'Palau', 'Panama', 'Papua New Guinea', 'Paraguay',
    'Peru', 'Philippines', 'Poland', 'Portugal', 'Qatar',
    'Romania', 'Russia', 'Rwanda', 'Saint Kitts and Nevis', 'Saint Lucia',
    'Saint Vincent and the Grenadines', 'Samoa', 'San Marino', 'Sao Tome and Principe',
    'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone',
    'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia',
    'South Africa', 'South Sudan', 'Spain', 'Sri Lanka', 'Sudan',
    'Suriname', 'Sweden', 'Switzerland', 'Syria', 'Taiwan',
    'Tajikistan', 'Tanzania', 'Thailand', 'Timor-Leste', 'Togo',
    'Tonga', 'Trinidad and Tobago', 'Tunisia', 'Turkey', 'Turkmenistan',
    'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom',
    'United States of America', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Vatican City',
    'Venezuela', 'Vietnam', 'Yemen', 'Zambia', 'Zimbabwe'
);

global $activity_set;
$activity_set = array(
    // Line 1
    'fa fa-binoculars' => 'Sightseeing',
    'fa fa-hiking' => 'Hiking',
    'fa fa-umbrella-beach' => 'Beach Relaxation',
    'fa fa-landmark' => 'Cultural Exploration',
    'fa fa-city' => 'City Tour',
    'fa fa-dumbbell' => 'Adventure Sports',
    'fa fa-paw' => 'Wildlife Safari',
    'fa fa-campground' => 'Camping',
    'fa fa-utensils' => 'Food Tasting',
    'fa fa-ship' => 'Boat Cruise',
    'fa fa-camera' => 'Photography',
    'fa fa-shopping-bag' => 'Shopping',
    'fa fa-spa' => 'Spa and Wellness',
    'fa fa-monument' => 'Historical Tours',
    'fa fa-swimming-pool' => 'Water Activities',
    'fa fa-tree' => 'Nature Walks',
    'fa fa-museum' => 'Museum Visits',
    'fa fa-wine-glass-alt' => 'Wine Tasting',
    'fa fa-glass-cheers' => 'Local Festivals',
    'fa fa-cocktail' => 'Nightlife',
    // Line 2
    'fa fa-road' => 'Road Trip',
    'fa fa-hiking' => 'Trekking',
    'fa fa-water' => 'Scuba Diving',
    'fa fa-snorkel-mask' => 'Snorkeling',
    'fa fa-mountain' => 'Mountain Climbing',
    'fa fa-bicycle' => 'Cycling',
    'fa fa-yoga' => 'Yoga Retreat',
    'fa fa-shopping-basket' => 'Food Market Tour',
    'fa fa-sun' => 'Sunset Watching',
    'fa fa-rafting' => 'River Rafting',
    'fa fa-binoculars' => 'Bird Watching',
    'fa fa-paint-brush' => 'Art Galleries',
    'fa fa-utensils' => 'Cooking Classes',
    'fa fa-hands-helping' => 'Volunteering',
    'fa fa-parachute-box' => 'Parasailing',
    'fa fa-archway' => 'Archaeological Sites',
    'fa fa-sun' => 'Sunbathing',
    'fa fa-train' => 'Train Rides',
    'fa fa-ship' => 'Cruise Excursions',
    'fa fa-helicopter' => 'Helicopter Tours',
    // Line 3
    'fa fa-exchange-alt' => 'Ziplining',
    'fa fa-surfing' => 'Surfing',
    'fa fa-kayak' => 'Kayaking',
    'fa fa-golf-ball' => 'Golfing',
    'fa fa-cave' => 'Spelunking',
    'fa fa-skiing' => 'Skiing',
    'fa fa-wind' => 'Windsurfing',
    'fa fa-caravan' => 'Desert Safari',
    'fa fa-motorcycle' => 'Motorbike Tours',
    'fa fa-parachute-box' => 'Skydiving',
    'fa fa-dolphin' => 'Dolphin Watching',
    'fa fa-utensils' => 'Local Cuisine Experience',
    'fa fa-monument' => 'Monument Visits',
    'fa fa-hot-air-balloon' => 'Hot Air Ballooning',
    'fa fa-palette' => 'Art and Craft Workshops',
    'fa fa-tree' => 'Gardens and Parks',
    'fa fa-cookie' => 'Snack Tasting',
    'fa fa-farm' => 'Farm Visits',
    'fa fa-waterfall' => 'Waterfall Exploration',
    'fa fa-helicopter' => 'Helicopter Sightseeing',
    // Line 4
    'fa fa-motorcycle' => 'Motorcycle Tours',
    'fa fa-hat-cowboy' => 'Cultural Festivals',
    'fa fa-fish' => 'Fishing',
    'fa fa-canyon' => 'Canyoning',
    'fa fa-hiking' => 'Sunrise Trek',
    'fa fa-horse' => 'Horseback Riding',
    'fa fa-cave' => 'Caving',
    'fa fa-heart' => 'Honeymoon Specials',
    'fa fa-exchange-alt' => 'Zip-lining',
    'fa fa-mountain' => 'Glacier Hiking',
    'fa fa-theater-masks' => 'Cultural Shows',
    'fa fa-beer' => 'Beer Tasting',
    'fa fa-tea' => 'Tea Plantation Tours',
    'fa fa-ship' => 'River Cruises',
    'fa fa-fish' => 'Marine Life Encounters',
    'fa fa-utensils' => 'Cooking Experiences',
    'fa fa-bolt' => 'Bungee Jumping',
    'fa fa-campground' => 'Desert Camping',
    'fa fa-mountain' => 'Rock Climbing',
    'fa fa-camera' => 'Photography Tours',
    // Line 5
    'fa fa-ship' => 'Boat Tours',
    'fa fa-sun' => 'Sunrise Watching',
    'fa fa-surfing' => 'Surf Lessons',
    'fa fa-elephant' => 'Elephant Sanctuaries',
    'fa fa-motorcycle' => 'Motorbike Rentals',
    'fa fa-paragliding' => 'Paragliding',
    'fa fa-yoga' => 'Yoga and Meditation Retreats',
    'fa fa-utensils' => 'Street Food Tours',
    'fa fa-mountain' => 'Ice Climbing',
    'fa fa-theater-masks' => 'Opera and Theater Shows',
    'fa fa-tree' => 'Nature Reserves',
    'fa fa-beer' => 'Beer Breweries',
    'fa fa-palette' => 'Art Museums',
    'fa fa-hiking' => 'Hiking Expeditions',
    'fa fa-wine-glass' => 'Winery Visits',
    'fa fa-shopping-basket' => 'Local Market Visits',
    'fa fa-ship' => 'Sailing Trips',
    'fa fa-hands-helping' => 'Cultural Workshops',
    'fa fa-snowboarding' => 'Snowboarding',
    'fa fa-paw' => 'Wildlife Encounters'
    // Add more activities here...
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

// Add meta box for photos
add_action('add_meta_boxes', 'add_travel_package_photos_meta_box');
function add_travel_package_photos_meta_box()
{
    add_meta_box(
        'travel_package_photos_meta_box', // Unique ID
        'Gallery Photos', // Box title
        'render_travel_package_photos_meta_box', // Callback function
        'travel-package', // Post type
        'normal', // Position
        'high' // Priority
    );
}

// Render meta box for photos
function render_travel_package_photos_meta_box($post)
{
    // Retrieve the current photos
    $photos = get_post_meta($post->ID, 'photos', true);

    // Output the HTML form fields
    ?>

    <div class="add-photos-container">
        <label for="travel-package-photos">Add Gallery Photos (Maximum 6):</label>
        <input type="file" id="travel-package-photos" name="travel-package-photos[]" multiple accept="image/*">
        <button type="button" id="save-photos-button">Save Photos</button>
    </div>


    <div id="uploaded-photos-container" class="uploaded-photos-container">
        <?php
        // Display the uploaded photos
        if (!empty($photos)) {
            echo '<div class="uploaded-photos">';
            foreach ($photos as $photo) {
                echo '<div class="uploaded-photo"><img src="' . esc_url($photo) . '" alt="Package Photo" style="width: 212.5px; height: 140px; object-fit: cover;"></div>';
            }
            echo '</div>';
        }
        ?>
    </div>

    <script>
        jQuery(document).ready(function($) {
            $('#save-photos-button').click(function() {
                    var formData = new FormData();
                    var files = $('#travel-package-photos')[0].files;
                    var postID = <?php echo get_the_ID(); ?>;

                    for (var i = 0; i < files.length; i++) {
                        formData.append('travel-package-photos[]', files[i]);
                    }
                    formData.append('post_id', postID);

                    // Send AJAX request to save the photos
                    $.ajax({
                        url: '<?php echo rest_url('travel-package-photos/v1/save'); ?>',
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('X-WP-Nonce', '<?php echo wp_create_nonce('wp_rest'); ?>'); // Update with the correct nonce name
                        },
                        success: function(response) {
                            if (response.success) {
                                // Clear the file input field
                                $('#travel-package-photos').val('');

                                // Update the uploaded photos container
                                $('#uploaded-photos-container').html(response.html);
                            }
                        }
                    });
            });
        });
    </script>
<?php
}

function upload_photo($photo_tmp, $photo_name)
{
    $photo_name = sanitize_file_name($photo_name); // Sanitize the photo name
    $photo_extension = pathinfo($photo_name, PATHINFO_EXTENSION); // Get the photo extension
    $upload_dir = wp_upload_dir(); // Retrieve the WordPress uploads directory information
    $target_dir = $upload_dir['path']; // Set the target directory for the uploaded photo
    $target_file = $target_dir . '/' . $photo_name; // Set the target file path
    $photo_url = $upload_dir['url'] . '/' . $photo_name; // Set the URL of the uploaded photo

    // Check if a file with the same name already exists
    $counter = 1;
    while (file_exists($target_file)) {
        $new_photo_name = pathinfo($photo_name, PATHINFO_FILENAME) . '-' . $counter . '.' . $photo_extension; // Append a counter to the file name
        $target_file = $target_dir . '/' . $new_photo_name;
        $photo_url = $upload_dir['url'] . '/' . $new_photo_name;
        $counter++;
    }

    // Move the uploaded photo to the target directory
    if (move_uploaded_file($photo_tmp, $target_file)) {
        return $photo_url; // Return the URL of the uploaded photo
    } else {
        return false; // Return false if the upload process failed
    }
}


// REST API endpoint to save photos
add_action('rest_api_init', 'register_save_travel_package_photos_endpoint');
function register_save_travel_package_photos_endpoint()
{
    register_rest_route('travel-package-photos/v1', '/save', array(
        'methods'  => 'POST',
        'callback' => 'save_travel_package_photos',
        'permission_callback' => function () {
            return current_user_can('edit_posts');
        },
    ));
}

// Callback function to handle photo saving
function save_travel_package_photos($request)
{
    $post_id = isset($request['post_id']) ? intval($request['post_id']) : 0;
    error_log('-------- save_travel_package_photos: ');
    // Check if photos were uploaded
    if (isset($_FILES['travel-package-photos'])) {
        error_log('-------- isset $_FILES TRUE: ');
        $photos = $_FILES['travel-package-photos'];

        // Array to store uploaded photo URLs
        $uploaded_photos = array();

        // Handle each uploaded photo
        foreach ($photos['name'] as $key => $photo_name) {
            if ($photos['error'][$key] === UPLOAD_ERR_OK) {
                // Check if the maximum number of photos has been reached
                if (count($uploaded_photos) >= 6) {
                    continue; // Exit the loop if the limit is reached
                }
                $photo_tmp = $photos['tmp_name'][$key];
                $photo_url = upload_photo($photo_tmp, $photo_name); // Implement the photo upload logic here

                if ($photo_url) {
                    $uploaded_photos[] = $photo_url;
                }
            }
        }

        // Update the meta field with the uploaded photos
        update_post_meta($post_id, 'photos', $uploaded_photos);
        error_log('-------- updated post meta: post id::'.$post_id);

        return rest_ensure_response(array(
            'success' => true,
            'html' => get_uploaded_photos_html($uploaded_photos)
        ));
    }

    return rest_ensure_response(array(
        'success' => false,
        'message' => 'No photos uploaded'
    ));
}

// Helper function to generate HTML for uploaded photos
function get_uploaded_photos_html($photos)
{
    $html = '<div class="uploaded-photos-container">';
    $html .= '<div class="uploaded-photos">';
    foreach ($photos as $photo) {
        $html .= '<div class="uploaded-photo"><img src="' . esc_url($photo) . '" alt="Package Photo" style="width: 212.5px; height: 140px; object-fit: cover;"></div>';
    }
    $html .= '</div>';
    $html .= '</div>';

    return $html;
}

function render_travel_package_details_meta_box($post)
{
    // Retrieve the current values of the custom attributes
    $country = get_post_meta($post->ID, 'country', true);
    $cost2pax = get_post_meta($post->ID, 'cost2pax', true);
    $cost4pax = get_post_meta($post->ID, 'cost4pax', true);
    $cost6pax = get_post_meta($post->ID, 'cost6pax', true);
    $cost8pax = get_post_meta($post->ID, 'cost8pax', true);
    $durationDays = get_post_meta($post->ID, 'duration_days', true);
    $durationNights = get_post_meta($post->ID, 'duration_nights', true);
    $end_date = get_post_meta($post->ID, 'end_date', true);
    $map_url = get_post_meta($post->ID, 'map_url', true);
    $package_includes = get_post_meta($post->ID, 'package_includes', true);
    $package_excludes = get_post_meta($post->ID, 'package_excludes', true);

    $highlights = get_post_meta($post->ID, 'highlights', true);
    $general_conditions = get_post_meta($post->ID, 'general_conditions', true);

    $cancellation_policy = get_post_meta($post->ID, 'cancellation_policy', true);
    $notes = get_post_meta($post->ID, 'notes', true);

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
            <label for="duration_days"><Strong><?php _e('Days:', 'travel-packages'); ?></Strong></label>
            <input type="text" id="duration_days" name="duration_days" placeholder="4" value="<?php echo esc_attr($durationDays); ?>">
            <label for="duration_nights"><Strong><?php _e('Nights:', 'travel-packages'); ?></Strong></label>
            <input type="text" id="duration_nights" name="duration_nights" placeholder="5" value="<?php echo esc_attr($durationNights); ?>">
        </div>
    </div>

    <hr class="clear-line">

    <div>
        <label for="add-cost"><Strong>Costs:</Strong></label>
    </div>


    <div style="padding-left:40px; padding-bottom:20px;">
        <div style="display: flex; flex-wrap: wrap;">
            <div style="flex-basis: 20%;">
                <label for="cost2pax">
                    <?php _e('2 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost2pax" name="cost2pax" value="<?php echo esc_attr($cost2pax); ?>">
            </div>
            <div style="flex-basis: 20%;" class="cost">
                <label for="cost4pax">
                    <?php _e('4 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost4pax" name="cost4pax" value="<?php echo esc_attr($cost4pax); ?>">
            </div>
            <div style="flex-basis: 20%;" class="cost">
                <label for="cost6pax">
                    <?php _e('6 Pax:', 'travel-packages'); ?>
                </label>
                <input type="text" id="cost6pax" name="cost6pax" value="<?php echo esc_attr($cost6pax); ?>">
            </div>
            <div style="flex-basis: 20%;" class="cost">
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
            style="display: inline-block; width: 100%; height: 100px;"><?php echo esc_textarea($map_url); ?></textarea>
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

    <div style="display: flex;">
        <div style="width: 50%; margin-right: 10px;">
            <label for="highlights">
                <?php _e('Highlights:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($highlights, 'highlights', array('textarea_name' => 'highlights')); ?>
        </div>
        <div style="width: 50%;">
            <label for="general_conditions">
                <?php _e('General Conditions:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($general_conditions, 'general_conditions', array('textarea_name' => 'general_conditions')); ?>
        </div>
    </div>

    <div style="display: flex;">
        <div style="width: 50%; margin-right: 10px;">
            <label for="cancellation_policy">
                <?php _e('Cancellation Policy:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($cancellation_policy, 'cancellation_policy', array('textarea_name' => 'cancellation_policy')); ?>
        </div>
        <div style="width: 50%;">
            <label for="notes">
                <?php _e('Special Notes:', 'travel-packages'); ?>
            </label>
            <?php wp_editor($notes, 'notes', array('textarea_name' => 'notes')); ?>
        </div>
    </div>

    <hr class="clear-line">
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


    if (isset($_POST['duration_days'])) {
        update_post_meta($post_id, 'duration_days', sanitize_text_field($_POST['duration_days']));
    }

    if (isset($_POST['duration_nights'])) {
        update_post_meta($post_id, 'duration_nights', sanitize_text_field($_POST['duration_nights']));
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

    if (isset($_POST['highlights'])) {
        update_post_meta($post_id, 'highlights', wp_kses_post($_POST['highlights']));
    }

    if (isset($_POST['general_conditions'])) {
        update_post_meta($post_id, 'general_conditions', wp_kses_post($_POST['general_conditions']));
    }

    if (isset($_POST['cancellation_policy'])) {
        update_post_meta($post_id, 'cancellation_policy', wp_kses_post($_POST['cancellation_policy']));
    }

    if (isset($_POST['notes'])) {
        update_post_meta($post_id, 'notes', wp_kses_post($_POST['notes']));
    }
}
add_action('save_post_travel-package', 'save_travel_package_details');

// Enqueing CSS file to show the travel packages
function enqueue_travel_package_styles()
{
    wp_enqueue_style('travel-package-styles', plugin_dir_url(__FILE__) . 'css/travel-package-styles.css');
}
add_action('wp_enqueue_scripts', 'enqueue_travel_package_styles');
add_action('admin_enqueue_scripts', 'enqueue_travel_package_styles');

function enqueue_plugin_styles() {
    wp_enqueue_style('font-awesome', 'https://use.fontawesome.com/releases/v5.13.0/css/all.css', array(), '5.13.0');
}

add_action('wp_enqueue_scripts', 'enqueue_plugin_styles');

function enqueue_custom_script() {
    // Enqueue the custom JavaScript file
    wp_enqueue_script('custom-script', plugin_dir_url(__FILE__) . 'js/custom-script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'enqueue_custom_script');

// Shortcode for displaying travel packages
function travel_packages_shortcode($atts)
{
    global $countries;
    $atts = shortcode_atts(
        array(
            'limit' => -1,
        ),
        $atts
    );

    $args = array(
        'post_type' => 'travel-package',
        'posts_per_page' => $atts['limit'],
    );

    $packages = new WP_Query($args);
    $country_names = array();
    if ($packages->have_posts()) {
        while ($packages->have_posts()) {
            $packages->the_post();

            // Retrieve the country attribute value for the current post
            $country_value = get_post_meta(get_the_ID(), 'country', true);

            // Capitalize the first letter of the country value
            $country_name = ucfirst(strtolower($country_value));

            // Add the country name to the array if it doesn't exist
            if (!in_array($country_name, $country_names)) {
                $country_names[] = $country_name;
            }
        }
        wp_reset_postdata();
    }

    ob_start();
    if ($packages->have_posts()) {
        $package_count = 0;
        ?>
        <div>
            <form id="package-filter-form" class="travel-package-search-box">
                <div class="form-group select-box">
                    <select id="country-filter" name="country-filter" style="height: 50px; width: 100%;">
                        <option value="" disabled selected>Select a Country</option>
                        <option value="">All Country</option>
                        <?php
                        foreach ($country_names as $index => $country) {
                            $selected = '';
                            if (isset($_GET['country-filter']) && $_GET['country-filter'] === $country) {
                                $selected = 'selected';
                            }
                            echo '<option value="' . $country . '" ' . $selected . '>' . $country . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group search-button">
                    <div style="position: relative;">
                        <span class="fa fa-search" style="color: white; position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></span>
                        <input type="submit" value="Find Travel Packages" style="height: 50px; width: 100%;">
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
            $durationDays = get_post_meta(get_the_ID(), 'duration_days', true);
            $durationNights = get_post_meta(get_the_ID(), 'duration_nights', true);
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
                                    <?php echo $durationDays; ?> Days <?php echo $durationNights; ?> Nights
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


// Travel destinations metabox

// Add meta box for travel destinations
add_action('add_meta_boxes', 'add_travel_destinations_meta_box');
function add_travel_destinations_meta_box()
{
    add_meta_box(
        'travel_destinations_meta_box', // Unique ID
        'Travel Destinations', // Box title
        'render_travel_destinations_meta_box', // Callback function
        'travel-package', // Post type
        'normal', // Position
        'high' // Priority
    );
}

// Render meta box for travel destinations
function render_travel_destinations_meta_box($post)
{
    // Retrieve the current travel destinations
    $travel_destinations = get_post_meta($post->ID, 'travel_destinations', true);

    // Output the HTML form fields
    ?>
    <div>
        <label for="travel-destinations">Travel Destinations:</label>
        <div id="travel-destinations-container">
            <?php
            if (!empty($travel_destinations)) {
                foreach ($travel_destinations as $destination) {
                    echo '<input type="text" class="travel-destination" name="travel_destinations[]" value="' . esc_attr($destination) . '">';
                }
            }
            ?>
        </div>
        <button type="button" id="add-destination-button">Add Destination</button>
    </div>
    <?php
}

// Save meta box data
add_action('save_post', 'save_travel_destinations_meta_box');
function save_travel_destinations_meta_box($post_id)
{
    if (isset($_POST['travel_destinations'])) {
        $travel_destinations = $_POST['travel_destinations'];
        update_post_meta($post_id, 'travel_destinations', $travel_destinations);
    }
}

// Enqueue scripts for meta box
add_action('admin_enqueue_scripts', 'enqueue_travel_destinations_meta_box_scripts');
function enqueue_travel_destinations_meta_box_scripts($hook)
{
    // Enqueue scripts only on the 'post' edit screen
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('travel-destinations-meta-box', plugin_dir_url(__FILE__) . 'js/travel-destinations-meta-box.js', array('jquery'), '1.0', true);
    }
}

add_action('admin_enqueue_scripts', 'enqueue_travel_package_scripts');
function enqueue_travel_package_scripts($hook)
{
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        wp_enqueue_script('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js', array('jquery'), '4.0.13', true);
        wp_enqueue_style('select2', 'https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css', array(), '4.0.13');
        wp_enqueue_script('travel-activities-scripts', plugin_dir_url(__FILE__) . 'js/travel-activities-scripts.js', array('jquery', 'select2'), '1.0', true);
    }
}


// Add meta box for activities
add_action('add_meta_boxes', 'add_travel_package_activities_meta_box');
function add_travel_package_activities_meta_box()
{
    add_meta_box(
        'travel_package_activities_meta_box', // Unique ID
        'Activities', // Box title
        'render_travel_package_activities_meta_box', // Callback function
        'travel-package', // Post type
        'normal', // Position
        'high' // Priority
    );
}

// Render meta box for activities
function render_travel_package_activities_meta_box($post)
{
    // Retrieve the current activities
    $activities = get_post_meta($post->ID, 'activities', true);

    // Output the HTML form fields
    ?>
    <div>
        <label for="travel-package-activities">Activities:</label>
        <select name="travel-package-activities[]" multiple class="widefat travel-package-activities">
            <?php
            global $activity_set;
            foreach ($activity_set as $activity) {
                $selected = in_array($activity, $activities) ? 'selected' : '';
                echo '<option value="' . esc_attr($activity) . '" ' . $selected . '>' . esc_html($activity) . '</option>';
            }
            ?>
        </select>
    </div>
    <?php
}



// Save meta box data
add_action('save_post', 'save_travel_package_activities_meta_box');
function save_travel_package_activities_meta_box($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!isset($_POST['travel-package-activities'])) {
        return;
    }

    $activities = $_POST['travel-package-activities'];

    // Sanitize and save activities
    $sanitized_activities = array_map('sanitize_text_field', $activities);
    update_post_meta($post_id, 'activities', $sanitized_activities);
}
