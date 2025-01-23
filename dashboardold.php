<!DOCTYPE html>
<?php session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include_once('connect.php');

$sql_free = "select count(*) as free from articles WHERE plan='Basic' and user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_free);
$row = $result->fetch_assoc();
$free = $row['free'];

$sql_total = "SELECT COUNT(*) as total FROM articles WHERE user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_total);
$row = $result->fetch_assoc();
$total = $row['total'];

$sql_paid = "select count(*) as paid from articles where plan!='Basic' and user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_paid);
$row = $result->fetch_assoc();
$paid = $row['paid'];

?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Overview</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet" />
    <style>
        body {
            font-family: "Nunito", sans-serif;
        }
        .page-link.active {
            background-color: #2563eb; /* Darker blue */
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body class="bg-gray-100">
    <!-- Header -->
    <?php include_once('header.inc.php'); ?>
    <section
        class="bg-cover bg-center h-32"
        style="background-image: url('assets/img/banner1.jpg'); opacity: 0.8">
        <div class="container mx-auto h-full flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold">Overview</h1>
                <p>Home / Dashboard / Overview</p>
            </div>
        </div>
    </section>

    <main
        class="container mx-auto px-4 py-16 md:px-12 lg:px-20 xl:px-32 2xl:px-20 flex flex-col md:flex-row space-y-16 md:space-y-0 md:space-x-6">
        <!-- Sidebar section -->
        <?php include_once('sidebar.inc.php'); ?>

        <!-- Main content section -->
        <section class="bg-slate-50 shadow md:w-5/6 sm:1/4 ml-4">
            <div class="rounded-lg p-6">
                <!-- Page header -->
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Overview</h1>
                    <nav class="text-gray-500 hidden sm:block">
                        <a class="hover:text-blue-500" href="#">Home</a> /
                        <a class="hover:text-blue-500" href="#">Dashboard</a> /
                        <span>Overview</span>
                    </nav>
                </div>
                <!-- Stats section -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">
                    <div class="bg-amber-400 shadow rounded-lg p-4 text-center p-8">
                        <div class="text-3xl font-bold"><?= $total; ?></div>
                        <div class="text-gray-800">Total Articles</div>
                    </div>
                    <div class="bg-orange-500 shadow rounded-lg p-4 text-center  p-8">
                        <div class="text-3xl font-bold"><?= $paid; ?></div>
                        <div class="text-gray-800">Paid Articles</div>
                    </div>
                    <div class="bg-cyan-500 shadow rounded-lg p-4 text-center  p-8">
                        <div class="text-3xl font-bold"><?= $free; ?></div>
                        <div class="text-gray-800">Free Articles</div>
                    </div>
                </div>
                <!-- Recent ads section -->
                <div class="flex justify-between items-center mb-4 rcent-posts">
                    <h2 class="text-xl font-bold">Recently Posted Blogs</h2>
                    <a class="text-blue-500 hover:underline" href="blogList.php">View All</a>
                </div>
                <!-- Ads cards grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8" id="article-container">

                </div>
                <div class="w-full flex justify-center mt-6">
                    <nav aria-label="Page navigation">
                        <ul class="flex justify-center space-x-2" id="pagination-controls">
                        </ul>
                    </nav>
                </div>
            </div>
        </section>
    </main>
    <!-- Footer -->
    <?php include_once('footer.inc.php'); ?>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            function fetchArticles(page = 1) {
                $.ajax({
                    url: 'fetch/fetchArticle.php',
                    type: 'GET',
                    data: {
                        page: page,
                        limit: 4
                    },
                    dataType: 'json',
                    success: function(data) {
                        const container = $('#article-container');
                        container.empty();
                        console.log(data);
                        if(data.articles.length>0){
                        data.articles.slice(0, 3).forEach(function(article) {
                            // Convert comma-separated tags into an array
                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];
                            const content = article.content;
                            const articleHTML = `<div class="bg-white p-4 rounded-lg shadow-md">
                                                    <img src="${article.image}" alt="${article.title}"
                                                        class="w-full h-48 object-cover mb-4" />
                                                    <div class="flex justify-start items-center mb-2">
                                                        <span class="text-red-500 font-semibold">${article.author} </span>
                                                        <span class="text-gray-500 text-sm">&nbsp;
                                                            ${article.date}</span>
                                                    </div>
                                                    <h3 class="text-lg font-semibold mb-2 text-center">${article.title}</h3>
                                                    <p class="line-clamp-3 mb-2">${content}</p>
                                                    <div class="col-span-3 flex flex-wrap row">
                                                    ${tags.map(tag => `<span
                                                        class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 mb-1 rounded dark:bg-blue-900 dark:text-blue-300">${tag}</span>`).join('')}
                                                    </div>
                                                    <div class="col-span-2 flex justify-end">
                                                    <a href="singlePost.php?title=${article.id}" class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white rounded text-sm px-2.5 py-0.5">Read more</a>   </div>
                                                </div>`;
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
                        } else{
    $('.rcent-posts').hide();
   $("#pagination-controls").css("display","none");
            }  
                    /* ,
                                        error: function(error) {
                                            console.error('Error fetching articles:', error);
                                            swal('Error fetching articles:');
                                        } */

        }
                
                   
            });       
                    }
            
            
            
            
            $('#pagination-controls').on('click', 'a.page-link', function(event) {
                event.preventDefault();
                const page = parseInt($(this).data('page'));
                fetchArticles(page);
            });
            fetchArticles();
        });
    </script>
</body>

</html>