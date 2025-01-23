<!DOCTYPE html>
<?php session_start(); //print_r($_SESSION);
include_once('connect.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
$username = $_SESSION['username'];
$firstname = $_SESSION['firstname'].' '.$_SESSION['lastname'];
$email = $_SESSION['email'];
$phone=$_SESSION['phone'] ;
$address=$_SESSION['address'];
$propic=$_SESSION['propic'];
?>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>User Profile</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,200..1000&display=swap"
        rel="stylesheet" />
        <link
        href="assets/css/sweetalert2.min.css"
        rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css">
    <style>
        body {
            font-family: "Nunito", sans-serif;
        }
        
    </style>
</head>

<body class="bg-white-100">
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
        <section class="bg-slate-50 shadow w-fit md:w-5/6 ml-4">
            <div class="rounded-lg p-6">
                <!-- Page header -->
                <div class="flex items-center justify-between mb-6">
                    <h1 class="text-2xl font-bold">Profile</h1>
                    <nav class="text-white-500">
                        <a class="hover:text-blue-500" href="#">Home</a> /
                        <a class="hover:text-blue-500" href="#">Dashboard</a> /
                        <span>Profile</span>
                    </nav>
                </div>

                <!-- Profile Section -->
               
                    <div class="bg-white-800 text-white p-6 rounded-lg shadow-lg">
                        <div class="flex items-center mb-6">
                            <img src="<?php echo  ($propic!=='')?$propic:'assets/img/avatar.png';?>" alt="Profile" class="w-24 h-24 rounded-full mr-4 object-cover" id="profileImage">
                            <input type="file" id="imageInput" class="hidden" accept="image/*">
                            <button class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded" id="uploadButton">Choose Image</button>
                        </div> 
                        <div id="cropperContainer" class="hidden">
                            <div style="width: 300px; height: 300px;">
                                <img id="cropImage" style="width: 100%;" />
                            </div>
                            <button id="saveButton" class="bg-green-500 hover:bg-green-700 text-white py-2 px-4 rounded">Save Cropped Image</button>
                        </div>

                        <form autocomplete="off" action="#" method="POST" onsubmit="return false;" id="userdetails">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-gray-800 mb-2">Full Name</label>
                                    <input type="text" <?php echo  isset($firstname)?'readOnly':'required'; ?> value="<?php echo  isset($firstname)?$firstname:''; ?>" placeholder="Full name" readonly class="w-full p-3 bg-white-400 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-800 mb-2">Phone Number</label>
                                    <div class="flex items-center">
                                        <select class="p-3 bg-white-700 text-gray-800 rounded-l-lg w-1/3">
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
                                        <input type="number" max="999999999999" name="phone" <?php echo  ($phone!=='0')?'readOnly':'required'; ?> value="<?php echo  isset($phone)?$phone:''; ?>"  required placeholder="Phone" class="w-full p-3 bg-white-400 text-gray-700 rounded-r-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                                <div>
                                    <label class="block text-gray-800 mb-2">Location</label>
                                    <input type="text"  placeholder="Enter address"  name="address" <?php echo  ($address!='')?'readOnly':'required'; ?> value="<?php echo  isset($address)?$address:''; ?>"   class="w-full p-3 bg-white-400 text-gray-700 rounded-lg border focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-800 mb-2">Email</label>
                                    <input type="text" name="email" <?php echo  isset($email)?'readOnly':'required'; ?> value="<?php echo  isset($email)?$email:''; ?>"  placeholder="Email Address" class="w-full p-3 bg-white-400 text-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 bg-readonly-input">
                                </div>
                            </div>

                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded-lg">Save Changes</button>
                        </form>
                    </div>

                    <div class="bg-white-800 text-gray p-6 rounded-lg shadow-lg mt-8">
                        <h2 class="text-lg font-semibold mb-4">Change Password</h2>
                         <label class="block mb-2 message"></label>
                        <form autocomplete="off" action="#" method="POST" onsubmit="return false;" id="password">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                                <div>
                                    <label class="block text-gray-600 mb-2">Current Password</label>
                                    <input type="password" placeholder="Password" id="password" name="password" class="w-full p-3 bg-white-700 text-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-600 mb-2">New Password</label>
                                    <input type="password" placeholder="Password" id="newpassword" name="newpassword" class="w-full p-3 bg-white-700 text-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-600 mb-2">Confirm Password</label>
                                    <input type="password" placeholder="Password" id="cpassword" name="cpassword" class="w-full p-3 bg-white-700 text-gray-500 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-6 rounded-lg">Save Changes</button>
                        </form>
                    </div>

                    <div class="bg-white-800 text-gray p-6 rounded-lg shadow-lg mt-8">
                        <h2 class="text-lg font-semibold mb-4">Delete Account</h2>
                        <p class="text-gray-400 mb-6">Once an admin deletes a profile, the profile is permanently deleted and cannot be retrieved.</p>
                        <button type="button" class="bg-red-600 hover:bg-red-800 text-white py-2 px-6 rounded-lg mx-auto delete"> <i class="fa fa-trash"></i> Delete Account</button>
                    </div>
               


            </div>
        </section>
    </main>

    <!-- Footer -->
    <?php include_once('footer.inc.php'); ?>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>

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