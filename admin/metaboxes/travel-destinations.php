<?php
// Render meta box for travel destinations
function render_travel_destinations_meta_box($post)
{
    // Retrieve the current travel destinations
    $travel_destinations = get_post_meta($post->ID, 'travel_destinations', true);
    ?>
    <div>
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

// Save destinations
add_action('save_post', 'save_travel_destinations_meta_box');
function save_travel_destinations_meta_box($post_id)
{
    if (isset($_POST['travel_destinations'])) {
        $travel_destinations = $_POST['travel_destinations'];
        update_post_meta($post_id, 'travel_destinations', $travel_destinations);
    }
}