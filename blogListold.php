<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Topical Points - Listing Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />
    <link rel="stylesheet" href="style.css" />
    <style>
        .active {
            background-color: rgb(59 130 246 / 0.5);
        }

        #article-container+.flex {
            margin-top: 0;
            /* Removes additional margin if needed */
            justify-content: center;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <!-- 
    <header
      class="w-full max-container header-bg mx-auto flex justify-between lg:justify-end items-center p-4 md:px-20 bg-opacity-50"
    >
      <button
        id="menu-btn"
        class="block lg:hidden text-white focus:outline-none"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>

      <button
        class="text-white px-4 py-2 rounded-full text-xl font-semibold flex items-center gap-2"
      >
        <img src="assets/person.svg" class="w-5 h-5" />
        Sign in
      </button>
    </header>    <nav
      id="mobile-menu"
      class="hidden bg-gray-700 text-white p-4 space-y-4 lg:hidden"
    >
      <a href="#" class="block hover:text-yellow-500">Home</a>
      <a href="#" class="block hover:text-yellow-500">View Articles</a>
      <a href="#" class="block hover:text-yellow-500">Pricing</a>
      <a href="#" class="block hover:text-yellow-500">Contact Us</a>
      <button class="w-full px-6 py-2 bg-red-500 hover:bg-red-600 rounded-full">
        Post an Article
      </button>
    </nav>

    <main class="flex flex-col banner-bg items-start justify-center text-center pt-6 pb-3">
        <div class="w-full">
            <img src="assets/logo.png" alt="Topical Points Logo" class="h-32 w-auto mx-auto" />
        </div>
    </main> -->
    <?php include('header.php');?>

    <div class="container mx-auto px-4 md:px-8 py-8">
        <div class="md:grid grid-cols-1 md:grid-cols-4 gap-8">
            <!-- Sidebar -->
            <aside class="md:col-span-1 space-y-6">
                <div id="selected-categories" class="mt-6 space-y-2 hidden">
                    <h2 class="font-semibold text-lg flex">Selected Categories</h2>
                    <ul class="space-y-1 flex items-center gap-3 flex-wrap" id="category-list"></ul>
                </div>

                <!-- Search Section -->
                <div class="space-y-2">
                    <div class="flex gap-x-4 items-center">
                        <img src="assets/c143b7ef21f2f38b6b0fc2d43e56f653.svg" class="w-7" />
                        <h2 class="font-semibold text-base lg:text-xl">
                            Search by Article
                        </h2>
                    </div>

                    <div class="gap-2 relative">
                        <input type="text" id="search" class="w-full p-2 border border-gray-300 rounded-lg"
                            placeholder="Search..." autocomplete="off" />
                        <!--<input type="text"  autocomplete="off" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search titles..."> -->
                        <ul id="dropdown"
                            class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden z-20"
                            style="max-height: 200px; overflow-y: auto"></ul>
                    </div>
                </div>

                <!-- Filter Section -->
                <div class="space-y-4">
                    <div class="flex gap-x-4 items-center">
                        <img src="assets/filter.png" class="w-7" />
                        <h2 class="font-semibold text-xl">Filter by</h2>
                    </div>

                    <!-- Dropdown for mobile and visible category for desktop -->
                    <div class="block lg:hidden">
                        <button id="toggle-categories"
                            class="w-full flex justify-between items-center py-2 px-4 border border-gray-300 rounded-lg">
                            <span>Category</span>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.23 7.21a.75.75 0 011.06-.02L10 10.708l3.71-3.5a.75.75 0 011.08 1.04l-4.25 4a.75.75 0 01-1.08 0l-4.25-4a.75.75 0 01-.02-1.06z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                        <div id="category-options-mobile" class="hidden space-y-2 mt-2">
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="w-4 h-4 category-checkbox" value="Technology Trends" />
                                <span>Technology Trends</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="w-4 h-4 category-checkbox" value="Health & Wellness" />
                                <span>Health & Wellness</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="w-4 h-4 category-checkbox" value="Travel & Adventure" />
                                <span>Travel & Adventure</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="w-4 h-4 category-checkbox" value="Finance & Investing" />
                                <span>Finance & Investing</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="checkbox" class="w-4 h-4 category-checkbox" value="Lifestyle & Culture" />
                                <span>Lifestyle & Culture</span>
                            </label>
                        </div>
                    </div>

                    <!-- Visible Category for Desktop -->
                    <div class="hidden lg:block space-y-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 category-checkbox" value="Technology Trends" />
                            <span>Technology Trends</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 category-checkbox" value="Health & Wellness" />
                            <span>Health & Wellness</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 category-checkbox" value="Travel & Adventure" />
                            <span>Travel & Adventure</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 category-checkbox" value="Finance & Investing" />
                            <span>Finance & Investing</span>
                        </label>
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="w-4 h-4 category-checkbox" value="Lifestyle & Culture" />
                            <span>Lifestyle & Culture</span>
                        </label>
                    </div>

                    <button
                        class="w-full bg-gradient-to-r from-red-500 to-orange-500 text-white font-medium py-2 rounded-lg hidden"
                        id="filter">
                        Apply
                    </button>
                    <label class="flex items-center space-x-2" id="error-message"></label>
                </div>
            </aside>

            <!-- Article Grid -->

            <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="article-container">
            </div>
            <div class="flex justify-center items-center mt-6 w-full col-span-2 md:col-span-4">
                <!-- Pagination -->
                <div class="w-full flex justify-center mt-6">
                    <nav aria-label="Page navigation">
                        <ul class="flex justify-center space-x-2" id="pagination-controls">
                            <!-- Pagination items will go here -->
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <?php include('footer.php');?>
</body>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function () {
        function fetchArticles(page = 1, titles = "",category="") {
            let limit;
            const width = window.innerWidth;

            if (width <= 600) {
                // Mobile
                limit = 2;
            } else if (width <= 992) {
                // Tablet
                limit = 4;
            } else {
                // Desktop
                limit = 9; // Or any other number suitable for desktop
            }

            $.ajax({
                url: "fetch/fetch_bloglist.php",
                type: "GET",
                data: {
                    page: page,
                    title: titles,
                    categories:category,
                    limit: limit
                },
                dataType: "json",
                success: function (data) {
                    const container = $("#article-container");
                    const tagsdiv = $("#popular-tags");

                    container.empty();
                    if (data.articles.length > 0) {
                        data.articles.forEach(function (article) {
                            // Convert comma-separated tags into an array
                            const tags = article.tags
                                ? article.tags.split(",").map((tag) => tag.trim())
                                : [];
                            const content = article.content;
                            const articleHTML = `<a href="singlePost?title=${article.id}" ><div class="bg-[#f5f5f5] shadow rounded-2xl overflow-hidden" >
                                                     <img
                                                          src="${article.image}"
                                                          alt="Card Image"
                                                          class="w-full h-56 object-cover" />
                                                        <div class="p-6">
                                                          <h3 class="text-xl font-semibold mb-2 min-h-[55px]">
                                                            ${article.title}
                                                          </h3>
                                                          <p class="text-gray-600 mb-4 line-clamp-3 min-h-[62px] md:min-h-[65px]">
                                                            ${content}
                                                          </p>
                                                          <div class="flex items-center space-x-4">
                                                            <img
                                                              src="https://via.placeholder.com/40"
                                                              alt="Avatar"
                                                              class="w-10 h-10 border-4 border-[#f4ee35] rounded-full" />
                                                            <div>
                                                              <p class="text-lg font-semibold">${article.author}</p>
                                                              <p class="text-sm">${article.date}</p>
                                                               <p class="text-sm">${article.category}</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div></a>`;
                            container.append(articleHTML);
                        });

                        const paginationControls = document.getElementById(
                            "pagination-controls"
                        );
                        paginationControls.innerHTML = ""; // Clear any existing pagination items

                        // Calculate start and end page numbers for a 5-page window
                        let startPage = Math.max(1, page - 2);
                        let endPage = Math.min(data.total_pages, page + 2);

                        if (endPage - startPage < 4) {
                            if (startPage === 1) {
                                endPage = Math.min(5, data.total_pages);
                            } else if (endPage === data.total_pages) {
                                startPage = Math.max(data.total_pages - 4, 1);
                            }
                        }

                        // Add Previous button
                        const prevButton = `<li class="page-item${page === 1 ? " disabled" : ""
                            } flex-1">
    <a class="page-link block py-2 px-4 text-center ${page === 1
                                ? "bg-gray-200 text-gray-500 cursor-not-allowed"
                                : "bg-blue-500 text-white"
                            } rounded-l"
        href="#"
        aria-label="Previous"
        data-page="${page - 1}">
        <span aria-hidden="true">«</span>
        <span class="sr-only">Previous</span>
    </a>
</li>`;
                        paginationControls.insertAdjacentHTML("beforeend", prevButton);

                        // Add page numbers within the calculated range
                        for (let i = startPage; i <= endPage; i++) {
                            const isActive = i === page ? " active" : "";
                            const pageLink = `<li class="page-item flex-1${isActive}">
        <a class="page-link block py-2 px-4 text-center font-bold ${isActive ? "bg-blue-500 text-white" : "text-gray-500"
                                }" 
            href="#" 
            data-page="${i}">${i}</a>
    </li>`;
                            paginationControls.insertAdjacentHTML("beforeend", pageLink);
                        }

                        // Add Next button
                        const nextButton = `<li class="page-item${page === data.total_pages ? " disabled" : ""
                            } flex-1">
    <a class="page-link block py-2 px-4 text-center ${page === data.total_pages
                                ? "bg-gray-200 text-gray-500 cursor-not-allowed"
                                : "bg-blue-500 text-white"
                            } rounded-r"
        href="#"
        aria-label="Next"
        data-page="${page + 1}">
        <span aria-hidden="true">»</span>
        <span class="sr-only">Next</span>
    </a>
</li>`;
                        paginationControls.insertAdjacentHTML("beforeend", nextButton);
                    } else {
                        const articlesImg = `<div class="p-6 bg-white rounded-lg shadow-md flex gap-4 flex-wrap md:flex-nowrap items-center mb-3">
                                     <img src="assets/img/no-data.png" alt="no terms" class="w-full h-auto rounded-lg object-cover">
                        </div>`;
                        container.append(articlesImg);
                    }
                },
                /* ,
                                              error: function(error) {
                                                  console.error('Error fetching articles:', error);
                                                  swal('Error fetching articles:');
                                              } */
            });
        }
        $("#pagination-controls").on("click", "a.page-link", function (event) {
            event.preventDefault();
            const page = parseInt($(this).data("page"));
            const titles = $("#search").val();
            const tags = $("#tags").val();
            fetchArticles(page, "", "");
        });
        fetchArticles();
    

    const searchInput = $("#search");
    const dropdown = $("#dropdown");
    searchInput.on("input", function () {
        const query = $(this).val();

        if (query.length > 0) {
            $.ajax({
                url: "search.php",
                type: "GET",
                data: {
                    term: query,
                },
                success: function (response) {
                    const titles = JSON.parse(response);
                    dropdown.empty();

                    if (titles.length > 0) {
                        dropdown.removeClass("hidden");
                        $.each(titles, function (index, title) {
                            const li = $("<li></li>")
                                .addClass(
                                    "flex items-center px-4 py-3 hover:bg-blue-50 cursor-pointer transition-all duration-150 ease-in-out border-b border-gray-200 last:border-b-0"
                                )
                                .text(title)
                                .on("click", function () {
                                    searchInput.val(title);
                                    dropdown.addClass("hidden");
                                    fetchArticles(1, title, "");
                                });

                            dropdown.append(li);
                        });

                        // Add a fixed height and scroll when items exceed five
                        if (response.length > 5) {
                            $(dropdown).css({
                                "max-height": "200px", // Adjust the height as needed
                                "overflow-y": "auto",
                            });
                        } else {
                            $(dropdown).css({
                                "max-height": "100px",
                                "overflow-y": "",
                            });
                        }
                    } else {
                        dropdown.append(
                            '<li class="flex items-center px-4 py-3 hover:bg-blue-50 cursor-pointer transition-all duration-150 ease-in-out border-b border-gray-200 last:border-b-0">No resut for search titles</li>'
                        );
                        //dropdown.addClass('hidden');

                        //fetchArticles(1, '', '');
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Error fetching search results:", error);
                },
            });
        } else {
            dropdown.addClass("hidden");
            fetchArticles(1, "", "");
        }
    });

    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (
            !$(event.target).closest("#search").length &&
            !$(event.target).closest("#dropdown").length
        ) {
            dropdown.addClass("hidden");
            $("#search").val("");
        }
    });

    // Close dropdown when clicking outside
    $(document).on("click", function (event) {
        if (
            !$(event.target).closest("#tags").length &&
            !$(event.target).closest("#tagsdown").length
        ) {
            $("#tagsdown").addClass("hidden");
            $("#tags").val("");
        }
    });

    //$('#filter').click(function() {
    $(".category-checkbox").on("change", function () {
        // Collect all <li> values into an array
        // Collect all <li> values into an array and check for empty values
        var categories = [];
        var isEmpty = false;

        $("#category-list li span").each(function () {
            var category = $(this).text().trim();
            //alert(category);
            if (category === "") {
                isEmpty = true;
            } else {
                categories.push(category);
            }
        });

        // Check if any category is empty
        if (isEmpty) {
            $("#error-message")
                .text("One or more categories are empty.")
                .addClass("text-red-500");
            return; // Stop the function if there’s an empty category
        }

        // Check if the categories array is empty
        if (categories.length === 0) {
            fetchArticles(1, "", "");
            //$('#error-message').text("Choose One or more categories.").addClass('text-red-500');
            return; // Stop the function if the array is empty
        }
        // Send the array to PHP via AJAX

        //listCategories((page = 1), categories);
        fetchArticles(1, "", categories);
    });

    $(".removeCategory").on("click", function () {
        $(".category-checkbox").on("change");
    });
    });    
