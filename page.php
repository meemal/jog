<?php get_header(); ?>

<div class="container mx-auto px-4">
    <?php 
    if (is_page('our-journey')) { 
        get_template_part('template-parts/pages/journey-page'); 
    } else { 
        while (have_posts()) : the_post();
            the_content();
        endwhile;
    }
    ?>
</div>

<?php get_footer(); ?>
