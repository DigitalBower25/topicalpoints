<!DOCTYPE html>
<?php session_start();
include_once('connect.php');
if (!isset($_SESSION['username']) && $_SESSION['usertype'] == 'admin') {
    header("Location: index.php");
    exit();
}
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
        </aside>
        <!-- Main Content -->
        <main class="flex-1 p-6">
            <!-- Statistics Section -->
            <!-- Content Section -->
            <div id="content" class="space-y-6">
                <section class="bg-white shadow-lg w-full lg:w-10/12 md:mx-auto pl-2 sm:pl-0 md:p-8 rounded-lg">
                    <div class="md:p-6 rounded-lg">
                        <h3 class="text-2xl font-semibold mb-6 text-gray-800">Enquiry</h3>
                       
                       <div class="relative overflow-x-auto">
                            <table class="min-w-full text-left text-gray-600 border border-gray-300 rounded-lg overflow-hidden" id="table">
                                <thead class="bg-gray-800 text-white uppercase">
                                <tr class="bg-gray-50 text-blue-500">
                                    <th class="p-4 text-center">
                                        Date
                                    </th>
                                     <th class="p-4 text-center">
                                        Name
                                    </th>
                                     <th class="p-4 text-center">
                                        Phone
                                    </th>
                                    <th class="p-4 text-center">
                                        Email
                                    </th>
                                    <th class="p-4 text-center">
                                        Message
                                    </th>
                                   
                                </tr>
                            </thead>
                             <?php
                                        // Set the number of results to display per page
                                        $results_per_page = 10;
                                            $range = 1;
                                        // Determine the current page number from the URL (default to page 1 if not provided)
                                        if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                            $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                                        } else {
                                            $current_page = 1;
                                        }
            
                                        // Calculate the starting limit for the query
                                        $start_from = ($current_page - 1) * $results_per_page;
            
                                        // Get the total number of articles for the logged-in user
                                        $sql_total = "SELECT COUNT(*) AS total FROM callback_request";
                                        $result_total = $conn->query($sql_total);
                                        $total_articles = $result_total->fetch_assoc()['total'];
            
                                        // Calculate the total number of pages needed
                                        $total_pages = ceil($total_articles / $results_per_page);
            
                                        // Fetch the articles for the current page
                                        $sql = "SELECT * FROM callback_request  LIMIT $start_from, $results_per_page";
                                        $result = $conn->query($sql);
                                        ?>
                                        <tbody class="bg-white">
                                            <?php
                                            if ($result->num_rows > 0) {
                                                // Output data of each row
                                                while ($row = $result->fetch_assoc()) {
                                            ?>
                                                    
                                                    <tr class="border-b text-center">
                                                            <td class="py-4 px-6 flex items-center text-gray-700">
                                                               <?php echo date("d-M-Y", strtotime($row['submitted_at']));?>
                                                            </td>
                                                             <td class="py-4 px-6 text-gray-700">
                                                                 <?= $row['name'];?>
                                                            </td>
                                                            <td class="py-4 px-6 text-gray-700">
                                                                 <?= $row['email'];?>
                                                            </td>
                                                            <td class="py-4 px-6 text-gray-700">
                                                                 <?= $row['country_code'].'-'.$row['phone'];?>
                                                            </td>
                                                            <td class="py-4 px-6 text-center text-gray-700">
                                                                <p style="text-align:justify;"> <?= $row['message'];?></p></td>
                                                           
                                                        </tr>
                                                    <?php }}else{?>
                                                    <tr>
                                                        <td colspan="5" class="text-center">
                                                            
                                                            <img src="assets/img/no-data.png" alt="Not Found" class="mx-auto max-h-52 max-w-64 mt-4 object-top">
                                                            <p class="font-semibold text-md text-blue-500 ">Data Not Found</p>
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                                 <div class="flex justify-center mt-5">
    <?php
        // Show first page link if not on the first page
        if ($current_page > $range + 1) {
            echo '<a href="?page=1" class="px-4 py-2 mx-1 text-blue-500 border border-gray-300 rounded hover:bg-gray-100 transition">1</a>';
            if ($current_page > $range + 2) {
                echo '<span class="px-4 py-2 mx-1">...</span>'; // Ellipsis for skipped pages
            }
        }

        // Display page numbers within the range
        for ($i = max(1, $current_page - $range); $i <= min($total_pages, $current_page + $range); $i++) {
            if ($i == $current_page) {
                // Highlight current page
                echo '<span class="px-4 py-2 mx-1 text-white bg-blue-500 rounded">' . $i . '</span>';
            } else {
                echo '<a href="?page=' . $i . '" class="px-4 py-2 mx-1 text-blue-500 border border-gray-300 rounded hover:bg-gray-100 transition">' . $i . '</a>';
            }
        }

        // Show last page link if not on the last page
        if ($current_page < $total_pages - $range) {
            if ($current_page < $total_pages - $range - 1) {
                echo '<span class="px-4 py-2 mx-1">...</span>'; // Ellipsis for skipped pages
            }
            echo '<a href="?page=' . $total_pages . '" class="px-4 py-2 mx-1 text-blue-500 border border-gray-300 rounded hover:bg-gray-100 transition">' . $total_pages . '</a>';
        }
    ?>
</div>
                                    
                                    
                                    
                        </div>
               </section>
            </div>
        </main>
    </div>
    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/sweetalert.min.js"></script>

    <!-- JavaScript for Toggle Functionality -->
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('hidden'); // Toggle the hidden class
        });
       
    </script>

    <style>
        /* Additional CSS for the toggle button */
        #toggleSidebar {
            position: fixed;
            bottom: 20px;
            right: 80px;
            z-index: 1000; /* Ensure it's above other elements */
        }
    
        @media (min-width: 768px) {
            #toggleSidebar {
                display: none; /* Hide toggle button on larger screens */
            }
        }
    </style>
    
</body>

</html>