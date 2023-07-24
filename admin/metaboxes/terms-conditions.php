<?php
// Render meta box for terms and conditions
function render_terms_conditions_meta_box($post)
{
    // Retrieve the terms and conditions
    $highlights = get_post_meta($post->ID, 'highlights', true);
    $general_conditions = get_post_meta($post->ID, 'general_conditions', true);

    $cancellation_policy = get_post_meta($post->ID, 'cancellation_policy', true);
    $notes = get_post_meta($post->ID, 'notes', true);

    // Output the HTML form fields
    ?>

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
    <?php
}