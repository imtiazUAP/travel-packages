<?php
// Render meta box for gallery photos
function render_travel_package_photos_meta_box($post)
{
    // Retrieve the current photos
    $photos = get_post_meta($post->ID, 'photos', true);
    ?>

    <div class="add-photos-container" id="add-photos-container">
        <label for="travel-package-photos">Add Gallery Photos (Maximum 6):</label>
        <input type="file" id="travel-package-photos" name="travel-package-photos[]" multiple accept="image/*">
        <button type="button" id="save-photos-button">Save Photos</button>
    </div>


    <div id="loader-container" style="display: none;">
        <img src="<?php echo plugin_dir_url(__FILE__) .'../../images/loader.gif'; ?>" alt="Uploading...">
        <span>Uploading gallery photos...</span>
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
        jQuery(document).ready(function ($) {
            $('#save-photos-button').click(function () {
                var formData = new FormData();
                var files = $('#travel-package-photos')[0].files;
                var postID = <?php echo get_the_ID(); ?>;

                for (var i = 0; i < files.length; i++) {
                    formData.append('travel-package-photos[]', files[i]);
                }
                formData.append('post_id', postID);

                // Show the loader GIF while photos are uploading
                $('#loader-container').show();
                $('#add-photos-container').hide();

                // Send AJAX request to save the photos
                $.ajax({
                    url: '<?php echo rest_url('travel-package-photos/v1/save'); ?>',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    beforeSend: function (xhr) {
                        xhr.setRequestHeader('X-WP-Nonce', '<?php echo wp_create_nonce('wp_rest'); ?>'); // Update with the correct nonce name
                    },
                    success: function (response) {
                        if (response.success) {
                            $('#loader-container').hide();
                            $('#add-photos-container').show();

                            // Clear the file input field
                            $('#travel-package-photos').val('');

                            // Update the uploaded photos container
                            $('#uploaded-photos-container').html(response.html);
                        }
                    },
                    error: function () {
                        // Hide the loader GIF on error
                        $('#loader-container').hide();
                        $('#add-photos-container').show();
                    }
                });
            });
        });
    </script>
    <?php
}

// Upload gallery photos
function upload_photo($photo_tmp, $photo_name)
{
    require_once(ABSPATH . 'wp-admin/includes/image.php'); // Load the necessary image handling functions

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
        // Get the image editor
        $image_editor = wp_get_image_editor($target_file);

        if (!is_wp_error($image_editor)) {
            // Get the original image dimensions
            $image_size = $image_editor->get_size();
            $original_width = $image_size['width'];

            // Set the maximum width for the image
            $max_width = 1000;

            // Calculate the new height while maintaining the aspect ratio
            $new_width = min($max_width, $original_width);
            $new_height = intval($new_width * ($image_size['height'] / $original_width));

            // Resize the image
            $image_editor->resize($new_width, $new_height);

            // Save the resized image
            $resized_image = $image_editor->save($target_file);

            if (!is_wp_error($resized_image)) {
                $photo_url = $upload_dir['url'] . '/' . $resized_image['file'];
            }
        }

        return $photo_url; // Return the URL of the uploaded and resized photo
    } else {
        return false; // Return false if the upload process failed
    }
}


// REST API endpoint to save photos
add_action('rest_api_init', 'register_save_travel_package_photos_endpoint');
function register_save_travel_package_photos_endpoint()
{
    register_rest_route('travel-package-photos/v1', '/save', array(
        'methods' => 'POST',
        'callback' => 'save_travel_package_photos',
        'permission_callback' => function () {
            return current_user_can('edit_posts');
        },
    )
    );
}

// Callback function to handle photo saving
function save_travel_package_photos($request)
{
    $post_id = isset($request['post_id']) ? intval($request['post_id']) : 0;
    // Check if photos were uploaded
    if (isset($_FILES['travel-package-photos'])) {
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

        return rest_ensure_response(
            array(
                'success' => true,
                'html' => get_uploaded_photos_html($uploaded_photos)
            )
        );
    }

    return rest_ensure_response(
        array(
            'success' => false,
            'message' => 'No photos uploaded'
        )
    );
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