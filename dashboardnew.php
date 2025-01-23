<!DOCTYPE html>
<?php session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
if($_SESSION['usertype'] == 'admin'){
     header("Location: adminDashboard.php");
    exit();
}
include_once('connect.php');

$sql_free = "select count(*) as paid from articles WHERE user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_free);
$row = $result->fetch_assoc();
$paid = $row['paid'];

$sql_total = "SELECT COUNT(*) as published FROM articles WHERE user_id='".$_SESSION['username']."' AND approvestatus='approved'";
$result = $conn->query($sql_total);
$row = $result->fetch_assoc();
$published = $row['published'];

$sql_paid = "select count(*) as draft from articles where user_id='".$_SESSION['username']."' AND approvestatus='Pending'";
$result = $conn->query($sql_paid);
$row = $result->fetch_assoc();
$draft = $row['draft'];

$sql_reject = "select count(*) as reject from articles where user_id='".$_SESSION['username']."' AND approvestatus='Decline'";
$result = $conn->query($sql_reject);
$row = $result->fetch_assoc();
$reject = $row['reject'];


/** Profile Tab Data start **/
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$email = $_SESSION['email'];
$phone=$_SESSION['phone'] ;
$address=$_SESSION['address'];
$propic=$_SESSION['propic'];
$selectedCountry = isset($_SESSION['countrycode']) ? $_SESSION['countrycode'] : 'US';
/** Profile Tab Data end **/

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard </title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
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
    <?php require('sidebar.inc.php');?>
      <!-- Main Content -->
      <main class="flex-1 p-6">
        <!-- Statistics Section -->
      

        <!-- Content Section -->
        <div id="content" class="space-y-6">
          <div id="myProfile" class="lg:w-10/12 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
              <div class="bg-yellow-100 p-6 rounded-lg text-center shadow">
                <h3 class="text-4xl font-bold"><?= $paid;?></h3>
                <p class="text-sm">Total Articles</p>
              </div>
              <div class="bg-green-100 p-6 rounded-lg text-center shadow">
                <h3 class="text-4xl font-bold"><?= $published;?></h3>
                <p class="text-sm">Published Articles</p>
              </div>
              <div class="bg-pink-100 p-6 rounded-lg text-center shadow">
                <h3 class="text-4xl font-bold"><?= $draft;?></h3>
                <p class="text-sm">Pending</p>
              </div>
            </div>
            <div id="cropperContainer" class="hidden">
                            <div style="width: 300px; height: 300px;">
                                <img id="cropImage" style="width: 100%;" />
                            </div>
                            <button id="saveButton" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save Cropped Image</button>
                        </div>
           <div class="bg-white p-6 rounded-lg">
          
          <h2 class="text-2xl font-semibold mb-4">Personal Information</h2>
            <form autocomplete="off" action="#" method="POST" onsubmit="return false;" id="userdetails">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <input
                type="text"
                placeholder="First Name"
                class="w-full p-3 border rounded "  value="<?php echo  isset($firstname)?$firstname:''; ?>"
              />
              <input
                type="text"
                placeholder="Last Name"
                class="w-full p-3 border rounded  "   value="<?php echo  isset($lastname)?$lastname:''; ?>"
              />
            </div>
            <input
              type="email"
              placeholder="Email"
              class="w-full p-3 border rounded mb-4 <?php echo  isset($firstname)?'bg-gray-100':''; ?> " <?php echo  isset($email)?'readOnly':'required'; ?> value="<?php echo  isset($email)?$email:''; ?>"
            /> <div class="flex items-center gap-x-3">
                                        <select class=" p-3 border rounded mb-4 w-1/3" name="countrycode" id="countrycode">
                                             <option value="US" <?php echo $selectedCountry === 'US' ? 'selected' : ''; ?>>🇺🇸 USA (+1)</option>
                                            <option value="IN" <?php echo $selectedCountry === 'IN' ? 'selected' : ''; ?>>🇮🇳 India (+91)</option>
                                            <option value="GB" <?php echo $selectedCountry === 'GB' ? 'selected' : ''; ?>>🇬🇧 UK (+44)</option>
                                            <option value="CA" <?php echo $selectedCountry === 'CA' ? 'selected' : ''; ?>>🇨🇦 Canada (+1)</option>
                                            <option value="AU" <?php echo $selectedCountry === 'AU' ? 'selected' : ''; ?>>🇦🇺 Australia (+61)</option>
                                            <option value="DE" <?php echo $selectedCountry === 'DE' ? 'selected' : ''; ?>>🇩🇪 Germany (+49)</option>
                                            <option value="FR" <?php echo $selectedCountry === 'FR' ? 'selected' : ''; ?>>🇫🇷 France (+33)</option>
                                            <option value="JP" <?php echo $selectedCountry === 'JP' ? 'selected' : ''; ?>>🇯🇵 Japan (+81)</option>
                                            <option value="BR" <?php echo $selectedCountry === 'BR' ? 'selected' : ''; ?>>🇧🇷 Brazil (+55)</option>
                                            <option value="AE" <?php echo $selectedCountry === 'AE' ? 'selected' : ''; ?>>🇦🇪 UAE (+971)</option>
                                            <option value="SA" <?php echo $selectedCountry === 'SA' ? 'selected' : ''; ?>>🇸🇦 SA (+966)</option>
                                        </select>
            <input
              type="text"
              placeholder="Phone" name="phone"  id="phone"  value="<?php echo  isset($phone)?$phone:''; ?>"  required
              class="w-full p-3 border rounded mb-4  " 
            /></div>
            <textarea
              placeholder="Address"
              class="w-full p-3 border rounded mb-4  name="address" 
              rows="4" 
            ><?php echo  isset($address)?$address:''; ?></textarea>
            <button
              type="submit"
              class="bg-gray-700 text-white px-10 py-2 rounded hover:bg-gray-800"
            >
              Save
            </button>
          </form>
           </div>
            <div
              id="change-password"
              class="bg-white rounded-lg shadow p-6 mt-8 mb-6"
            >
              <h2 class="text-2xl font-semibold mb-4">Change Password</h2>
              <!--<form id="changePasswordForm">-->  
              <form autocomplete="off" action="#" method="POST" onsubmit="return false;" id="password">
                  <div class="relative mb-4">
                    <input type="password" placeholder="Current Password" id="Cpassword" name="password" class="w-full p-3 border rounded pr-12" >
                           <i
                    class="fas fa-eye absolute right-4 top-3 text-gray-400 cursor-pointer"
                    onclick="togglePasswordVisibility('Cpassword', this)"
                  ></i>
                  </div>
                <div class="relative mb-4">
                  <input
                    id="newPassword"
                    type="password"
                    name="newpassword"
                    placeholder="New Password"
                    class="w-full p-3 border rounded pr-12"
                    required
                  />
                  <i
                    class="fas fa-eye absolute right-4 top-3 text-gray-400 cursor-pointer"
                    onclick="togglePasswordVisibility('newPassword', this)"
                  ></i>
                </div>
                
                   <div class="relative mb-4">
                  <input
                    id="confirmPassword"
                    name="cpassword"
                    type="password"
                    placeholder="Confirm Password"
                    class="w-full p-3 border rounded pr-12"
                    required
                  />
                  <i
                    class="fas fa-eye absolute right-4 top-3 text-gray-400 cursor-pointer"
                    onclick="togglePasswordVisibility('confirmPassword', this)"
                  ></i>
                </div>
                <button
                  type="submit"
                  class="bg-gray-700 text-white px-10 py-2 rounded hover:bg-gray-800"
                >
                  Save
                </button>
              </form>
            </div>

            <!-- Delete Account Section -->
            <div id="delete-account" class="bg-white rounded-lg shadow p-6">
              <h2 class="text-2xl font-semibold mb-4">Delete Account</h2>
              <p class="text-gray-400 mb-6">Once an admin deletes a profile, the profile is permanently deleted and cannot be retrieved.</p>
              <button
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 delete"
              >
                Delete
              </button>
            </div>
          </div>
        </div>
      </main>
    </div>


    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <!-- Profile Data Save Script Start -->
    <script>
        $(document).ready(function () {
            
           
            $("#userdetails").on('submit',function (e) { 
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "fetch/userUpdate.php",
                    data: $("#userdetails").serialize(),
                    success: function (response) {
                        if(response=='success'){
                            setTimeout(() => {
                                location.href='Logout.php';
                            }, 3000);
                            
                        }else{
                            console.log(response);
                        }
                    }
                });
            });
            $("#password").on('submit',function (e) { 
                e.preventDefault();
                $.ajax({
                    method: "POST",
                    url: "fetch/passwordUpdate.php",
                    data: $("#password").serialize(),
                    success: function (response) {
                        $('.message').text('');
                        if(response=='success'){
                            $('.message').text('Password Updated');
                            $('.message').addClass('text-green-500');
                            location.reload();
                        }else{
                            $('.message').text(response);
                            $('.message').addClass('text-red-500');
                            
                        }
                    }
                });
            });
            $('.delete').on('click',function(e){
                e.preventDefault();
                swal({
      title: "Are you sure want to Delete Account?",
      text: "You will not be able to recover your Articles!",
      icon: "warning",
      buttons: [
        'No, cancel it!',
        'Yes, I am sure!'
      ],
      dangerMode: true,
    }).then(function(isConfirm) {
      if (isConfirm) {
        $.ajax({
                    method: "POST",
                    url: "fetch/deleteAccount.php",
                    data:{data:'delete'},
                    success: function (response) {
                        $('.message').text('');
                        if(response=='success'){
                            swal({
                              title: 'Deleted!',
                              text: 'Account successfully removed!',
                              icon: 'success'
                            }).then(function() {
                               location.href='index.php';
                            });
                           
                        }else{
                            $('.message').text(response);
                            $('.message').addClass('text-red-500');
                            
                        }
                    }
                });
      } else {
        swal("Cancelled", "Your Account is safe :)", "error");
      }
    })
            })
        });
    </script>
    <!-- Profile Data Save Script End -->


    <script>
      // Function to toggle password visibility
      function togglePasswordVisibility(inputId, icon) {
        const inputField = document.getElementById(inputId);
        const isPasswordVisible = inputField.type === "text";

        // Toggle input type
        inputField.type = isPasswordVisible ? "password" : "text";

        // Toggle icon
        icon.classList.toggle("fa-eye");
        icon.classList.toggle("fa-eye-slash");
      }

      // Function to show the selected page
      function showPage(page) {
        // Hide all pages
        document.getElementById("myProfile").classList.add("hidden");
        document.getElementById("postArticle").classList.add("hidden");
        document.getElementById("myArticles").classList.add("hidden");
        document.getElementById("paymentInfo").classList.add("hidden");

        // Show the selected page
        document.getElementById(page).classList.remove("hidden");

        // Set active class on the clicked link
        const links = document.querySelectorAll("nav a");
        links.forEach((link) => link.classList.remove("active"));
        event.target.closest("a").classList.add("active");
      }
    </script>
    
    <script>
    document.getElementById('uploadButton').addEventListener('click', function() {
        document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;

                // Create a modal or container for cropping
                const cropperContainer = document.getElementById('cropperContainer');
                //cropperContainer.innerHTML = '<div style="width: 300px; height: 300px;"><img id="cropImage" style="width: 100%;" /></div>';
                //document.body.appendChild(cropperContainer);
                cropperContainer.classList.remove('hidden');
                document.getElementById('cropImage').src = e.target.result;

                const cropper = new Cropper(document.getElementById('cropImage'), {
                    aspectRatio: 1,
                    viewMode: 1,
                });

                const saveButton =  document.getElementById('saveButton');
                //saveButton.innerText = 'Save Cropped Image';
                saveButton.onclick = function() {
                    cropper.getCroppedCanvas().toBlob(function(blob) {
                        const formData = new FormData();
                        formData.append('croppedImage', blob);

                        // AJAX request to upload the image
                        fetch('fetch/savepropic.php', {
                            method: 'POST',
                            body: formData,
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                document.getElementById('profileImage').src = data.imagePath; // Update image src
                            }
                        });

                        cropper.destroy();
                        cropperContainer.remove();
                    });
                };

                cropperContainer.appendChild(saveButton);
            };
            reader.readAsDataURL(file);
        }
    });
</script>
  </body>
</html>
