<!DOCTYPE html>
<?php session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
include_once('connect.php');

$sql_free = "select count(*) as free from articles WHERE plan='Basic' and user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_free);
$row = $result->fetch_assoc();
$free = $row['free'];

$sql_total = "SELECT COUNT(*) as total FROM articles WHERE user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_total);
$row = $result->fetch_assoc();
$total = $row['total'];

$sql_paid = "select count(*) as paid from articles where plan!='Basic' and user_id='".$_SESSION['username']."'";
$result = $conn->query($sql_paid);
$row = $result->fetch_assoc();
$paid = $row['paid'];

?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Topical Points - Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
      /* Prevent overflow and ensure smooth layout shift */
      body {
        overflow-x: hidden;
      }

      /* Transition for sidebar */
      #sidebar {
        transition: transform 0.3s ease-in-out;
      }

      /* Full width for mobile sidebar when open */
      @media (max-width: 768px) {
        #sidebar {
          width: 100%;
        }
      }
    </style>

    <script defer>
      // Toggle sidebar for mobile and tablets
      function toggleSidebar() {
        const sidebar = document.getElementById("sidebar");
        sidebar.classList.toggle("-translate-x-full");

        // Adjust the main content margin when sidebar opens
        const mainContent = document.getElementById("main-content");
        mainContent.classList.toggle("top]");
      }
    </script>
  </head>

  <body class="bg-gray-100 overflow-hidden">
    <!-- Mobile Navbar -->
    <div class="md:hidden bg-gray-800 p-4 text-white flex justify-between items-center">
      <h1 class="text-xl font-semibold">Topical Points</h1>
      <button onclick="toggleSidebar()">
        <img src="assets/hamburger.svg" class="w-8 h-8" alt="Menu" />
      </button>
    </div>

    <div class="flex h-screen">
      <!-- Sidebar -->
      <aside
        id="sidebar"
        class="w-64 bg-gray-800 text-white p-4 fixed md:relative transform md:translate-x-0 -translate-x-full transition-transform duration-300 ease-in-out z-50"
      >
        <div class="flex flex-col items-center mb-6">
          <div class="relative w-24 h-24 mb-3">
            <img
              src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/img/avatar.png';?>"
              alt="Profile"
              class="rounded-full border-2 border-yellow-400"
            />
            <button class="absolute -bottom-2 left-0 bg-yellow-400 rounded-full p-1" id="uploadButton">
              <img src="assets/Edit.svg" class="w-7 h-7" />
              <input type="file" id="imageInput" class="hidden" accept="image/*">
            </button>
          </div>
          <h2 class="text-xl font-semibold"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></h2>
          <p class="text-sm text-gray-400"><?php echo $_SESSION['username'];?></p>
          <button class="mt-2 flex items-center text-sm text-gray-400 hover:text-white" onclick="location.href='Logout';">
            <img src="assets/logout.svg" class="w-4 h-4 mr-1" alt="Logout" /> 
          </button>
        </div>
        <nav>
         <a href="profile" class="flex items-center py-2 px-4 bg-gray-700 rounded mb-1">
            <img src="assets/user.svg" class="w-5 h-5 mr-2" /> My Profile
          </a>
          <a href="postarticle" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded mb-1">
            <img src="assets/article.svg" class="w-5 h-5 mr-2" /> Post an Article
          </a>
          <a href="myArticle" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded mb-1">
            <img src="assets/articles.svg" class="w-5 h-5 mr-2" /> My Articles
          </a>
          <a href="pricing" class="flex items-center py-2 px-4 hover:bg-gray-700 rounded mb-1">
            <img src="assets/payment.svg" class="w-5 h-5 mr-2" /> Payment Info
          </a>
        </nav>
      </aside>

      <!-- Main Content -->
      <main
        id="main-content"
        class="flex-1 p-4 transition-all duration-300 ease-in-out"
      >
        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
          <div class="bg-yellow-100 p-4 rounded-lg text-center">
            <h3 class="text-4xl font-bold"><?= $total; ?></h3>
            <p class="text-sm">Total Articles</p>
          </div>
          <div class="bg-green-100 p-4 rounded-lg text-center">
            <h3 class="text-4xl font-bold"><?= $paid; ?></h3>
            <p class="text-sm">Paid Articles</p>
          </div>
          <div class="bg-pink-100 p-4 rounded-lg text-center">
            <h3 class="text-4xl font-bold"><?= $free; ?></h3>
            <p class="text-sm">Free Articles</p>
          </div>
        </div>

        <!-- Personal Information -->
        <div class="bg-[#D9D9D9] rounded-lg shadow-sm p-6 mb-6">
          <h2 class="text-2xl font-semibold mb-4">Personal Information</h2>
          <form>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <input type="text" placeholder="First Name" class="w-full p-2 border rounded" />
              <input type="text" placeholder="Last Name" class="w-full p-2 border rounded" />
            </div>
            <input type="email" placeholder="Email" class="w-full p-2 border rounded mb-4" />
            <textarea placeholder="Bio" class="w-full p-2 border rounded mb-4" rows="4"></textarea>
            <button class="bg-gray-600 text-white px-4 py-2 rounded hover:bg-gray-700">Save</button>
          </form>
        </div>
      </main>
    </div>
  </body>
</html>
