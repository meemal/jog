<?php
/**
 * Template Name: Home Page
 * Description: A custom home page template for the John Mill theme.
 */

get_header();

// Ensure Global Post Variable
global $post;
$post_id = get_option('page_on_front'); // Fetch Static Front Page ID

// Fetching Meta Data
$hero_enabled = get_post_meta($post_id, '_hero_enabled', true);
$journey_enabled = get_post_meta($post_id, '_journey_enabled', true);
$stay_enabled = get_post_meta($post_id, '_stay_enabled', true);

$hero_title = get_post_meta($post_id, '_hero_title', true);
$hero_image = get_post_meta($post_id, '_hero_image', true);
$journey_title = get_post_meta($post_id, '_journey_title', true);
$journey_desc = get_post_meta($post_id, '_journey_desc', true);
$stay_title = get_post_meta($post_id, '_stay_title', true);
$stay_desc = get_post_meta($post_id, '_stay_desc', true);
$stay_image = get_post_meta($post_id, '_stay_image', true);
?>

<?php if ($hero_enabled) : ?>
<!-- Hero Section -->
<section class="relative mt-[-108px] lg:mt-[-70px] z-10 h-[563px] lg:h-[120vh]">
<div 
  style="background-image: url('<?php echo esc_url($hero_image); ?>');"
  class="absolute inset-0 bg-center bg-no-repeat bg-cover w-full h-full"
></div>



    <!-- <div style="background-image: url('<?php //echo esc_url($hero_image); ?>');" class="absolute inset-0 bg-cover object-contain bg-center py-[100px]"></div> -->
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="relative h-full flex justify-start items-center md:justify-end container px-11 pt-[150px] lg:pt-0 ">
        <h1 class="font-artz text-white text-[25px] sm:text-[40px] lg:text-[60px] relative ml-0 w-full sm:max-w-[480px] md:max-w-[721px] lg:ml-[14rem] mr-[140px]  text-left after:content-[''] after:absolute after:bottom-[-50px] after:left-0 after:w-[110px] after:h-[4px] after:bg-white leading-[25px] sm:leading-[40px] lg:leading-[55px]">
            <?php echo esc_html($hero_title); ?>
        </h1>
    </div>
</section>
<?php endif; ?>

<?php if ($journey_enabled) : ?>
    <!-- Follow Our Journey Section -->
    <section class="bg-[#B0B2B4]  text-white pt-[55px] md:pt-[50px]  rounded-t-[30px] relative mt-[-30px] lg:mt-[-160px] z-[30]">

        <div class="container flex justify-start items-center ssm:items-end gap-[1rem] flex-col ">
            <div class="text-center ssm:text-left">
                <h2 class="text-[40px] md:text-[60px] font-artz mb-[7px] md:mb-[29px]"><?php echo esc_html($journey_title); ?></h2>
                <p class="text-[22px] leading-[32px] mr-0 md:text-[28px] md:mb-[30px] md:leading-[42px] xl:mr-[250px]  "><?php echo esc_html($journey_desc); ?></p>
            </div>

            <?php
                $journey_url = get_post_meta(get_the_ID(), '_journey_url', true);
                if (!empty($journey_url)) :
                ?>
                <div class=" pb-[75px] flex items-end">
                    <!-- Arrow Icon (Displayed only if Journey URL exists) -->
                    <a href="<?php echo esc_url($journey_url); ?>" class="group ml-auto mt-[11px] md:mt-0 lg:mt-[-70px] block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65"
                            class="transition-colors duration-300">
                            <g id="Group_62" data-name="Group 62" transform="translate(-59 -2051)">
                                <!-- Circle background with hover -->
                                <circle id="Ellipse_8" data-name="Ellipse 8" cx="32.5" cy="32.5" r="32.5"
                                        transform="translate(59 2051)"
                                        class="fill-[#939393] group-hover:fill-[#727070] transition-colors duration-300" />
                                
                                <!-- White Arrow -->
                                <g id="Group_52" data-name="Group 52" transform="translate(116 2107) rotate(180)">
                                    <path d="M0,0H48V48H0Z" fill="none"/>
                                    <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#fff"/>
                                </g>
                            </g>
                        </svg>
                    </a>

                </div>
                <?php endif; ?>

        </div>
    </section>
    

<?php endif; ?>

