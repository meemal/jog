<?php get_header(); ?>

<main>

    <?php
    $news_query = new WP_Query([
        'post_type'      => 'page',
        'title'          => 'News and Events',
        'posts_per_page' => 1,
    ]);

    if ($news_query->have_posts()) {
        $news_page = $news_query->posts[0];
        $news_link = get_permalink($news_page->ID);
    } else {
        $news_link = home_url();
    }
    ?>


    <div class="container pt-[34px] items-center ">
        <a class="group flex gap-[16px] items-center" href="<?php echo esc_url($news_link); ?>">
            <svg xmlns="http://www.w3.org/2000/svg" width="39" height="39" viewBox="0 0 39 39" class="transition-colors duration-300">
                <g transform="translate(-65 -1965)">
                    <!-- Circle background -->
                    <circle cx="19.5" cy="19.5" r="19.5"
                            transform="translate(65 1965)"
                            class="fill-[#e2d6c5] group-hover:fill-[#bba89c] transition-colors duration-300" />
                    <!-- Arrow -->
                    <g transform="translate(70.4 1969.799)">
                        <path d="M0,0H28.8V28.8H0Z" fill="none"/>
                        <path d="M27.2,16.4H12.6l6.7-6.7L17.6,8,8,17.6l9.6,9.6,1.7-1.7-6.7-6.7H27.2Z"
                            transform="translate(-3.2 -3.2)"
                            fill="#f9f5ed"/>
                    </g>
                </g>
            </svg>

            <h1 class="text-[#474442] text-[28px] font-artz mt-1 transition-colors duration-300 group-hover:text-[#9A0F1E]">
                Back to news
            </h1>
        </a>

    </div>

    <div class="w-full border-t border-[#E2D6C5] mt-[30px]"></div>


    <section>
        <div class="text-center ssm:text-left container pt-[71px] md:pt-[105px]">
            <h1 class="text-[#9A0F1E] font-artz text-[60px] lg:text-[120px] mb-[25px] leading-[55px] lg:leading-[95px] lg:mb-[80px]"><?php the_title(); ?></h1>

            <?php if (has_excerpt()) : ?>
                <p class="text-[#474442] font-artz text-[40px] lg:text-[42px] leading-[40px] w-full lg:max-w-[1306px] mb-[20px] lg:mb-[80px] ">
                    <?php echo wp_strip_all_tags(get_the_excerpt()); ?>
                </p>

            <?php endif; ?>
        </div>
    </section>
    

    <section class="text-center ssm:text-left container <?php echo has_post_thumbnail() ? 'grid grid-cols-1 lg:grid-cols-2' : ''; ?> gap-[60px] lg:gap-[73px] mb-8 pt-5">
        <?php if (has_post_thumbnail()) : ?>
            <!-- Text First on Mobile, Second on Desktop -->
            <div class="order-1 lg:order-2 text-[#2C2C2C] font-normal max-h-full lg:max-h-[700px] overflow-auto font-hwt_regular text-[22px] lg:text-[28px] leading-[32px] lg:leading-[38px]">
                <?php the_content(); ?>
            </div>

            <!-- Image Second on Mobile, First on Desktop -->
            <div class="order-2 lg:order-1">
                <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" class="w-full rounded-[30px] h-[545px] lg:h-[685px] object-cover">
            </div>
        <?php else : ?>
            <!-- Full-width layout when no image -->
            <div class="text-[#2C2C2C] font-normal text-[22px] lg:text-[28px] leading-[32px] lg:leading-[38px]">
                <?php the_content(); ?>
            </div>
        <?php endif; ?>
    </section>



    <!-- Share Section -->
    <section class=" mb-[100px] lg:mb-[200px] container mt-[55px] lg:mt-[78px]">
        <h3 class="text-[#474442] font-artz text-[42px] ">Share</h3>
        <div class="flex -mt-3 ml-[-16px]">
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" 
            class="w-[65px] h-[65px] flex items-center justify-center rounded-full hover:bg-[#e2d6c5] transition-all duration-300" 
            target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook02.svg" alt="">
            </a>

            <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>" 
            class="-ml-2 w-[65px] h-[65px] flex items-center justify-center rounded-full hover:bg-[#e2d6c5] transition-all duration-300" 
            target="_blank">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/twitter.svg" alt="">
            </a>

            <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" 
            class="-ml-2 w-[65px] h-[65px] flex items-center justify-center rounded-full hover:bg-[#e2d6c5] transition-all duration-300">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/at.svg" alt="">
            </a>
        </div>


    </section>



    <!-- Pagination -->
