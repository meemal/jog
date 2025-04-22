<?php

// Load More Posts - AJAX handlers
add_action('wp_ajax_load_more_posts', 'load_more_posts');
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

function load_more_posts() {
    $paged = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 6,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        ob_start();
        while ($query->have_posts()) {
            $query->the_post();

            $template_path = get_template_directory() . '/templates/news-events-card.php';
            if (file_exists($template_path)) {
                include $template_path;
            } else {
                echo '<p>Card template not found at: ' . esc_html($template_path) . '</p>';
                error_log('Template missing: ' . $template_path);
            }
        }
        wp_reset_postdata();
        echo ob_get_clean();
    } else {
        echo '<p>No more posts found.</p>';
    }

    wp_die();
}


// Check if More Posts Exist
add_action('wp_ajax_check_more_posts', 'check_more_posts');
add_action('wp_ajax_nopriv_check_more_posts', 'check_more_posts');

function check_more_posts() {
    $loaded = isset($_GET['loaded']) ? intval($_GET['loaded']) : 6;

    $args = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );

    $query = new WP_Query($args);
    $total = $query->found_posts;

    wp_send_json(array(
        'has_more' => $loaded < $total
    ));
}






