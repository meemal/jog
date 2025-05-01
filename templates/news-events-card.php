<div class="news-card rounded-[40px] border-[1px] border-mill-smoke-light lg:h-auto flex flex-col sm:flex-row-reverse items-center md:justify-start md:flex-col
            md:h-auto px-[23px]  lg:px-[42px] pt-[32px] lg:pt-[53px]">

    <!-- Featured Image -->
    <?php if (has_post_thumbnail()) : ?>
        <img src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>" class="md:h-[266px] md:w-full w-full sm:w-[155px] max-h-[266px] sm:h-[142px] rounded-[5px] object-cover mb-[40px]">
        <?php else: ?>
            <div class="hidden sm:flex md:hidden justify-end mt-10">
            <a href="<?php the_permalink(); ?>" class="block">
                <button class="group arrow-button flex items-center justify-center w-[60px] h-[60px] rounded-full transition-colors duration-300 hover:bg-mill-blue">
                    <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 65 65">
                        <g id="Group_58" data-name="Group 58" transform="translate(-1793 -2835)">
                            <!-- Border Circle -->
                            <g id="Ellipse_12" data-name="Ellipse 12" transform="translate(1793 2835)" fill="none" stroke="#787573" stroke-width="3">
                                <circle cx="32.5" cy="32.5" r="32.5" stroke="none"/>
                                <circle cx="32.5" cy="32.5" r="31" fill="none"/>
                            </g>

                            <!-- Arrow -->
                            <g id="Group_56" data-name="Group 56" transform="translate(1850 2891) rotate(180)">
                                <path id="Path_37" d="M0,0H48V48H0Z" fill="none"/>
                                <path id="Path_38"
                                    d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                    class="transition-colors duration-300 fill-mill-smoke group-hover:fill-white" />
                            </g>
                        </g>
                    </svg>
                </button>
            </a>

            </div>
        <?php endif; ?>


    <!-- Content -->
    <div class="flex flex-col h-full w-full">
        <!-- Post Title -->
        <h3 class="text-mill-warm-grey text-[40px] lg:text-[60px] font-artz leading-[40px] lg:leading-[55px] mb-6">
            <a href="<?php the_permalink(); ?>" class="hover:text-mill-red"><?php the_title(); ?></a>
        </h3>

        <!-- Post Excerpt -->
        <p class="text-mill-warm-grey max-w-[472px] md:max-w-full mb-[25px]  font-hwt_light md:text-[29px] text-[22px] leading-[32px] md:leading-[42px]">
            <?php echo wp_trim_words(get_the_excerpt(), 17, '...'); ?>
        </p>

        <!-- Read More Button (Pushed to Bottom) -->
        <div class="flex ssm:flex md:flex justify-end sm:hidden mt-auto mb-[33px]">
        <a href="<?php the_permalink(); ?>" class="block">
            <button class="group arrow-button flex items-center justify-center w-[65px] h-[65px] rounded-full transition-colors duration-300 hover:bg-mill-blue">
                <svg xmlns="http://www.w3.org/2000/svg" width="65" height="65" viewBox="0 0 65 65">
                    <g id="Group_58" data-name="Group 58" transform="translate(-1793 -2835)">
                        <!-- Border Circle -->
                        <g id="Ellipse_12" data-name="Ellipse 12" transform="translate(1793 2835)" fill="none" stroke="#787573" stroke-width="3">
                            <circle cx="32.5" cy="32.5" r="32.5" stroke="none"/>
                            <circle cx="32.5" cy="32.5" r="31" fill="none"/>
                        </g>
                        
                        <!-- Arrow -->
                        <g id="Group_56" data-name="Group 56" transform="translate(1850 2891) rotate(180)">
                            <path id="Path_37" data-name="Path 37" d="M0,0H48V48H0Z" fill="none"/>
                            <path id="Path_38"
                                d="M40,22H15.66L26.83,10.83,24,8,8,24,24,40l2.83-2.83L15.66,26H40Z"
                                class="transition-colors duration-300 fill-mill-smoke group-hover:fill-white"/>
                        </g>
                    </g>
                </svg>
            </button>
        </a>

        </div>
    </div>

</div>