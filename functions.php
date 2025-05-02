<?php
// =============================================
// Prevent Direct File Access
// =============================================
if (!defined('ABSPATH')) {
    exit;
}

// =============================================
// Global Theme Version (for cache busting)
// =============================================
$theme = wp_get_theme();
$theme_version = $theme->get('Version');



// =============================================
// Enqueue Admin Styles
// =============================================
function load_admin_styles() {
    wp_enqueue_style('admin-custom-style', get_stylesheet_directory_uri() . '/assets/css/admin-style.css');
}
add_action('admin_enqueue_scripts', 'load_admin_styles');


// =============================================
// Enqueue Frontend Styles & Scripts
// =============================================
function johnmill_enqueue_assets() {
    global $theme_version;

    wp_enqueue_style(
        'tailwind-css',
        get_stylesheet_directory_uri() . '/assets/css/output.css',
        [],
        $theme_version,
        'all'
    );

    wp_enqueue_script(
        'custom-js',
        get_stylesheet_directory_uri() . '/assets/js/script.js',
        [],
        $theme_version,
        true
    );

    wp_localize_script('custom-js', 'news_ajax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
    ]);
}
add_action('wp_enqueue_scripts', 'johnmill_enqueue_assets');


// =============================================
// Theme Setup (Menus, Logos, Thumbnails)
// =============================================
function johnmill_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');

    add_theme_support('custom-logo', [
        'height'      => 100,
        'width'       => 250,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'primary' => __('Primary Menu', 'john-mill'),
        'footer'  => __('Footer Menu', 'john-mill'),
    ]);
}
add_action('after_setup_theme', 'johnmill_theme_setup');


// =============================================
// Add Custom Class to Logo Output
// =============================================
function add_custom_logo_class($html) {
    return str_replace('custom-logo-link', 'custom-logo-link flex items-center justify-start', $html);
}
add_filter('get_custom_logo', 'add_custom_logo_class');


// =============================================
// Enqueue Admin Scripts for Meta Boxes
// =============================================
function john_mill_admin_scripts($hook) {
    global $theme_version;

    if (!in_array($hook, ['post.php', 'post-new.php'])) {
        return;
    }

    wp_enqueue_script(
        'meta-box-js',
        get_stylesheet_directory_uri() . '/assets/js/home-meta-box.js',
        ['jquery'],
        $theme_version,
        true
    );

    wp_enqueue_script(
        'journey-admin-js',
        get_stylesheet_directory_uri() . '/assets/js/journey.js',
        ['jquery'],
        $theme_version,
        true
    );

    wp_enqueue_script(
        'show-meta-box-js',
        get_stylesheet_directory_uri() . '/assets/js/show-meta-box.js',
        ['jquery'],
        $theme_version,
        true
    );
}
add_action('admin_enqueue_scripts', 'john_mill_admin_scripts');


// =============================================
// Force Specific Template for Front Page
// =============================================
function force_front_page_template($template) {
    if (is_front_page()) {
        return get_stylesheet_directory() . '/front-page.php';
    }
    return $template;
}
add_filter('template_include', 'force_front_page_template');


// =============================================
// AJAX Handler to Check Page Template
// =============================================
function john_mill_check_template() {
    if (!isset($_POST['post_id'])) {
        wp_send_json_error(['message' => 'No post ID']);
    }

    $post_id = intval($_POST['post_id']);
    $template = get_page_template_slug($post_id);

    wp_send_json_success(['template' => $template]);
}
add_action('wp_ajax_john_mill_check_template', 'john_mill_check_template');


// =============================================
// Redirect Empty Search Results to 404
// =============================================
function redirect_invalid_search_results() {
    if (is_search() && !have_posts()) {
        wp_redirect(home_url('/404'));
        exit;
    }
}
add_action('template_redirect', 'redirect_invalid_search_results');


// =============================================
// Include Modular Theme Files (Child Override Support)
// =============================================
$includes = [
    'inc/menu.php',
    'inc/customizer.php',
    'inc/home-meta-box.php',
    'inc/journey-meta-box.php',
    // 'inc/news-event-meta-box.php',
    'inc/load-more.php',
    'inc/visit-us-meta-box.php',
    'inc/theme-option.php',
    'inc/contact-meta-box.php',
];

foreach ($includes as $file) {
    $filepath = locate_template($file);
    if ($filepath) {
        require_once $filepath;
    }
}


// =============================================
// Allow SVG Uploads in Media Library
// =============================================
function upload_svg_files($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'upload_svg_files');


// =============================================
// Enqueue Adobe Typekit Fonts
// =============================================
function custom_enqueue_typekit_fonts() {
    wp_enqueue_style('adobe-fonts', 'https://use.typekit.net/zim2phj.css', false);
}
add_action('wp_enqueue_scripts', 'custom_enqueue_typekit_fonts');


// =============================================
// Enable saving of JSON files for ACF
// =============================================

function my_acf_json_save_point( $path ) {
    return get_stylesheet_directory() . '/acf-json';
}
add_filter( 'acf/settings/save_json', 'my_acf_json_save_point' );

// =============================================
// Edd excerpts to pages
// =============================================

function add_excerpt_to_pages() {
    add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_to_pages');


?>