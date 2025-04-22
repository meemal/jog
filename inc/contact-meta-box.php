<?php
// Add Meta Box
function contact_page_meta_box() {
    add_meta_box(
        'contact_page_meta',
        'Contact Page Description',
        'contact_page_meta_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'contact_page_meta_box');

// Meta Box Callback Function
function contact_page_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'contact_page_meta_nonce');
    $stored_meta = get_post_meta($post->ID, '_contact_page_description', true);
    ?>
    <label for="contact_page_description"><strong>Page Description:</strong><span class="text-sm"> (Optional)</span></label>
    <textarea id="contact_page_description" name="contact_page_description" rows="4" style="width:100%;"><?php echo esc_textarea($stored_meta); ?></textarea>
    <?php
}

// Save Meta Box Data
function save_contact_page_meta($post_id) {
    if (!isset($_POST['contact_page_meta_nonce']) || !wp_verify_nonce($_POST['contact_page_meta_nonce'], basename(__FILE__))) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST['contact_page_description'])) {
        update_post_meta($post_id, '_contact_page_description', sanitize_text_field($_POST['contact_page_description']));
    }
}
add_action('save_post', 'save_contact_page_meta');



// for connect footer email page link
function get_contact_page_url_by_template_name($template_name = 'Contact Page') {
    $pages = get_pages();
    foreach ($pages as $page) {
        $template_slug = get_page_template_slug($page->ID);
        
        // Match by template slug (filename)
        if ($template_slug && strpos($template_slug, 'contact') !== false) {
            return get_permalink($page->ID);
        }

        // Fallback: match by title
        if (get_the_title($page->ID) === $template_name) {
            return get_permalink($page->ID);
        }
    }
    return '';
}
?>
