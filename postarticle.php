<!DOCTYPE html>
<?php
session_start();
error_reporting(0);
include_once('connect.php');
$config = include('admin/config.php');
$stripeApiKey = $config['stripe_pk_key'];
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit();
}
$author = $_SESSION['firstname'] . ' ' . $_SESSION['lastname'];
$username = $_SESSION['username'];
$sql = "SELECT firstarticle FROM users WHERE username = '" . $username . "'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
$firstarticle = $row['firstarticle'];


$sql1 = "SELECT id, categories FROM categories order by categories ASC";
$result = $conn->query($sql1);

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Post Article</title>
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
    <?php include_once('sidebar.inc.php'); ?>

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
                          name="title" />
                        <input
                          type="hidden"
                          id="author"
                          name="author"
                          required
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
                              for="category"
                              class="block text-sm font-semibold mb-2 mt-5 hidden">Select Category:</label>
                            <select
                              id="category"
                              class="w-full p-2 px-4 border rounded-md mb-4"
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
                      <div class="col-span-2 text-right">
                        <button
                          type="button"
                          class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 submit-step">
                          Submit
                        </button>
                      </div>
                      
                       <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
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
                        onclick="location.href='myArticle';"
                        class="mt-6 bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800">
                        View Article
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            <?php } else { ?>
              <div id="" class="py-10">
                <div
                  class="lg:w-10/12 mx-auto p-5 py-10 bg-white shadow-md rounded-lg">
                  <!-- Step Indicator -->
                  <div
                    class="flex justify-between w-8/12 mx-auto items-center mb-8">
                    <div class="text-center">
                      <div
                        id="step1Circle"
                        class="h-10 w-10 rounded-full bg-gray-700 text-white flex items-center justify-center mb-2 step-circle">
                        1
                      </div>
                    </div>
                    <div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step2Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2 step-circle">
                        2
                      </div>
                    </div>
                    <div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step3Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2 step-circle">
                        3
                      </div>
                    </div>
                    <div class="flex-1 border-t-4 border-gray-300 mx-2"></div>
                    <div class="text-center">
                      <div
                        id="step4Circle"
                        class="h-10 w-10 rounded-full bg-gray-300 text-white flex items-center justify-center mb-2 step-circle">
                        4
                      </div>
                    </div>
                  </div>
    
                  <!-- Step 1: Post Article -->
                  <form  id="multiStepForm"
                      action="#"
                      method="post"
                      onsubmit="return false;"
                      enctype="multipart/form-data">
                      <div id="step1" class="step w-full form-step">
                        <h2 class="text-2xl font-semibold mb-4">Post an Article</h2>
                        <!-- Step 1 Error Message -->
                        <label class="block text-sm font-medium text-red-700 error-message1 mb-4"></label>
                        <div class=" gap-6 grid-cols-1 lg:grid-cols-2">
                          <div>
                            <input
                              type="text"
                              placeholder="Article Title"
                              class="w-full p-2 px-4 border rounded-md mb-4"
                              required
                              id="title"
                              name="title" />
                           
                             <textarea
                              placeholder="Article Content"
                              class="w-full p-2 px-4 border rounded-md mb-4 content2"
                              rows="3"
                              id="content"
                              name="content"></textarea>
                          </div>
                          
                          <div class="mt-6">
                               <label
                              for="category"
                              class="block text-sm font-semibold mb-2 hidden">Select Category:</label>
                            <select
                              id="category"
                              class="w-full p-2 px-4 border rounded-md mb-4"
                              required
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
                            <input
                              type="hidden"
                              placeholder="Tags (comma separated)"
                              class="w-full p-2 px-4 border rounded-md mb-4" id="tags"
                          name="tags" value=""/>
                           <input
                                type="hidden"
                                id="author"
                                name="author"
                                
                                class="w-full mt-1 p-2 border rounded" value="<?= $author;?>"/>
                            <label
                              for="imageUpload"
                              class="block text-sm font-semibold mb-2">Upload an Image:</label>
                              <input
                              type="file"
                              id="image1" name="image1" required
                              class="w-full p-2 px-4 border rounded-md mb-4"
                              accept="image/*" />
                            <div class="relative w-full overflow-hidden">
                              <img
                                id="imagePreview" name="imagePreview"
                                class="max-w-32 max-h-32 py-5 object-cover rounded-lg shadow-md hidden"
                                alt="Preview" />
                                <div id="modal" class="modal hidden">
                              <div class="bg-white w-96 rounded-lg shadow-lg p-4 ">
                                <h2 class="text-xl font-bold mb-4 text-center">Crop Your Image</h2>
        
                                <!-- Cropping Area -->
                                <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                                  <img id="image-to-crop" class="hidden max-w-32 max-h-32 py-5 object-cover rounded-lg shadow-md" alt="Image to Crop" />
                                </div>
        
                                <!-- Modal Buttons -->
                                <div class="flex justify-between mt-4">
                                  <button type="button" id="crop-button" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Crop</button>
                                  <button type="button" id="close-modal" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</button>
                                </div>
                              </div>
                            </div>
                            </div>
                            <!-- Modal Background -->
                          </div>
                          <div class="col-span-2 text-right">
                            <button
                              type="button"
                              class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 next-step">
                              Next Step
                            </button>
                          </div>
            
                      </div>
                      </div>
                      <!-- Step 2: Plan Details -->
                      <div id="step2" class="step w-full hidden form-step">
                        <h2 class="text-2xl font-semibold mb-4">Choose a Plan</h2>
                        <!-- Step 1 Error Message -->
                        <label class="block text-sm font-medium text-red-700 error-message2 mb-4"></label>
                        <div class="grid gap-6 md:grid-cols-3">
                          <!-- Standard Plan -->
                          <div class="plan bg-gray-800 rounded-xl shadow-lg p-8 w-full text-center flex flex-col justify-between" data-plan="Starter" data-price="50" data-duration="30">
                            <div>
                              <h2 class="text-2xl font-bold mb-4 text-white">Starter Plan</h2>
                              <p class="text-white mb-6">
        
                              </p>
                              <p class="text-4xl font-bold mb-2 text-white">
                                $50<span class="text-lg font-normal">/article</span>
                              </p>
                              <p class="text-white mb-6">
                              <ul class="space-y-4 mb-6 text-left text-white text-sm">
                                <li>✔ Article remains active for 1 month</li>
                                <li>✔ Access to advanced formatting tools (images, tables, etc.)</li>
                                <li>✔ Email support available for article-related queries</li>
                                <li>✔ Minimal display ads on published articles</li>
                              </ul>
                              </p>
                            </div>
                            <div class="text-center">
                              <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold ">
                                Select Plan
                              </button>
                            </div>
                          </div>
        
                          <!-- Premium Plan -->
                          <div class="plan bg-gray-800 rounded-xl shadow-lg lg:scale-110 p-8 w-full text-center flex flex-col justify-between border-2 border-red-500" data-plan="Pro"
                            data-price="100" data-duration='90'>
                            <div>
                              <h2 class="text-2xl font-bold mb-4 text-white flex justify-center items-center">
                                Pro Plan
                                <span class="ml-2 bg-blue-500 text-white text-xs font-semibold py-1 px-2 rounded-md">POPULAR</span>
                              </h2>
                              <p class="text-white mb-6">
        
                              </p>
                              <p class="text-4xl font-bold mb-2 text-white">
                                $100<span class="text-lg font-normal">/article</span>
                              </p>
                              <p class="text-white mb-6">
                              <ul class="space-y-4 mb-6 text-left text-white text-sm">
                                <li>✔ Article remains active for 3 months</li>
                                <li>✔ Access to premium formatting options images, tables, videos etc.)</li>
                                <li>✔ Minimal display ads on published articles</li>
                                <li>✔ Moderate SEO improve visibility search</li>
                              </ul>
                              </p>
                            </div>
                            <div class="text-center">
                              <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold">
                                Select Plan
                              </button>
                            </div>
                          </div>
        
                          <!-- Premium Plus Plan -->
                          <div class="plan bg-gray-800 rounded-xl shadow-lg p-8 w-full text-center flex flex-col justify-between" data-plan="Business" data-price="300" data-duration="365">
                            <div>
                              <h2 class="text-2xl font-bold mb-4 text-white">Business</h2>
                              <p class="text-white mb-6">
        
                              </p>
                              <p class="text-4xl font-bold mb-2 text-white">
                                $300<span class="text-lg font-normal">/article</span>
                              </p>
                              <p class="text-white mb-6">
                              <ul class="space-y-4 mb-6 text-left text-white text-sm">
                                <li>✔ Article remains active for 1 year.</li>
                                <li>✔ Update up to 2 times on active period.</li>
                                <li>✔ Access to premium formatting.</li>
                                <li>✔ Priority email support.</li>
                                <li>✔ Minimal display ads.</li>
                                <li>✔ Advanced SEO improve visibility in search</li>
                              </ul>
                              </p>
                            </div>
                            <div class="text-center">
                              <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold">
                                Select Plan
                              </button>
                            </div>
                          </div>
                        </div>
        
                        <div class="mt-8 flex justify-between">
                          <button
                            type="button"
                           
                            class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 previous-step">
                            Previous Step
                          </button>
                          <button
                            type="button"
                            
                            class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 next-step">
                            Next Step
                          </button>
                        </div>
                      </div>
        
                      <!-- Step 3: Payment -->
                      <div id="step3" class="step w-full hidden form-step">
                        <!-- Step 1 Error Message -->
                        <label class="block text-sm font-medium text-red-700 error-message3 mb-4"></label>  
                        <div class="bg-gray-50 lg:p-10 rounded-xl lg:w-8/12 mx-auto">
                          <h2 class="text-2xl font-semibold mb-4">
                            Payment Information
                          </h2>
                          <form>
                            <input
                              type="text"
                              placeholder="Cardholder Name"
                              class="w-full p-3 border rounded-md mb-4"
                              id="name"
                              name="name" />
        
                            <div class="flex items-center">
                              <div id="card-element" class="w-full p-3 border rounded-md mb-4">
                                <!-- A Stripe Element will be inserted here. -->
                              </div>
        
                            </div>
                            <div id="card-errors" role="alert"></div>
                            <div class="grid gap-4 grid-cols-2">
                                <label
                              for="price"
                              class="block text-sm font-semibold mb-2 hidden">Selected Plan Price</label>
                              <input
                                type="text"
                                placeholder="Plan Price"
                                class="p-3 border rounded-md"
                                name="price"
                                id="price" readonly />
                                
                              <input
                                type="hidden"
                                placeholder="Plan Duration"
                                class="p-3 border rounded-md"
                                name="duration"
                                id="duration" />
                              <input
                                type="hidden"
                                name="plan"
                                id="plan"
                                class="w-3/4 p-2 border rounded"
                                readonly />
        
                              <input type="hidden" name="token" id="token" value="token" class="w-3/4 p-2 border rounded">
                              <input
                                type="hidden"
                                id="total"
                                name="total"
                                class="w-3/4 p-2 border rounded"
                                readonly />
                            </div>
                            <div class="mt-8 flex justify-between">
                              <button
                                type="button"
                                
                                class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600 previous-step">
                                Previous Step
                              </button>
                              <button
                                type="submit"
                                class="bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800">
                                Submit
                              </button>
                            </div>
                         
                        </div>
                      </div>
                      
                      <!-- Loading Indicator -->
                    <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
                    </div>

               </form>
                  <!-- Step 4: Confirmation -->
                  <div id="step4" class="step hidden w-full form-step">
                      <!-- Step 1 Error Message -->
                        <label class="block text-sm font-medium text-red-700 error-message4 mb-4"></label>
                    <div
                      class="bg-gray-50 lg:p-10 rounded-xl text-center lg:w-8/12 mx-auto">
                              <h2 class="text-2xl font-semibold mb-4">
                            Your Article is posted to Admin for Approval.
                        </h2>
                        <p class="text-gray-500 mb-8">
                            Your Article was shared with Admin for Approval.Once the Artical approved its available for public
                        </p>
                      <button
                        onclick="resetForm()"
                        class="mt-6 bg-gray-700 text-white px-6 py-2 rounded hover:bg-gray-800 another">
                        Post Another Article
                      </button>
                    </div>
                  </div>
                </div>
              </div>
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

    if (frstarcle == 1) {
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

    } else {

      tinymce.init({
        selector: "#content",
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
        "<?= $stripeApiKey;?>"
      ); // Replace with your own Publishable Key
      var elements = stripe.elements();
      //var cardElement = elements.create("card");
      var cardElement = elements.create('card', {
        hidePostalCode: true
      });
      cardElement.mount("#card-element");

      // Handle form submission
      const form = document.getElementById("multiStepForm");
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
        } else {
          // Handle successful paymentMethod creation here
          console.log("Payment Method:", paymentMethod);
        }
      });
    }
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
 if (frstarcle == 1) {
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
    }else{
    document.querySelector('.error-message1').textContent = "";
    return true;
     }
  }
    
  });
    $("#firstArticle_form").on("submit", function() {
         cropper.getCroppedCanvas().toBlob(function(blob) {
            url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
   
      tinyMCE.triggerSave(true, true);
      tinyMCE.get("content1").save();
      var formData = new FormData($("#firstArticle_form")[0]);
      /* jQuery.each($($("#multiStepForm")[0])[0].files, function(i, file) {
          formData.append('image' + i, file);
      });
      jQuery.each($($("#multiStepForm")[0])[0].files, function(i, file) {
          formData.append('imagePreview', file);
      }); */
     const loadingIndicator = $('#loadingIndicator');
    loadingIndicator.removeClass('hidden');
     formData.append('imagePreview', base64data);
      $.ajax({
        url: "fetch/upload_articlefree.php", // PHP script that will handle saving the image
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
			}
      
    })
  
 })
 }
    $("#multiStepForm").on("submit", function(e) {
      //e.preventDefault();
      stripe.createToken(cardElement).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          $("#card-errors").text(result.error.message);
        } else {
          // Send data to the server using AJAX
          $("#token").val(result.token.id);
        }
      });
      
       cropper.getCroppedCanvas().toBlob(function(blob) {
            url = URL.createObjectURL(blob);
			var reader = new FileReader();
			reader.readAsDataURL(blob);
			reader.onloadend = function(){
				var base64data = reader.result;
   
        tinyMCE.triggerSave(true, true);
        tinyMCE.get("content").save();
        var formData = new FormData($("#multiStepForm")[0]);
        /* jQuery.each($($("#multiStepForm")[0])[0].files, function(i, file) {
            formData.append('image' + i, file);
        });
        jQuery.each($($("#multiStepForm")[0])[0].files, function(i, file) {
            formData.append('imagePreview', file);
        }); */
        formData.append('imagePreview', base64data);
        var token = $("#token").val();
        if (token != 'token') {
             const loadingIndicator = $('#loadingIndicator');
              loadingIndicator.removeClass('hidden');
          $.ajax({
            url: "upload_article.php", // PHP script that will handle saving the image
            type: "POST",
            processData: false,
            contentType: false,
            //data: {
            data: formData,

            //},
            //editor: tinymce.activeEditor.getContent()
            //},
            success: function(response) {
              if (response == "1") {
               showStep(4);
              } else {
                alert(response);
              }
            },
            complete: function(data) {
                 loadingIndicator.addClass('hidden');
            }

          });
        }
			}
    });
      
    });
    $(".another").on('click',function(){
        $('#multiStepForm').reset();
    //showStep(1);
    
    const img =  $("#imagePreview");
    if (img) {
        img.removeAttribute("src"); // Clear the src attribute
    }
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


 
  
// Function to show specified step and hide others
function showStep(step) {
  const formSteps = document.querySelectorAll('.form-step');
  const stepCircles = document.querySelectorAll('.step-circle');

  // Toggle visibility of each step
  formSteps.forEach((formStep, index) => {
    if (index + 1 === step) {
      formStep.classList.remove('hidden'); // Show the current step
    } else {
      formStep.classList.add('hidden'); // Hide all other steps
    }
  });

  // Update step indicator circles
  stepCircles.forEach((circle, index) => {
    if (index + 1 === step) {
      circle.classList.add('bg-gray-700'); // Highlight current step
      circle.classList.remove('bg-gray-300'); // Remove inactive color
    } else {
      circle.classList.add('bg-gray-300'); // Set inactive color for other steps
      circle.classList.remove('bg-gray-700'); // Remove highlight
    }
  });
}

// Check if function works on initial load
document.addEventListener("DOMContentLoaded", function() {
  showStep(1); // Start with Step 1 visible
});
  // Reset form and go back to Step 1
  
  // Validation functions for each step
  function validateStep1() {
    const title = document.getElementById('title').value;
    const category = document.getElementById('category').value;
    const content = tinymce.get('content').getContent({ format: 'text' }).trim(); 
    const image1 = document.getElementById('image1').files[0];

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
    }else{
    document.querySelector('.error-message1').textContent = "";
    return true;
     }
  }

  function validateStep2() {
    const selectedPlan = document.querySelector('.plan-selected');
    if (!selectedPlan) {
      document.querySelector('.error-message2').textContent = "Please select a plan.";
    
      $("html, body").animate({
            scrollTop:  $('.error-message2').offset().top
        }, 500); // Adjust the duration as needed
      
      return false;
    }
    document.querySelector('.error-message2').textContent = "";
    return true;
  }

  function validateStep3() {
    const cardholderName = document.getElementById('name').value;
    const cardElement = document.getElementById('card-element');
    
    if (!cardholderName || !cardElement) {
      document.querySelector('.error-message3').textContent = "Payment information is required.";
      return false;
    }
    document.querySelector('.error-message3').textContent = "";
    return true;
  }

  // Bind Next button event listeners for each step
  document.querySelector('#step1 .next-step').addEventListener('click', () => {
      
    if (validateStep1()) {
      showStep(2);  // Proceed to Step 2 if Step 1 validation passes
      
    }
  });

  document.querySelector('#step2 .next-step').addEventListener('click', () => {
    if (validateStep2()) {
      showStep(3); 
       // Proceed to Step 3 if Step 2 validation passes
    }
  });



  // Bind Previous button event listeners for each step
  document.querySelector('#step2 .previous-step').addEventListener('click', () => {
    showStep(1);  // Go back to Step 1 from Step 2
  });

  document.querySelector('#step3 .previous-step').addEventListener('click', () => {
    showStep(2);  // Go back to Step 2 from Step 3
  });

  // Plan selection styling
  document.querySelectorAll('.plan').forEach(plan => {
    plan.addEventListener('click', () => {
      document.querySelectorAll('.plan').forEach(p => p.classList.remove('plan-selected'));
      plan.classList.add('plan-selected');
    });
  });
  
  });
  
  

</script>


</html>