</script>
<script>
    const categoryCheckboxes = document.querySelectorAll(".category-checkbox");
    const selectedCategories = document.getElementById("selected-categories");
    const categoryList = document.getElementById("category-list");
    const toggleCategoriesBtn = document.getElementById("toggle-categories");
    const categoryOptionsMobile = document.getElementById(
        "category-options-mobile"
    );

    toggleCategoriesBtn.addEventListener("click", () => {
        categoryOptionsMobile.classList.toggle("hidden");
    });

    categoryCheckboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", (e) => {
            const category = e.target.value;
            if (e.target.checked) {
                addCategory(category);
            } else {
                removeCategory(category);
            }
            toggleSelectedCategories();
        });
    });

    function addCategory(category) {
        const li = document.createElement("li");
        li.className =
            "flex justify-between items-center bg-gray-200 px-3 py-1 rounded-md categories";
        li.innerHTML = `
                <span>${category}</span>
                <button onclick="removeCategory('${category}', true)" class="text-red-500 removeCategory">
                    &times;
                </button>
            `;
        categoryList.appendChild(li);
        $("#error-message").text("");
    }

    function removeCategory(category, uncheck) {
        const items = categoryList.querySelectorAll("li");
        const category1 = category.trim();
        items.forEach((item) => {
            if (item.textContent.includes(category)) {
                item.remove();
            }
        });

        if (uncheck) {
            document.querySelector(`input[value="${category1}"]`).checked = false;
            $(`input[value="${category1}"]`).prop("checked", false);
        }
    }

    function toggleSelectedCategories() {
        selectedCategories.classList.toggle(
            "hidden",
            categoryList.children.length === 0
        );
    }
</script>

</html>