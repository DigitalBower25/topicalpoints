<!DOCTYPE html>
<?php session_start();?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Topical Points - Reset Password</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <link rel="stylesheet" href="style.css" />
  </head>

  <body>

    <?php include('header.php');?>


    <div class="container mx-auto px-4 md:px-8 py-8">
        
           
            <section class="flex items-center justify-center my-10 px-4 pb-12">
    <div class="bg-white rounded-2xl card-light-shadow p-8 w-full max-w-xl">
      
      <h2 class="text-3xl font-bold text-center mb-6">Reset Password</h2>
      
       <label class="font-bold text-center mb-6" id="responseMessage"></label>
     
      <form onsubmit="return false;" id="signup" method="POST">
          
    <input type="hidden" name="token" id="token" value="<?php echo $_GET['token']; ?>">
      
        <input type="password" name="password" placeholder="New password" id="password" required class=" w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400">
            
        <button
          class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full font-semibold" onclick="resetPassword()">
          Reset Password
        </button>
      </form>
      <p class="text-center mt-4 text-sm">
        Don't have an account? <a href="signIn" class="text-orange-500">Sign in</a>
      </p>
    </div>
  </section>
           
           
           
        </div>
    </div>
        <?php include('footer.php');?>
        <script src="assets/js/jquery-3.7.1.min.js"></script>
        <script>
        function resetPassword() {
            $.ajax({
                url: 'fetch/update_password.php',
                type: 'POST',
                data: {
                    token: $('#token').val(),
                    password: $('#password').val()
                },
                success: function(response) {
                    $('#responseMessage').text(response.message).addClass('text-orange-600');
                },
                error: function() {
                    $('#responseMessage').text("An error occurred. Please try again.");
                }
            });
        }
    </script>
</body>
</html>
