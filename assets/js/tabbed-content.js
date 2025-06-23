jQuery(document).ready(function($) {
    $('.tab-button').on('click', function() {
        var target = $(this).data('tab');

        // Reset all buttons
        $('.tab-button').removeClass('bg-white text-mill-red border-b-[4px] border-mill-red')
                        .addClass('bg-[#F4F1ED] text-dark-grey');

        // Activate current button
        $(this).removeClass('bg-[#F4F1ED] text-dark-grey')
               .addClass('bg-white text-mill-red border-b-[4px] border-mill-red');

        // Hide all content and show selected tab
        $('.tab-content').addClass('hidden');
        $('#' + target).removeClass('hidden');
    });

    $('a[href^="#"]').on('click', function(e) {
        const target = $(this.getAttribute('href'));
        if (target.length) {
            e.preventDefault();
            $('html, body').animate({
                scrollTop: target.offset().top
            }, 600);
        }
    });
});