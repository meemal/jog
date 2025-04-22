<?php
// Prevent Direct Access
if (!defined('ABSPATH')) exit;

// Register Custom Taxonomy for Tabs (Categories)
function journey_register_tabs_taxonomy() {
    register_taxonomy('journey_tabs', 'page', [
        'label'        => __('Journey Tabs'),
        'rewrite'      => false,
        'hierarchical' => true,
        'show_ui'      => false,
    ]);
}
add_action('init', 'journey_register_tabs_taxonomy');

// Add Meta Box
function journey_custom_meta_boxes() {
    add_meta_box(
        'journey-meta-box',
        'Our Journey Page Details',
        'journey_meta_box_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'journey_custom_meta_boxes');


// Meta Box UI
function journey_meta_box_callback($post) {
    $tabs = get_terms([
        'taxonomy' => 'journey_tabs',
        'hide_empty' => false,
        'orderby' => 'id', // Order by ID (ensures oldest tabs appear first)
        'order' => 'ASC' // ASC means oldest tabs first
    ]);
    wp_enqueue_media();
    wp_enqueue_editor();
    ?>
    <style>
        #journey-tab-list { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 10px; }
        .tab-item { background: #0073aa; color: white; padding: 8px 12px; cursor: pointer; border-radius: 5px; transition: all 0.3s ease; }
        .tab-item:hover { background: #005177; }
        .tab-item.active { background: #004466; }
        .image-preview img { max-width: 100px; margin-top: 5px; display: block; }

        /* Modal Styles */
        .modal, .modal-overlay { display: none; }
        .modal { position: fixed; z-index: 1000; left: 50%; top: 50%; transform: translate(-50%, -50%); width: 40%; background: white; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2); padding: 20px; border-radius: 5px; }
        .modal-overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 999; }

    </style>

    <div id="journey-admin-panel">
        
        <button type="button" id="add-tab-btn" class="button button-primary" style="margin-right: 5px; margin-bottom: 8px">+ Add Tab</button>
        <button type="button" id="manage-tabs-btn" class="button button-secondary">⚙️ Manage Tabs</button>

        <div id="new-tab-section" style="display: none;">
            <input type="text" id="new-tab-name" placeholder="Enter unique tab name">
            <button type="button" id="save-tab-btn" class="button-primary">Save</button>
        </div>

        <ul id="journey-tab-list">
    <?php 
    $page_id = get_the_ID(); // Get the current page ID
    $tabs = get_post_meta($page_id, 'journey_tabs', true); // Fetch tabs for this specific page
    if (!empty($tabs) && is_array($tabs)) :
        foreach ($tabs as $tab_id => $tab_name): ?>
            <li class="tab-item" data-tab-id="<?php echo esc_attr($tab_id); ?>">
                <span class="tab-title"><?php echo esc_html($tab_name); ?></span>
            </li>
        <?php endforeach;
    else: ?>
        <li>No tabs found for this page.</li>
    <?php endif; ?>
</ul>
<p style="font-size: 14px; color: #666; line-height: 1.6; margin-top: -16px;">
    <strong>Note:</strong> After providing any tab information, please switch to another tab once before saving to ensure the data is stored correctly.
</p>



        <!-- Error Message Container (Initially Hidden) -->
        <p id="tab-error-message" style="color: red; display: none; margin-top: 10px;"></p>



        <div id="tab-content-section">
            
            <div id="tab-content-wrapper" style="display: none;">
                <p><strong>Upload Image:</strong></p>
                <input type="hidden" id="tab-image" />
                <button type="button" id="upload-tab-image" class="button">📷 Upload Image</button>
                <button type="button" id="delete-tab-image" class="button">🗑️ Delete Image</button>
                <div class="image-preview"></div>

                <?php wp_editor('', 'tab-content-editor', [
                    'textarea_name' => 'tab-content-editor',
                    'media_buttons' => false
                ]); ?>
            </div>
        </div>
    </div>

<!-- Manage Tabs Modal -->
    <div id="modal-overlay" class="modal-overlay"></div>
    <div id="manage-tabs-modal">
        <h2>Manage Tabs</h2>
        <ul id="manage-tab-list"></ul>
        <button id="close-manage-tabs" class="button-secondary">Close</button>
    </div>

    <!-- Delete Confirmation Modal -->
    <div id="delete-modal-overlay" class="modal-overlay"></div>
    <div id="confirm-delete-modal">
        <h2>Confirm Delete</h2>
        <p>Are you sure you want to delete this tab?</p>
        <button id="confirm-delete-btn" class="button-primary">Yes, Delete</button>
        <button id="cancel-delete-btn" class="button-secondary">Cancel</button>
    </div>



    <?php
}

function journey_create_tab() {
    if (!isset($_POST['tab_name']) || !isset($_POST['page_id'])) {
        wp_send_json_error(['message' => 'Invalid request. Missing page_id or tab_name.']);
    }

    $page_id = intval($_POST['page_id']);
    $tab_name = sanitize_text_field($_POST['tab_name']);

    if (!$page_id) {
        wp_send_json_error(['message' => 'Invalid page ID.']);
    }

    $tabs = get_post_meta($page_id, 'journey_tabs', true);
    if (!is_array($tabs)) $tabs = [];

    if (in_array($tab_name, $tabs)) {
        wp_send_json_error(['message' => 'Duplicate tab name not allowed.']);
    }

    $tab_id = uniqid();
    $tabs[$tab_id] = $tab_name;

    update_post_meta($page_id, 'journey_tabs', $tabs);

    wp_send_json_success(['tab_id' => $tab_id, 'tab_name' => $tab_name]);
}
add_action('wp_ajax_journey_create_tab', 'journey_create_tab');

// AJAX: Load Tab Data
function journey_load_tab_data() {
    if (!isset($_POST['tab_id']) || !isset($_POST['page_id'])) {
        wp_send_json_error(['message' => 'Invalid request. Missing tab_id or page_id.']);
    }

    $page_id = intval($_POST['page_id']);
    $tab_id = sanitize_text_field($_POST['tab_id']);

    // Load tab data specific to this page
    $image = get_post_meta($page_id, "journey_tab_image_$tab_id", true);
    $content = get_post_meta($page_id, "journey_tab_content_$tab_id", true);

    if (!$image) {
        $image = ''; // Default empty image
    }
    if (!$content) {
        $content = ''; // Default empty content
    }

    wp_send_json_success(['image' => $image, 'content' => $content]);
}
add_action('wp_ajax_journey_load_tab_data', 'journey_load_tab_data');



// AJAX: Save Tab Data
function journey_save_tab_data() {
    if (!isset($_POST['tab_id']) || !isset($_POST['page_id']) || !isset($_POST['content']) || !isset($_POST['image'])) {
        wp_send_json_error(['message' => 'Invalid data. Missing parameters.']);
    }

    $page_id = intval($_POST['page_id']);
    $tab_id = sanitize_text_field($_POST['tab_id']);
    $content = wp_kses_post($_POST['content']);
    $image = esc_url($_POST['image']);

    if (empty($page_id) || empty($tab_id)) {
        wp_send_json_error(['message' => 'Page ID or Tab ID is missing.']);
    }

    // Ensure each tab saves its own data using a unique meta key
    $content_key = "journey_tab_content_" . sanitize_key($tab_id);
    $image_key = "journey_tab_image_" . sanitize_key($tab_id);

    // Save data separately per tab
    update_post_meta($page_id, $content_key, $content);
    update_post_meta($page_id, $image_key, $image);

    // Verify if data was saved correctly
    $saved_content = get_post_meta($page_id, $content_key, true);
    $saved_image = get_post_meta($page_id, $image_key, true);

    if ($saved_content !== $content || $saved_image !== $image) {
        wp_send_json_error(['message' => 'Failed to save tab data.']);
    }

    wp_send_json_success(['message' => 'Tab data saved successfully.']);
}
add_action('wp_ajax_journey_save_tab_data', 'journey_save_tab_data');
// add_action('wp_ajax_nopriv_journey_save_tab_data', 'journey_save_tab_data'); // If non-logged-in users need access



// AJAX: Fetch All Tabs for Modal
function journey_fetch_tabs() {
    if (!isset($_POST['page_id'])) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    $page_id = intval($_POST['page_id']);
    $tabs = get_post_meta($page_id, 'journey_tabs', true);
    if (!is_array($tabs)) $tabs = [];

    $formatted_tabs = [];
    foreach ($tabs as $tab_id => $tab_name) {
        $formatted_tabs[] = [
            'id'   => esc_attr($tab_id),
            'name' => esc_html($tab_name),
        ];
    }

    wp_send_json_success(['tabs' => $formatted_tabs]);
}
add_action('wp_ajax_journey_fetch_tabs', 'journey_fetch_tabs');



function journey_update_tab() {
    if (!isset($_POST['page_id']) || !isset($_POST['edited_tabs'])) {
        wp_send_json_error(['message' => 'Invalid request.']);
    }

    $page_id = intval($_POST['page_id']);
    $edited_tabs = $_POST['edited_tabs']; // Array of updated tab names

    if (!$page_id || !is_array($edited_tabs)) {
        wp_send_json_error(['message' => 'Invalid page ID or data.']);
    }

    $tabs = get_post_meta($page_id, 'journey_tabs', true);
    if (!is_array($tabs)) $tabs = [];

    // Convert all existing tab names to lowercase for case-insensitive comparison
    $existingTabNames = array_map('strtolower', array_values($tabs));

    foreach ($edited_tabs as $tab_id => $new_name) {
        $new_name = sanitize_text_field($new_name);
        $new_name_lower = strtolower($new_name);

        // Check if the new name already exists (excluding the one being updated)
        if (in_array($new_name_lower, $existingTabNames) && $tabs[$tab_id] !== $new_name) {
            wp_send_json_error(['message' => 'Duplicate tab name not allowed.']);
        }

        // Update tab name if it's not a duplicate
        if (isset($tabs[$tab_id])) {
            $tabs[$tab_id] = $new_name;
        }
    }

    update_post_meta($page_id, 'journey_tabs', $tabs);

    wp_send_json_success(['message' => 'Tabs updated successfully!']);
}
add_action('wp_ajax_journey_update_tab', 'journey_update_tab');

// AJAX: Delete Tab
function journey_delete_tab() {
    if (!isset($_POST['tab_id']) || !isset($_POST['page_id'])) {
        wp_send_json_error(['message' => __('Invalid request. Missing tab_id or page_id.', 'journey')]);
    }

    $tab_id = sanitize_text_field($_POST['tab_id']);
    $page_id = intval($_POST['page_id']);

    // Delete tab data from post meta
    delete_post_meta($page_id, "journey_tab_content_$tab_id");
    delete_post_meta($page_id, "journey_tab_image_$tab_id");

    // Retrieve existing tabs and remove the one being deleted
    $tabs = get_post_meta($page_id, 'journey_tabs', true);
    if (is_array($tabs) && isset($tabs[$tab_id])) {
        unset($tabs[$tab_id]);
        update_post_meta($page_id, 'journey_tabs', $tabs); // Update the list without the deleted tab
    }

    // Check if the tab was successfully removed
    $updated_tabs = get_post_meta($page_id, 'journey_tabs', true);
    if (isset($updated_tabs[$tab_id])) {
        wp_send_json_error(['message' => __('Error deleting tab data.', 'journey')]);
    }

    wp_send_json_success(['message' => __('Tab and associated data deleted successfully!', 'journey')]);
}

add_action('wp_ajax_journey_delete_tab', 'journey_delete_tab');




