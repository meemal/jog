document.addEventListener("DOMContentLoaded", function () {
    const mobileMenu = document.querySelector("#mobileMenu");
    const body = document.body;
    const openMenuBtn = document.querySelector("#threeDot");
    const closeMenuBtn = document.querySelector("#closeMobileMenu");

    // Only add event listeners if the menu exists on the page
    if (openMenuBtn && closeMenuBtn && mobileMenu) {
        openMenuBtn.addEventListener("click", function () {
            mobileMenu.classList.remove("-translate-x-full", "opacity-0");
            mobileMenu.classList.add("translate-x-0", "opacity-100");
            body.classList.add("overflow-hidden"); // Prevent scrolling
        });

        closeMenuBtn.addEventListener("click", function () {
            mobileMenu.classList.remove("translate-x-0", "opacity-100");
            mobileMenu.classList.add("-translate-x-full", "opacity-0");
            body.classList.remove("overflow-hidden"); // Allow scrolling
        });
    }

    // Do the same check for tabs
    const tabButtons = document.querySelectorAll(".tab-button");
    const tabContents = document.querySelectorAll(".tab-content");
    const nextButton = document.querySelector(".nextBtn");
    const nextText = document.querySelector(".next-text");

    if (tabButtons.length > 0 && tabContents.length > 0 && nextButton && nextText) {
        function activateTab(tabId) {
            tabContents.forEach(content => content.classList.add("hidden"));
            tabButtons.forEach(button => button.classList.remove("text-mill-red", "border-b-[6px]", "border-mill-red"));

            // document.getElementById(tabId).classList.remove("hidden");
            // document.querySelector(`[data-tab="${tabId}"]`).classList.add("text-mill-red", "border-b-[4px]", "border-mill-red");

            // Hide all tabs and remove active styles
            document.querySelectorAll(".tab-content").forEach(el => el.classList.add("hidden"));
            document.querySelectorAll(".tab-button").forEach(el => {
                el.classList.remove("text-mill-red", "border-b-[4px]", "border-mill-red");
            });

            // Show the selected tab
            document.getElementById(tabId).classList.remove("hidden");

            // Add active styles to selected tab
            document.querySelector(`[data-tab="${tabId}"]`).classList.add(
                "text-mill-red",
                "border-b-[4px]",
                "border-mill-red"
            );


            let currentTabIndex = Array.from(tabButtons).findIndex(button => button.dataset.tab === tabId);
            let nextTabIndex = (currentTabIndex + 1) % tabButtons.length;
            nextText.textContent = tabButtons[nextTabIndex].textContent;
        }

        tabButtons.forEach(button => {
            button.addEventListener("click", function () {
                activateTab(this.dataset.tab);
            });
        });

        nextButton.addEventListener("click", function (event) {
            event.preventDefault();
            let currentTabIndex = Array.from(tabButtons).findIndex(button => button.classList.contains("text-mill-red"));
            let nextTabIndex = (currentTabIndex + 1) % tabButtons.length;
            activateTab(tabButtons[nextTabIndex].dataset.tab);
        });

        const firstActiveTab = document.querySelector(".tab-button[data-initial-tab='true']");
        if (firstActiveTab) {
            activateTab(firstActiveTab.getAttribute("data-tab"));
        }
    }



    let page = 2; 
    const loadMoreButton = document.getElementById("load-more");
    const newsContainer = document.getElementById("news-container");

    // If these elements don't exist, stop the script to prevent errors
    if (!loadMoreButton || !newsContainer) {
        console.warn("Load More functionality not initialized: Required elements are missing.");
        return; // Stops execution if elements are not found
    }

    function checkMorePosts() {
        const loadedCount = (page - 1) * 6;
        fetch(news_ajax.ajaxurl + "?action=check_more_posts&loaded=" + loadedCount)
            .then(response => response.json())
            .then(data => {
                if (data.has_more) {
                    loadMoreButton.classList.remove("hidden");
                } else {
                    loadMoreButton.classList.add("hidden");
                }
            });
    }

    checkMorePosts();

    loadMoreButton.addEventListener("click", function () {
        loadMoreButton.innerHTML = `<div class="flex justify-center items-center space-x-2">
                                        <div class="w-4 h-4 border-2 border-[#FFFFFF]  border-t-transparent rounded-full animate-spin"></div>
                                        <span class="text-[16px] font-brother font-bold">Loading...</span>
                                    </div>`;
        loadMoreButton.disabled = true;

        fetch(news_ajax.ajaxurl + "?action=load_more_posts&page=" + page)
            .then(response => response.text())
            .then(data => {
                if (data.trim() !== "") {
                    newsContainer.insertAdjacentHTML("beforeend", data);
                    page++;
                    loadMoreButton.innerHTML = "Load More";
                    loadMoreButton.disabled = false;
                    checkMorePosts();
                } else {
                    loadMoreButton.classList.add("hidden");
                }
            });
    });
});






