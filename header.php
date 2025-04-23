<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <!-- Character Encoding -->
    <meta charset="<?php bloginfo('charset'); ?>">

    <!-- Viewport for Responsive Design -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Dynamic and SEO-Friendly Title -->
    <title><?php wp_title('|', true, 'right'); ?><?php bloginfo('name'); ?></title>

    <!-- Description for SEO -->
    <meta name="description" content="<?php bloginfo('description'); ?>">

    <!-- DNS Prefetching for External Resources -->
    <link rel="dns-prefetch" href="//fonts.googleapis.com">

    <!-- Preconnect for Faster Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Favicon for Browser Tabs -->
    <link rel="icon" href="<?php echo get_site_icon_url(); ?>" sizes="32x32" />

    <!-- Profile and Pingback for Legacy Support -->
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body class="font-light font-brother bg-[#F9F5ED]" <?php body_class(); ?>>

    <!-- Header/Navigation -->
<header class="w-full container relative bg-[#FFFFFF] z-50 rounded-b-[40px]">
    <nav class=" pt-[35.8px] pb-[37.8px] md:pt-[30px] md:pb-[51px] flex justify-between  items-center">
        <!-- Dynamic Logo -->
        <div class="flex max-w-[250px] md:max-w-[366.02px]  lg:max-w-full items-center">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" class=" h-auto object-fill" alt="<?php bloginfo('name'); ?>">
                <?php endif; ?>
            </a>
        </div>

        <!-- Navigation Menu -->
        <div class="custom-show-div hidden">
    <?php
    // wp_nav_menu(array(
    //     'theme_location' => 'primary',
    //     'container'      => false,
    //     'menu_class'     => 'flex text-[28px] text-[#B0B2B4] list-none overflow-y-auto',
    //     'fallback_cb'    => false,
    //     'walker'         => new Custom_Walker_Nav_Menu() // Custom Walker Added
    // ));
    ?>

    <div class="  whitespace-nowrap  flex pt-[13px]">
        <nav class="flex  ">
            <?php
            wp_nav_menu(array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'flex text-[28px] text-[#B0B2B4] list-none font-artz',
                'fallback_cb'    => false,
                'walker'         => new Custom_Walker_Nav_Menu()
            ));
            ?>
        </nav>
    </div>

    
</div>


        <!-- Mobile Menu Button -->
        <button class="custom-hide-btn block" id="threeDot">
            <svg xmlns="http://www.w3.org/2000/svg" width="51.854" height="9.412" viewBox="0 0 55.854 12.412">
                <path id="Path_41" data-name="Path 41" d="M30.927,10a6.206,6.206,0,1,0,6.206,6.206A6.224,6.224,0,0,0,30.927,10ZM9.206,10a6.206,6.206,0,1,0,6.206,6.206A6.224,6.224,0,0,0,9.206,10Zm43.442,0a6.206,6.206,0,1,0,6.206,6.206A6.224,6.224,0,0,0,52.648,10Z" transform="translate(-3 -10)" fill="#9a0f1e"/>
            </svg>
        </button>


        <!-- Mobile Menu -->
        <div class="bg-[#B81E26] text-white h-[100vh] fixed top-0 bottom-0 left-0 right-0 -translate-x-full transition-all duration-600 opacity-0" id="mobileMenu">
            <div class="flex justify-between items-center container py-5">
                <div class="flex-shrink-0">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php 
                        $mobile_logo = get_theme_mod('john_mill_mobile_logo'); 
                        if ($mobile_logo) : ?>
                            <img src="<?php echo esc_url($mobile_logo); ?>" class="w-[200px] md:w-[250px] h-auto object-fill" alt="<?php bloginfo('name'); ?>">
                        <?php elseif (has_custom_logo()) : ?>
                            <?php the_custom_logo(); ?>
                        <?php else : ?>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/logowhite.svg" class="w-[200px] md:w-[250px] h-auto object-fill" alt="<?php bloginfo('name'); ?>">
                        <?php endif; ?>
                    </a>
                </div>

                <button id="closeMobileMenu" class="text-white text-[16px] font-normal w-10 h-10 rounded-full flex justify-center items-center">
                    <svg id="Group_108" data-name="Group 108" xmlns="http://www.w3.org/2000/svg" width="54.248" height="54.248" viewBox="0 0 54.248 54.248">
                        <path id="Path_52" data-name="Path 52" d="M41.644,13.2l-3.2-3.2L25.822,22.624,13.2,10,10,13.2,22.624,25.822,10,38.446l3.2,3.2L25.822,29.021,38.446,41.644l3.2-3.2L29.021,25.822Z" transform="translate(1.302 1.302)" fill="#fff"/>
                        <path id="Path_53" data-name="Path 53" d="M0,0H54.248V54.248H0Z" fill="none"/>
                    </svg>

                 </button>

            </div>



            <!-- Mobile Navigation (Only Main Menu) -->
            <ul class="flex flex-col text-white list-none mt-5 pt-5">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'items_wrap'     => '%3$s', // Ensures proper list structure
                    'fallback_cb'    => false,
                    'walker'         => new class extends Walker_Nav_Menu {
                        function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
                            if ($depth === 0) { // Only display top-level menu items
                                $output .= '<li class="border-t border-[#FFFFFF] last:border-b">'; // Applies border to all items
                                $output .= '<a href="' . esc_url($item->url) . '" class="hover:text-black transition-all duration-500 py-4 px-5 text-[30px] text-[#FFFFFF] flex  justify-between items-center font-artz">';
                                $output .= esc_html($item->title);

                                // Add arrow icon
                                $output .= '<span class="ml-auto"> 
                                <div class="bg-gray-900/20 rounded-full p-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48">
                                        <g id="Group_52" data-name="Group 52" transform="translate(48 48) rotate(180)">
                                            <path id="Path_37" data-name="Path 37" d="M0,0H48V48H0Z" fill="none"/>
                                            <path id="Path_38" data-name="Path 38" d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z" fill="#fff"/>
                                        </g>
                                    </svg>
                                </div>
                                            </span>';

                                $output .= '</a></li>';
                            }
                        }
                    }
                ));
                ?>
            </ul>
        </div>
    </nav>
</header>



