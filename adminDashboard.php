<!DOCTYPE html>
<?php session_start();
include_once('connect.php');error_reporting(0);
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin') {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Admin</title>
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
      /* Custom styles for active links */
      .active {
        background-color: #1f2937;
        color: white;
      }
    </style>
  </head>

  <body class="bg-gray-100 overflow-hidden overflow-y-scroll">
    <div class="flex flex-col lg:flex-row min-h-screen">
      <!-- Sidebar -->
      <aside class="w-full lg:w-64 bg-gray-800 text-white p-6">
        <div class="flex flex-col items-center mb-8">
         <div class="bg-white w-1/2 lg:w-2/3 mx-auto">
          <img
          src="assets/logo.png"  onclick="location.href='/'"
          alt="logo"
          class=" border-4 p-4 border-yellow-400  h-full"
        />
         </div>
          <div class="relative mt-6 w-24 h-24 mb-3">
          
            <img
              src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/img/avatar.png';?>"
              alt="Profile"
              class="rounded-full border-4 border-yellow-400 w-full h-full"
            />
            <button
              class="absolute -bottom-2 left-0 bg-yellow-400 rounded-full p-1"
            >
              <img src="assets/Edit.svg" class="w-6 h-6" />
            </button>
          </div>
          <h2 class="text-xl font-semibold"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></h2>
          <p class="text-sm text-gray-400"><?php echo $_SESSION['username']?></p>
          <button
            class="mt-2 flex items-center text-sm text-gray-400 hover:text-white" onclick="location.href='Logout'"
          >
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </div>

        <!-- Navigation Links -->
        <nav>
          <a
            href="adminDashboard"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2 active"
           
          >
            <i class="fas fa-th-large mr-3"></i> Overview
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="viewContact"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            
          >
            <i class="fas fa-file-alt mr-3"></i> Enquiry
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="refund"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            onclick=""
          >
            <i class="fas fa-newspaper mr-3"></i> Refund Rejection
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="demoArticles"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            onclick=""
          >
            <i class="fas fa-newspaper mr-3"></i> Post Articles
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="createAdmin"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
          >
            <i class="fas fa-credit-card mr-3"></i> Account Admin
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="Addcategories"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
          >
            <i class="fas fa-credit-card mr-3"></i> Categories
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="viewCallBackReq"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
          >
            <i class="fas fa-credit-card mr-3"></i> Call Back Request
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
        </nav>
      </aside>
      <!-- Main Content -->
      <main class="flex-1 p-6">
        <!-- Statistics Section -->
        <!-- Content Section -->
        <div id="content" class="space-y-6">
                 <section class="bg-white shadow-lg w-full lg:w-10/12 md:mx-auto pl-2 sm:pl-0 md:p-8 rounded-lg">
                <div class="md:p-6 rounded-lg">
                  <h3 class="text-2xl font-semibold mb-6 text-gray-800">Approve Articles</h3>
            <div class="flex justify-between items-center mb-4">
                <div class="relative w-64">
                    <input type="text" id="search" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search titles...">
                    <ul id="dropdown" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden"></ul>
                </div>
            </div>
            <div class="relative overflow-x-auto">
                    <table class="min-w-full text-left text-gray-600 border border-gray-300 rounded-lg overflow-hidden" id="table">
                        <thead class="bg-gray-800 text-white uppercase text-sm">
                    <tr class="bg-gray-50 text-blue-500">
                        <th class="p-4 text-center">
                            Articles
                        </th>
                        <th class="p-4 text-center">
                            Title
                        </th>
                        <th class="p-4 text-center">
                            Category
                        </th>
                        <th class="p-4 text-center">
                            Plan Type
                        </th>
                       
                        <th class="p-4 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                           

                </tbody>
            </table>
            
            
            
            </div>
            <div class="flex justify-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="flex justify-between mt-2 w-full" id="pagination-controls">
                    </ul>
                </nav>
            </div></div>
                 <!-- Loading Indicator -->
                    <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
                    </div>
            
        </section>
                
        </div>
      </main>
    </div>
    
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchArticles(page = 1,titles='') {
                 $("#loadingIndicator").removeClass('hidden');
                $.ajax({
                    url: 'admin/fetchArticle.php',
                    type: 'GET',
                    data: {
                        page: page,
                        title: titles
                    },
                    dataType: 'json',
                    success: function(data) {
                        const container = $('#table tbody');
                        container.empty();
                        console.log(data);
                        if(data.articles.length>0){
                        data.articles.forEach(function(article) {
                            // Convert comma-separated tags into an array

                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];

                            const articleHTML = `
                                         <tr class="hover:bg-gray-100 transition duration-200">
                                            <td class="py-2 px-4 border-b">
                                                <input type="hidden" value="${article.id}" id="docno"> 
                                                <img alt="${article.title}" class="h-12 w-12 rounded mr-4" height="50" src="${article.image}" width="50" />
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <a href="singlePost?title=${article.id}" style="text-decoration:none;" target="_balnk">${article.title}</a>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                ${article.category}
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                ${article.plan}
                                            </td>
                                            
                                           <td class="py-2 px-4 border-b flex-nowrap">
                                                <select class="approve-status bg-gray-50 border border-gray-300 rounded-lg  block md:w-full p-2.5 ">
                                                    <option>Choose Status</option>
                                                     <option value="Approved" ${article.approvestatus=='Approved'?'selected':''} class='text-green-300 hover:text-green-300'>Approved</option>
                                                    <option value="Pending" ${article.approvestatus=='Pending'?'selected':''} class='text-blue-300' hover:text-blue-300>Pending</option>
                                                    <option value="Declined" ${article.approvestatus=='Declined'?'selected':''} class='text-red-300 hover:text-red-300'>Declined</option>
                                                </select>
                                            </td>
                                        </tr>`;
                            container.append(articleHTML);
                        });
                        }else{
                             const articleHTML = `
                                         <tr class="hover:bg-gray-100 transition duration-200">
    <td colspan="5" class="text-center py-4">
        <img src="assets/img/no-data.png" alt="No data found" class="mx-auto mb-2 h-64" />
        <span class="text-gray-500">No Data Found</span>
    </td>
</tr>
`;container.append(articleHTML);
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

                            const pageLink = ` <li class="flex-1" class="page-item ${isActive}">
                                                    <a class="block py-2 px-4 text-center bg-blue-500 text-white font-bold page-link  ${isActive}" href="#" data-page="${i}">${i}
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
                    },complete:function(data){
                        
                        $("#loadingIndicator").addClass('hidden');
                        
                        
                    }
                    /* ,
                                        error: function(error) {
                                            console.error('Error fetching articles:', error);
                                            swal('Error fetching articles:');
                                        } */

                });
            }
            $('#pagination-controls').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                const page = parseInt($(this).data('page'));
                fetchArticles(page,'');
            });
            fetchArticles();

            const searchInput = $('#search');
            const dropdown = $('#dropdown');

            searchInput.on('input', function() {
                const query = $(this).val();

                if (query.length > 0) {
                    $.ajax({
                        url: 'admin/search.php',
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
                                        .addClass('px-4 py-2 hover:bg-blue-100 cursor-pointer')
                                        .text(title)
                                        .on('click', function() {
                                            searchInput.val(title);
                                            dropdown.addClass('hidden');
                                            fetchArticles(1,title);
                                        });

                                    dropdown.append(li);
                                });
                            } else {
                                dropdown.addClass('hidden');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error fetching search results:', error);
                        }
                    });
                } else {
                    dropdown.addClass('hidden');
                    fetchArticles(1,'');
                }
            });

            // Close dropdown when clicking outside
            $(document).on('click', function(event) {
                if (!$(event.target).closest('#search').length && !$(event.target).closest('#dropdown').length) {
                    dropdown.addClass('hidden');
                }
            });
            $('#table tbody').on('change','.approve-status',function () { 
                var status=$(this).find('option:selected').val();
                var id=$(this).closest('tr').find("#docno").val();
                 $("#loadingIndicator").removeClass('hidden');
                $.ajax({
                    type: "post",
                    url: "admin/approval.php",
                    data: {
                        status:status,
                        id:id
                    },
                    success: function (response) {
                        if(response=='success'){
                            swal('updated successfully');
                            setTimeout(() => {
                                location.reload();
                            }, 300);
                        }else{
                            swal('Contact Admin');
                        }
                    },
                    complete:function(data){
                         $("#loadingIndicator").addClass('hidden');
                    }
                });


             })
        });
    </script>
  </body>
</html>
