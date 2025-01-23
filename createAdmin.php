<!DOCTYPE html>
<?php session_start();
include_once('connect.php');
//if (!isset($_SESSION['username']) && $_SESSION['usertype'] != 'admin') {
    //header("Location: index.php");
   // exit();
//}


?>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard - Admin</title>
    <!-- Font Awesome CDN -->
    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous"
        referrerpolicy="no-referrer" />
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
        <?php if (isset($_SESSION['username'])){?>
        <aside class="w-full lg:w-64 bg-gray-800 text-white p-6">
            <div class="flex flex-col items-center mb-8">
                <div class="bg-white w-1/2 lg:w-2/3 mx-auto">
                    <img
                        src="assets/logo.png"  onclick="location.href='home'"
                        alt="logo"
                        class=" border-4 p-4 border-yellow-400  h-full" />
                </div>
                <div class="relative mt-6 w-24 h-24 mb-3">

                    <img
                        src="<?php echo ($_SESSION['propic'] !== '') ? $_SESSION['propic'] : 'assets/img/avatar.png'; ?>"
                        alt="Profile"
                        class="rounded-full border-4 border-yellow-400 w-full h-full" />
                    <button
                        class="absolute -bottom-2 left-0 bg-yellow-400 rounded-full p-1">
                        <img src="assets/Edit.svg" class="w-6 h-6" />
                    </button>
                </div>
                <h2 class="text-xl font-semibold"><?php echo $_SESSION['firstname'] . ' ' . $_SESSION['lastname']; ?></h2>
                <p class="text-sm text-gray-400"><?php echo $_SESSION['username'] ?></p>
                <button
                    class="mt-2 flex items-center text-sm text-gray-400 hover:text-white" onclick="location.href='Logout'">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </div>

            <!-- Navigation Links -->
            <nav>
                <a
                    href="adminDashboard"
                    class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2 active">
                    <i class="fas fa-th-large mr-3"></i> Overview
                    <i class="fas fa-chevron-down ml-auto"></i>
                    <!-- Dropdown Icon -->
                </a>
                <a
                    href="viewContact"
                    class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2">
                    <i class="fas fa-file-alt mr-3"></i> Enquiry
                    <i class="fas fa-chevron-down ml-auto"></i>
                    <!-- Dropdown Icon -->
                </a>
                <a
                    href="refund"
                    class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
                    onclick="">
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
                    class="flex items-center py-3 px-4 hover:bg-gray-700 rounded">
                    <i class="fas fa-credit-card mr-3"></i> Account Admin
                    <i class="fas fa-chevron-down ml-auto"></i>
                    <!-- Dropdown Icon -->
                </a>
            </nav>
        </aside> <?php } ?>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Statistics Section -->
            <!-- Content Section -->
            <div id="content" class="space-y-6">
                <section class="bg-white shadow-lg w-full lg:w-10/12 md:mx-auto pl-2 sm:pl-0 md:p-8 rounded-lg">
                    <form action="fetch/insert_user.php" method="post">
                        <h2 class="text-2xl font-bold mb-6 text-center">Create Admin User</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 p-2">
                            <div class="col-span-1">
                                <div class="mb-4">
                                    <label for="firstname" class="block text-gray-700">First Name</label>
                                    <input type="text" id="firstname" name="firstname" required class="w-full px-3 py-2 border rounded">
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="block text-gray-700">Password</label>
                                    <input type="password" id="password" name="password" required class="w-full px-3 py-2 border rounded">
                                </div>
                                <div class="mb-4">
                                    <label for="address" class="block text-gray-700">Address</label>
                                    <input type="text" id="address" name="address" required class="w-full px-3 py-2 border rounded">
                                </div>
                            </div>
                            <div class="col-span-1">
                                <div class="mb-4">
                                    <label for="lastname" class="block text-gray-700">Last Name</label>
                                    <input type="text" id="lastname" name="lastname" required class="w-full px-3 py-2 border rounded">
                                </div>
                                <div class="mb-4">
                                    <label for="phonenumber" class="block text-gray-700">Phone Number</label>
                                    <input type="text" id="phonenumber" name="phonenumber" required class="w-full px-3 py-2 border rounded">
                                </div>
                                <div class="mb-4">
                                    <label for="email" class="block text-gray-700">Email</label>
                                    <input type="email" id="email" name="email" required class="w-full px-3 py-2 border rounded">
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-center mt-4">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-1/3">
                                Add User
                            </button>
                        </div>

                          
                       
                    </form>
                </section>
            </div>
        </main>    
        <!-- Toggle Button for Mobile -->

       
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>
    <!-- JavaScript for Toggle Functionality -->
<script>
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden'); // Toggle the hidden class
    });
    $(document).on('click',function(){
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden'); // Toggle the hidden class
    })
    
</script>

</body>

</html>