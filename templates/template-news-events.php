<?php
/*
Template Name: News and Events
*/
get_header();
$get_involved_url = get_post_meta(get_the_ID(), '_get_involved_url', true);
?>

<!-- Page Header -->
<div class=" pt-[130px] lg:pt-[230px]">
    <div class="container">
        <div class="w-auto lg:max-w-[1306px] mb-[74px] md:mb-[114px] text-center ssm:text-left">
            <h1 class="text-mill-red font-artz text-[60px] lg:text-[120px] leading-[55px] mb-[65px] md:mb-[100px] "><?php the_title(); ?></h1>
            <div class="text-mill-warm-grey font-artz text-[40px] lg:text-[42px]  leading-[40px] ">
            <?php while (have_posts()) : the_post(); the_excerpt(); endwhile; ?>
            </div>
            <div class="my-10">
                <?= the_content() ?>
            </div>
        </div>
    </div>
</div>

<!-- News Grid -->
<div class="px-[20px] mb-16">
    <div id="news-container" class="grid grid-cols-1 md:grid-cols-2  lg:grid-cols-3 gap-[15px] md:gap-[21px]">
        <?php
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => 6,
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
            'paged'          => 1
        );

        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                include 'news-events-card.php'; // Including inline post card template
            endwhile;
            wp_reset_postdata();
        else :
            echo '<p class="text-gray-600">No news or events found.</p>';
        endif;
        ?>
    </div>

    <!-- Load More Button -->
    <div class="flex justify-center mt-8">
        <button id="load-more" class="hidden border font-brother font-bold text-[#FFFFFF] bg-mill-blue hover:bg-mill-blue-light px-6 py-3 rounded-lg text-[18px] transition-all duration-300">
            Load More
        </button>
    </div>
</div>



<?php get_footer(); ?>

