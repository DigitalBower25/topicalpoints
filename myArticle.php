<!DOCTYPE HTML>
<?php session_start();
include('connect.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>My Articles</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .active{
            background-color: lightblue;
        }
        
    </style>
</head>

<body class="bg-gray-100 overflow-hidden overflow-y-scroll">
    <div class="flex flex-col lg:flex-row min-h-screen">
    <!-- Sidebar section -->
    <?php include_once('sidebar.inc.php'); ?>
    <main class="flex-1 p-6">
        <!-- Statistics Section -->
        <!-- Content Section -->
        <div id="content" class="space-y-6 bg-white mb-4 shadow-lg">
 <div
              class="flex lg:w-10/12 mx-auto rounded-xl bg-white flex-col md:flex-row justify-between items-center mb-4 space-y-4 md:space-y-0 md:space-x-4"
            >
              <!-- Search Input -->
               
              <div class="relative p-4 w-full">
                <input
                  type="text"
                  id="search"
                  autocomplete="off"
                  class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400"
                  placeholder="Search titles..."
                />
                <ul
                  id="dropdown"
                  class="absolute mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden z-20"
                  style="max-height: 200px; overflow-y: auto"
                ></ul>
              </div>
             
              <!-- Filter Options -->
              <div
                class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4 w-full md:w-auto"
              >
                <select class="w-full sm:w-auto p-2 px-6 mr-4 border rounded" id="select">
                  <option value="All">All</option>
                  <option value="recent">Recently posted</option>
                </select>
              </div>
            </div>

            <!-- Table Section -->
            <div class="overflow-x-auto">
                <label class="message text-center "></label>
              <table class="lg:w-10/12 mx-auto bg-white shadow rounded-xl" id="table">
                 
                <thead>
                  <tr class="bg-gray-50 rounded-xl">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-4 text-left">
                            Articles
                        </th>
                        <th class="p-4 text-left">
                            Date
                        </th>
                        <th class="p-4 text-left">
                            Plan
                        </th>
                         <th class="p-4 text-left">
                            Status
                        </th>
                         <th class="p-4 text-left">
                             Duration
                        </th>
                        <th class="p-4 text-left">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
        <div class="flex justify-center mt-4 ">
            <nav aria-label="Page navigation">
                <ul class="flex justify-between mt-2 w-full mb-4" id="pagination-controls">

                </ul>
            </nav>
        </div>
        </div>
    </main>

