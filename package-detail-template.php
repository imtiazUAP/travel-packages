<?php
/*
 * Template Name: Package Detail Template
 * Template Post Type: page
 */

get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">

            <?php
            // Check if a package ID is provided in the URL query string
            $package_id = isset($_GET['package_id']) ? intval($_GET['package_id']) : 0;

            // Query the package by ID
            $package = get_post($package_id);

            // Display the package detail content
            if ($package) {
                echo '<div class="package-title">' . get_the_title($package) . '</div>';

                // Display the post image
                $package_image = get_the_post_thumbnail_url($package->ID, 'large');
                if ($package_image) {
                    echo '<div class="package-detail-thumbnail">';
                    echo '<img src="' . esc_url($package_image) . '" alt="' . get_the_title($package) . '" />';
                    echo '</div>';
                }

                echo apply_filters('the_content', $package->post_content);

                // Display custom attributes
                $country = get_post_meta($package->ID, 'country', true);
                $cost = get_post_meta($package->ID, 'cost', true);
                $duration = get_post_meta($package->ID, 'duration', true);
                $map_url = get_post_meta($package->ID, 'map_url', true);
                $package_includes = get_post_meta($package->ID, 'package_includes', true);
                $package_excludes = get_post_meta($package->ID, 'package_excludes', true);
                // TODO - START
                $photo_album = get_post_meta($package->ID, 'photo_album', true);
                // TODO - END

                if (!empty($country)) {
                    echo '<p>Country: ' . esc_html($country) . '</p>';
                }

                if (!empty($cost)) {
                    echo '<p>cost: ' . esc_html($cost) . '</p>';
                }

                if (!empty($duration)) {
                    echo '<p>Duration: ' . esc_html($duration) . '</p>';
                }
                

                if (!empty($map_url)) {
                    echo '<p>Map URL: ' . esc_html($map_url) . '</p>';
                }

                if (!empty($map_url)) {
                    echo '<iframe src="'. esc_html($map_url) .'" width="640" height="480"></iframe>';
                }

                if (!empty($package_includes)) {
                    echo '<p>Package Includes:</p>';
                    echo wp_kses_post($package_includes);
                }
                
                if (!empty($package_excludes)) {
                    echo '<p>Package Excludes:</p>';
                    echo wp_kses_post($package_excludes);
                }

                // TODO - START
                if (!empty($photo_album)) {
                    echo '<div class="photo-album">';
                    foreach ($photo_album as $photo) {
                        echo '<div class="photo"><img src="' . esc_url($photo) . '" alt="Photo" /></div>';
                    }
                    echo '</div>';
                }
                // TODO - END
            } else {
                echo 'Package not found.';
            }
            ?>

        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
?>
