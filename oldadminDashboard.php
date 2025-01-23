<!DOCTYPE html>
<?php session_start();
include_once('connect.php');
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin') {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Approve Articles</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@^2.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    <?php include_once('header.inc.php'); ?>
    <main
        class="container mx-auto px-4 py-16 md:px-12 lg:px-20 xl:px-32 2xl:px-20 flex flex-col md:flex-row space-y-16 md:space-y-0 md:space-x-6">
        <!-- Sidebar section -->
<aside
    id="sidebar"
    class="sm:inline md:block w-fit md:w-1/4 bg-white shadow rounded-lg p-4 fixed md:relative md:h-full hidden">
    <div class="flex items-center mb-4">
        <img
            alt="User Avatar"
            class="h-12 w-12 rounded-full"
            src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/img/avatar.png';?>" />
        <div class="ml-4">
            <div class="text-lg font-bold"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></div>
            <div class="text-gray-500">Member</div>
        </div>
    </div>
    <nav class="space-y-4">
        <a href="adminDashboard" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-100 rounded-md">
            <i class="fas fa-th-large mr-3"></i> Overview
        </a>
        <a href="viewContact" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-100 rounded-md">
            <i class="fas fa-plus mr-3"></i> Enquiry
        </a>
        <a href="refund" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-100 rounded-md">
            <i class="fas fa-cog mr-3"></i> Refund Rejection
        </a>
        <a href="createAdmin" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-100 rounded-md">
            <i class="fas fa-user-cog mr-3"></i> Account Admin
        </a>
        <a href="Logout" class="flex items-center px-4 py-2 text-gray-600 hover:bg-blue-100 rounded-md">
            <i class="fas fa-sign-out-alt mr-3"></i> Sign Out
        </a>
    </nav>
</aside>

        <section class="w-full md:w-3/4 shadow  bg-gray-200 p-6">
            <div class="flex justify-between items-center mb-4">
                <div class="relative w-64">
                    <input type="text" id="search" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="Search titles...">
                    <ul id="dropdown" class="absolute w-full mt-1 bg-white border border-gray-300 rounded-lg shadow-lg hidden"></ul>
                </div>
            </div>
            <div class="overflow-x-auto">
            <table class="w-full bg-white shadow rounded-lg " id="table">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-4 text-center">
                            Articles
                        </th>
                        <th class="p-4 text-center">
                            Title
                        </th>
                        <th class="p-4 text-center">
                            Tags
                        </th>
                        <th class="p-4 text-center">
                            Plan Type
                        </th>
                       
                        <th class="p-4 text-center">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table></div>
            <div class="flex justify-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="flex justify-between mt-2 w-full" id="pagination-controls">
                    </ul>
                </nav>
            </div>
        </section>
        </div>
    </main>
    <!-- Toggle Button for Mobile -->
<button id="toggleSidebar" class="fixed bottom-4 right-4 bg-gray-600 text-white rounded-full p-2 md:hidden">
    <i class="fas fa-bars"></i>
</button>

    <?php include_once('footer.inc.php'); ?>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

<!-- JavaScript for Toggle Functionality -->
<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden'); // Toggle the hidden class
    });
    $(document).on('click',function(){
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden'); // Toggle the hidden class
    })
</script>

<style>
    /* Additional CSS for the toggle button */
    #toggleSidebar {
        position: fixed;
        bottom: 20px;
        right: 80px;
        z-index: 1000; /* Ensure it's above other elements */
    }

    @media (min-width: 768px) {
        #toggleSidebar {
            display: none; /* Hide toggle button on larger screens */
        }
    }
</style>
    <script>
        $(document).ready(function() {
            function fetchArticles(page = 1,titles='') {
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
                        data.articles.forEach(function(article) {
                            // Convert comma-separated tags into an array

                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];

                            const articleHTML = `
                                        <tr class="border-b text-center">
                                            <td class="p-4 flex items-center">
                                                <input type="hidden" value="${article.id}" id="docno"> 
                                                <img alt="${article.title}" class="h-12 w-12 rounded mr-4" height="50" src="${article.image}" width="50" />
                                            </td>
                                            <td class="p-4">
                                                <a href="singlePost?title=${article.id}" style="text-decoration:none;" target="_balnk">${article.title}</a>
                                            </td>
                                            <td class="p-4">
                                                ${article.tags}
                                            </td>
                                            <td class="p-4 text-green-600">
                                                ${article.plan}
                                            </td>
                                            
                                            <td class="p-4 flex flex-nowrap">
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

                            const pageLink = ` <li class="flex-1" class="page-item${isActive}">
                                                    <a class="block py-2 px-4 text-center bg-blue-500 text-white font-bold page-link" href="#" data-page="${i}">${i}
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
                //makeAjaxCall();
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
                    }
                });


             })
        });
    </script>
</body>

</html>