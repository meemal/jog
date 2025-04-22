jQuery(document).ready(function ($) {
    
    function checkTemplateSelection() {
        let selectedTemplate = $('#page_template').val();
        let metaBoxWrapper = $('#journey-meta-box').closest('.postbox'); // Target full meta box container
        let metaBoxContent = $('#journey-meta-box'); // Target only the fields inside

        if (selectedTemplate === 'templates/template-journey.php') {
            metaBoxWrapper.slideDown(300); // Smoothly show the full meta box
            metaBoxContent.slideDown(300); // Smoothly show the fields
        } else {
            metaBoxWrapper.slideUp(300); // Smoothly hide the entire box
        }
    }
    // Run on page load (for existing pages)
    checkTemplateSelection();

    // Detect when the template dropdown changes (for new pages)
    $('#page_template').on('change', function () {
        checkTemplateSelection();
    });

    // Ensure it runs after custom fields and TinyMCE are loaded
    setTimeout(checkTemplateSelection, 500);
    setTimeout(function () {
        let editor = tinyMCE.get('tab-content-editor');

        if (editor) {
            editor.on('change input keyup', function () {
                let activeTabId = $('.tab-item.active').data('tab-id');
                if (activeTabId) {
                    tabDataCache[activeTabId] = {
                        content: editor.getContent(),
                        image: $('#tab-image').val(),
                    };
                }
            });
        }
    }, 1000); // Wait 1 second to ensure TinyMCE is ready

//..................................................................................................

    let pageID = $('input#post_ID').val(); // Get the current Page ID
    let tabDataCache = {}; // Cache for storing tab data while switching

    // Add Tab - Keep Existing Code
    $('#add-tab-btn').click(function () {
        $('#new-tab-section').fadeToggle();
    });

    let newExistingTabNames = []; // Store existing tab names as they are (case-sensitive)

   // Fetch all existing tab names when the modal opens
    $('#manage-tabs-btn').on('click', function () {
        let pageID = $('input#post_ID').val(); // Ensure pageID is defined

        $.post(ajaxurl, { action: 'journey_fetch_tabs', page_id: pageID }, function (response) {
            if (response.success) {
                newExistingTabNames = response.data.tabs.reduce((acc, tab) => {
                    acc[tab.id] = tab.name.toLowerCase();
                    return acc;
                }, {}); // Store names in lowercase for case-insensitive validation
            }
        });
    });



    // Fetch current tab names on page load or on Add Tab modal open
    function loadExistingTabNames() {
        let pageID = $('input#post_ID').val();

        $.post(ajaxurl, { action: 'journey_fetch_tabs', page_id: pageID }, function (response) {
            if (response.success && Array.isArray(response.data.tabs)) {
                newExistingTabNames = response.data.tabs.map(tab => tab.name.toLowerCase());
            } else {
                newExistingTabNames = [];
            }
        });
    }

    // Call this once when Add Tab modal/section is opened
    $('#add-tab-btn').on('click', function () {
        loadExistingTabNames(); // always refresh names
    });

    // Check for duplicate tab name when creating a new tab
    $('#save-tab-btn').click(function () {
        let tabName = $('#new-tab-name').val().trim();

        if (!tabName) {
            $('#tab-error-message').text('Tab name cannot be empty.').fadeIn();
            return;
        }

        let tabNameLower = tabName.toLowerCase();

        // Ensure array check is safe
        if (Array.isArray(newExistingTabNames) && newExistingTabNames.includes(tabNameLower)) {
            $('#tab-error-message').text('Duplicate tab name not allowed.').fadeIn();
            return;
        }

        let pageID = $('input#post_ID').val();

        $.post(ajaxurl, { action: 'journey_create_tab', tab_name: tabName, page_id: pageID }, function (response) {
            if (response.success) {
                let newTab = `<li class="tab-item" data-tab-id="${response.data.tab_id}">
                    <span class="tab-title">${response.data.tab_name}</span>
                </li>`;
                $('#journey-tab-list').append(newTab);
                $('#new-tab-name').val('');
                $('#new-tab-section').fadeOut();
                $('#tab-error-message').fadeOut();

                newExistingTabNames.push(tabNameLower); // Update the list
            } else {
                $('#tab-error-message').text("Duplicate tab name not allowed.").fadeIn();
            }
        }).fail(function () {
            $('#tab-error-message').text("Error adding tab. Please try again.").fadeIn();
        });
    });


        
    
    // Handle tab name change and check for duplicates instantly
    $(document).on('input', '.edit-tab-name', function () {
        let tabId = $(this).closest('.manage-tab-item').data('tab-id');
        let newName = $(this).val().trim();
    
        if (!newName) {
            $('#tab-error-message').text('').fadeOut();
            return;
        }
    
        let newNameLower = newName.toLowerCase(); // Convert to lowercase for validation
    
        // Get all tab names except the one being edited
        let otherTabNames = Object.values(newExistingTabNames)
            .filter((name, index) => name !== $(`.tab-item[data-tab-id="${tabId}"] .tab-title`).text().trim().toLowerCase());
    
        // Check if the new name already exists in the list (excluding the current tab being edited)
        let isDuplicate = otherTabNames.includes(newNameLower);
    
        if (isDuplicate) {
            $('#tab-error-message').text('Duplicate tab name not allowed.').fadeIn();
            $(this).addClass('error'); // Add an error class for UI styling
        } else {
            $('#tab-error-message').text('').fadeOut();
            $(this).removeClass('error'); // Remove error styling
        }
    
        // Store edited name
        editedTabs[tabId] = newName;
    
        // Update UI instantly
        $(`.tab-item[data-tab-id="${tabId}"] .tab-title`).text(newName);
    });
        

    // Handle tab name change and check for duplicates instantly
    $(document).on('input', '.edit-tab-name', function () {
        let tabId = $(this).closest('.manage-tab-item').data('tab-id');
        let newName = $(this).val().trim().toLowerCase(); // Convert input to lowercase to avoid case-sensitive duplicates
    
        if (!newName) {
            $('#tab-error-message').text('').fadeOut();
            return;
        }
    
        // Check if the new name is already in the list (excluding the current tab being edited)
        let isDuplicate = newExistingTabNames.includes(newName) && newName !== $(`.tab-item[data-tab-id="${tabId}"] .tab-title`).text().trim().toLowerCase();
    
        if (isDuplicate) {
            $('#tab-error-message').text('Duplicate tab name not allowed.').fadeIn();
        } else {
            $('#tab-error-message').text('').fadeOut();
        }
    });
    
    // Click Tab to Load Data & Preserve Unsubmitted Changes
    $(document).on('click', '.tab-item', function () {
        let prevTabId = $('.tab-item.active').data('tab-id');
        if (prevTabId) {
            // Save changes for the currently active tab before switching
            tabDataCache[prevTabId] = {
                timestamp: new Date().getTime(),
                image: $('#tab-image').val(),
                content: tinyMCE.get('tab-content-editor').getContent(),
            };
        }

    
        $('.tab-item').removeClass('active');
        $(this).addClass('active');
        let tabId = $(this).data('tab-id');
        let pageID = $('input#post_ID').val(); // Ensure pageID is defined
    
        if (tabDataCache[tabId] && (tabDataCache[tabId].content || tabDataCache[tabId].image)) {
            $('#tab-image').val(tabDataCache[tabId].image);
            $('.image-preview').html(tabDataCache[tabId].image ? `<img src="${tabDataCache[tabId].image}" />` : '');
            tinyMCE.get('tab-content-editor').setContent(tabDataCache[tabId].content);
            $('#tab-content-wrapper').fadeIn(); // Ensure the content wrapper is displayed
        } else {
            $.post(ajaxurl, { action: 'journey_load_tab_data', tab_id: tabId, page_id: pageID }, function (response) {
                if (response.success) {
                    let image = response.data.image ? response.data.image : '';
                    let content = response.data.content ? response.data.content : '';
    
                    $('#tab-image').val(image);
                    $('.image-preview').html(image ? `<img src="${image}" />` : '');
                    tinyMCE.get('tab-content-editor').setContent(content);
                    $('#tab-content-wrapper').fadeIn(); // Ensure the content wrapper is displayed
    
                    // Store fetched data in cache
                    tabDataCache[tabId] = {
                        image: image,
                        content: content,
                    };
                } else {
                    alert("Error: " + response.message);
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                alert("AJAX error: " + textStatus);
            });
        }
    });
    

    // Upload Image - Preserve Image Selection
    $('#upload-tab-image').click(function () {
        let frame = wp.media({ title: "Select Image", multiple: false, library: { type: 'image' } });
        frame.on('select', function () {
            let attachment = frame.state().get('selection').first().toJSON();
            $('#tab-image').val(attachment.url);
            $('.image-preview').html(`<img src="${attachment.url}" />`);
    
            let activeTabId = $('.tab-item.active').data('tab-id');
            if (activeTabId) {
                tabDataCache[activeTabId] = tabDataCache[activeTabId] || {};
                tabDataCache[activeTabId].image = attachment.url;
            }
        });
        frame.open();
    });
    
    // Delete Image - Preserve Deletion in Cache
    $('#delete-tab-image').click(function () {
        $('#tab-image').val('');
        $('.image-preview').html('');
    
        let activeTabId = $('.tab-item.active').data('tab-id');
        if (activeTabId) {
            tabDataCache[activeTabId] = tabDataCache[activeTabId] || {};
            tabDataCache[activeTabId].image = '';
        }
    });
    
    
    // Save Tab Content - Save All Cached Data
    $('#publish, #save-post').click(function (event) {
        let pageID = $('input#post_ID').val(); // Ensure pageID is defined
    
        $('.tab-item').each(function () {
            let tabId = $(this).data('tab-id');

            if (tabDataCache[tabId]) {
                let editor = tinyMCE.get('tab-content-editor');
                
                    editor.save();

                let content = tabDataCache[tabId].content || '';
                let image = tabDataCache[tabId].image || '';
    
                // Introduce a short delay to ensure TinyMCE updates before sending AJAX
                setTimeout(function () {
                    $.post(ajaxurl, {
                        action: 'journey_save_tab_data',
                        tab_id: tabId,
                        page_id: pageID,
                        content: content,
                        image: image
                    })
                }, 200); // Short delay (200ms) ensures TinyMCE updates before AJAX call
            }
        });
    });
    



//.............................................for manage tab modal

    $('#manage-tabs-btn').on('click', function (e) {
        e.preventDefault(); // Prevent default button behavior

        let pageID = $('input#post_ID').val(); // Get the current page ID

        $.post(ajaxurl, { action: 'journey_fetch_tabs', page_id: pageID }, function (response) {
            if (response.success) {
                let tabList = $('#manage-tab-list');
                tabList.empty(); // Clear existing list before adding new tabs

                response.data.tabs.forEach(tab => {
                    tabList.append(`
                        <li class="manage-tab-item" data-tab-id="${tab.id}">
                            <input type="text" class="edit-tab-name" value="${tab.name}">
                            <button class="delete-tab-btn button-secondary" data-tab-id="${tab.id}">🗑️ Delete</button>
                        </li>
                    `);
                });

                // Open modal and overlay (force display)
                $('#manage-tabs-modal, #modal-overlay').fadeIn().css("display", "block");
            } else {
                alert('Error loading tabs: ' + response.message);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("AJAX error: " + textStatus);
        });
    });

    // Global Event Listener for Closing the Modal
    $(document).on('click', '#close-manage-tabs, #modal-overlay', function (e) {
        e.preventDefault();
        $('#manage-tabs-modal, #modal-overlay').fadeOut();
    });

    // Prevent modal from closing when clicking inside it
    $(document).on('click', '#manage-tabs-modal', function (e) {
        e.stopPropagation();
    });

    let existingTabNames = []; // Store existing tab names
    let editedTabs = {}; // Store edited tab names before saving

    $('#manage-tabs-btn').on('click', function () {
        let pageID = $('input#post_ID').val(); // Get the current Page ID
    
        $.post(ajaxurl, { action: 'journey_fetch_tabs', page_id: pageID }, function (response) {
            if (response.success) {
                existingTabNames = response.data.tabs.map(tab => tab.name.toLowerCase()); // Store names
            }
        });
    });
    

    // Handle tab name change and check for duplicates instantly
    $(document).on('input', '.edit-tab-name', function () {
        let tabId = $(this).closest('.manage-tab-item').data('tab-id');
        let newName = $(this).val().trim();

        if (!newName) {
            $('#tab-error-message').text('').fadeOut();
            return;
        }

        // Ensure duplicate check works only on names other than the one being edited
        let isDuplicate = existingTabNames.includes(newName.toLowerCase()) &&
                        newName.toLowerCase() !== $(`.tab-item[data-tab-id="${tabId}"] .tab-title`).text().trim().toLowerCase();

        if (isDuplicate) {
            $('#tab-error-message').text('Duplicate tab name not allowed.').fadeIn();
        } else {
            $('#tab-error-message').text('').fadeOut();
        }

        // Store the updated name in editedTabs
        editedTabs[tabId] = newName;

        // Update the UI instantly
        $(`.tab-item[data-tab-id="${tabId}"] .tab-title`).text(newName);
    });

    

    // Save changes when clicking "Update"
    $('#publish, #save-post').on('click', function () {
        if (Object.keys(editedTabs).length === 0) {
            return; // No changes, do nothing
        }
    
        let pageID = $('input#post_ID').val(); // Get the current Page ID
    
        $.post(ajaxurl, { action: 'journey_update_tab', page_id: pageID, edited_tabs: editedTabs }, function (response) {
            if (response.success) {
                existingTabNames = Object.values(editedTabs).map(name => name.toLowerCase()); // Update existing names
                editedTabs = {}; // Clear the edited list after saving
            }
        });
    });
    
    
    // Open Delete Confirmation Modal
    $(document).on('click', '.delete-tab-btn', function (e) {
        e.preventDefault(); // Prevent default page refresh
    
        let tabId = $(this).data('tab-id');
    
        if (!tabId) {
            return;
        }
    
        // Show delete confirmation modal and store tab ID
        $('#confirm-delete-modal').fadeIn();
        $('#confirm-delete-btn').data('tab-id', tabId);
    });
    
    // Cancel Delete (Close Modal Without Refresh)
    $(document).on('click', '#cancel-delete-btn, #delete-modal-overlay', function (e) {
        e.preventDefault();
        $('#confirm-delete-modal, #delete-modal-overlay').fadeOut();
    });
    
    // Confirm Delete (Prevent Refresh, Delete Instantly)
    $(document).on('click', '#confirm-delete-btn', function (e) {
        e.preventDefault();
    
        let tabId = $(this).data('tab-id');
        let pageID = $('input#post_ID').val(); // Get the current Page ID
    
        if (!tabId || !pageID) {
            return;
        }
    
        // Send AJAX request to delete the tab and its data
        $.post(ajaxurl, { action: 'journey_delete_tab', tab_id: tabId, page_id: pageID }, function (response) {
            if (response.success) {
                // Remove the tab from the UI
                $(`.tab-item[data-tab-id="${tabId}"]`).fadeOut(300, function () { $(this).remove(); });
                $(`.manage-tab-item[data-tab-id="${tabId}"]`).fadeOut(300, function () { $(this).remove(); });
    
                // Clear UI elements if the deleted tab was active
                if ($('.tab-item.active').data('tab-id') === tabId) {
                    $('#tab-image').val('');
                    $('.image-preview').html('');
                    tinyMCE.get('tab-content-editor').setContent('');
                    $('#tab-content-wrapper').fadeOut();
                }
    
                // Close delete confirmation modal
                $('#confirm-delete-modal, #delete-modal-overlay').fadeOut();
            } else {
                alert('Error deleting tab: ' + response.message);
            }
        }).fail(function (jqXHR, textStatus, errorThrown) {
            alert("AJAX error: " + textStatus);
        });
    });    
});
