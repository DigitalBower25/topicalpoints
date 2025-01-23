<!DOCTYPE html>
<?php
session_start();
include('connect.php');
$title = $_GET['title'];
$basehome='https://topicalpoints.com';
$sql="select id,enquiry from articles where slugtitle='$title'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();
$title=$row['id'];
$enquiry=$row['enquiry'];
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Article Detail</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo $basehome;?>/style.css" />
    <link rel="shortcut icon" href="<?php echo $basehome;?>/assets/img/favicon.png" type="image/x-icon">
  </head>

  <body>
    <!-- Navbar -->
    <?php include('header.php');?>

    <!-- Main Content -->
    <div class="flex max-container flex-col gap-6 md:flex-row p-8 lg:px-[100px]">
      <!-- Sidebar -->

      <!-- Article Section -->
      <main class="w-full md:w-3/5 lg:w-3/4 md:pl-6">
        <article class=" p-6 rounded-3xl" id="post-content">
          
        </article>
       
           <?php if($enquiry=='1'){?> <section class="bg-white p-6 rounded-3xl shadow-md mt-8 flex flex-col md:flex-row gap-4 md:gap-8 items-center justify-center">
               
 
  <button 
    class="bg-red-500 text-white rounded-md hover:bg-red-600  px-6 py-2  transition-colors duration-200 w-full md:w-auto text-lg font-semibold shadow-md hover:shadow-lg"
    onclick="openModal()"
  >
     Request a Call-Back
  </button>
</section> <?php } ?>


            
           

        <!-- Comment Section -->
        <section class="bg-white p-6 rounded-3xl shadow-md mt-8">
          <h2 class="text-xl font-semibold mb-4">Leave a Comment</h2>
          <form class="space-y-4" action="#" method="post" onsubmit="return false;" id="comment-form">
            <label id="error-message" class="text-red-500 mb-2 hidden"></label>  
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <input
                type="text"
                placeholder="Full name" name="cname" id="cname"
                class="border p-3 rounded-md w-full"
              />
              <input
                type="email"
                placeholder="Email address" name="cmail" id="cmail"
                class="border p-3 rounded-md w-full"
              />
            </div>
            <!-- <input
              type="text"
              placeholder="Subject"
              class="border p-3 rounded-md w-full"
            /> -->
            <textarea
              rows="4"
              placeholder="Message"
              class="border p-3 rounded-md w-full" name="comment" id="comment"
            ></textarea><input type="hidden" name="title" id="title" value="<?php echo $title; ?>">
            <button
              class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600"
            >
              Submit
            </button>
          </form>
        </section>

        <!-- Comments Display -->
        <section class="bg-white p-6 rounded-3xl shadow-md mt-8">
          <h2 class="text-xl font-semibold mb-4">Comments</h2>
          <ul class="space-y-4" id="comment-container">
            
            <!--<li class="flex space-x-4">
              <img
                src="assets/card-image.jpg"
                alt="Commenter"
                class="w-10 h-10 rounded-full"
              />
              <div>
                <h3 class="text-sm font-semibold">lorespm master</h3>
                <p class="text-xs text-gray-500">22 Nov 2024</p>
                <p class="text-sm">
                  It is a long established fact that a reader will be distracted
                  by the readable content.
                </p>
              </div>
            </li>-->
          </ul>
        </section>
      </main>
      <aside
        class="w-full md:w-2/5 lg:w-1/4 bg-white p-3 rounded-3xl shadow-md mb-8 md:mb-0"
      >
        <h2 class="text-xl font-semibold mb-4">Recent Posts</h2>
        <ul class="space-y-6" id="recent-posts">
         
         <!-- <li class="flex items-center space-x-4 pt-5">
            <img
              src="assets/card-image.jpg"
              alt="Author"
              class="w-10 h-10 rounded-full"
            />
            <div>
              <p class="text-sm font-bold">It is a long established fact</p>
              <p class="text-xs text-gray-500">22 Nov 2024</p>
            </div>
          </li>
          <p class="text-sm mt-0I  font-bold">
            It is a long established fact that a reader will be distracted
          </p>
          <p class="text-xs mt-0I  text-gray-500">
            It is a long established fact that a reader will be distracted by
            the readable content of a page when looking at its layout. The point
            of using Lorem Ipsum is that it has a more-or- less normal
            distribution
          </p> -->
        </ul>
      </aside>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-800 max-container text-white text-center py-4 mt-8">
      <p>&copy; 2024 TopicalPoints. All rights reserved</p>
      <p>
        <a href="#" class="hover:underline">Privacy Policy</a> |
        <a href="#" class="hover:underline">Terms of Use</a>
      </p>
    </footer>
    
    <!-- Modal Box -->
