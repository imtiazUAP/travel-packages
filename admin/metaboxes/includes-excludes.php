<?php
// Render meta box for package includes and excludes
function render_package_include_exclude_meta_box($post)
{
    // Retrieve the current travel includes and excludes
    $package_includes = get_post_meta($post->ID, 'package_includes', true);
    $package_excludes = get_post_meta($post->ID, 'package_excludes', true);

    // Output the HTML form fields
    ?>
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
    <?php
}