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
            <h1 class="text-[#9a0f1e] font-artz text-[60px] lg:text-[120px] leading-[55px] mb-[65px] md:mb-[100px] "><?php the_title(); ?></h1>
            <div class="text-[#474442] font-artz text-[40px] lg:text-[42px]  leading-[40px] ">
                <?php while (have_posts()) : the_post(); the_content(); endwhile; ?>
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

<!-- Only show this section if a link exists -->
<?php if (!empty($get_involved_url)) : ?>
    <div class="get-involved-section bg-[#9A0F1E] pt-[66px] pb-[80.5px] lg:pt-[112px] lg:pb-[112px] rounded-t-[30px]">
        <div class=" pr-[63px] pl-[53px]">
            <div class="flex justify-between items-center">
                <h2 class="text-white leading-[55px] font-artz text-[40px] sm:text-[60px]">GET INVOLVED</h2>
                <a href="<?php echo esc_url($get_involved_url); ?>" 
                   class="flex items-center justify-center w-[45px] h-[45px] sm:w-[65px] sm:h-[65px] bg-gray-600/30 rounded-full hover:bg-gray-600/50">

                   <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 8l4 4m0 0l-4 4m4-4H8" stroke="white"/>
                    </svg>

                </a>
            </div>
        </div>
    </div>
<?php endif; ?>

<?php get_footer(); ?>

