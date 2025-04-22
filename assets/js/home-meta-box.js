jQuery(document).ready(function ($) {
    // Function to toggle meta box visibility based on selected template
    function toggleMetaBox() {
        let template = $('#page_template').val();
        let metaBoxWrapper = $('#john-mill-meta-box').closest('.postbox'); // Target the full meta box wrapper
        let metaBoxContent = $('#john-mill-meta-box'); // Target the actual fields inside

        if (template === 'front-page.php') {
            metaBoxWrapper.slideDown(300);  // Smoothly show the entire meta box
            metaBoxContent.slideDown(300); // Smoothly show the fields inside
        } else {
            metaBoxWrapper.slideUp(300); // Smoothly hide everything
        }
    }

    // Run on page load with animation
    toggleMetaBox();

    // Detect when template changes (without refresh)
    $('#page_template').on('change', function () {
        toggleMetaBox();
    });


    // Detect when template dropdown is added dynamically
    function waitForTemplateDropdown() {
        let templateDropdown = $('#page_template');

        if (templateDropdown.length) {
            toggleMetaBox();
            templateDropdown.on('change', toggleMetaBox);
        } else {
            setTimeout(waitForTemplateDropdown, 500); // Keep checking until available
        }
    }

    waitForTemplateDropdown(); // Ensure function runs when adding a new page

    // Detect post editor changes (for new pages without refresh)
    let observer = new MutationObserver(function (mutations) {
        mutations.forEach(function (mutation) {
            if ($(mutation.target).find('#page_template').length) {
                toggleMetaBox();
            }
        });
    });

    observer.observe(document.body, { childList: true, subtree: true });

    // Function for uploading images and previewing them
    function uploadImage(buttonClass, inputID, previewID) {
        var mediaUploader;
        $(buttonClass).click(function (e) {
            e.preventDefault();

            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            mediaUploader = wp.media({
                title: 'Choose Image',
                button: {
                    text: 'Choose Image'
                },
                multiple: false
            });

            mediaUploader.on('select', function () {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $(inputID).val(attachment.url);
                $(previewID).attr('src', attachment.url).removeClass('hidden').show();
            });

            mediaUploader.open();
        });
    }

    // Apply image upload functionality for Hero images
    uploadImage('.upload-hero-image', '#hero_image', '#hero_image_preview');
    uploadImage('.upload-stay-image', '#stay_image', '#stay_image_preview');
});
