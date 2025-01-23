<?php

$title = $_GET['title'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Blog Post</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet" />
    <style>
    body {
        font-family: "Nunito", sans-serif;
    }
    </style>
</head>

<body class="bg-white-100">
    <!-- Header -->
    <?php include_once('header.inc.php'); ?>
    <section class="bg-cover bg-center h-32" style="background-image: url('assets/img/banner1.jpg'); opacity: 0.8">
        <div class="container mx-auto h-full flex items-center justify-center">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold">Single Post</h1>
                <p>Home / Dashboard / Overview</p>
            </div>
        </div>
    </section>

    <main
        class="mx-auto justify-center px-4 py-16 md:px-12 lg:px-20 xl:px-32 2xl:px-20 space-y-16 md:space-y-0 md:space-x-6">
        <!-- Single Blog Section -->

        <section class="bg-slate-50 ml-4">
            <div class="container mx-auto p-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Blog Posts -->
                <div class="md:col-span-2 space-y-8">
                    <div class="max-w-4xl mx-auto" id="post-content">

                    </div>
                    <div class="max-w-4xl mx-auto">
                        <div class="comment-section mt-4 bg-neutral-200 p-3">
                            <h2 class="text-2xl font-bold">
                                Leave a comment
                            </h2>
                            <div id="loading" class="hidden fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
                              <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
                            </div>
                           <form class="mt-4" action="#" method="post" onsubmit="return false;" id="comment-form">
    <label id="error-message" class="text-red-500 mb-2 hidden"></label>
    <div class="grid grid-cols-4 gap-4 mb-4">
        <div class="col-span-1"><input class="w-full px-3 py-2 border rounded bg-white text-dark "
            placeholder="Full name" type="text" name="cname" id="cname" /></div>
        <div class="col-span-1"><input class="w-full px-3 py-2 border rounded bg-white text-dark "
            placeholder="Email address" type="email" name="cmail" id="cmail" /></div>
        <div class="col-span-2">    
        <textarea class="w-full px-3 py-2 border rounded bg-white text-dark"
            placeholder="What's your thought..." name="comment" id="comment"></textarea></div>
        <input type="hidden" name="title" id="title" value="<?php echo $title; ?>">
    </div>
    <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded" type="submit">
        Post Comment
    </button>
</form>

                        </div>
                        <div class="comment-section mt-4">
                            <h2 class="text-2xl font-bold">
                                Comments
                            </h2>
                            <div class="comment mt-4" id="comment-container">

                            </div>

                            <button class="mt-4 px-4 py-2 bg-blue-500 text-white rounded flex items-center">
                                <i class="fas fa-sync-alt mr-2">
                                </i>
                                Load More
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Search Box -->
                <div class="md:col-span-1 space-y-6">
                    <!-- Recent Post -->
                    <div class="p-6 bg-gray-50 rounded-lg space-y-4">
                        <h3 class="font-semibold">Recent Post</h3>
                        <div class="space-y-4" id="recent-posts">

                            <!-- Add more recent posts here -->
                        </div>


                    </div>
                </div>

            </div>
            <!-- Pagination -->
        </section>
    </main>
    <!-- Footer -->
    <?php include_once('footer.inc.php'); ?>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {
         $('#comment-form')[0].reset();
        function fetchContent(titles){
        $.ajax({
            url: 'fetch/fetchContent.php',
            type: 'GET',
            data: {
                title: titles
            },
            dataType: 'json',
            success: function(data) {
                const container = $("#post-content");
                container.empty();
                console.log(data);
                data.articles.forEach(function(article) {
                    document.title = article.title;
                    const fetchContent = `<div class="flex flex-wrap items-center text-blue-500 mt-4">
                            <i class="fas fa-tag mr-2">
                            </i>
                            <span>
                                 ${article.tags}
                            </span>
                            <i class="fas fa-user ml-4 mr-2">
                            </i>
                            <span>
                                ${article.author}
                            </span>
                            <i class="fas fa-comments ml-4 mr-2">
                            </i>
                            <span>
                                36 Comments
                            </span>
                        </div>
                        <h1 class="text-3xl font-bold mt-4" id="title">
                             ${article.title}
                        </h1>
                        <div id="content">
                        ${article.content}
                        </div>`;


                    container.append(fetchContent);

                    if (article.plan === 'free') {
                        disableImagesForFreePlan();
                        disableHyperlinksForFreePlan();
                    }
                })
            }
        });
        }fetchContent($("#title").val());

   
         $.ajax({
                
                 url: 'fetch/fetch_recentPost.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const recntpost = $("#recent-posts");
                        recntpost.empty();
                        //console.log(data);

                        data.articles.forEach(function(article) {
                        
                            const content = article.content;
                            const recntposts = `<div class="flex flex-auto">
                                <img src="${article.image}" alt="${article.title}" class="w-16 h-16 rounded-lg">
                                <div>
                                    
                                    <a href="singlePost.php?title=${article.id}" class=""><p class="text-gray-600 text-sm line-clamp-2 p-3 mb-2  hover:text-blue-600  md:text-base">${article.title}</p></a>
                                    <span class="text-sm text-gray-400">${article.date} · 47 Comments</span>
                                </div>
                            </div>`;
                            recntpost.append(recntposts);
                        
                        });
                    }
            })

        $("#comment-form").on('submit', function(event) {
            function validateForm(event) {
                //event.preventDefault(); // Prevent form submission for validation
                const cname = document.getElementById('cname').value.trim();
                const cmail = document.getElementById('cmail').value.trim();
                const comment = document.getElementById('comment').value.trim();
                const errorMessage = document.getElementById('error-message');

                // Validation logic
                if (!cname) {
                     errorMessage.style.display = 'block';
                    errorMessage.textContent = 'Please fill out name field.';
                    return false;
                }
                if(!cmail){
                     errorMessage.style.display = 'block';
                    errorMessage.textContent = 'Please fill out email field.';
                    return false;
                } if(!comment) {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = 'Please fill out comment field.';
                    return false;
                }

                // Email validation regex
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(cmail)) {
                    errorMessage.style.display = 'block';
                    errorMessage.textContent = 'Please enter a valid email address.';
                    return false;
                }

                errorMessage.style.display = 'none';
                // Proceed with form submission logic if needed
                return true;
            }

            if (validateForm()) {
                $('#loading').removeClass('hidden');
                $.ajax({
                    method: "POST",
                    url: "fetch/addComment.php",
                    data: $("#comment-form").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response === 'success') {
                            $("#error-message").removeClass('text-red-500');
                            $("#error-message").text('Comment Added Successfully');
                            $("#error-message").addClass('text-green-500');
                            $('#comment-form')[0].reset();
                            setTimeout(() => {
                                location.reload();
                            }, 3000);
                           
                        } else {
                            console.log(response);
                            $("#error-message").text('Fill all Required values');
                        }
                    },
                    
                     complete: function() {
                    // Hide loading spinner
                    $('#loading').addClass('hidden');
                  }
                });
            }
        });

        $.ajax({
            type: "GET",
            url: "fetch/fetchComment.php",
            data: {
                id: $("#title").val()
            },
            dataType: 'json',
            success: function(response) {
                const comment_container = $("#comment-container");
                comment_container.empty();
                console.log(response);
                response.data.forEach(function(comments) {
                    const fcomment = ` <p class="text-gray-400">
                                    ${comments.name}
                                    <span class="text-gray-600">
                                        ${formatDate(comments.comment_date)}
                                    </span>
                                </p>
                                <p>
                                   ${comments.comment}
                                </p>`;
                    comment_container.append(fcomment);
                })
            }
        });

        
            
             // Add click event listener to all span elements within #popular-tags
       $('#popular-tags').on('click', 'span', function() {
            // Get the text content of the clicked span
            const tagValue = $(this).text();
            fetchArticles(1,'',tagValue);
              // Change the background color to blue-500 (using Tailwind CSS)
            $(this).removeClass('bg-gray-200').addClass('bg-blue-500');
        });
           




        function validateForm(event) {
            event.preventDefault(); // Prevent form submission for validation
            const cname = document.getElementById('cname').value.trim();
            const cmail = document.getElementById('cmail').value.trim();
            const comment = document.getElementById('comment').value.trim();
            const errorMessage = document.getElementById('error-message');

            // Validation logic
            if (!cname || !cmail || !comment) {
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'Please fill out all fields.';
                return false;
            }

            // Email validation regex
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(cmail)) {
                errorMessage.style.display = 'block';
                errorMessage.textContent = 'Please enter a valid email address.';
                return false;
            }

            errorMessage.style.display = 'none';
            // Proceed with form submission logic if needed
            return true;
        }

        function formatDate(dateString) {
            var months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
            var parts = dateString.split("-");

            var year = parts[0];
            var month = months[parseInt(parts[1], 10) - 1]; // Get month name
            var day = parseInt(parts[2], 10); // Remove leading zeros

            return day + " " + month + ", " + year;
        }

       function disableHyperlinksForFreePlan() {
           const postcontent=document.getElementById('post-content');
            
            const links = postcontent.querySelectorAll('a');
            links.forEach(link => {
                link.removeAttribute('href');
                link.style.pointerEvents = 'none'; // Disables clicking
                link.style.color = 'gray'; // Optional: Visually indicate it's disabled
            });
        }

        function disableImagesForFreePlan() {
            const postcontent=document.getElementById('post-content');
            const images = postcontent.querySelectorAll('img');
            images.forEach(img => {
                img.src = '';
                img.alt = 'Image disabled for free plan users'; // Optional: Set alt text
            });
        }

    });
    </script>

</body>

</html>