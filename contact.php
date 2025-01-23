<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Topical Points - Contact</title>
  <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="style.css" />
      <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
</head>

<body>
  <!-- Navbar -->
 <?php include('header.php');?>

  <!-- Sign In Form -->


  <!-- Contact Section -->
  <section class="py-12 px-6 md:px-[100px]">
    <div class="max-container">
      <div class="text-center mb-8">
        <p class="text-gray-500">Reach out with your inquiries, feedback, or ideas!</p>
        <h2 class="text-4xl font-bold mt-2">Let's Connect</h2>
      </div>
      
      <div class="lg:flex flex-col md:flex-row justify-center gap-8">
        <!-- Contact Info -->
        
<div class="bg-white rounded-3xl card-light-shadow p-8 w-full lg:w-1/2">
  <h3 class="text-4xl font-medium mb-4">Contact Info</h3>
  
  <div class="text-gray-700 text-xl mb-2 flex items-center">
    <i class="fa fa-envelope mr-2" aria-hidden="true"></i>
    <span>info@topicalpoints.com</span>
  </div>
  
  <div class="text-gray-700 text-xl flex items-start">
    <i class="fa fa-map-marker mr-2" aria-hidden="true"></i>
    <span>
      Digital Bower FZ -LLC,<br>
      Ras Al Khaimah Economic Zone,<br>
      United Arab Emirates
    </span>
  </div>
</div>


        <!-- Send Message Form -->
        <div
          class="bg-white rounded-3xl card-light-shadow p-8 w-full lg:w-1/2">
          <h3 class="text-2xl font-bold mb-4">Send Message</h3>
          <label class="success text-center"></label>
          <form action="#" id="contact_form" onsubmit="return false;">
            <div class="flex flex-col md:flex-row gap-4 mb-4">
              <input
                type="text"
                placeholder="Full name"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400"  name="name" required />
              <input
                type="email"
                placeholder="Email address"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400"  name="email" required  />
            </div>
            <input
              type="text"
              placeholder="Subject"
              class="w-full mb-4 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" name="subject" required/>
            <textarea
              placeholder="Message"
              rows="4"
              class="w-full mb-4 px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" name="message" required></textarea>
            <button
              class="bg-[#ff914d] text-white px-4 py-3 rounded-lg font-semibold w-40">
              Submit
            </button>
            
             <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
          </form>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <?php include('footer.php');?>
   <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script>
      $(document).ready(function(){
          $("#contact_form").on('submit',function(){
              $("#loadingIndicator").removeClass('hidden');
                  $.ajax({
                  method: "POST",
                  url: "fetch/saveContact.php",
                  data:$("#contact_form").serialize(),
                  success: function(response) {
                 if (response == 1) {
                  $(".success").text('Enquiry Added Successfully').addClass('text-green-500');
                  setTimeout(function () {
                    // Send a request to clear session data after 5 seconds
                    location.href = "contact.php";
                 }, 3000);
                  
                } else {
                  $(".success").text('contact admin');
                }
              },complete:function(data){
                  $("#loadingIndicator").addClass('hidden');
              }
            });
        })

      })
  </script>
</body>

</html>