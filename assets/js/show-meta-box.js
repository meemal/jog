jQuery(document).ready(function ($) {

    //.........................................News and Events
    function checkTemplateSelectionNews() {
        let selectedTemplate = $('#page_template').val();
        let metaBoxWrapper = $('#john_mill_news_event_meta').closest('.postbox'); // Full meta box container
        let metaBoxContent = $('#john_mill_news_event_meta'); // Only the fields inside

        if (selectedTemplate === 'templates/template-news-events.php') {
            metaBoxWrapper.slideDown(300); // Show full meta box smoothly
            metaBoxContent.slideDown(300); // Show fields smoothly
        } else {
            metaBoxWrapper.slideUp(300); // Hide the entire box smoothly
        }
    }

    // Run on page load (for existing pages)
    checkTemplateSelectionNews();

    // Detect when the template dropdown changes (for new pages)
    $('#page_template').on('change', function () {
        checkTemplateSelectionNews();
    });

    // Ensure it runs after custom fields and TinyMCE are loaded
    setTimeout(checkTemplateSelectionNews, 1000);


    
    //.........................................Visit Us
    function checkTemplateSelectionVisit() {
        let selectedTemplate = $('#page_template').val();
        let metaBoxWrapper = $('#visit_us_meta_box').closest('.postbox'); // Full meta box container
        let metaBoxContent = $('#visit_us_meta_box'); // Only the fields inside

        if (selectedTemplate === 'templates/template-visit-us.php') {
            metaBoxWrapper.slideDown(300); // Show full meta box smoothly
            metaBoxContent.slideDown(300); // Show fields smoothly
        } else {
            metaBoxWrapper.slideUp(300); // Hide the entire box smoothly
        }
    }

    // Run on page load (for existing pages)
    checkTemplateSelectionVisit();

    // Detect when the template dropdown changes (for new pages)
    $('#page_template').on('change', function () {
        checkTemplateSelectionVisit();
    });

    // Ensure it runs after custom fields and TinyMCE are loaded
    setTimeout(checkTemplateSelectionVisit, 1000);



    //.........................................Contact Us
    function checkTemplateSelectionContact() {
        let selectedTemplate = $('#page_template').val();
        let metaBoxWrapper = $('#contact_page_meta').closest('.postbox'); // Full meta box container
        let metaBoxContent = $('#contact_page_meta'); // Only the fields inside

        if (selectedTemplate === 'templates/template-contact.php') {
            metaBoxWrapper.slideDown(300); // Show full meta box smoothly
            metaBoxContent.slideDown(300); // Show fields smoothly
        } else {
            metaBoxWrapper.slideUp(300); // Hide the entire box smoothly
        }
    }

    // Run on page load (for existing pages)
    checkTemplateSelectionContact();

    // Detect when the template dropdown changes (for new pages)
    $('#page_template').on('change', function () {
        checkTemplateSelectionContact();
    });

    // Ensure it runs after custom fields and TinyMCE are loaded
    setTimeout(checkTemplateSelectionContact, 1000);

    

});
