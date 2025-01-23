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
$firstarticle = $row['firstarticle'];

$sql1 = "SELECT * FROM articles WHERE id = '" . $_GET['article'] . "'";
$result1 = $conn->query($sql1);
$row1 = $result1->fetch_assoc();

$title= $row1['title'];
$category= $row1['category'];
$content=$row1['content'];
$image=$row1['image'];
$plan=$row1['plan'];
$id=$row1['id'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Edit Post Article</title>
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
            
              <div id="" class="py-10 <?php ($plan == 'free')?'hidden':'' ?>">
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
                  </div>
    
                  <!-- Step 1: Post Article -->
                  <div id="frstep1" class="step w-full form-step">
                    <h2 class="text-2xl font-semibold mb-4">Update an Article</h2>
                    <label class="block text-sm font-medium text-red-700 error-message1 mb-4"></label>
                    <form class="lg:grid gap-6 grid-cols-1 md:grid-cols-2" id="firstArticle_form"
                      action="#"
                      method="post"
                      onsubmit="return false;"
                      enctype="multipart/form-data">
                      <div>
                        <input
                          type="text"
                          placeholder="Article Title"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          id="title"
                          name="title" value="<?= $title; ?>"/>
                          <input
                          type="hidden"
                          placeholder="Article Title"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          id="id"
                          name="id" value="<?= $id; ?>"/>
                          
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
                      <div>
                        <input
                          type="hidden"
                          placeholder="Tags (comma separated)"
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          id="tags"
                          name="tags" value=""/>
                           <label
                              for="category"
                              class="block text-sm font-semibold mb-2 hidden">Select Category:</label>
                            <select
                              id="category"
                              class="w-full p-2 px-4 border rounded-md mb-4"
                              name="category"
                              id="category">
                              <option value="" disabled>
                                Select a category
                              </option>
                              <option value="Market"  <?php echo $category === 'Market' ? 'selected' : ''; ?>>Market</option>
                              <option value="Investment"  <?php echo $category === 'Investment' ? 'selected' : ''; ?>>Investment</option>
                              <option value="Design"  <?php echo $category === 'Design' ? 'selected' : ''; ?>>Design</option>
                              <option value="Trends"  <?php echo $category === 'Trends' ? 'selected' : ''; ?>>Trends</option>
                              <option value="Guides" <?php echo $category === 'Guides' ? 'selected' : ''; ?>>Guides</option>
                            </select>
                        <label
                          for="imageUpload"
                          class="block text-sm font-semibold mb-2">Upload an Image:</label>
                        <input
                          type="file"
                          id="image1" name=""
                          class="w-full p-2 px-4 border rounded-md mb-4"
                          accept="image/*" />
                        <div class="relative w-full overflow-hidden">
                          <img
                            id="imagePreview" name="imagePreview"
                            class="max-w-32 max-h-32 py-5 object-cover rounded-lg shadow-md"
                            alt="Preview" src="<?php echo $image;?>"/>
                        </div>
                        <!-- Modal Background -->
                        <div id="modal" class="modal hidden">
                          <div class="bg-white w-96 rounded-lg shadow-lg p-4 ">
                            <h2 class="text-xl font-bold mb-4 text-center">Crop Your Image</h2>
    
                            <!-- Cropping Area -->
                            <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
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
                    Your Article is Updated to Admin for Approval.
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
           
        </div>

</main>
</div>
<!-- Footer -->

</body>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<!-- Cropper.js JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
<script>
        tinymce.init({
            selector: '#content1', // Initialize TinyMCE on your textarea
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
            setup: function(editor) {
                editor.on('init', function() {
                    // Set the content from PHP variable when TinyMCE initializes
                    editor.setContent(`<?php echo addslashes($content); ?>`);
                });
            }
        });
    
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


    // Handle image upload and preview
    $("#image1").change(function(event) {
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
      formData.append('imagePreview', base64data);
      

     const loadingIndicator = $('#loadingIndicator');
    loadingIndicator.removeClass('hidden');
     
      $.ajax({
        url: "fetch/update_article.php", // PHP script that will handle saving the image
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
            //$("#step1Circle").removeClass('bg-gray-700'); // Remove highlight
            
          } else {
            document.querySelector('.error-message1').textContent = response;
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

})
  

</script>

</html>