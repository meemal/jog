<?php

class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        if ($depth === 0) {
            $output .= "\n$indent<ul class=\"absolute left-0 top-[76px] w-[200px] rounded-lg bg-white shadow-lg border-[3px] p-3 px-4 border-gray-200 
                        opacity-0 translate-y-[-10px] transition-all duration-300 ease-in-out group-hover:opacity-100 group-hover:translate-y-0 invisible group-hover:visible\">\n";
        } else {
            $output .= "\n$indent<ul class=\"sub-menu\">\n";
        }
    }

    function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        static $menu_index = 0;
        static $menu_items_count = null;

        if ($menu_items_count === null && isset($args->menu->term_id)) {
            $menu_obj = wp_get_nav_menu_items($args->menu->term_id);
            $menu_items_count = count($menu_obj);
        }

        $menu_index++;

        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        
        // Check if this menu item is the currently active page
        $active_class = in_array('current-menu-item', (array) $item->classes) || in_array('current_page_parent', (array) $item->classes) ? ' text-red-800' : '';

        $border_class = ($depth === 0 && $menu_index < $menu_items_count) ? "border-r-[4px] rounded-sm border-[#ddd]" : "";

        if ($depth === 0) {
            $output .= "$indent<li class=\"relative group py-5\">
                            <a href=\"" . esc_attr($item->url) . "\" 
                               class=\"px-[18px]  $border_class hover:text-red-800 group-hover:text-red-800$active_class\">" . esc_html($item->title) . "</a>";
        } else {
            $output .= "$indent<li>
                            <a class=\"py-2 px-2 block hover:text-red-800$active_class\" 
                               href=\"" . esc_attr($item->url) . "\">" . esc_html($item->title) . "</a>";
        }
    }

    function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = null) {
        $output .= "</ul>\n";
    }
}



// ................Mobile Menue Settings...................
function john_mill_customize_register($wp_customize) {
    // Add Mobile Menu Section
    $wp_customize->add_section('john_mill_mobile_menu_section', array(
        'title'       => __('Mobile Menu Settings', 'john-mill'),
        'priority'    => 30,
        'description' => __('Customize the mobile menu settings.', 'john-mill'),
    ));

    // Add Mobile Logo Setting
    $wp_customize->add_setting('john_mill_mobile_logo', array(
        'default'   => '',
        'transport' => 'refresh',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Add Mobile Logo Upload Control
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'john_mill_mobile_logo', array(
        'label'    => __('Mobile Menu Logo', 'john-mill'),
        'section'  => 'john_mill_mobile_menu_section',
        'settings' => 'john_mill_mobile_logo',
    )));
}
add_action('customize_register', 'john_mill_customize_register');
