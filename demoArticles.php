<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include_once('connect.php');
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}
$author = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
$username = $_SESSION['username'];
$sql = "SELECT firstarticle FROM users WHERE username = '" . $username . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$firstarticle = '1';


$sql1 = "SELECT id, categories FROM categories order by categories ASC";
$result = $conn->query($sql1);

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin Post Article</title>
  <!-- Font Awesome CDN -->
   <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer" />
  <script
    src="https://cdn.tiny.cloud/1/inq6dulu1dtzre8y1s15vtafym9e1d2c5en1c0jkmur1ttdl/tinymce/7/tinymce.min.js"
    referrerpolicy="origin"></script>
  <script src="https://js.stripe.com/v3/"></script>

  <!-- Include Cropper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" />
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
     <aside class="w-full lg:w-64 bg-gray-800 text-white p-6">
        <div class="flex flex-col items-center mb-8">
         <div class="bg-white w-1/2 lg:w-2/3 mx-auto">
          <img
          src="assets/logo.png"  onclick="location.href='/'"
          alt="logo"
          class=" border-4 p-4 border-yellow-400  h-full"
        />
         </div>
          <div class="relative mt-6 w-24 h-24 mb-3">
          
            <img
              src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/img/avatar.png';?>"
              alt="Profile"
              class="rounded-full border-4 border-yellow-400 w-full h-full"
            />
            <button
              class="absolute -bottom-2 left-0 bg-yellow-400 rounded-full p-1"
            >
              <img src="assets/Edit.svg" class="w-6 h-6" />
            </button>
          </div>
          <h2 class="text-xl font-semibold"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></h2>
          <p class="text-sm text-gray-400"><?php echo $_SESSION['username']?></p>
          <button
            class="mt-2 flex items-center text-sm text-gray-400 hover:text-white" onclick="location.href='Logout'"
          >
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </div>

        <!-- Navigation Links -->
        <nav>
          <a
            href="adminDashboard"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2 active"
           
          >
            <i class="fas fa-th-large mr-3"></i> Overview
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="viewContact"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            
          >
            <i class="fas fa-file-alt mr-3"></i> Enquiry
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="refund"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            onclick=""
          >
            <i class="fas fa-newspaper mr-3"></i> Refund Rejection
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="demoArticles"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            onclick=""
          >
            <i class="fas fa-newspaper mr-3"></i> Post Articles
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="createAdmin"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
          >
            <i class="fas fa-credit-card mr-3"></i> Account Admin
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
        </nav>
      </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <!-- Statistics Section -->
      <!-- Content Section -->
      <div id="" class="space-y-6">
            <!-- Stepper  Section -->
            <input type="hidden" value="<?php echo  $firstarticle; ?>" id="firstarticle">
            <?php if ($firstarticle == 1) { ?>
              <div id="" class="py-10">
                <div
                  class="lg:w-10/12 mx-auto p-5 py-10 bg-white shadow-md rounded-lg">
                  <!-- Step Indicator -->
                  <div
                    class="flex justify-between w-8/12 mx-auto items-center mb-8">
                    <div class="text-center">
                      <div
                        id="step1Circle"
                        class="h-10 w-10 rounded-full bg-gray-700 text-white flex items-center justify-center mb-2">
                        1
                      </div>
                    </div>
                    <div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step2Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2">
                        2
                      </div>
                    </div>
                    <!--<div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step3Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2"
                      >
                        3
                      </div>
                    </div>
                    <div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step4Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2"
                      >
                        4
                      </div>
                    </div> -->
                  </div>
    
                  <!-- Step 1: Post Article -->
                  <div id="frstep1" class="step w-full form-step">
                    <h2 class="text-2xl font-semibold mb-4">Post an Article</h2>
                    <label class="block text-sm font-medium text-red-700 error-message1 mb-4"></label>
                    <form class="w-full" id="firstArticle_form"
                      action="#"
                      method="post"
                      onsubmit="return false;"
                      enctype="multipart/form-data">
                      <div class="mb-6">
                        <input
                          type="text"
                          placeholder="Article Title"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          id="title"
                          name="title" autocomplete="off"/>
                         <div class="flex items-center space-x-4 mb-4">
                              <label for="enquiry" class="text-sm font-semibold">Show / Hide Enquiry:</label>
                              
                              <div class="flex items-center space-x-2">
                                <input type="radio" id="enquiry_yes" name="enquiry" value="1" class="text-blue-500">
                                <label for="enquiry_yes" class="text-sm">Yes</label>
                              </div>
                            
                              <div class="flex items-center space-x-2">
                                <input type="radio" id="enquiry_no" name="enquiry" value="0" checked class="text-blue-500">
                                <label for="enquiry_no" class="text-sm">No</label>
                              </div>
                            </div>
                                                  <label
                          for="imageUpload"
                          class="block text-sm font-semibold mb-2">Author Name(need Change):</label>
                        <input
                          type="text"
                          id="author"
                          name="author"
                          required
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          value="<?= $author; ?>" />
                        <textarea
                          placeholder="Article Content"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          rows="5"
                          id="content1"
                          name="content1"></textarea>
                        
                      </div>
                      <div class="mt-6">
                        <input
                          type="hidden"
                          placeholder="Tags (comma separated)"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          id="tags"
                          name="tags" value=""/>
                           
                        <label
                          for="imageUpload"
                          class="block text-sm font-semibold mb-2">Upload an Image:</label>
                        <input
                          type="file"
                          id="image1" name="image1"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          accept="image/*" />
                        <div class="relative w-full overflow-hidden">
                          <img
                            id="imagePreview" name="iamgePreview"
                            class="max-w-32 max-h-32 py-5 object-cover rounded-lg shadow-md hidden"
                            alt="Preview" />
                        </div>
                        <!-- Modal Background -->
                        <div id="modal" class="modal hidden">
                          <div class="bg-white w-full lg:w-96 rounded-lg shadow-lg p-4 ">
                            <h2 class="text-xl font-bold mb-4 text-center">Crop Your Image</h2>
    
                            <!-- Cropping Area -->
                            <div class="w-full lg:h-64 bg-gray-200 flex items-center justify-center">
                              <img id="image-to-crop" class="hidden max-w-32 max-h-32 py-5 object-cover rounded-lg shadow-md" alt="Image to Crop" />
                            </div>
    
                            <!-- Modal Buttons -->
                            <div class="flex justify-between mt-4">
                              <button type="button"  id="crop-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crop</button>
                              <button  type="button"  id="close-modal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="grid gap-4 grid-cols-2">
                            <input
                              type="text"
                              placeholder="Cardholder Name"
                              class="w-full p-2 border rounded-md mb-2"
                              id="name"
                              name="name" value="<?= $author; ?>" />
        
                            <div class="flex items-center">
                              <div id="card-element" class="w-full p-3 border rounded-md mb-2">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>
                                <div id="card-errors" role="alert"></div>
                            </div>
                            
                            </div>
                      <div class="grid gap-4 grid-cols-2">
                                <label
                              for="category"
                              class="block text-sm font-semibold mb-2 mt-5 hidden">Select Category:</label>
                            <select
                              id="category"
                              class="w-full p-2 px-4 border rounded-md mb-2"
                              name="category"
                              id="category">
                              <option value="" disabled selected>
                                Select a category
                              </option>
                               <?php
                                if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) {
                                        echo "<option value='" . $row['categories'] . "'>" . $row['categories'] . "</option>";
                                    }
                                } else {
                                    echo "<option value='' disabled>No categories available</option>";
                                }
                                ?>
                            </select>
                                <label
                              for="stepper2"
                              class="block text-sm font-semibold mb-2 hidden">Selected Plan | Price | Duration</label>   
                            <select
                              id="stepper2"
                              class="w-full p-2 px-4 border rounded-md mb-2"
                              required
                              name="stepper2"
                              id="stepper2">
                              <option value="" selected disabled>
                               Select  Plan  Price  Duration
                              </option>
                              <option value="Starter">Starter | 50 | 30</option>
                              <option value="Pro">Pro | 100 | 90</option>
                              <option value="Business">Business | 300 | 365</option>
                            </select>
                                <label
                              for="price"
                              class="block text-sm font-semibold mb-2 hidden">Selected Plan Price</label>
                               <input
                                type="text"
                                name="plan"
                                id="plan"
                                class="p-3 border rounded-md"
                                placeholder="Selected Plan"
                                readonly />
                              <input
                                type="text"
                                placeholder="Plan Price"
                                class="p-3 border rounded-md"
                                name="price"
                                id="price" readonly />
                                
                              <input
                                type="text"
                                placeholder="Plan Duration"
                                class="p-3 border rounded-md"
                                name="duration"
                                id="duration" readonly/>
                             
        
                              <input type="text" name="token" id="token" value="token" class=" p-2 border rounded">
                              <input
                                type="hidden"
                                id="total"
                                name="total"
                                class="w-3/4 p-2 border rounded"
                                readonly />
                            </div>
                      <!-- Loading Indicator -->
                        <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                          <div class="flex flex-col items-center">
                            <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                            <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                          </div>
                        </div>
                          <div class="col-span-2 text-right">
                            <button
                              type="button"
                              class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 submit-step">
                              Submit
                            </button>
                          </div>
                    </form>
                  </div>
                  <!-- Step 4: Confirmation -->
                  <div id="step4" class="step w-full hidden">
                    <div
                      class="bg-gray-50 lg:p-10 rounded-xl text-center lg:w-8/12 mx-auto">
                     <h2 class="text-2xl font-semibold mb-4">
                    Your Article is posted to Admin for Approval.
                </h2>
                <p class="text-gray-500 mb-8">
                    Your Article was shared with Admin for Approval.Once the Artical approved its available for public
                </p>
                      <button
                        onclick="location.href='/adminDashboard'"
                        class="mt-6 bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800">
                        Approve Article
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } else { ?>

            <?php } ?>
        </div>