<section class="r mb-10 border-t border-[#E6E1D7]  container">
    <div class="flex font-artz justify-between items-cente pt-[80px] lg:pt-[78px]  pb-[40px]">
    <div class="flex space-x-2 items-center">
        <!-- Next Post Button -->
        <?php
        $next_post = get_next_post();
        if (!empty($next_post)) : ?>
            <a href="<?php echo get_permalink($next_post->ID); ?>"
                class="group w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] rounded-full flex items-center justify-center transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65" class="w-full h-full">
                        <g transform="translate(-65 -1964.999)">
                            <!-- Circle background with hover color transition -->
                            <circle cx="32.5" cy="32.5" r="32.5"
                                    transform="translate(65 1964.999)"
                                    class="transition-colors duration-300 fill-mill-red group-hover:fill-mill-red-light" />
                            
                            <!-- Arrow white-->
                            <g transform="translate(74 1972.999)">
                                <path d="M0,0H48V48H0Z" fill="none"/>
                                <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                    fill="#f9f5ed"/>
                            </g>
                        </g>
                    </svg>
                </a>

        <?php else : ?>
            <span class="rounded-full w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] flex items-center justify-center opacity-50 cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 65 65">
                <g id="Group_96" data-name="Group 96" transform="translate(-65 -1964.999)">
                    <circle id="Ellipse_12" data-name="Ellipse 12" cx="32.5" cy="32.5" r="32.5" transform="translate(65 1964.999)" fill="#e2d6c5"/>
                    <g id="Group_56" data-name="Group 56" transform="translate(74 1972.999)">
                    <path id="Path_37" data-name="Path 37" d="M0,0H48V48H0Z" fill="none"/>
                    <path id="Path_38" data-name="Path 38" d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#f9f5ed"/>
                    </g>
                </g>
            </svg>

            </span>
        <?php endif; ?>

        <!-- Numbered Pagination -->
        <?php
        $all_posts = new WP_Query(array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => -1,
			'orderby'        => 'date',
			'order'          => 'DESC'
		));

            $posts = $all_posts->posts;
            $total_posts = count($posts);
            $posts_per_page = 1;
            $total_pages = ceil($total_posts / $posts_per_page);
            $current_post_id = get_the_ID();
            $current_page = 1;

            foreach ($posts as $index => $post) {
                if ($post->ID == $current_post_id) {
                    $current_page = ceil(($index + 1) / $posts_per_page);
                    break;
                }
            }

            $max_pages_to_show = 7;
            if ($total_pages <= $max_pages_to_show) {
                $start_page = 1;
                $end_page = $total_pages;
            } else {
                if ($current_page <= floor($max_pages_to_show / 2)) {
                    $start_page = 1;
                    $end_page = $max_pages_to_show;
                } elseif ($current_page > $total_pages - floor($max_pages_to_show / 2)) {
                    $start_page = $total_pages - ($max_pages_to_show - 1);
                    $end_page = $total_pages;
                } else {
                    $start_page = $current_page - floor($max_pages_to_show / 2);
                    $end_page = $current_page + floor($max_pages_to_show / 2);
                }
            }

            if ($total_pages > 1) {
                echo '<div class="flex space-x-2">';
                for ($i = $start_page; $i <= $end_page; $i++) {
                    // Shared text size for both active and inactive
                    $text_size = 'text-[17px] sm:text-[32px]';
            
                    // Conditional styling
                    $is_active = ($i == $current_page)
                        ? 'text-mill-red border-[3px] border-mill-oatmeal'
                        : 'text-mill-oatmeal';
            
                    $post_index = ($i - 1) * $posts_per_page;
            
                    if (isset($posts[$post_index])) {
                        $post_link = get_permalink($posts[$post_index]->ID);
            
                        echo '<a href="' . esc_url($post_link) . '" 
                                 class="hover:text-mill-red w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] 
                                        rounded-full ' . $text_size . ' ' . $is_active . ' 
                                        flex items-center justify-center 
                                        transition-colors duration-300 hover:bg-mill-oatmeal">' . $i . '</a>';
                    }
                }
                echo '</div>';
            }
            
            
            wp_reset_postdata();
        ?>

    </div>
    <div>
        <!-- Previous Post Button -->
        <?php
        $prev_post = get_previous_post();
        if (!empty($prev_post)) : ?>
            <a href="<?php echo get_permalink($prev_post->ID); ?>"
                class="group rounded-full w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] flex items-center justify-center transition-colors duration-300">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65" class="w-full h-full">
                        <g transform="translate(-1792 -1964.999)">
                            <!-- Circle background with transition -->
                            <circle cx="32.5" cy="32.5" r="32.5"
                                    transform="translate(1857 2029.999) rotate(180)"
                                    class="transition-colors duration-300  fill-mill-red group-hover:fill-mill-red-light" />
                            
                            <!-- Arrow -->
                            <g transform="translate(1848 2021.999) rotate(180)">
                                <path d="M0,0H48V48H0Z" fill="none"/>
                                <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                    fill="#f9f5ed" />
                            </g>
                        </g>
                    </svg>
                </a>

        <?php else : ?>
            <span class="rounded-full w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] flex items-center justify-center opacity-50 cursor-not-allowed">
            <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 65 65">
                <g id="Group_100" data-name="Group 100" transform="translate(-1792 -1964.999)">
                    <circle id="Ellipse_16" data-name="Ellipse 16" cx="32.5" cy="32.5" r="32.5" transform="translate(1857 2029.999) rotate(180)" fill="#e2d6c5"/>
                    <g id="Group_95" data-name="Group 95" transform="translate(1848 2021.999) rotate(180)">
                    <path id="Path_37" data-name="Path 37" d="M0,0H48V48H0Z" fill="none"/>
                    <path id="Path_38" data-name="Path 38" d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#f9f5ed"/>
                    </g>
                </g>
            </svg>

            </span>
        <?php endif; ?>
    </div>
    </div>
    