<div id="modal" class="fixed inset-0 bg-gray-500 bg-opacity-50 hidden justify-center items-center z-50">
      <div class="fixed inset-0 z-10 w-screen overflow-y-auto">
        <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
         
         <div class="bg-white p-6 rounded-3xl shadow-lg w-4/5 sm:w-3/4 md:w-1/2 lg:w-1/3">
    <h2 class="text-xl font-semibold mb-4">Request a Call-Back Form</h2>
    <form id="contactForm">
      <div class="mb-4">
        <label for="name" class="block text-sm font-semibold"></label>
        <input type="text" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required placeholder="Your Name"/>
      </div>
      <div class="mb-4">
        <label for="email" class="block text-sm font-semibold"></label>
        <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required placeholder="Your Email"/>
      </div>
      <div class="mb-4">
        <label for="phone" class="block text-sm font-semibold"></label>
        <div class="flex items-center">
                                        <select class="p-3  px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500 w-1/3" name="country_code" >
                                            <option value="US">🇺🇸 USA (+1)</option>
                                            <option value="IN">🇮🇳 India (+91)</option>
                                            <option value="GB">🇬🇧 UK (+44)</option>
                                            <option value="CA">🇨🇦 Canada (+1)</option>
                                            <option value="AU">🇦🇺 Australia (+61)</option>
                                            <option value="DE">🇩🇪 Germany (+49)</option>
                                            <option value="FR">🇫🇷 France (+33)</option>
                                            <option value="JP">🇯🇵 Japan (+81)</option>
                                            <option value="BR">🇧🇷 Brazil (+55)</option>
                                            <option value="AE">🇦🇪 UAE (+971)</option>
                                            <option value="SA">🇸🇦 SA(+966)</option>
                                        </select>
                                        <input type="number" max="999999999999" name="phone"  required placeholder="Phone" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500">
                                    </div>
      </div>
      <div class="mb-4">
        <label for="message" class="block text-sm font-semibold"></label>
        <textarea id="message" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-red-500" required placeholder="Your Message"></textarea>
      </div>
      <div class="mb-4">
        <label for="message" class="block text-sm font-semibold success"></label>
        
    </div>
      <div class="flex justify-between">
        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600" onclick="closeModal()">Cancel</button>
        <button type="submit" class="bg-red-500 text-white px-6 py-2 rounded-md hover:bg-red-600">Submit</button>
      </div>
      
      <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
                    </div>
    </form>
  </div>
          </div>
     </div>
