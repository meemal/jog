<?php
// Block direct access
if (!defined('ABSPATH')) {
    exit;
}

// Add Meta Box (Always register, but control visibility dynamically)
function john_mill_add_custom_meta_boxes() {
    add_meta_box(
        'john_mill_page_meta',
        __('Home Page Sections', 'john-mill'),
        'john_mill_page_meta_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'john_mill_add_custom_meta_boxes');

function john_mill_page_meta_callback($post) {
    wp_nonce_field(basename(__FILE__), 'john_mill_meta_nonce');

    // Get stored values (default checked)
    $hero_enabled = get_post_meta($post->ID, '_hero_enabled', true);
    $hero_enabled = ($hero_enabled === '' || $hero_enabled === false) ? 1 : $hero_enabled;

    $hero_title = get_post_meta($post->ID, '_hero_title', true);
    $hero_image = get_post_meta($post->ID, '_hero_image', true);

    $journey_enabled = get_post_meta($post->ID, '_journey_enabled', true);
    $journey_enabled = ($journey_enabled === '' || $journey_enabled === false) ? 1 : $journey_enabled;

    $journey_title = get_post_meta($post->ID, '_journey_title', true);
    $journey_desc = get_post_meta($post->ID, '_journey_desc', true);
    $journey_url = get_post_meta($post->ID, '_journey_url', true); // New Field

    $stay_enabled = get_post_meta($post->ID, '_stay_enabled', true);
    $stay_enabled = ($stay_enabled === '' || $stay_enabled === false) ? 1 : $stay_enabled;

    $stay_title = get_post_meta($post->ID, '_stay_title', true);
    $stay_desc = get_post_meta($post->ID, '_stay_desc', true);
    $stay_image = get_post_meta($post->ID, '_stay_image', true);
    $stay_url = get_post_meta($post->ID, '_stay_url', true); // New Field

    // Ensure the meta box is hidden initially unless 'Home Page' is selected
    $current_template = get_page_template_slug($post->ID);
    $visible = ($current_template === 'front-page.php') ? '' : 'style="display:none;"';
    ?>

    <div id="john-mill-meta-box" <?php echo $visible; ?>>

        <!-- Hero Section -->
        <div class="postbox">
            <h2 class="hndle"><span>Hero Section</span></h2>
            <div class="inside">
                <label>
                    <input type="checkbox" id="hero_enabled" name="hero_enabled" value="1" <?php checked($hero_enabled, 1); ?>>
                    Show Hero Section
                </label>
                <table class="form-table">
                    <tr>
                        <th><label for="hero_title">Hero Title</label></th>
                        <td><input type="text" id="hero_title" name="hero_title" value="<?php echo esc_attr($hero_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="hero_image">Hero Image</label></th>
                        <td>
                            <input type="text" id="hero_image" name="hero_image" value="<?php echo esc_attr($hero_image); ?>" class="regular-text">
                            <button class="button upload-hero-image">Upload</button>
                            <br>
                            <?php if ($hero_image) : ?>
                                <img id="hero_image_preview" src="<?php echo esc_url($hero_image); ?>" style="max-width: 120px; display: block; margin-top: 10px;">
                            <?php else : ?>
                                <img id="hero_image_preview" src="" style="max-width: 120px; display: none; margin-top: 10px;">
                            <?php endif; ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Journey Section -->
        <div class="postbox">
            <h2 class="hndle"><span>Our Journey</span></h2>
            <div class="inside">
                <label>
                    <input type="checkbox" id="journey_enabled" name="journey_enabled" value="1" <?php checked($journey_enabled, 1); ?>>
                    Show Journey Section
                </label>
                <table class="form-table">
                    <tr>
                        <th><label for="journey_title">Journey Title</label></th>
                        <td><input type="text" id="journey_title" name="journey_title" value="<?php echo esc_attr($journey_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="journey_desc">Journey Description</label></th>
                        <td><textarea id="journey_desc" name="journey_desc" class="large-text"><?php echo esc_textarea($journey_desc); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="journey_url">Journey Page URL</label></th>
                        <td><input type="url" id="journey_url" name="journey_url" value="<?php echo esc_url($journey_url); ?>" class="regular-text"></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Stay With Us Section -->
        <div class="postbox">
            <h2 class="hndle"><span>Stay With Us</span></h2>
            <div class="inside">
                <label>
                    <input type="checkbox" id="stay_enabled" name="stay_enabled" value="1" <?php checked($stay_enabled, 1); ?>>
                    Show Stay With Us Section
                </label>
                <table class="form-table">
                    <tr>
                        <th><label for="stay_title">Stay Title</label></th>
                        <td><input type="text" id="stay_title" name="stay_title" value="<?php echo esc_attr($stay_title); ?>" class="regular-text"></td>
                    </tr>
                    <tr>
                        <th><label for="stay_desc">Stay Description</label></th>
                        <td><textarea id="stay_desc" name="stay_desc" class="large-text"><?php echo esc_textarea($stay_desc); ?></textarea></td>
                    </tr>
                    <tr>
                        <th><label for="stay_image">Stay Image</label></th>
                        <td>
                            <input type="text" id="stay_image" name="stay_image" value="<?php echo esc_attr($stay_image); ?>" class="regular-text">
                            <button class="button upload-stay-image">Upload</button>
                            <br>
                            <?php if ($stay_image) : ?>
                                <img id="stay_image_preview" src="<?php echo esc_url($stay_image); ?>" style="max-width: 120px; display: block; margin-top: 10px;">
                            <?php else : ?>
                                <img id="stay_image_preview" src="" style="max-width: 120px; display: none; margin-top: 10px;">
                            <?php endif; ?>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="stay_url">Stay With Us Page URL</label></th>
                        <td><input type="url" id="stay_url" name="stay_url" value="<?php echo esc_url($stay_url); ?>" class="regular-text"></td>
                    </tr>
                </table>
            </div>
        </div>

    </div>

<?php
}

// Save Meta Box Data
function john_mill_save_meta_box_data($post_id) {
    if (!isset($_POST['john_mill_meta_nonce']) || !wp_verify_nonce($_POST['john_mill_meta_nonce'], basename(__FILE__))) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    $fields = ['hero_title', 'hero_image', 'journey_title', 'journey_desc', 'journey_url', 'stay_title', 'stay_desc', 'stay_image', 'stay_url'];
    $checkboxes = ['hero_enabled', 'journey_enabled', 'stay_enabled'];

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }

    foreach ($checkboxes as $checkbox) {
        $value = isset($_POST[$checkbox]) ? 1 : 0;
        update_post_meta($post_id, '_' . $checkbox, $value);
    }
}
add_action('save_post', 'john_mill_save_meta_box_data');