</main>
</div>
<!-- Footer -->

</body>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
  $(document).ready(function() {
    var cropper;
    var $modal = $('#modal');
    var $imageInput = $('#image1');
    var $imageToCrop = $('#image-to-crop');
    var $croppedImage = $('#imagePreview');
    var $cropButton = $('#crop-button');
    var $closeModal = $('#close-modal');

    // Image upload and show modal for cropping
    $imageInput.on('change', function(e) {
      var file = e.target.files[0];
      if (file) {
        var reader = new FileReader();
        reader.onload = function(event) {
          $imageToCrop.attr('src', event.target.result).removeClass('hidden');

          // Show modal
          $modal.removeClass('hidden');

          // Initialize Cropper.js
          if (cropper) {
            cropper.destroy();
          }
          cropper = new Cropper($imageToCrop[0], {
            aspectRatio: 1, // Square crop
            viewMode: 1,
            dragMode: 'move',
            aspectRatio: 16 / 9,
            autoCropArea: 0.65,
            restore: false,
            guides: false,
            center: false,
            highlight: false,
            cropBoxMovable: true,
            cropBoxResizable: false,
            toggleDragModeOnDblclick: false,
          });
        };
        reader.readAsDataURL(file);
      }
    });

    // Cropping the image and showing it outside the modal
    $cropButton.on('click', function() {
      if (cropper) {

        var canvas = cropper.getCroppedCanvas();
        $croppedImage.attr('src', canvas.toDataURL('image/png')).removeClass('hidden');
        $imageInput.attr('src', canvas.toDataURL('image/png'));

        // Close modal
        $modal.addClass('hidden');
      }
    });

    // Close modal without cropping
    $closeModal.on('click', function() {
      $modal.addClass('hidden');
    });

    // Close modal when clicking outside the modal content
    $(window).on('click', function(event) {
      if ($(event.target).is($modal)) {
        $modal.addClass('hidden');
      }
    });

    var frstarcle = $("#firstarticle").val();

   
      $("#allarticle").css("display", "none");
     

      tinymce.init({
        selector: "#content1",
        menubar: false,
        plugins: [
          // Core editing features
          "anchor",
          "image",
          "link",
          "lists",
          "searchreplace",
          "table",
          // Your account includes a free trial of TinyMCE premium features
        ],
        toolbar: "undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image  table | align lineheight",
      });

      // Set up Stripe.js and Elements
      var stripe = Stripe(
        "pk_test_51Q4eUWLg6tc3IU2sQ4eWvzve616nswfYJJNUniclSFdA3Sa2FvKwixWtBfzGCKDfyPdWXFj7Vt5GdJeBdzhOYdC4008NbbdB8a"
      ); // Replace with your own Publishable Key
      var elements = stripe.elements();
      //var cardElement = elements.create("card");
      var cardElement = elements.create('card', {
        hidePostalCode: true
      });
      cardElement.mount("#card-element");

      // Handle form submission
      const form = document.getElementById("firstArticle_form");
      form.addEventListener("submit", async (event) => {
        event.preventDefault();

        const {
          error,
          paymentMethod
        } = await stripe.createPaymentMethod({
          type: "card",
          card: cardElement,
        });

        if (error) {
          // Display error message in #card-errors div
          document.getElementById("card-errors").textContent = error.message;
          return;
        } else {
          // Handle successful paymentMethod creation here
          console.log("Payment Method:", paymentMethod);
        }
      });
    
    // Handle image upload and preview
    $("#image1").change(function(event) {
        $("#imagePreview").removeClass('hidden');
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $("#imagePreview").attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
      }
    });

    // Define custom styling
    const style = {
      base: {
        color: "#32325d",
        fontFamily: 'Nunito, sans-serif',
        fontSmoothing: "antialiased",
        fontSize: "16px",
        "::placeholder": {
          color: "#aab7c4"
        }
      },
      invalid: {
        color: "#fa755a",
        iconColor: "#fa755a"
      }
    };

 document.querySelector('#frstep1 .submit-step').addEventListener('click', () => {
      
    if (frvalidateStep1()) {
        $(".submit-step").attr('type','submit');
    }else{
         $(".submit-step").prop('type','button');
    }
    
     function frvalidateStep1() {
    const title = document.getElementById('title').value;
    const category = document.getElementById('category').value;
    const content = tinymce.get('content1').getContent({ format: 'text' }).trim(); 
    const image1 = document.getElementById('image1').files[0];
     const plan = document.getElementById('stepper2').value;

    if (!title){
         document.querySelector('.error-message1').textContent = "title are required.";
      return false;
    }else if( !category){
         document.querySelector('.error-message1').textContent = "category are required.";
      return false;
    } else if( !content){
         document.querySelector('.error-message1').textContent = "Article Content are required.";
      return false;
    } else if(!image1) {
      document.querySelector('.error-message1').textContent = "image are required.";
      return false;
    } else if(!plan) {
      document.querySelector('.error-message1').textContent = "choose the plan are required.";
      return false;
    }else{
    document.querySelector('.error-message1').textContent = "";
    return true;
     }
  }
    
  });
 $("#firstArticle_form").on("submit", function() {
        
        stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          $("#card-errors").text(result.error.message);
        } else {
          // Send data to the server using AJAX
          $("#token").val(result.token.id);
        }
      
        
        
         cropper.getCroppedCanvas().toBlob(function(blob) {
            url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
   
      tinyMCE.triggerSave(true, true);
      tinyMCE.get("content1").save();
      var formData = new FormData($("#firstArticle_form")[0]);
      
     const loadingIndicator = $('#loadingIndicator');
    loadingIndicator.removeClass('hidden');
     formData.append('imagePreview', base64data);
      var token = $("#token").val();
        if (token !== 'token') {
                 $.ajax({
        url: "saveadmin_article.php", // PHP script that will handle saving the image
        type: "POST",
        processData: false,
        contentType: false,
        //data: {
        data: formData,

        //},
        //editor: tinymce.activeEditor.getContent()
        //},
        beforeSend: function(data) {

        },
        success: function(response) {
          if (response == "1") {
            $("#step4").removeClass('hidden');
            $("#frstep1").addClass('hidden');
            $("#step2Circle").addClass('bg-gray-300'); // Set inactive color for other steps
            //$("#step1Circle").classList.remove('bg-gray-700'); // Remove highlight
            
          } else {
            alert(response);
           $("#step4").addClass('hidden');
            $("#frstep1").removeClass('hidden');
            //showStep(1);
          }
        },
        complete: function(data) {
             loadingIndicator.addClass('hidden');
        }

      });
		}else{
		    document.querySelector('.error-message1').textContent = "incomplete payment are required.";
		}
      
			}
  
 })
 
 
        });

 })
    function resetForm() {
    document.getElementById('multiStepForm').reset();
    //showStep(1);
    
    const img = document.getElementById("imagePreview");
    if (img) {
        img.removeAttribute("src"); // Clear the src attribute
    }
  }
    // When a plan is clicked
    $(".plan").click(function() {
      // Remove selected class from all plans
      $(".plan").removeClass("border border-4 border-green-500 selected");

      // Add selected class to the clicked plan
      $(this).addClass("border border-4 border-green-500 selected");

      // Get the plan type and price
      var selectedPlan = $(this).data("plan");
      var selectedPrice = $(this).data("price");
      var selected_duration = $(this).data("duration");
      $(".planpay").append(selectedPlan);
      $("#total").val(selected_duration);
      $("#price").val(selectedPrice);
      $("#plan").val(selectedPlan);
      $("#duration").val(selected_duration);
    });
    // Plan selection validation on Step 2 (Pricing)
    $(".plan").on("click", function() {
      $(".plan").removeClass("selected");
      $(this).addClass("selected");

      // Update the plan details in the Payment step
      let planName = $(this).data("plan");
      let planPrice = $(this).data("price");
      $(".planpay").text(
        planName.charAt(0).toUpperCase() + planName.slice(1)
      );
      $("#price").val(`$${planPrice}`);
      $("#total").val(`$${planPrice}`);
    });

    // Image Preview for Image Upload Fields
    $("#image1").on("change", function() {
      previewImage(this, "#imagePreview");
    });
    $("#stepper2").on("change", function() {
    
        var text=$(this).find("option:selected").text();
        var plan=text.split(" | ")[0];
        var price=text.split(" | ")[1];
        var duration=text.split(" | ")[2];
        
        $("#price").val(price);
        $("#plan").val(plan);
        $("#duration").val(duration);
    
    });
    function previewImage(input, previewElement) {
      const file = input.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          $(previewElement).attr("src", e.target.result);
        };
        reader.readAsDataURL(file);
      }
    }


  
});
</script>


</html>