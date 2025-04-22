<?php
function visit_us_add_meta_box() {
    add_meta_box(
        'visit_us_meta_box', 
        'Visit Us Page Details', 
        'visit_us_meta_box_callback', 
        'page', 
        'normal', 
        'high'
    );
}
add_action('add_meta_boxes', 'visit_us_add_meta_box');

function visit_us_meta_box_callback($post) {
    // Get saved values
    $visit_us_title = get_post_meta($post->ID, 'visit_us_title', true);
    $visit_us_map = get_post_meta($post->ID, 'visit_us_map', true);

    wp_nonce_field('visit_us_save_meta_box', 'visit_us_meta_box_nonce');

    ?>
    <p>
        <label for="visit_us_title"><strong>Title</strong></label><br>
        <input type="text" id="visit_us_title" name="visit_us_title" value="<?php echo esc_attr($visit_us_title); ?>" class="widefat">
    </p>
    <p>
        <label for="visit_us_map"><strong>Google Map Embed URL</strong></label><br>
        <textarea id="visit_us_map" name="visit_us_map" rows="3" class="widefat"><?php echo esc_textarea($visit_us_map); ?></textarea>
    </p>
    <?php
}

function visit_us_save_meta_box($post_id) {
    // Verify nonce
    if (!isset($_POST['visit_us_meta_box_nonce']) || !wp_verify_nonce($_POST['visit_us_meta_box_nonce'], 'visit_us_save_meta_box')) {
        return;
    }

    // Check for autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check user permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    if (isset($_POST['visit_us_title'])) {
        update_post_meta($post_id, 'visit_us_title', sanitize_text_field($_POST['visit_us_title']));
    }

    if (isset($_POST['visit_us_map'])) {
        update_post_meta($post_id, 'visit_us_map', esc_url_raw($_POST['visit_us_map']));
    }
}
add_action('save_post', 'visit_us_save_meta_box');
