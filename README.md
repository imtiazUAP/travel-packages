# Travel Packages Plugin

## Description

The Travel Packages Plugin is designed to create and manage travel packages on your WordPress site. This plugin allows you to add detailed travel package information, including country, cost, duration, map URL, package inclusions, exclusions, and a photo album.

## Features

- Create and manage travel packages.
- Add custom details like country, cost, duration, map URL, and package inclusions/exclusions.
- Upload and display multiple photos for each travel package.
- Display travel packages on the frontend with a custom template.

## Installation

1. Download the plugin zip file.
2. Navigate to the WordPress admin dashboard.
3. Go to Plugins > Add New > Upload Plugin.
4. Choose the downloaded zip file and click "Install Now".
5. Activate the plugin.

## Usage

### Creating a Travel Package

1. Navigate to the WordPress admin dashboard.
2. Click on "Travel Packages" in the admin menu.
3. Click "Add New" to create a new travel package.
4. Fill in the details such as title, content, country, cost, duration, map URL, package inclusions, and exclusions.
5. Upload photos by clicking the "Choose Files" button under the "Photos" section.
6. Publish the travel package.

### Displaying Travel Packages

To display the travel packages on the frontend, use the following shortcode in a post or page:
```html
[travel_packages]
```

## Code Overview

### Registering Custom Post Type

The plugin registers a custom post type for travel packages:

```php
function travel_packages_custom_post_type() {
    $labels = array(
        'name'               => __( 'Travel Packages', 'travel-packages-plugin' ),
        'singular_name'      => __( 'Travel Package', 'travel-packages-plugin' ),
        'menu_name'          => __( 'Travel Packages', 'travel-packages-plugin' ),
        'name_admin_bar'     => __( 'Travel Package', 'travel-packages-plugin' ),
        'add_new'            => __( 'Add New', 'travel-packages-plugin' ),
        'add_new_item'       => __( 'Add New Travel Package', 'travel-packages-plugin' ),
        'new_item'           => __( 'New Travel Package', 'travel-packages-plugin' ),
        'edit_item'          => __( 'Edit Travel Package', 'travel-packages-plugin' ),
        'view_item'          => __( 'View Travel Package', 'travel-packages-plugin' ),
        'all_items'          => __( 'All Travel Packages', 'travel-packages-plugin' ),
        'search_items'       => __( 'Search Travel Packages', 'travel-packages-plugin' ),
        'parent_item_colon'  => __( 'Parent Travel Packages:', 'travel-packages-plugin' ),
        'not_found'          => __( 'No travel packages found.', 'travel-packages-plugin' ),
        'not_found_in_trash' => __( 'No travel packages found in Trash.', 'travel-packages-plugin' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'travel-package' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
        'register_meta_box_cb' => 'add_travel_package_meta_boxes'
    );

    register_post_type( 'travel-package', $args );
}
add_action( 'init', 'travel_packages_custom_post_type' );
```

### Adding Meta Boxes

The plugin adds meta boxes for additional travel package details:

```php
function add_travel_package_meta_boxes() {
    add_meta_box(
        'travel-package-details',
        __( 'Travel Package Details', 'travel-packages-plugin' ),
        'render_travel_package_details_meta_box',
        'travel-package',
        'normal',
        'high'
    );
}
```

### Rendering Meta Boxes

The plugin renders the meta boxes for user input:

```php
function render_travel_package_details_meta_box( $post ) {
    $country = get_post_meta( $post->ID, 'country', true );
    $cost = get_post_meta( $post->ID, 'cost', true );
    $duration = get_post_meta( $post->ID, 'duration', true );
    $map_url = get_post_meta( $post->ID, 'map_url', true );
    $package_includes = get_post_meta( $post->ID, 'package_includes', true );
    $package_excludes = get_post_meta( $post->ID, 'package_excludes', true );
    $photos = get_post_meta( $post->ID, 'photos', true );

    // Render HTML form fields here...
}
```

### Saving Meta Box Data

The plugin saves the meta box data when the travel package is saved:

```php
function save_travel_package_details( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( isset( $_POST['country'] ) ) {
        update_post_meta( $post_id, 'country', sanitize_text_field( $_POST['country'] ) );
    }

    if ( isset( $_POST['cost'] ) ) {
        update_post_meta( $post_id, 'cost', sanitize_text_field( $_POST['cost'] ) );
    }

    if ( isset( $_POST['duration'] ) ) {
        update_post_meta( $post_id, 'duration', sanitize_text_field( $_POST['duration'] ) );
    }

    if ( isset( $_POST['map_url'] ) ) {
        update_post_meta( $post_id, 'map_url', sanitize_text_field( $_POST['map_url'] ) );
    }

    if ( isset( $_POST['package_includes'] ) ) {
        update_post_meta( $post_id, 'package_includes', wp_kses_post( $_POST['package_includes'] ) );
    }

    if ( isset( $_POST['package_excludes'] ) ) {
        update_post_meta( $post_id, 'package_excludes', wp_kses_post( $_POST['package_excludes'] ) );
    }

    if ( isset( $_FILES['photos'] ) ) {
        $photo_urls = array();

        $photo_files = $_FILES['photos'];

        foreach ( $photo_files['name'] as $key => $photo_name ) {
            $photo_tmp = $photo_files['tmp_name'][$key];
            $photo_type = $photo_files['type'][$key];
            $upload_dir = wp_upload_dir();
            $upload_path = $upload_dir['path'];
            $upload_url = $upload_dir['url'];

            $photo_path = $upload_path . '/' . $photo_name;
            $photo_url = $upload_url . '/' . $photo_name;

            move_uploaded_file( $photo_tmp, $photo_path );

            $photo_urls[] = $photo_url;
        }

        update_post_meta( $post_id, 'photos', $photo_urls );
    }
}
add_action( 'save_post_travel-package', 'save_travel_package_details' );
```

### Displaying the Travel Package

The plugin provides a template for displaying travel packages:

```php
function display_travel_package($content) {
    if ( 'travel-package' == get_post_type() ) {
        $country = get_post_meta( get_the_ID(), 'country', true );
        $cost = get_post_meta( get_the_ID(), 'cost', true );
        $duration = get_post_meta( get_the_ID(), 'duration', true );
        $map_url = get_post_meta( get_the_ID(), 'map_url', true );
        $package_includes = get_post_meta( get_the_ID(), 'package_includes', true );
        $package_excludes = get_post_meta( get_the_ID(), 'package_excludes', true );
        $photos = get_post_meta( get_the_ID(), 'photos', true );

        // Display the travel package details here...
    }

    return $content;
}
add_filter('the_content', 'display_travel_package');
```

## Contributing

1. Fork the repository.
2. Create a new branch.
3. Make your changes.
4. Submit a pull request.

## License

This plugin is licensed under the MIT License. See the LICENSE file for details.