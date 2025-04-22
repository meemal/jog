<?php
/*
Template Name: Contact Page
*/

get_header();
?>


<div class="container py-8 pt-[50px] sm:pt-[100px] text-center">
    <!-- Dynamic Page Title -->
    <h1 class="text-[#9A0F1E] text-[40px] sm:text-[60px] font-artz lg:text-[82px]  mb-2"><?php the_title(); ?></h1>

    <!-- Get Custom Meta Description (Show only if provided) -->
    <?php 
    $description = get_post_meta(get_the_ID(), '_contact_page_description', true);
    if (!empty(trim($description))) : ?>
        <p class="text-[#474442] text-[20px] sm:text-[30px] lg:text-[32px] max-w-3xl mx-auto font-artz mb-6 leading-[20px] sm:leading-[30px] lg:leading-[35px]"><?php echo esc_html($description); ?></p>
    <?php endif; ?>

    <!-- Dynamic Page Content -->
    <div class="text-gray-700 text-xl font-normal max-w-3xl mx-auto custom-line-height mb-8">
        <?php the_content(); ?>
    </div>
</div>

<?php get_footer(); ?>
