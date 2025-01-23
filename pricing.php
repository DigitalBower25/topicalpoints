<!DOCTYPE HTML>
<?php
session_start();
include_once('connect.php');
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Billing & Pricing</title>
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />

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
        <!-- Sidebar section -->
        <?php include_once('sidebar.inc.php'); ?>
         <!-- Main Content -->
      <main class="flex-1 p-6">
        <!-- Statistics Section -->
      

        <!-- Content Section -->
        <div id="content" class="space-y-6">
     
         <div class="bg-white shadow-lg w-full lg:w-10/12 md:mx-auto pl-2 sm:pl-0 md:p-8 rounded-lg">
                <div class="md:p-6 rounded-lg">
                  <h3 class="text-2xl font-semibold mb-6 text-gray-800">Invoice History</h3>
                  <div class="relative overflow-x-auto">
                    <table class="min-w-full text-left text-gray-600 border border-gray-300 rounded-lg overflow-hidden">
                        <thead class="bg-gray-800 text-white uppercase text-sm">
                            <tr>
                                <th scope="col" class="py-3 px-4">Date</th>
                                <th scope="col" class="py-3 px-4">Title</th>
                                <th scope="col" class="py-3 px-4">Plan</th>
                                <th scope="col" class="py-3 px-4">Category</th>
                                <th scope="col" class="py-3 px-4">Amount($)</th>
                                <th scope="col" class="py-3 px-4">#</th>
                            </tr>
                        </thead>
                            <?php
                            // Set the number of results to display per page
                            $results_per_page = 5;

                            // Determine the current page number from the URL (default to page 1 if not provided)
                            if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                                $current_page = (int)$_GET['page'];
                            } else {
                                $current_page = 1;
                            }

                            // Calculate the starting limit for the query
                            $start_from = ($current_page - 1) * $results_per_page;

                            // Get the total number of articles for the logged-in user
                            $sql_total = "SELECT COUNT(*) AS total FROM articles WHERE user_id='" . $_SESSION['username'] . "'";
                            $result_total = $conn->query($sql_total);
                            $total_articles = $result_total->fetch_assoc()['total'];

                            // Calculate the total number of pages needed
                            $total_pages = ceil($total_articles / $results_per_page);

                            // Fetch the articles for the current page
                            $sql = "SELECT * FROM articles WHERE user_id='" . $_SESSION['username'] . "' LIMIT $start_from, $results_per_page";
                            $result = $conn->query($sql);
                            ?>
                             <tbody class="bg-white">
                            
                                <?php
                                if ($result->num_rows > 0) {
                                    // Output data of each row
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr class="hover:bg-gray-100 transition duration-200">
                                <td class="py-2 px-4 border-b">
                                                <?php echo date("M j, Y", strtotime($row['date'] . " 23:34")); ?>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <?= $row['title']; ?>
                                            </td>
                                            <td class="py-2 px-4 border-b">
                                                <?= $row['plan']; ?>
                                            </td>
                                             <td class="py-2 px-4 border-b">
                                                <?= $row['category']; ?>
                                            </td>
                                           <td class="py-2 px-4 border-b">
                                                <?= $row['price']; ?>
                                            </td>
                                            <td class="py-2 px-4 border-b"><?php if($row['ReceiptURL']!=''){?>
                                                <a href="<?= $row['ReceiptURL']?>" class="inline-block px-2 py-2 text-white text-sm bg-blue-500 hover:bg-blue-600 rounded-md" target="_blank">
                                                    <?php echo $row['ReceiptURL']!=''?'Download':''; ?>
                                                </a>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <!-- Pagination links -->
                        <div class="flex justify-center mt-6 space-x-2">
                        
                            <?php
                            if ($total_pages > 1) {
                                // Display pagination links
                                for ($page = 1; $page <= $total_pages; $page++) {
                                    if ($page == $current_page) {
                                        echo "<span class='px-4 py-2 text-white bg-gray-800 rounded-md'>$page</span>";
                                    } else {
                                        echo "<a href='?page=$page' class='px-4 py-2 text-gray-800 bg-white border border-gray-300 rounded-md hover:bg-gray-100 transition duration-200'>$page</a>";
                                    }
                                }
                            }
                            ?>
                        </div>
                        </table>
                    </div>
                </div>
        </div>
        </div>
    </main>
    </div>

</body>

</html>