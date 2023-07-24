<?php


function render_travel_package_details_meta_box($post)
{
    // Retrieve the values of the package details attributes
    $country = get_post_meta($post->ID, 'country', true);
    $cost2pax = get_post_meta($post->ID, 'cost2pax', true);
    $cost4pax = get_post_meta($post->ID, 'cost4pax', true);
    $cost6pax = get_post_meta($post->ID, 'cost6pax', true);
    $cost8pax = get_post_meta($post->ID, 'cost8pax', true);
    $durationDays = get_post_meta($post->ID, 'duration_days', true);
    $durationNights = get_post_meta($post->ID, 'duration_nights', true);
    $map_url = get_post_meta($post->ID, 'map_url', true);
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
            <label for="duration_days"><Strong>
                    <?php _e('Days:', 'travel-packages'); ?>
                </Strong></label>
            <input type="text" id="duration_days" name="duration_days" placeholder="Ex: 4"
                value="<?php echo esc_attr($durationDays); ?>">
            <label for="duration_nights"><Strong>
                    <?php _e('Nights:', 'travel-packages'); ?>
                </Strong></label>
            <input type="text" id="duration_nights" name="duration_nights" placeholder="Ex: 5"
                value="<?php echo esc_attr($durationNights); ?>">
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
                <input type="text" id="cost2pax" name="cost2pax" placeholder="Ex: 29999"
                    value="<?php echo esc_attr($cost2pax); ?>">
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
            style="display: inline-block; width: 100%; height: 100px;"
            placeholder="Generate travel map using google map and paste the url here..."><?php echo esc_textarea($map_url); ?></textarea>
    </div>
    <?php
}

// Save package detail
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