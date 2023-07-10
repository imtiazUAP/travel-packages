<?php
/*
 * Template Name: Package Detail Template
 * Template Post Type: page
 */

get_header();

function enqueue_lightbox_scripts() {
    wp_enqueue_style('lightbox-css', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css', array(), '2.11.3', 'all');
    wp_enqueue_script('lightbox-js', 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js', array('jquery'), '2.11.3', true);
}
add_action('wp_enqueue_scripts', 'enqueue_lightbox_scripts');

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
                // Display custom attributes
                $country = get_post_meta($package->ID, 'country', true);
                $cost2pax = get_post_meta($package->ID, 'cost2pax', true);
                $cost4pax = get_post_meta($package->ID, 'cost4pax', true);
                $cost6pax = get_post_meta($package->ID, 'cost6pax', true);
                $cost8pax = get_post_meta($package->ID, 'cost8pax', true);
                $duration_days = get_post_meta($package->ID, 'duration_days', true);
                $duration_nights = get_post_meta($package->ID, 'duration_nights', true);
                $map_url = get_post_meta($package->ID, 'map_url', true);
                $package_includes = get_post_meta($package->ID, 'package_includes', true);
                $package_excludes = get_post_meta($package->ID, 'package_excludes', true);
                $highlights = get_post_meta($package->ID, 'highlights', true);
                $general_conditions = get_post_meta($package->ID, 'general_conditions', true);
                $cancellation_policy = get_post_meta($package->ID, 'cancellation_policy', true);
                $notes = get_post_meta($package->ID, 'notes', true);
                // TODO - START
                $photo_album = get_post_meta($package->ID, 'photos', true);
                $travel_destinations = get_post_meta($package->ID, 'travel_destinations', true);
                // TODO - END
                ?>
                <div class="photo-detail-flexbox">
                    <div class="photo-flex">
                        <?php
                            if ($package_image) {
                                echo '<div class="package-detail-thumbnail">';
                                echo '<a href="' . esc_url($package_image) . '" data-lightbox="photo-album" data-title="Package Photo"><img src="' . esc_url($package_image) . '" alt=" Package Photo" /></a>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                    <div class="cost-duration-country-flex">
                        <div class="country-detail">
                            <div>
                                <label><Strong>Country:</Strong></label>
                            </div>
                            <div class="country">
                                <?php
                                    if (!empty($country)) {
                                        echo '<i class="fas fa-map-marker-alt"></i> <span>'. esc_html(ucfirst($country)) . '</span>';
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="travel-destinations-detail">
                            <div>
                                <label><strong>Travel Destinations:</strong></label>
                            </div>
                            <div class="travel-destinations">
                                <?php
                                foreach ($travel_destinations as $travel_destination) {
                                    if (!empty($travel_destination)) {
                                        echo '<div class="travel-destination">';
                                        echo '<i class="fas fa-map-marker-alt"></i> <span>' . esc_html(ucfirst($travel_destination)) . '</span>';
                                        echo '</div>';
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <div class="duration-detail">
                            <div>
                                <label><Strong>Duration Detail:</Strong></label>
                            </div>
                            <div class="duration">
                                <?php
                                    if (!empty($duration_days) && !empty($duration_nights)) {
                                        echo '<i class="fa-regular fa-clock"></i> <span>'. esc_html($duration_days) . ' Days ' . esc_html($duration_nights) . ' Nights</span>';
                                    }
                                ?>
                            </div>
                        </div> 
                        <div class="cost-detail">
                            <div>
                                <label><Strong>Cost Detail:</Strong></label>
                            </div>
                            <div class="cost">
                                <?php
                                    if (!empty($cost2pax)) {
                                        echo '<i class="fas fa-user"></i><strong>x2</strong><span> person group: ' . esc_html($cost2pax) . ' per person</span><br>';
                                    }
                                    if (!empty($cost4pax)) {
                                        echo '<i class="fas fa-user"></i><strong>x4</strong><span> person group: ' . esc_html($cost4pax) . ' per person</span><br>';
                                    }
                                    if (!empty($cost6pax)) {
                                        echo '<i class="fas fa-user"></i><strong>x6</strong><span> person group: ' . esc_html($cost6pax) . ' per person</span><br>';
                                    }
                                    if (!empty($cost8pax)) {
                                        echo '<i class="fas fa-user"></i><strong>x8</strong><span> person group: ' . esc_html($cost8pax) . ' per person</span><br>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <?php
                        if (!empty($photo_album)) {
                            echo '<div class="photo-album">';
                            foreach ($photo_album as $index => $photo) {
                                echo '<a href="' . esc_url($photo) . '" data-lightbox="photo-album" data-title="Photo ' . ($index + 1) . '"><img src="' . esc_url($photo) . '" alt="Photo ' . ($index + 1) . '" /></a>';
                            }
                            echo '</div>';
                        }
                    ?>
                </div>
                <div class="travel-plan">
                    <h3>Our Travel Plan</h3>
                </div>
                <div class="package-detail">
                    <?php echo apply_filters('the_content', $package->post_content);?>
                </div>

                <div class="package-include-exclue"><?php
                    if (!empty($package_includes)) { ?>
                        <div class="package-includes">
                            <div>
                                <label><Strong>Package Includes:</Strong></label>
                            </div>
                            <div>
                                <?php echo wp_kses_post($package_includes); ?>
                            </div>
                        </div>
                    <?php
                    }

                    if (!empty($package_excludes)) { ?>
                        <div class="package-excludes">
                            <div>
                                <label><Strong>Package Excludes:</Strong></label>
                            </div>
                            <div>
                                <?php echo wp_kses_post($package_excludes); ?>
                            </div>
                        </div>
                    <?php
                    }
                ?></div>

                <div class="tabs">
                    <div class="tab">
                        <button class="tablinks" onclick="openTab(event, 'TravelMap')" id="defaultOpen">Travel Map</button>
                        <button class="tablinks" onclick="openTab(event, 'Highlights')">Highlights</button>
                        <button class="tablinks" onclick="openTab(event, 'GeneralCondition')">General Condition</button>
                        <button class="tablinks" onclick="openTab(event, 'CancellationPolicy')">Cancellation Policy</button>
                        <button class="tablinks" onclick="openTab(event, 'Notes')">Special Notes</button>
                    </div>

                    <div id="TravelMap" class="tabcontent">
                        <div class="map-view">
                        <?php
                            if (!empty($map_url)) {
                                echo '<iframe src="'. esc_html($map_url) .'" width="100%" height="380px"></iframe>';
                            }
                        ?>
                        </div>
                    </div>

                    <div id="Highlights" class="tabcontent">
                    <?php
                        if (!empty($highlights)) { ?>
                            <div class="highlights">
                                <?php echo wp_kses_post(nl2br($highlights)); ?>
                            </div>
                        <?php
                        }
                    ?>
                    </div>

                    <div id="GeneralCondition" class="tabcontent">
                    <?php
                        if (!empty($general_conditions)) { ?>
                            <div class="general-conditions">
                                <?php echo wp_kses_post(nl2br($general_conditions)); ?>
                            </div>
                        <?php
                        }
                    ?>
                    </div>

                    <div id="CancellationPolicy" class="tabcontent">
                    <?php
                        if (!empty($cancellation_policy)) { ?>
                            <div class="cancellation-policy">
                                <?php echo wp_kses_post(nl2br($cancellation_policy)); ?>
                            </div>
                        <?php
                        }
                    ?>
                    </div>

                    <div id="Notes" class="tabcontent">
                    <?php
                        if (!empty($notes)) { ?>
                            <div class="notes">
                                <?php echo wp_kses_post(nl2br($notes)); ?>
                            </div>
                        <?php
                        }
                    ?>
                    </div>
                </div>

            <?php
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
