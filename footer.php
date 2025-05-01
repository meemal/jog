<!-- Footer -->
<footer class="bg-[#FFFFFF] pt-[71px] pb-[39px] md:pt-[85px] md:pb-[60px] rounded-t-[30px] mt-[-25px]">
    <div class="container  px-[3rem] text-sm lg:text-md text-[16px]"> <!-- Reduced text size -->
        <div class="flex flex-col lg:flex-row lg:justify-between items-start">
            <div class="flex flex-col sm:flex-row gap-[30px] lg:gap-12">
                <!-- Logo & Contact Info -->
                <div class="flex justify-start items-start gap-4 lg:gap-0 lg:items-center">
                    <!-- Dynamic Logo (Fixed Size) -->
                    <?php 
                    $footer_logo = get_theme_mod('john_mill_footer_logo');
                    if ($footer_logo) {
                        echo '<a href="'.home_url().'" class="">
                            <img src="' . esc_url($footer_logo) . '" class="w-[150px] md:w-[150px] h-auto object-contain" alt="Logo"> 
                        </a>';
                    }
                    ?>
                </div>

                <!-- Dynamic Footer Menu -->
                <div class="w-full">
                    <div class="block lg:hidden mb-6">
                        <div class="flex flex-col gap-2">
                            <!-- <div class="space-y-2">
                                <div class=" w-[346px] text-left font-artz text-gray-400 text-[28px] leading-[27px]"> 
                                    <p>THE JOHN O'GROATS MILL TRUST IS A NOT-FOR-PROFIT ORGANISATION</p>
                                    <p class="text-left mt-1 font-artz">
                                        <a href="mailto:<?php // echo antispambot(get_option('john_mill_footer_email', 'groatsmill@gmail.com')); ?>" class="text-mill-red">
                                            <?php // echo antispambot(get_option('john_mill_footer_email', 'groatsmill@gmail.com')); ?>
                                        </a>
                                    </p>
                                </div>
                            </div> -->

                            <div class="space-y-2">
                                <div class="w-[346px] text-left font-artz text-gray-400 text-[28px] leading-[27px]">
                                    <p>THE JOHN O'GROATS MILL TRUST IS A NOT-FOR-PROFIT ORGANISATION</p>
                                    <p class="text-left mt-1 font-artz">
                                        <?php
                                        $contact_url = get_contact_page_url_by_template_name(); // use the same helper function
                                        $email = get_option('john_mill_footer_email', 'groatsmill@gmail.com');
                                        ?>
                                        <?php if ($contact_url && $email) : ?>
                                            <a href="<?php echo esc_url($contact_url); ?>" title="Contact John O Groat Mill"  class="text-mill-red hover:to-mill-red-high">
                                                Contact Us
                                            </a>
                                        <?php endif; ?>
                                    
                                    </p>
                                </div>
                            </div>


                            <!-- Social Icons -->
                            <div class="flex justify-start items-start gap-3 mt-[32px] mb-[20px]">
                                <?php 
                                $instagram = get_option('john_mill_footer_instagram', '');
                                $facebook  = get_option('john_mill_footer_facebook', '');
                                ?>

                                <?php if (!empty($instagram)) : ?>
                                    <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="relative group block w-[45px] h-[45px] mt-[-2px]">
                                        <span class="absolute top-1/2 left-1/2 w-[40px] h-[40px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-mill-red opacity-0 group-hover:opacity-100 transition-all duration-300 z-0"></span>
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.png" class="w-[45px] h-[45px] object-contain relative z-10" alt="Instagram">
                                    </a>
                                <?php endif; ?>

                                <?php if (!empty($facebook)) : ?>
                                    <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="relative group block w-[40px] h-[40px]">
                                        <!-- Hover background circle (smaller than the image) -->
                                        <span class="absolute top-1/2 left-1/2 w-[30px] h-[30px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-mill-red opacity-0 group-hover:opacity-100 transition-all duration-300 z-0"></span>

                                        <!-- Actual image -->
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"
                                            class="w-[40px] h-[40px] object-contain relative z-10"
                                            alt="Facebook">
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>


                    <?php
                    if (has_nav_menu('footer')) {
                        $menu_items = wp_get_nav_menu_items(get_nav_menu_locations()['footer']);
                        
                        if ($menu_items) {
                            $total_items = count($menu_items);
                            $split = ($total_items > 3) ? ceil($total_items / 2) : $total_items; // Split dynamically

                            $menu_sections = array_chunk($menu_items, $split);

                            echo '<div class="flex flex-col mr-8 gap-4 lg:flex-row lg:gap-[105px] ">';
                            foreach ($menu_sections as $menu_section) {
                                echo '<div class="flex text-[#b0b2b4] font-artz flex-col space-y-[14px] ">'; // Adjusted text color & font weight
                                foreach ($menu_section as $menu_item) {
                                    echo '<a href="' . esc_url($menu_item->url) . '" class="text-[24px] text-[#b0b2b4] leading-[27px] hover:text-mill-red">' . esc_html($menu_item->title) . '</a>';
                                }
                                echo '</div>';
                            }
                            echo '</div>';
                        }
                    }
                    ?>
                </div>
            </div>
            
            


            <!-- Footer Right: Organization Info & Social Links -->
            <div class="hidden lg:flex flex-col lg:flex-row gap-[132.6px]">
                <!-- <div class="space-y-2 lg:block">
                    <div class="text-left text-[28px] leading-[34px] font-artz text-[#b0b2b4]  "> 
                        <p class="mb-2">THE JOHN O'GROATS MILL TRUST IS A NOT-FOR-PROFIT ORGANISATION</p>
                        <p class="text-left font-artz">
                            <a href="mailto:<?php //echo antispambot(get_option('john_mill_footer_email', 'groatsmill@gmail.com')); ?>" class="text-mill-red text-[28px] leading-[34px]">
                            <?php //echo antispambot(get_option('john_mill_footer_email', 'groatsmill@gmail.com')); ?>
                            </a>
                        </p>
                    </div>
                </div> -->
                
                <div class="space-y-2 lg:block">
                    <div class="text-left text-[22px] leading-[34px] font-artz text-[#b0b2b4]">
                        <p class="mb-2">THE JOHN O'GROATS MILL TRUST IS A NOT-FOR-PROFIT ORGANISATION</p>
                        <p class="text-left font-artz">
                            <?php
                            $contact_url = get_contact_page_url_by_template_name();
                            $email = get_option('john_mill_footer_email', 'groatsmill@gmail.com');
                            ?>
                            <?php if ($contact_url && $email) : ?>
                                <a href="<?php echo esc_url($contact_url); ?>" title="Contact John O Groat Mill"  class="text-mill-red hover:text-mill-red-high">
                                                Contact Us
                                           
                                </a>
                            <?php endif; ?>
                        </p>
                    </div>
                </div>


                <!-- Social Icons -->
                <div class="flex justify-end items-start gap-3">
                    <?php 
                    $instagram = get_option('john_mill_footer_instagram', '');
                    $facebook  = get_option('john_mill_footer_facebook', '');
                    ?>

                    <?php if (!empty($instagram)) : ?>
                        <a href="<?php echo esc_url($instagram); ?>" target="_blank" class="relative group block w-[45px] h-[45px] mt-[-2px]">
                            <span class="absolute top-1/2 left-1/2 w-[30px] h-[30px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-mill-red opacity-0 group-hover:opacity-100 transition-all duration-300 z-0"></span>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/instagram.png" class="w-[45px] h-[45px] object-contain relative z-10" alt="Instagram">
                        </a>


                    <?php endif; ?>

                    <?php if (!empty($facebook)) : ?>
                        <a href="<?php echo esc_url($facebook); ?>" target="_blank" class="relative group block w-[40px] h-[40px]">
                            <!-- Hover background circle (smaller than the image) -->
                            <span class="absolute top-1/2 left-1/2 w-[30px] h-[30px] -translate-x-1/2 -translate-y-1/2 rounded-full bg-mill-red opacity-0 group-hover:opacity-100 transition-all duration-300 z-0"></span>

                            <!-- Actual image -->
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/facebook.svg"
                                class="w-[40px] h-[40px] object-contain relative z-10"
                                alt="Facebook">
                        </a>

                    <?php endif; ?>
                </div>
            </div>

        </div>

        <!-- Copyright -->
        <p class="text-[#474341] leading-[21px] text-[16px] mt-[105px] md:mt-[108.2px]"> <!-- Adjusted copyright text size -->
           © <?php echo date("Y"); ?> The John O'Groats Mill Trust. All rights reserved.
        </p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>