</section>


    <div class="get-involved-section bg-[#FCF9F2] py-[100px] rounded-t-[30px]">
        <div class="container">
        <div class="flex justify-between items-center">
            <?php $prev_post = get_previous_post(); ?>
            
            <?php if ($prev_post) : ?>
                <div>
                    <p class="text-[22px] font-normal text-[#474341] mb-2">Next</p>
                    <h2 class="text-[40px] hover:text-[#9A0F1E] duration-200 sm:text-[60px] font-artz leading-[35px] sm:leading-[55px] text-[#2C2C2C]">
                        <a href="<?php echo get_permalink($prev_post->ID); ?>">
                            <?php echo get_the_title($prev_post->ID); ?>
                        </a>
                    </h2>
                </div>

                <a href="<?php echo get_permalink($prev_post->ID); ?>" class="group relative mt-6 w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] block">
                    <!-- Static border circle (always visible) -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65"
                        class="w-full h-full absolute inset-0 z-10 pointer-events-none">
                        <g transform="translate(0 0)" fill="none" stroke="#787573" stroke-width="3">
                            <circle cx="32.5" cy="32.5" r="32.5" stroke="none"/>
                            <circle cx="32.5" cy="32.5" r="31" fill="none"/>
                        </g>
                    </svg>

                    <!-- Default background + arrow -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65"
                        class="w-full h-full absolute inset-0 transition-opacity duration-300 opacity-100 group-hover:opacity-0 z-0">
                        <g transform="translate(-1793 -2835)">
                            <g transform="translate(1793 2835)">
                                <!-- No fill here so background stays transparent -->
                                <!-- Background stays transparent -->
                            </g>
                            <g transform="translate(1850 2891) rotate(180)">
                                <path d="M0,0H48V48H0Z" fill="none"/>
                                <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#787573"/>
                            </g>
                        </g>
                    </svg>

                    <!-- Hover background + arrow -->
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65"
                        class="w-full h-full absolute inset-0 transition-opacity duration-300 opacity-0 group-hover:opacity-100 z-0">
                        <g transform="translate(-1792 -1964.999)">
                            <!-- Inner fill background -->
                            <circle cx="32.5" cy="32.5" r="32.5"
                                    transform="translate(1857 2029.999) rotate(180)"
                                    fill="#bba89c"/>
                            <g transform="translate(1848 2021.999) rotate(180)">
                                <path d="M0,0H48V48H0Z" fill="none"/>
                                <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#f9f5ed"/>
                            </g>
                        </g>
                    </svg>
                </a>


            
            <?php else : ?>
                <div class="text-center text-gray-500/30  text-[24px]">
                    <p>Ahh, No more contents ahead. Stay tuned for new content!</p>
                </div>
            <?php endif; ?>
        </div>

        </div>
    </div>

</main>

<?php get_footer(); 



// if ($total_pages > 1) {
//     echo '<div class="flex space-x-2">';
//     for ($i = $start_page; $i <= $end_page; $i++) {
//         $is_active = ($i == $current_page) ? 'text-mill-red border-[1px] border-[#E2D6C5] text-[17px] sm:text-[32px]' : 'text-[#E2D6C5]';
//         $post_index = ($i - 1) * $posts_per_page;
//         if (isset($posts[$post_index])) {
//             $post_link = get_permalink($posts[$post_index]->ID);
//             echo '<a href="' . esc_url($post_link) . '" class="w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] text-[17px] sm:text-[32px]  rounded-full ' . $is_active . ' flex items-center justify-center transition-colors duration-300">' . $i . '</a>';
//         }
//     }
//     echo '</div>';
// }
?>
