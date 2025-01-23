<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Topical Points - Forgot Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>

    <?php include('header.php');?>


    <div class="container mx-auto px-4 md:px-8 py-8">
        
           
            <section class="flex items-center justify-center my-10 px-4 pb-12">
    <div class="bg-white rounded-2xl card-light-shadow p-8 w-full max-w-xl">
      
      <h2 class="text-3xl font-bold text-center mb-6">Forgot Password</h2>
      
       
     
      <form id="signup" method="post" onsubmit="return false;">
          <div id="responseMessage"></div>
   
        <input
          type="email"
          placeholder="Email address"
          class=" w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" name="email" id="email" />
        
            
        <button
          class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full font-semibold"  onclick="submitForgotPassword()">
          Send Reset Link
        </button>
      </form>
      <p class="text-center mt-4 text-sm">
        Don't have an account? <a href="signup" class="text-orange-500">Sign Up</a>
      </p>
    </div>
  </section>
           
           
           
        </div>
    </div>
        <?php include('footer.php');?>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script>
             function submitForgotPassword() {
                // Send AJAX request
                $.ajax({
                    url: 'fetch/send_reset_link.php', // PHP file that handles the reset link
                    type: 'POST',
                    data: {
                        email: $('#email').val() // Get the email input value
                    },
                    success: function(response) {
                        $('#responseMessage').text(response.message);
                    },
                    error: function() {
                        $('#responseMessage').text("An error occurred. Please try again.");
                    }
                });
        }
            
            
        </script>
    
</body>
</html>
