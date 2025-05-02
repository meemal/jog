<?php
/*
Template Name: Journey Page
*/
get_header();
$page_id = get_the_ID();
$tabs = get_post_meta($page_id, 'journey_tabs', true); // Fetch tabs from meta
$first_tab_key = array_key_first($tabs); // Get first tab key dynamically
?>

<main class="bg-warm-oatmeal-light pt-[135px] lg:pt-[225px] pb-[94px] lg:pb-[290px]">
    <div class="container text-center ssm:text-left">
        <h1 class=" text-mill-red font-artz text-[60px] md:text-[120px] leading-[55px] mb-[45px] md:mb-[100px] "><?php the_title(); ?></h1>

        <div class=" text-mill-warm-grey font-artz text-[40px] md:text-[42px] leading-[40px] max-w-[90rem] mb-[73px] lg:mb-[120px]">
        <?php while (have_posts()) : the_post(); the_excerpt(); endwhile; ?>
            </div>
            <div class="my-10">
                <?= the_content() ?>
            </div>

        <?php
        if (!empty($tabs) && is_array($tabs)) :
            // Filter out tabs with no content or image
            $filtered_tabs = [];
            foreach ($tabs as $tab_id => $tab_name) {
                $tab_content = get_post_meta($page_id, "journey_tab_content_" . sanitize_key($tab_id), true);
                $tab_image = get_post_meta($page_id, "journey_tab_image_" . sanitize_key($tab_id), true);

                if (!empty($tab_content) || !empty($tab_image)) {
                    $filtered_tabs[$tab_id] = $tab_name;
                }
            }

            // If there are valid tabs, display them
            if (!empty($filtered_tabs)) :
                $first_tab_key = array_key_first($filtered_tabs);
        ?>
                <div class="border-b border--mill-peach-light mb-[62px] lg:mb-[61px]">
                    <nav class="flex flex-col sm:flex-row">
                        <?php foreach ($filtered_tabs as $index => $tab_name) : ?>
                            <button data-tab="tab-<?php echo esc_attr($index); ?>" 
                                    class="tab-button text-[28px] text-dark-grey font-artz hover:text-mill-red-high pb-[30px] lg:pb-[39.5px]
                                        relative px-[36px] 
                                        sm:after:content-[''] sm:after:absolute sm:after:w-[4px] sm:after:h-[25px] sm:after:rounded-lg sm:after:bg-[#E2D6C5] 
                                        sm:after:top-3 sm:after:right-0 sm:last:after:hidden
                                    <?php echo ($index == $first_tab_key) ? 'text-mill-red border-mill-red' : ''; ?>"
                                    <?php echo ($index == $first_tab_key) ? 'data-initial-tab="true"' : ''; ?>>
                                <?php echo esc_html($tab_name); ?>
                            </button>
                        <?php endforeach; ?>
                    </nav>

                </div>

                <div>
                    <?php foreach ($filtered_tabs as $tab_id => $tab_name) :
                        $tab_content = get_post_meta($page_id, "journey_tab_content_" . sanitize_key($tab_id), true);
                        $tab_image = get_post_meta($page_id, "journey_tab_image_" . sanitize_key($tab_id), true);
                    ?>
                        <div id="tab-<?php echo esc_attr($tab_id); ?>" 
                            class="grid lg:grid-cols-2 gap-0 sm:gap-[51px] lg:gap-[73px] tab-content <?php echo ($tab_id == $first_tab_key) ? '' : 'hidden'; ?>">
                            
                            <!-- Content First on Mobile, Second on Desktop -->
                            <div class="space-y-6 text-[22px] max-h-full lg:max-h-[750px] lg:overflow-auto leading-[32px] lg:text-[28px] lg:leading-[38px] text-dark-grey  font-brother font-normal  order-1 lg:order-2 mt-[-27px]">
                                <p><?php echo wp_kses_post($tab_content); ?></p>
                            </div>

                            <!-- Image Second on Mobile, First on Desktop -->
                            <div class="order-2 lg:order-1">
                                <?php if (!empty($tab_image)) : ?>
                                    <img src="<?php echo esc_url($tab_image); ?>" 
                                        alt="<?php echo esc_attr($tab_name); ?>" 
                                        class="w-full h-auto sm:h-[544px] lg:h-[685px] rounded-[30px] object-fill sm:object-cover">
                                <?php endif; ?>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>

        <?php
            endif; // End of checking valid tabs
        else :
        ?>
            <p class="text-gray-600">No journey content found.</p>
        <?php endif; ?>

    </div>
</main>

<section class="bg-[#FCF9F2] pt-[71px] pb-[70px] rounded-t-[30px]">
    <div class="container">
        <div class="flex justify-between items-center">
            <div class="">
                <p class=" font-normal text-[22px] text-mill-warm-grey">Next</p>
                <p class="text-[40px] sm:text-[60px] font-bold text-dark-grey font-artz hover:text-mill-red next-text">VISION</p>
            </div>
            <a href="#"
   class="group w-[40px] h-[40px] sm:w-[65px] sm:h-[65px] font-bold rounded-full border-[3px] border-gray-500 flex items-center justify-center mt-4 nextBtn">
    <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65" class="w-full h-full">
        <g transform="translate(-1793 -2835)">
            <!-- Hover background circle (transparent by default) -->
            <circle cx="32.5" cy="32.5" r="32.5"
                    transform="translate(1793 2835)"
                    class="fill-transparent transition-colors duration-300 group-hover:fill-[#bba89c]" />

            <!-- Arrow -->
            <g transform="translate(1850 2891) rotate(180)">
                <path d="M0,0H48V48H0Z" fill="none" />
                <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                      class="fill-[#787573] transition-colors duration-300 group-hover:fill-white" />
            </g>
        </g>
    </svg>
</a>

        </div>
    </div>
</section>

<?php get_footer(); ?>
