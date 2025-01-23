  <!-- Sidebar -->
  <style>
      .active {
  background-color: #4a5568; /* Example color, adjust as needed */
  color: #ffffff;
}

  </style>
  <aside class="w-full lg:w-64 bg-gray-800 text-white p-6">
        <div class="flex flex-col items-center mb-8">
         <div class="bg-white w-1/2 lg:w-2/3 mx-auto">
          <img
          src="assets/logo.png" onclick="location.href='/'"
          alt="logo"
          class=" border-4 p-4 border-yellow-400  h-auto"
        />
         </div>
          <div class="relative mt-6 w-24 h-24 mb-3">
          
            <img id="profileImage"
              src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/img/avatar.png';?>"
              alt="Profile"
              class="rounded-full border-4 border-yellow-400 w-full h-auto"
            /><input type="file" id="imageInput" class="hidden" accept="image/*">
            <button
              class="absolute -bottom-2 left-0 bg-yellow-400 rounded-full p-1" id="uploadButton"
            >
              <img src="assets/Edit.svg" class="w-6 h-6" />
            </button>
          </div>
          <h2 class="text-xl font-semibold"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname'];?></h2>
          <p class="text-sm text-gray-400"><?php echo $_SESSION['username'];?></p>
          <button
            class="mt-2 flex items-center text-sm text-gray-400 hover:text-white" onclick="location.href='Logout'"
          >
            <i class="fas fa-sign-out-alt mr-2"></i> Logout
          </button>
        </div>

        <!-- Navigation Links -->
        <nav>
          <a
            href="dashboard"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            
          >
            <i class="fas fa-user mr-3"></i> My Profile
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="postarticle"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
            
          >
            <i class="fas fa-file-alt mr-3"></i> Post an Article
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="myArticle"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded mb-2"
           
          >
            <i class="fas fa-newspaper mr-3"></i> My Articles
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
          <a
            href="pricing"
            class="flex items-center py-3 px-4 hover:bg-gray-700 rounded"
           
          >
            <i class="fas fa-credit-card mr-3"></i> Payment Info
            <i class="fas fa-chevron-down ml-auto"></i>
            <!-- Dropdown Icon -->
          </a>
        </nav>
      </aside>
      <script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function () {
  // Get the current URL path
  const currentPath = window.location.pathname;

  // Loop through each nav link
  $("nav a").each(function () {
    const linkPath = $(this).attr("href");

    // If the href attribute matches the current path, add 'active' class
    if (currentPath.includes(linkPath)) {
      $(this).addClass("active");
    }
  });
});

</script>