<!DOCTYPE html>
<?php session_start();
include_once('connect.php');error_reporting(0);
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin') {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Add/Edit Categories - Admin</title>
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
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
      <!-- Sidebar -->
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
          <a
            href="Addcategories"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
          >
            <i class="fas fa-credit-card mr-3"></i> Categories
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
        </nav>
      </aside>
      <!-- Main Content -->
      <main class="flex-1 p-6">
        <!-- Statistics Section -->
        <!-- Content Section -->
        <div id="content" class="space-y-6">
                 <section class="bg-white shadow-lg w-full lg:w-10/12 md:mx-auto pl-2 sm:pl-0 md:p-8 rounded-lg">
                <div class="md:p-6 rounded-lg">
                 <h3 class="text-2xl font-semibold text-gray-700 mb-6">Add / Edit  Category</h3>
            <div class="flex justify-between items-center mb-4">
                
            </div>
            <div class="relative overflow-x-auto">
                <div class="bg-white p-8 rounded-lg shadow-md w-4/6">
        
        <form action="insert_category.php" method="POST">
            <div class=" flex mb-4 ">
                <label for="category_name" class="block text-gray-600 font-semibold mb-2">Category Name</label>
                <input type="text" id="category_name" name="category_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-blue-500" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 rounded-lg transition-colors">Add Category</button>
        </form>
    </div>
    <?php // Fetch categories from the `categories` table
$sql = "SELECT id, categories FROM categories ORDER by categories ASC";
$result = $conn->query($sql);
?>
                    <table class="min-w-full text-left text-gray-600 border border-gray-300 rounded-lg overflow-hidden" id="table">
                        <thead>
                <tr>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">ID</th>
                    <th class="py-2 px-4 border-b text-left text-gray-600 font-semibold">Category Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td class='py-2 px-4 border-b'>" . $row["id"] . "</td>";
                        echo "<td class='py-2 px-4 border-b'>" . $row["categories"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2' class='py-2 px-4 text-center text-gray-500'>No categories found.</td></tr>";
                }
                ?>
            </tbody>
            </table>
            
            
            
            </div>
            <div class="flex justify-center mt-4">
                <nav aria-label="Page navigation">
                    <ul class="flex justify-between mt-2 w-full" id="pagination-controls">
                    </ul>
                </nav>
            </div></div>
                 <!-- Loading Indicator -->
                    <div id="loadingIndicator" class="hidden fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-50 z-50">
                      <div class="flex flex-col items-center">
                        <div class="loader animate-spin h-16 w-16 border-4 border-t-4 border-blue-500 rounded-full"></div>
                        <p class="mt-4 text-white text-lg font-semibold">Loading...</p>
                      </div>
                    </div>
            
        </section>
                
        </div>
      </main>
    </div>
    
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
   
  </body>
</html>