<?php if ($stay_enabled) : ?>
    <!-- Stay With Us Section -->
    <section class="bg-[#6899BF] rounded-t-[30px] mt-[-25px] pb-[66px] lg:pb-0 z-[30] rounded-b-[30px] relative">
        <div class="container flex items-start gap-[30.5px] lg:gap-[148px] relative lg:flex-row flex-col lg:pt-[52px] pb-[64px] py-20 pt-[4rem]">
            <div class="w-full  mb-2 lg:mb-24 text-center ssm:text-left">
                <h2 class="text-white text-[60px] md:text-[60px] font-artz mb-[11px] md:mb-[23px]"><?php echo esc_html($stay_title); ?></h2>
                <p class="text-[#ffffff] text-[22px] md:text-[28px] leading-[31px] md:leading-[42px]"><?php echo esc_html($stay_desc); ?></p>
            </div>
            <div class="w-full h-full mb-12 mr-2 lg:mb-0  ">
                <img src="<?php echo esc_url($stay_image); ?>" alt="Community" class="rounded-lg  object-cover">
            </div>

            <!-- Arrow Icon (Static Image) -->
            <?php
                $stay_url = get_post_meta(get_the_ID(), '_stay_url', true);
                if (!empty($stay_url)) :
                ?>
                <a href="<?php echo esc_url($stay_url); ?>"
                    class="group mt-[64.8px] absolute bottom-0 lg:bottom-[64px] right-[41px] lg:left-[53px]">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            width="65" height="65" viewBox="0 0 65 65"
                            class="transition-colors duration-300">
                            <g id="Group_60" data-name="Group 60" transform="translate(-59 -2051)">
                                <!-- Circle background with hover color -->
                                <circle id="Ellipse_8" data-name="Ellipse 8" cx="32.5" cy="32.5" r="32.5"
                                        transform="translate(59 2051)"
                                        class="fill-[#4b7ea5] group-hover:fill-[#386180] transition-colors duration-300"/>
                                
                                <!-- White Arrow -->
                                <g id="Group_52" data-name="Group 52" transform="translate(116 2107) rotate(180)">
                                    <path d="M0,0H48V48H0Z" fill="none"/>
                                    <path d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                        fill="#fff"/>
                                </g>
                            </g>
                        </svg>
                    </a>

                <?php endif; ?>

        </div>
    </section>

<?php endif; ?>

<!-- News and Events Section -->
<section class="bg-[#f9f5ed] pt-[54px] pb-[85px] lg:pb-[224px]">
    <div class="px-[20px]">
        <h2 class="container text-[40px] md:text-[60px] font-artz mb-[49px] md:mb-[40px] text-[#474341]">NEWS AND EVENTS</h2>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4  ">
            <?php
            $event_query = new WP_Query(array(
                'post_type'      => 'post',
                'posts_per_page' => 3,
                'post_status'    => 'publish'
            ));
            if ($event_query->have_posts()) :
                while ($event_query->have_posts()) : $event_query->the_post(); ?>
                    <div class="bg-transparent border-[1px] border-[#b0b2b4] h-auto pt-[20px] lg:pt-[49px] px-[22px] lg:px-[40px] rounded-[40px] hover:shadow-lg transition-all duration-300 relative">
                        <span class="text-[22px] leading-[30px] text-[#474341] "><?php echo get_the_category_list(', '); ?></span>
                        <h3 class="text-[40px] leading-[55px] text-[#474341] md:text-[60px] font-artz mt-[10px] mb-4 "><?php the_title(); ?></h3>
                        <p class="text-[#474341] pb-[32px] lg:pb-[111px]  text-[22px] max-w-[420px] sm:max-w-[520px] md:max-w-full mb-[35px] md:text-[29px] leading-[32px] lg:leading-[42px]  md:mb-[119px]"><?php echo wp_trim_words(get_the_excerpt(), 17); ?></p>
                        <a href="<?php the_permalink(); ?>" class="group w-[40px] sm:w-[65px] h-[40px] sm:h-[65px] mt-4 bg-transparent rounded-full absolute right-8 bottom-[32px] lg:bottom-0 lg:mb-[44px] flex items-center justify-center transition-colors duration-300 hover:bg-mill-blue">
                                
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 65 65" class="w-full h-full">
                                    <g id="Group_58" data-name="Group 58" transform="translate(-1793 -2835)">
                                        <!-- Circle border -->
                                        <g id="Ellipse_12" data-name="Ellipse 12" transform="translate(1793 2835)" fill="none" stroke="#787573" stroke-width="3">
                                            <circle cx="32.5" cy="32.5" r="32.5" stroke="none"></circle>
                                            <circle cx="32.5" cy="32.5" r="31" fill="none"></circle>
                                        </g>
                                        
                                        <!-- Arrow -->
                                        <g id="Group_56" data-name="Group 56" transform="translate(1850 2891) rotate(180)">
                                            <path id="Path_37" d="M0,0H48V48H0Z" fill="none"></path>
                                            <path id="Path_38" d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" class="transition-colors duration-300 fill-[#787573] group-hover:fill-white"></path>
                                        </g>
                                    </g>
                                </svg>
                            </a>

                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p class="text-gray-600">No recent events found.</p>
            <?php endif; ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>