</div>
  </body>
   <script src="<?php echo $basehome;?>/assets/js/jquery-3.7.1.min.js"></script>
    <script>
    $(document).ready(function() {
        
        $("#contactForm").on("submit", function(event) {
        event.preventDefault(); // Prevent the default form submission
    $("#loadingIndicator").removeClass('hidden');
        // Gather form data
        var formData = {
            name: $("#name").val(),
            email: $("#email").val(),
            country_code: $("select[name=country_code]").val(),
            phone: $("input[name=phone]").val(),
            message: $("#message").val()
        };

        // AJAX request
        $.ajax({
            url: "https://topicalpoints.com/calbackform.php",
            type: "POST",
            data: formData,
            success: function(response) {
                $(".success").text(response).addClass('text-green-500'); // Display success message
                $("#contactForm")[0].reset(); // Clear the form
                
                 setTimeout(function () {
                      $("#modal").addClass('hidden');
                 }, 2500);
               
            },complete:function(data){
              $("#loadingIndicator").addClass('hidden');  
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });
        
        
         $('#comment-form')[0].reset();
        function fetchContent(titles){
        $.ajax({
            url: 'https://topicalpoints.com/fetch/fetchContent.php',
            type: 'GET',
            data: {
                title: titles
            },
            dataType: 'json',
            success: function(data) {
                const container = $("#post-content");
                container.empty();
                console.log(data.length);
                if(Object.keys(data).length>0){
                data.articles.forEach(function(article) {
                    document.title = 'Detail Article'+article.title;
                    const fetchContent = `<div class="flex items-center space-x-4 mb-6">
            <img
              src="https://topicalpoints.com/${article.image}"
              alt="Author"
              class="w-12 h-12 rounded-full"
            />
            <div>
              <h3 class="text-lg font-semibold">${article.author}</h3>
              <p class="text-sm text-gray-500">${article.date}</p>
            </div>
          </div>
          <h1 class="text-3xl font-bold mb-4">${article.title}</h1>
          <p class="text-gray-700 leading-relaxed mb-4" id="artcontent">
           ${article.content}
          </p>
         `;
         
         


                    container.append(fetchContent);

                    if (article.plan === 'free') {
                        disableImagesForFreePlan();
                        disableHyperlinksForFreePlan();
                    }
                })
                
                
            }else{
                    const fetchContent = `<div class="flex items-center space-x-4 mb-6">
                                            <img
                                              src="assets/img/no-data.png"
                                              alt="Author"
                                              class="w-12 h-12 rounded-full"
                                            />
                                            <div>
                                              <h3 class="text-lg font-semibold"></h3>
                                              <p class="text-sm text-gray-500"></p>
                                            </div>
                                          </div>
                                          <h1 class="text-3xl font-bold mb-4"></h1>
                                          <p class="text-gray-700 leading-relaxed mb-4">
                                          </p>
                                          <img
                                            src="/assets/img/no-data.png" 
                                            alt="Article Image"
                                            class="w-40 h-48 rounded-md mb-4 align-center"
                                          />
                                          <p class="text-gray-700 leading-relaxed">
                                          </p> `;
                                          
                                           container.append(fetchContent);
                }
            }
        });
        }fetchContent($("#title").val());

   
         $.ajax({
                
                 url: 'https://topicalpoints.com/fetch/fetch_recentPost.php',
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const recntpost = $("#recent-posts");
                        recntpost.empty();
                        //console.log(data);

                        data.articles.forEach(function(article) {
                        
                            const content = article.content;
                            const recntposts = `<div className="my-4">
                            <a href='/article/${article.slug}' style="text-decoration-none;"> <li class="flex items-center space-x-4">
                                <img
                                  src="https://topicalpoints.com/${article.image}"
                                  alt="Author"
                                  class="w-7 h-7 rounded-full"
                                />
                                <div>
                                  <p class="text-sm font-bold">${article.author}</p>
                                  <p class="text-xs text-gray-500">${article.date}</p>
                                </div>
                              </li>
                              <p class="text-sm lg:ml-10 mt-2  font-bold">
                               ${article.title}
                              </p>
                              <p class="text-xs mt-2 lg:ml-10  text-gray-500  line-clamp-3">
                                ${content}
                              </p></a>
                            </div> `;
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
                    url: "https://topicalpoints.com/fetch/addComment.php",
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
            url: "https://topicalpoints.com/fetch/fetchComment.php",
            data: {
                id: $("#title").val()
            },
            dataType: 'json',
            success: function(response) {
                const comment_container = $("#comment-container");
                comment_container.empty();
                console.log(response);
                response.data.forEach(function(comments) {
                    const fcomment = `<li class="flex space-x-4">
              <img
                src="/assets/card-image.jpg"
                alt="Commenter"
                class="w-10 h-10 rounded-full"
              />
              <div>
                <h3 class="text-sm font-semibold"> ${comments.name}</h3>
                <p class="text-xs text-gray-500"> ${formatDate(comments.comment_date)}</p>
                <p class="text-sm">
                   ${comments.comment}
                </p>
              </div>
            </li>`;
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
           const postcontent=document.getElementById('artcontent');
            
            const links = postcontent.querySelectorAll('a');
            links.forEach(link => {
                link.removeAttribute('href');
                link.style.pointerEvents = 'none'; // Disables clicking
                link.style.color = 'gray'; // Optional: Visually indicate it's disabled
            });
        }

        function disableImagesForFreePlan() {
            const postcontent=document.getElementById('artcontent');
            const images = postcontent.querySelectorAll('img');
            images.forEach(img => {
                img.src = '';
                img.alt = 'Image disabled for free plan users'; // Optional: Set alt text
            });
        }

    });
    </script>
  
  
  
  
  <script>
    // JavaScript to toggle mobile menu visibility
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
      // Toggle the 'hidden' class to show or hide the menu
      mobileMenu.classList.toggle("hidden");
    });
  </script>
   <script>
              // Open the modal
              function openModal() {
                document.getElementById('modal').classList.remove('hidden');
              }
            
              // Close the modal
              function closeModal() {
                document.getElementById('modal').classList.add('hidden');
              }
            </script>
</html>
