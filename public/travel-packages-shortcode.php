<?php
// Shortcode for displaying travel packages thumbnails
function travel_packages_shortcode($atts)
{
    global $countries;
    $atts = shortcode_atts(
        array(
            'limit' => -1,
        ),
        $atts
    );

    // Getting the country names for the country filter drop-down
    $allPackages = new WP_Query([
        'post_type' => 'travel-package',
        'posts_per_page' => -1
    ]);
    $country_names = array();
    if ($allPackages->have_posts()) {
        while ($allPackages->have_posts()) {
            $allPackages->the_post();

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
    if ($allPackages->have_posts()) {
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
                        <span class="fa fa-search"
                            style="color: white; position: absolute; top: 50%; left: 10px; transform: translateY(-50%);"></span>
                        <input type="submit" value="Find Travel Packages" style="height: 50px; width: 100%;">
                    </div>
                </div>
            </form>
        </div>
        <?php
        // Get the current page number from the URL query parameter
        $current_page = (isset($_GET['tp_page']) && is_numeric($_GET['tp_page'])) ? max(1, intval($_GET['tp_page'])) : 1;

        $args = array(
            'post_type' => 'travel-package',
            'posts_per_page' => $atts['limit'],
            'paged' => $current_page,
        );

        echo '<div class="travel-package-grid">';

        // Apply filter based on selected country
        if (isset($_GET['country-filter']) && !empty($_GET['country-filter'])) {
            $args['meta_key'] = 'country';
            $args['meta_value'] = $_GET['country-filter'];
        }

        $packages = new WP_Query($args);

        // Set the max_num_pages property for pagination
        $total_pages = $packages->max_num_pages;

        while ($packages->have_posts()) {
            $packages->the_post();

            $package_image = get_the_post_thumbnail_url(get_the_ID(), 'large');

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
                                    <?php echo $durationDays; ?> Days
                                    <?php echo $durationNights; ?> Nights
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

        // Generate pagination links with custom labels
        $pagination_links = paginate_links(
            array(
                'current' => $current_page,
                'total' => $total_pages,
                'format' => '?tp_page=%#%',
                // The format for the pagination parameter in the URL
                'prev_text' => '<< Prev',
                // Label for the previous page link
                'next_text' => 'Next >>', // Label for the next page link
            )
        );

        if ($pagination_links) {
            echo '<div class="pagination-wrapper">';
            echo '<div class="pagination">';
            echo $pagination_links;
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo 'No travel packages found.';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('travel_packages', 'travel_packages_shortcode');