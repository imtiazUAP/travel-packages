<?php
// Render meta box for activities
function render_travel_package_activities_meta_box($post)
{
    // Retrieve the current activities
    $activities = get_post_meta($post->ID, 'activities', true);
    ?>
    <div>
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

// Save activities
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