</div>
   
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const dropdownToggle = document.querySelector('[data-dropdown-toggle="dropdownDelay"]');
            const dropdown = document.getElementById('dropdownDelay');

            if (dropdownToggle && dropdown) {
                dropdownToggle.addEventListener('mouseenter', function() {
                    setTimeout(() => {
                        dropdown.classList.toggle('hidden');
                    }, 500); // Apply delay specified in the data attribute
                });

                dropdownToggle.addEventListener('mouseleave', function() {
                    setTimeout(() => {
                        dropdown.classList.add('hidden');
                    }, 500);
                });
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            function  fetchArticles(page = 1, titles = '') {
                $.ajax({
                    url: 'fetch/fetch_mylist.php',
                    type: 'GET',
                    data: {
                        page: page,
                        title: titles,
                        tag:''
                    },
                    dataType: 'json',
                    success: function(data) {
                            const container = $('#table tbody');
                    container.empty();
                    console.log(data);
                    if (data.articles.length > 0) {
                        data.articles.forEach(function (article) {
                            // Convert comma-separated tags into an array
                            
                
                            // Determine the HTML for the plan based on the value of `article.plan`
                            let planHTML;
                            let apprHTML;
                            if (article.plan === 'free') {
                                planHTML = `<span class="text-sm text-gray-500 font-bold">${article.plan}</span>`;
                            } else if (article.plan === 'Starter') {
                                planHTML = `<span class="text-sm text-blue-500 font-bold">${article.plan}</span>`;
                            } else if (article.plan=== 'Pro') {
                                planHTML = `<span class="text-sm text-red-500 font-bold">${article.plan}</span>`;
                            } else {
                                planHTML = `<span class="text-sm text-green-500 font-bold">${article.plan}</span>`;
                            }
                            
                            if (article.approvestatus === 'Pending') {
                                apprHTML = `<span class="text-sm text-blue-500 font-bold">${article.approvestatus}</span>`;
                            } else if (article.approvestatus === 'Decline') {
                                apprHTML = `<span class="text-sm text-red-500 font-bold">${article.approvestatus}</span>`;
                            } else {
                                apprHTML = `<span class="text-sm text-green-500 font-bold">${article.approvestatus}</span>`;
                            }
                console.log(planHTML);
                            // Construct the HTML for each row
                            const articleHTML = `
                                <tr class="border-b">
                                    <td class="p-4 flex items-center">
                                        <img alt="${article.title ?? 'No Title'}" class="h-12 w-12 rounded mr-4" height="50" src="${article.image ?? 'https://via.placeholder.com/50'}" width="50" />
                                    </td>
                                    <td class="p-4">
                                        ${article.date ?? 'No Date'}
                                    </td>
                                   
                                    <td class="p-4">
                                        ${planHTML}
                                    </td>
                                     <td class="p-4">
                                        ${apprHTML}
                                    </td>
                                    <td class="p-4">
                                        ${article.duration}
                                    </td>
                                    <td class="p-4  items-center">
                                        <button class="rounded ${article.plan === 'Business' ? '' : 'hidden'}" onclick="location.href='editArticle.php?article=${article.id}'">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="rounded">
                                            <a href='singlePost?title=${article.id}' style="text-decoration-none;" target="_blank"><i class="fas fa-eye"></i></a>
                                        </button>
                                        <button class="rounded delArticle">
                                            <input id="articleid" value="${article.id}" type="hidden">
                                            <i class="fas fa-trash"></i></a>
                                        </button>
                                    </td>
                                </tr>`;
                            container.append(articleHTML); // Append each row separately
                        });
                    } else {
                        // Append a "No Data Found" message in a single row spanning all columns
                        container.append(`
                            <tr>
                                <td colspan="5" class="text-center">
                                    
                                    <img src="assets/img/no-data.png" alt="Not Found" class="mx-auto max-h-52 max-w-64 mt-4 object-top">
                                    <p class="font-semibold text-md text-blue-500 ">Data Not Found</p>
                                </td>
                            </tr>
                        `);
                    }

                            const paginationControls = document.getElementById('pagination-controls');
                        paginationControls.innerHTML = ''; // Clear any existing pagination items

                        // Add Previous button
                        const prevButton = `<li class="page-item${page === 1 ? ' disabled' : ''} flex-1">
                            <a class="page-link block py-2 px-4 text-center bg-gray-200 text-gray-500 cursor-not-allowed rounded-l"
                                href="#"
                                aria-label="Previous"
                                data-page="${page - 1}">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>`;
                        paginationControls.insertAdjacentHTML('beforeend', prevButton);

                        // Add page numbers
                        for (let i = 1; i <= data.total_pages; i++) {
                            
                            const isActive = i === page ? ' active' : '';
                           
                            const pageLink = ` <li class="flex-1" class="page-item${isActive} active">
                                                <a class="block py-2 px-4 text-center text-gray-500 font-bold page-link ${isActive}" href="#" data-page="${i}">${i}
                                                </a>
                                                </li>`;
                            paginationControls.insertAdjacentHTML('beforeend', pageLink);
                        }

                        // Add Next button
                        const nextButton = `<li class="page-item${page === data.total_pages ? ' disabled' : ''} flex-1">
                            <a class="block py-2 px-4 text-center bg-gray-200 text-gray-500 cursor-not-allowed rounded-r"
                                href="#"
                                aria-label="Next"
                                 data-page="${page + 1}" >
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>`;
                        paginationControls.insertAdjacentHTML('beforeend', nextButton);
                    },
                    error: function(error) {
                            console.error('Error fetching articles:', error);
                            swal('Error fetching articles:');
                    }

                });
            }

//Search titles process ajax call
             const searchInput = $('#search');
            const dropdown = $('#dropdown');
            searchInput.on('input', function() {
                const query = $(this).val();
                if (query.length > 0) {
                    $.ajax({
                        url: 'searchArticle.php',
                        type: 'GET',
                        data: {
                            term: query
                        },
                        success: function(response) {
                            const titles = JSON.parse(response);
                            dropdown.empty();

                            if (titles.length > 0) {
                                dropdown.removeClass('hidden');
                                $.each(titles, function(index, title) {
                                    const li = $('<li></li>')
                                        .addClass('flex items-center px-4 py-3 hover:bg-blue-50 cursor-pointer transition-all duration-150 ease-in-out border-b border-gray-200 last:border-b-0')
                                        .text(title)
                                        .on('click', function() {
                                            searchInput.val(title);
                                            dropdown.addClass('hidden');
                                            fetchArticles(1, title);
                                            //articleTable(data, page = 1)
                                        });

                                    dropdown.append(li);
                                    
                                    
                                    
                                });
                                
                                // Add a fixed height and scroll when items exceed five
                            if (response.length > 5) {
                                $(dropdown).css({
                                    'max-height': '200px', // Adjust the height as needed
                                    'overflow-y': 'auto'
                                });
                            } else {
                                $(dropdown).css({
                                    'max-height': '',
                                    'overflow-y': ''
                                });
                            }
                                
                                
                            } else {
                                
                                dropdown.append('<li class="flex items-center px-4 py-3 hover:bg-blue-50 cursor-pointer transition-all duration-150 ease-in-out border-b border-gray-200 last:border-b-0">No resut for search titles</li>');
                                //dropdown.addClass('hidden');
                                
                                //fetchArticles(1, '', '');
                            }
                        },complete:function(data){
                           
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching search results:', error);
                        }
                    });
                } else {
                    dropdown.addClass('hidden');
                    fetchArticles(1, '', '');
                }
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search').length && !$(event.target).closest('#dropdown').length) {
                    dropdown.addClass('hidden');
                }
            });

             $("#select").on('change',function(e){
                 e.preventDefault();
                 if($(this).val()==='recent'){
                     $.ajax({
                        url: 'fetch/fetch_recentPost.php',
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                             const container = $('#table tbody');
                    container.empty();
                    console.log(data);
                    if (data.articles.length > 0) {
                        data.articles.forEach(function (article) {
                            // Convert comma-separated tags into an array
                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];
                
                            // Determine the HTML for the plan based on the value of `article.plan`
                            let planHTML;
                            let apprHTML;
                            if (article.plan === 'free') {
                                planHTML = `<span class="text-sm text-gray-500 font-bold">${article.plan}</span>`;
                            } else if (article.plan === 'Basic') {
                                planHTML = `<span class="text-sm text-blue-500 font-bold">${article.plan}</span>`;
                            } else if (article.plan=== 'Standard') {
                                planHTML = `<span class="text-sm text-red-500 font-bold">${article.plan}</span>`;
                            } else {
                                planHTML = `<span class="text-sm text-green-500 font-bold">${article.plan}</span>`;
                            }
                            
                            if (article.approvestatus === 'Pending') {
                                apprHTML = `<span class="text-sm text-blue-500 font-bold">${article.approvestatus}</span>`;
                            } else if (article.approvestatus === 'Decline') {
                                apprHTML = `<span class="text-sm text-red-500 font-bold">${article.approvestatus}</span>`;
                            } else {
                                apprHTML = `<span class="text-sm text-green-500 font-bold">${article.approvestatus}</span>`;
                            }
                
                            // Construct the HTML for each row
                            const articleHTML = `
                                <tr class="border-b">
                                    <td class="p-4 flex items-center">
                                        <img alt="${article.title ?? 'No Title'}" class="h-12 w-12 rounded mr-4" height="50" src="${article.image ?? 'https://via.placeholder.com/50'}" width="50" />
                                    </td>
                                    <td class="p-4">
                                        ${article.date ?? 'No Date'}
                                    </td>
                                    <td class="p-4">
                                        ${tags.join(', ')}
                                    </td>
                                    <td class="p-4">
                                        ${planHTML}
                                    </td>
                                     <td class="p-4">
                                        ${apprHTML}
                                    </td>
                                    <td class="p-4">
                                        ${article.duration}
                                    </td>
                                    <td class="p-4  items-center">
                                        <button class="rounded">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>`;
                            container.append(articleHTML); // Append each row separately
                        });
                    } else {
                        // Append a "No Data Found" message in a single row spanning all columns
                        container.append(`
                            <tr>
                                <td colspan="5" class="text-center">
                                    
                                    <img src="https://img.freepik.com/free-vector/no-data-concept-illustration_114360-536.jpg" alt="Not Found" class="mx-auto max-h-52 max-w-64 mt-4 object-top">
                                    <p class="font-semibold text-md text-blue-500 ">Data Not Found</p>
                                </td>
                            </tr>
                        `);
                    }

                            const paginationControls = document.getElementById('pagination-controls');
                        paginationControls.innerHTML = ''; // Clear any existing pagination items

                        // Add Previous button
                        const prevButton = `<li class="page-item${page === 1 ? ' disabled' : ''} flex-1">
                            <a class="page-link block py-2 px-4 text-center bg-gray-200 text-gray-500 cursor-not-allowed rounded-l"
                                href="#"
                                aria-label="Previous"
                                data-page="${page - 1}">
                                <span aria-hidden="true">«</span>
                                <span class="sr-only">Previous</span>
                            </a>
                        </li>`;
                        paginationControls.insertAdjacentHTML('beforeend', prevButton);

                        // Add page numbers
                        for (let i = 1; i <= data.total_pages; i++) {
                            
                            const isActive = i === page ? ' active' : '';
                            console.log('----------------------------------------->'+page);
                            console.log('----------------------------------------->'+isActive);
                            const pageLink = ` <li class="flex-1" class="page-item${isActive}">
                                                <a class="block py-2 px-4 text-center text-gray-500 font-bold page-link ${isActive}" href="#" data-page="${i}">${i}
                                                </a>
                                                </li>`;
                            paginationControls.insertAdjacentHTML('beforeend', pageLink);
                        }

                        // Add Next button
                        const nextButton = `<li class="page-item${page === data.total_pages ? ' disabled' : ''} flex-1">
                            <a class="block py-2 px-4 text-center bg-gray-200 text-gray-500 cursor-not-allowed rounded-r"
                                href="#"
                                aria-label="Next"
                                 data-page="${page + 1}" >
                                <span aria-hidden="true">»</span>
                                <span class="sr-only">Next</span>
                            </a>
                        </li>`;
                        paginationControls.insertAdjacentHTML('beforeend', nextButton);
                        },
                  });
                    
                 }else{
                     fetchArticles();
                 }
             });       
             
              $('#pagination-controls').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                const page = parseInt($(this).data('page'));
                const titles=$('#search').val();
                fetchArticles(page,titles,'');
            });
             fetchArticles();
            $("#table tbody ").on('click','.delArticle',function(e){
                e.preventDefault();
                const query = $(this).closest("tr").find("#articleid").val();
                  $.ajax({
                        url: 'deleteArticle.php',
                        type: 'POST',
                        data: {
                            term: query
                        },
                        success: function(response) {
                            if(response==1){
                                $(".message").text('Article Deleted Sucessfully').addClass('text-green-500');
                                setTimeout(location.reload(), 3000);
                            }
                        }
                })
            });
        });
    </script>
</body>

</html>