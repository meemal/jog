<?php
/*
Template Name: Tabbed Content Page
*/
get_header();
$page_id = get_the_ID();
?>

<main class="bg-warm-oatmeal-light pt-[135px] lg:pt-[225px] pb-4">
    <div class="container text-center ssm:text-left">
        <h1 class=" text-mill-red font-artz text-[60px] md:text-[120px] leading-[55px] mb-[45px] md:mb-[100px] ">
            <?php the_title(); ?>
        </h1>

        <div class="text-mill-warm-grey font-artz text-[40px] md:text-[42px] leading-[40px] max-w-[90rem] mb-[73px] lg:mb-[120px]">
            <?php if (have_posts()) : the_post(); the_excerpt(); endif; ?>
        </div>

        <div class="my-10">
            <?php the_content(); ?>
        </div>

        <?php if (have_rows('tabbed_content')) :
            $tab_id_base = uniqid('tab_');
            $index = 0;
            $filtered_tabs = [];

            while (have_rows('tabbed_content')) : the_row();
                $tab_name = get_sub_field('tab_name');
                $tab_content = get_sub_field('tab_content');
                $tab_image = get_sub_field('tab_image');

                if (!empty($tab_content) || !empty($tab_image)) {
                    $filtered_tabs[] = [
                        'id' => $tab_id_base . '_' . $index,
                        'name' => $tab_name,
                        'content' => $tab_content,
                        'image' => $tab_image,
                    ];
                }
                $index++;
            endwhile;
            
?>
          
          <?php if (!empty($filtered_tabs)) : 

                $first_tab_id = $filtered_tabs[0]['id']; ?>
                <a id="tab-section" class="block relative -top-[100px]"></a>
                <div class="border-b border--mill-peach-light mb-[62px] lg:mb-[61px]">
                    <nav class="flex flex-col sm:flex-row">
                        <?php foreach ($filtered_tabs as $tab) : ?>
                            <button data-tab="<?php echo esc_attr($tab['id']); ?>" 
                                class="tab-button text-[28px] font-artz pb-[30px] lg:pb-[39.5px] relative px-[36px]
                                sm:after:content-[''] sm:after:absolute sm:after:w-[4px] sm:after:h-[25px] sm:after:rounded-lg 
                                sm:after:top-3 sm:after:right-0 sm:last:after:hidden
                                <?php echo ($tab['id'] === $first_tab_id) 
                                    ? 'bg-white text-mill-red border-b-[4px] border-mill-red' 
                                    : ' text-dark-grey hover:text-mill-red-high'; ?>"
                                <?php echo ($tab['id'] === $first_tab_id) ? ' data-initial-tab="true"' : ''; ?>>
                                <?php echo esc_html($tab['name']); ?>
                            </button>
                        <?php endforeach; ?>
                    </nav>
                </div>

                <div>
                    <?php foreach ($filtered_tabs as $tab) :
                        $tab_image_url = $tab['image']['sizes']['medium'] ?? '';
                        $tab_image_alt = $tab['image']['alt'] ?? $tab['name'];
                    ?>
                        <div id="<?php echo esc_attr($tab['id']); ?>"
     class="tab-content grid gap-0 sm:gap-[51px] lg:gap-[73px] <?php echo empty($tab_image_url) ? 'grid-cols-1' : 'lg:grid-cols-2'; ?> <?php echo ($tab['id'] === $first_tab_id) ? '' : 'hidden'; ?>">

                            <!-- Content First on Mobile, Second on Desktop -->
                            <div class="content space-y-6 text-[22px] max-h-full lg:max-h-[750px] lg:overflow-auto leading-[32px] lg:text-[28px] lg:leading-[38px] text-dark-grey font-brother font-normal 
                                order-1 lg:order-2 mt-[-27px] <?php echo empty($tab_image_url) ? 'lg:col-span-2 lg:px-[calc((100%-90rem)/2+36px)]' : ''; ?>">
                                <p><?php echo wp_kses_post($tab['content']); ?></p>
                            </div>

                            <!-- Image Second on Mobile, First on Desktop -->
                            <?php if (!empty($tab_image_url)) : ?>
                                <div class="order-2 lg:order-1">
                                    <img src="<?php echo esc_url($tab_image_url); ?>" 
                                        alt="<?php echo esc_attr($tab_image_alt); ?>" 
                                        class="w-full h-auto sm:h-[544px] lg:h-[685px] rounded-[30px] object-fill sm:object-cover">
                                </div>
            
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>

        <?php else : ?>
            <p class="text-gray-600">No tabbed content available.</p>
        <?php endif; endif; ?>
    </div>
</main>

<section class="bg-[#FCF9F2] pt-[71px] pb-[70px] rounded-t-[30px]">
    <div class="container">
        <div class="flex justify-between items-center">
            <div>
                <p class="font-normal text-[22px] text-mill-warm-grey">Next</p>
                <p class="text-[40px] sm:text-[60px] font-bold text-dark-grey font-artz hover:text-mill-red next-text">VISION</p>
            </div>
            <a href="#tab-section" class="group w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] font-bold rounded-full border-[3px] border-gray-500 flex items-center justify-center mt-4 nextBtn">
                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" class="w-full h-full">
                    <g transform="translate(-1793 -2835)">
                        <circle cx="32.5" cy="32.5" r="32.5" transform="translate(1793 2835)"
                                class="fill-transparent transition-colors duration-300 group-hover:fill-[#bba89c]" />
                        <g transform="translate(1850 2891) rotate(180)">
                            <path d="M0,0H48V48H0Z" fill="none" />
                            <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                  class="fill-mill-smoke transition-colors duration-300 group-hover:fill-white" />
                        </g>
                    </g>
                </svg>
            </a>
        </div>
    </div>
</section>

<?php if (get_field('show_map')) : ?>
    <!-- Map Section -->
    <div class=" w-full h-[518px] lg:h-[1152px] relative mb-[200px] sm:mb-[782.6px] lg:mb-[350px]">
        <div class="px-4 sm:container mt-[20px] sm:mt-[40px] mb-[20px] sm:mb-[50px]">
            <?php if (!empty($final_link)) { ?>
                <div class="px-4 sm:container mt-[20px] sm:mt-[40px] mb-[20px] sm:mb-[50px]">
        
                    <a href="<?php echo esc_url($what_3_words_link); ?>" target="_blank"
            class="text-mill-red font-artz text-[30px] sm:text-[42px] hover:underline transition-all duration-300">
                        <?php echo esc_html($what_3_words); ?> 
                    </a>
                </div>
            <?php }; ?>
        </div>


        <div class="px-4 sm:px-[43px] md:px-[20px]">
            <iframe
                class="rounded-[40px] overflow-hidden w-full"
                src="<?php echo esc_url(get_post_meta(get_the_ID(), 'visit_us_map', true)); ?>"
                style="
                    border: 0;
                    height: 518px;
                "
                allowfullscreen=""
                loading="lazy">
            </iframe>

            <!-- <iframe
                class="rounded-[40px] overflow-hidden "
                src="<?php //echo esc_url(get_post_meta(get_the_ID(), 'visit_us_map', true)); ?>"
                width="100%"
                height="1152"
                style="border:0;"
                allowfullscreen=""
                loading="lazy">
            </iframe> -->
        </div>
    </div>

    <style>
        @media (min-width: 1024px) {
            iframe {
            height: 1152px !important;
            }
        }
    </style>
<?php endif; ?>


<?php get_footer(); ?>
