<?php
/*
Template Name: Visit Us
*/

get_header();

$visit_us_title = get_post_meta(get_the_ID(), 'visit_us_title', true);
$visit_us_map = get_post_meta(get_the_ID(), 'visit_us_map', true);

if (isset($what_3_words)){
    $what_3_words_link = "https://what3words.com/".strtolower(str_replace('///', '', $what_3_words));
}

?>
<section class="text-center ssm:text-left">
    <div class="px-4  sm:container pt-[60px] sm:pt-[100px] lg:pt-[180px]">
        <!-- Dynamic Page Title -->
        <h1 class="text-mill-red text-[40px] sm:text-[60px] lg:text-[120px] font-artz mb-[20px] sm:mb-[40px]"><?php the_title(); ?></h1>

        <!-- Dynamic Page Content -->
        <div class="text-mill-warm-grey font-artz text-[25px] sm:text-[40px] lg:text-[42px] w-full lg:max-w-[1306px] leading-[30px] sm:leading-[40px]">
            <?php the_content(); ?>
        </div>
    </div>



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

</section>



<!-- https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.8354345093747!2d144.9537353153166!3d-37.81627974202105!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf577d2d2f2c12b9e!2sFlinders%20St%2C%20Melbourne%20VIC%203000%2C%20Australia!5e0!3m2!1sen!2sus!4v1625075000000!5m2!1sen!2sus -->

<?php get_footer(); ?>
