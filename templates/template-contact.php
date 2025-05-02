<?php
/*
Template Name: Contact Page
*/

get_header();
?>


<div class=" pt-[130px] lg:pt-[230px]">
    <div class="container">
        <div class="w-auto lg:max-w-[1306px] mb-[74px] md:mb-[114px] text-center ssm:text-left">
            <h1 class="text-mill-red font-artz text-[60px] lg:text-[120px] leading-[55px] mb-[65px] md:mb-[100px] "><?php the_title(); ?></h1>
            <div class="text-mill-warm-grey font-artz text-[40px] lg:text-[42px]  leading-[40px] ">

                <?php the_excerpt();  ?>
            </div>      
            <div class="m-10">
                <?= the_content() ?>
            </div>
        </div>




    </div>
 </div>

<?php get_footer(); ?>
