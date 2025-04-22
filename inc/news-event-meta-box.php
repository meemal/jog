<?php
// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Register Meta Box
function john_mill_add_news_event_meta_box() {
    add_meta_box(
        'john_mill_news_event_meta',
        __('Get Involved Link', 'john-mill'),
        'john_mill_news_event_meta_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'john_mill_add_news_event_meta_box');

// Meta Box Callback Function
function john_mill_news_event_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'john_mill_news_event_meta_nonce');

    // Fetch stored values
    $get_involved_url = get_post_meta($post->ID, '_get_involved_url', true);
    ?>

    <div id="john-mill-news-event-meta-box">
        <label for="get_involved_url"><strong>Enter Page/Post/Custom Link:</strong></label>
        <input type="text" id="get_involved_url" name="get_involved_url" value="<?php echo esc_url($get_involved_url); ?>" style="width:100%; margin-top:5px; padding:5px; border:1px solid #ddd;" placeholder="Enter URL here">
        <p class="description">Provide the URL for the 'Get Involved' section button.</p>
    </div>

    <?php
}

// Save Meta Box Data
function john_mill_save_news_event_meta_data($post_id) {
    if (!isset($_POST['john_mill_news_event_meta_nonce']) || !wp_verify_nonce($_POST['john_mill_news_event_meta_nonce'], basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['get_involved_url'])) {
        update_post_meta($post_id, '_get_involved_url', esc_url($_POST['get_involved_url']));
    }
}
add_action('save_post', 'john_mill_save_news_event_meta_data');


