<!DOCTYPE html>
<?php session_start();?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <title>Topical Points - Signin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="style.css" />
  <link  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"  rel="stylesheet" />
</head>

<style>
  .haAclf{
    display: block;
  }
  </style>
<body>
  <!-- Navbar -->
<?php include('header.php');?>
  <!-- Sign In Form -->
  <section class="flex items-center justify-center my-10 px-4 pb-12">
    <div class="bg-white rounded-2xl card-light-shadow p-8 w-full max-w-xl">
      
      <h2 class="text-3xl font-bold text-center mb-6">Sign In</h2>
       <div id="g_id_onload" data-client_id="835293556640-eqshf1eoblncbp47kka061b1k0pho0ha.apps.googleusercontent.com" data-context="signin" class="lg:w-[60%] md:ml-32 ml-10 flex justify-center mx-auto"  data-callback="handleCredentialResponse" data-auto_prompt="false">
            <div
          class="g_id_signin w-full block "
          data-type="standard"
          data-size="large"
          data-theme="outline"
          data-shape="rectangular"

          data-text="continue_with"
          data-logo_alignment="center"
          data-width="100%"
        />
      </div>
       </div>
       
      <p class="text-center text-gray-500 my-4 success">or</p>
      <form onsubmit="return false;" id="signup">
        <input
          type="text"
          placeholder="Username or email address"
          class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" id="username" name="username" />
        
            <div class="relative mb-4">
            <input type="password" id="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            <i class="fas fa-eye absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-orange-400 toggle-password" data-toggle="#password"></i>
        </div>
        <div class="flex justify-between items-center mb-4">
          <label class="flex items-center">
            <input type="checkbox" class="mr-2 accent-orange-400" id="rememberMe"/>
            Keep me logged in
          </label>
          <a href="forgot_password" class="text-orange-500 text-sm">Forgot password?</a>
        </div>
        <button
          class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full font-semibold">
          Sign In
        </button>
      </form>
      <p class="text-center mt-4 text-sm">
        Don't have an account? <a href="signup" class="text-orange-500">Sign Up</a>
      </p>
    </div>
  </section>

  <?php include('footer.php');?>
  
   <script src="https://accounts.google.com/gsi/client" async defer></script>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.5/dist/js.cookie.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>  
  <script>
document.getElementById("g_id_onload").addEventListener("click", function() {
  
        google.accounts.id.prompt(); // Manually triggers the sign-in prompt
    });
    
   
    function handleCredentialResponse(response) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', '../fetch/verify_token.php');
      xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
      xhr.setRequestHeader('Access-Control-Allow-Origin', '*');
      xhr.setRequestHeader('Cross-Origin-Resource-Policy', 'same-site');
      referrerPolicy: {
  policy: 'strict-origin-when-cross-origin'
}
      xhr.onload = function() {
        if (xhr.status === 200) {
          // Assume the response is the form data you want to send to the next page
          var serverResponse = xhr.responseText;

          // Call function to forward to another page with the response data
          forwardToNextPage(serverResponse);
        } else {
          console.error('An error occurred');
        }
      };
      xhr.send('credential=' + response.credential);
    }

    function forwardToNextPage(formData) {
      // Create a new form element
      var form = document.createElement('form');
      form.method = 'POST'; // Use POST method
      form.action = '../fetch/glsignup.php'; // PHP page to forward the data

      // Create an input element to hold the formData
      var input = document.createElement('input');
      input.type = 'hidden'; // Hidden input
      input.name = 'data'; // Form field name
      input.value = formData; // Pass the responseText from AJAX as form data

      // Append the input to the form
      form.appendChild(input);

      // Append form to the body (it must be in the DOM to submit)
      document.body.appendChild(form);

      // Submit the form programmatically
      form.submit();
    }

    
    $(document).ready(function() {
  // Populate fields if the cookies exist
  if ($.cookie('username') && $.cookie('password')) {
    $('#username').val($.cookie('username'));
    $('#password').val($.cookie('password'));
    //$('#rememberMe').prop('checked', true);
  }

  // On form submit
    $("#signup").on("submit",  function(e) {
    e.preventDefault();

    var username = $('#username').val();
    var password = $('#password').val();
    var rememberMe = $('#rememberMe').is(':checked');

    // Save credentials if 'Remember Me' is checked
    if (rememberMe) {
      $.cookie('username', username, { expires: 7 }); // Save for 7 days
      $.cookie('password', password, { expires: 7 }); // Save for 7 days
    } else {
      // Clear cookies if not checked
      $.removeCookie('username');
      $.removeCookie('password');
    }

    // Use AJAX to submit the form data to the server
 
            e.preventDefault();
        
            var username = $('#username').val();
            var password = $('#password').val();
            var rememberMe = $('#rememberMe').is(':checked');
        
            // Save credentials if 'Remember Me' is checked
            if (rememberMe) {
              $.cookie('username', username, { expires: 7 }); // Save for 7 days
              $.cookie('password', password, { expires: 7 }); // Save for 7 days
            } else {
              // Clear cookies if not checked
              $.removeCookie('username');
              $.removeCookie('password');
            }
            
        if(username!=='' || password!==''){    
        $.ajax({
          method: "POST",
          url: "fetch/signin_ajax.php",
          data: {
            username: $("#username").val(),
            password: $("#password").val()
          },
          success: function(response) {
             if (response == 1) {
              $('.success').text('Login Successfully');
              $('.success').addClass('text-green-400');
              location.href = "dashboard";
            } else if (response == 2) {
              location.href = "dashboard";
            } else if (response == 3) {
              location.href = "adminDashboard";
            } else {
              $('.success').text(response);
               $('.success').addClass('text-red-400');
            }
          }
        });
        }else{
                $('.success').text('Either username or password cannot be empty');
               $('.success').addClass('text-red-400');
        }
     
  });
});

 $(document).ready(function() {
            $(".toggle-password").click(function() {
                const input = $($(this).attr("data-toggle"));
                const icon = $(this);
                
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                }
            });
        });
  </script>
</body>

</html>