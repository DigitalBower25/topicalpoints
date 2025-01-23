<?php session_start();?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <title>Topical Points - Signup</title>
  <script src="https://cdn.tailwindcss.com"></script><!-- Add FontAwesome icons (for the eye icon) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="style.css" />
</head>

<body>
  <!-- Navbar -->
 <?php include('header.php');?>

  <!-- Sign In Form -->
  <section class="flex  max-container items-center justify-center my-10 pb-12">
    <div class="bg-white rounded-2xl card-light-shadow p-8  max-w-xl">
      <h2 class="text-3xl font-bold text-center mb-6">Sign Up</h2>
        <div id="g_id_onload" data-client_id="835293556640-eqshf1eoblncbp47kka061b1k0pho0ha.apps.googleusercontent.com" data-context="signin" style="width:100%" data-callback="handleCredentialResponse" data-auto_prompt="true"
        class="items-center justify-center"> 
            <div class="g_id_signin mx-auto justify-center pl-10 lg:pl-16 w-full  flex" style=" margin: 0 auto;">
           <button
          class="flex items-center justify-center w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-100 "
        ><img src="/assets/download.png" alt="Google Logo" class="h-5 mr-2 " />
          Sign in with Google</button></div>
    </div>
       
      <p class="text-center text-gray-500 my-4">or</p>
       <label class="success font-bold text-md justify-center items-center "></label>
      <form  action="#" method="POST" onsubmit="return false;" id="signup_form">
   <div class="grid gap-6 md:grid-cols-2">
          <div>
            <input type="text" id="first_name" name="first_name" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" placeholder="First name"  />
          </div>
          <div>

            <input type="text" id="last_name" name="last_name" class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" placeholder="Last name"  />
          </div>
        </div>
        <input
          type="email"
          placeholder="Email Address"
          class="w-full mb-4 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400"  id="email" name="email"/>
        <!-- Password field -->
        <div class="relative mb-4">
            <input type="password" id="password" name="password" placeholder="Password" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            <i class="fas fa-eye-slash absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-700 toggle-password" data-toggle="#password"></i>
        </div>
        <!-- Confirm Password field -->
        <div class="relative mb-4">
            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password" class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-orange-400">
            <i class="fas fa-eye-slash absolute right-3 top-1/2 transform -translate-y-1/2 cursor-pointer text-gray-500 hover:text-gray-700 toggle-password" data-toggle="#confirmPassword"></i>
        </div>
        <div class="flex justify-between items-center mb-4">
          <label class="flex items-center" for="terms">
            <input  class="mr-2 accent-orange-600 bg-white" type="checkbox" id="terms" name="terms"/>
            I agree to the terms and conditions
          </label>
        </div>
        <button
          class="bg-blue-600 text-white px-4 py-2 rounded-lg w-full font-semibold">
          Sign Up
        </button>
        
         <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
                    </div>
        
      </form>
      <p class="text-center mt-4 text-sm">
        Already have an account? <a href="signIn" class="text-orange-500">Sign In</a>
      </p>
    </div>
  </section>

  <!-- Footer -->
 <?php include('footer.php');?>
 
 <script src="https://accounts.google.com/gsi/client"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
  <script>
  

let googleSignInContainer = $("#g_id_signin");
let renderGoogleTimeout = 0;

window.addEventListener("resize", e => {
    clearTimeout(renderGoogleTimeout);
    renderGoogleTimeout = setTimeout(() => {
        googleSignInContainer.html("");   // clear contents of Google button container
        
        let w = googleSignInContainer.width(); // get current container's width
        google.accounts.id.renderButton(
            googleSignInContainer[0],
            {
                theme: "outline",
                width: w,
            }
        );
    }, 100);
})
    function handleCredentialResponse(response) {
      var xhr = new XMLHttpRequest();
      xhr.open('POST', 'fetch/verify_token.php');
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
      form.action = 'fetch/glsignup.php'; // PHP page to forward the data

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


 $(document).ready(function () {
    $("#signup_form").on('submit',function(){
        
         const password = $("#password").val();
      const confirmPassword = $("#confirmPassword").val();
      const errorMessage = document.getElementById('success');
      
      
    if($("#first_name").val()===''){
          $('.success').text (' First name fields must be filled do not left empty.'); $('.success').addClass('text-red-400');
       
        return false;
    }else if($("#last_name").val()===''){
          $('.success').text ('Last Name fields must be filled do not left empty.'); $('.success').addClass('text-red-400');
       
        return false;
       
    }else if($("#email").val()===''){
          $('.success').text ('Email fields must be filled need to be in correct format.'); $('.success').addClass('text-red-400');
       
        return false;
       
    }else if((password==='') || (confirmPassword==='')) {
           $('.success').text ('Both password fields must be filled do not left empty.'); $('.success').addClass('text-red-400');
       
        return false;
      }else if (password !== confirmPassword) {
        $('.success').text ('The passwords you entered do not match. Re-enter both fields.'); $('.success').addClass('text-red-400');
       
        return false;
      }else if (!$('#terms').is(':checked')) {
            $('.success').text("You must agree to the terms and conditions.").addClass('text-red-400'); // Show error message
            return false; // Exit the function without submitting the form
        }   else {
          
             const loadingIndicator = $('#loadingIndicator');
            loadingIndicator.removeClass('hidden');
         
            $.ajax({
            type: "POST",
            url: "fetch/signup_ajax.php",
            data: $("#signup_form").serialize(),
            success: function (response) {
              if(response=='1'){
                 $('.success').text('User created successfully! You can now log in with your credentials.');
                   $('.success').addClass('text-green-400');
                   setTimeout(function() {
                    window.location.href = 'signIn'; // Replace with your sign-in page URL
                }, 3000); // 3000 milliseconds = 3 seconds
              }else if(response=='2'){
                
                 $('.success').text('Fill missed values');
                   $('.success').addClass('text-red-400');
              }else if(response=='3'){
                  $('.success').text('User Aleady Exists');
                   $('.success').addClass('text-red-400');
                
              }else{
               
                $('.success').text('contact admin');
                   $('.success').addClass('text-red-400');
              }
            },
        complete: function(data) {
             loadingIndicator.addClass('hidden');
        }
           });
      }
       
    })
    
    
        $(document).ready(function() {
            $(".toggle-password").click(function() {
                const input = $($(this).attr("data-toggle"));
                const icon = $(this);
                
                if (input.attr("type") === "password") {
                    input.attr("type", "text");
                    icon.removeClass("fa-eye-slash").addClass("fa-eye");
                } else {
                    input.attr("type", "password");
                    icon.removeClass("fa-eye").addClass("fa-eye-slash");
                }
            });
        });
    
    
});
  </script>
</body>

</html>