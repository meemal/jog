<?php
// Add Theme Options Page
function john_mill_theme_menu() {
    add_menu_page(
        'Theme Options',
        'Theme Options',
        'manage_options',
        'john_mill_theme_options',
        'john_mill_theme_options_page',
        'dashicons-admin-generic',
        99
    );
}
add_action('admin_menu', 'john_mill_theme_menu');

// Theme Options Page Content
function john_mill_theme_options_page() { ?>
    <div class="wrap">
        <h1>Theme Options</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('john_mill_theme_options_group');
            do_settings_sections('john_mill_theme_options');
            submit_button();
            ?>
        </form>
    </div>
<?php }

// Register Settings
function john_mill_theme_settings() {
    add_settings_section('john_mill_social_links', 'Footer Settings', null, 'john_mill_theme_options');

    // Contact
    add_settings_field('john_mill_footer_contact_url', 'Contact Page', 'john_mill_footer_contact_callback', 'john_mill_theme_options', 'john_mill_social_links');
    register_setting('john_mill_theme_options_group', 'john_mill_footer_contact_url');

    // Get Involved
    add_settings_field('john_mill_footer_get_involved', 'Get Involved URL', 'john_mill_footer_getinvolved_callback', 'john_mill_theme_options', 'john_mill_social_links');
    register_setting('john_mill_theme_options_group', 'john_mill_footer_get_involved');

    // Instagram
    add_settings_field('john_mill_footer_instagram', 'Instagram URL', 'john_mill_footer_instagram_callback', 'john_mill_theme_options', 'john_mill_social_links');
    register_setting('john_mill_theme_options_group', 'john_mill_footer_instagram');

    // Facebook
    add_settings_field('john_mill_footer_facebook', 'Facebook URL', 'john_mill_footer_facebook_callback', 'john_mill_theme_options', 'john_mill_social_links');
    register_setting('john_mill_theme_options_group', 'john_mill_footer_facebook');
}
add_action('admin_init', 'john_mill_theme_settings');

// // Input Field Callbacks
function john_mill_footer_getinvolved_callback() {
    $gilink = get_option('john_mill_footer_get_involved', '/contact');
    echo '<input type="url" name="john_mill_footer_get_involved" value="' . esc_attr($gilink) . '" class="regular-text">';
}
// Input Field Callbacks
function john_mill_footer_contact_callback() {
    $contact = get_option('john_mill_footer_contact_url', '/contact');
    echo '<input type="url" name="john_mill_footer_contact_url" value="' . esc_attr($contact) . '" class="regular-text">';
}
function john_mill_footer_instagram_callback() {
    $instagram = get_option('john_mill_footer_instagram', '');
    echo '<input type="url" name="john_mill_footer_instagram" value="' . esc_attr($instagram) . '" class="regular-text">';
}

function john_mill_footer_facebook_callback() {
    $facebook = get_option('john_mill_footer_facebook', '');
    echo '<input type="url" name="john_mill_footer_facebook" value="' . esc_attr($facebook) . '" class="regular-text">';
}


