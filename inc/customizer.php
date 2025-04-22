<?php
function john_mill_theme_customizer($wp_customize) {
    // Footer Section
    $wp_customize->add_section('john_mill_footer_section', array(
        'title'    => __('Footer Settings', 'john-mill'),
        'priority' => 130,
    ));

    // Footer Logo
    $wp_customize->add_setting('john_mill_footer_logo', array(
        'default'           => '',
        'transport'         => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'john_mill_footer_logo_control', array(
        'label'    => __('Footer Logo', 'john-mill'),
        'section'  => 'john_mill_footer_section',
        'settings' => 'john_mill_footer_logo',
    )));
}

// Register the Customizer function
add_action('customize_register', 'john_mill_theme_customizer');
