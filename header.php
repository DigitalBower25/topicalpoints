  <!-- Navbar -->
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <style>
        .hactive {
    position: relative;
}

.hactive::after {
    content: "";
    position: absolute;
    left: 0;
    bottom: -2px; /* Adjust for spacing below the text */
    width: 100%;
    height: 2px; /* Thickness of the underline */
    background-color: #ff914d; /* Color of the underline */
}

    </style>
  <header
    class="w-full max-container header-bg mx-auto flex justify-between lg:justify-end items-center p-4 md:px-20 bg-opacity-50">
    <button
      id="menu-btn"
      class="block lg:hidden text-white focus:outline-none">
      <svg
        xmlns="http://www.w3.org/2000/svg"
        class="h-8 w-8"
        fill="none"
        viewBox="0 0 24 24"
        stroke="currentColor"
        stroke-width="2">
        <path
          stroke-linecap="round"
          stroke-linejoin="round"
          d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

  <?php if (!isset($_SESSION['username'])) { ?>
      <button
        class="text-white px-4 py-2 rounded-full text-xl font-semibold flex items-center gap-2"  onclick="location.href='/signIn'"
      >
        <img src="/assets/person.svg" class="w-5 h-5" /> 
        Sign in
      </button>
      <?php } else {?>
       <div class="relative">
          <button id="dropdown-btn"
        class="text-white px-4 py-2 rounded-full text-xl font-semibold flex items-center gap-2"  
      >
        <img src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/person.svg'?>" class="w-8 h-8 rounded-full" />
        <?php echo ($_SESSION['firstname']!=='')?$_SESSION['firstname']:'Sign out'?> <i class="fas fa-chevron-down text-sm"></i>
      </button>
      
       <!-- Dropdown Menu -->
    <div id="dropdown-menu" class="hidden absolute right-0 mt-2 w-48 shadow-lg header-bg">
        <a href="/" class="block px-4 py-2 text-gray-700 hover:header-bg text-white hover:text-gray-900">Home</a>
      <a href="dashboard" class="block px-4 py-2 text-gray-700 hover:header-bg text-white hover:text-gray-900">My Profile</a>
      <a href="Logout" class="block px-4 py-2 text-gray-700 hover:header-bg text-white hover:text-gray-900"  >Logout</a>
    </div>
  </div>
     <script>
  // Toggle dropdown menu
  document.getElementById('dropdown-btn').addEventListener('click', function () {
    document.getElementById('dropdown-menu').classList.toggle('hidden');
  });

  // Close the dropdown if clicked outside
  document.addEventListener('click', function (event) {
    const dropdownBtn = document.getElementById('dropdown-btn');
    const dropdownMenu = document.getElementById('dropdown-menu');
    if (!dropdownBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
      dropdownMenu.classList.add('hidden');
    }
  });
</script>
  
  
  
      <?php } ?>
    </header>
  </header>
  <nav
    id="mobile-menu"
    class="hidden bg-gray-700 text-white p-4 space-y-4 lg:hidden">
    <a href="/" data-path="/" class="block hover:text-yellow-500">Home</a>
    <a href="/blogList" data-path="/blogList" class="block hover:text-yellow-500">View Articles</a>
    <a href="/#pricing" data-path="/#pricing" class="block hover:text-yellow-500">Pricing</a>
    <a href="/contact" data-path="/contact" class="block hover:text-yellow-500">Contact Us</a>
   
    <?php if (isset($_SESSION['username'])) { ?>

             <?php if($_SESSION['usertype']=='admin'){?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='/demoArticles'">
                    Post an Article
                  </button> <?php }else{ ?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='/postarticle'">
                    Post an Article
                  </button>
                   <?php } ?>
       
      <?php }else{ ?>
      <button
        class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
      onclick="location.href='/signIn'">
        Post an Article
      </button>
      <?php } ?>
  </nav>
  <section
    class="w-full max-container md:px-[40px] lg:px-[100px] mx-auto flex flex-col items-center justify-center banner-bg text-center p-6">
    <img src="/assets/logo.png" alt="Topical Points Logo" class="h-32 mb-6" onclick="location.href='/'"/>

    <nav
      id="menu"
      class="hidden lg:flex gap-2 md:gap-8 my-5 text-base md:text-3xl">
      <a href="/" data-path="/" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">Home</a>
      <a href="/blogList" data-path="/blogList" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">View Articles</a>
      <a href="/#pricing" data-path="/#pricing" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">Pricing</a>
      <a href="/contact" data-path="/contact" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">Contact Us</a>
      
           <?php if (isset($_SESSION['username'])) { ?>

             <?php if($_SESSION['usertype']=='admin'){?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='/demoArticles'">
                    Post an Article
                  </button> <?php }else{ ?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='/postarticle'">
                    Post an Article
                  </button>
                   <?php } ?>
       
      <?php }else{ ?>
      <button
        class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
      onclick="location.href='/signIn'">
        Post an Article
      </button>
      <?php } ?>
    </nav>
      <script src="https://topicalpoints.com/assets/js/jquery-3.7.1.min.js"></script>
 <script>
    // JavaScript to toggle mobile menu visibility
    const menuBtn = document.getElementById("menu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
      // Toggle the 'hidden' class to show or hide the menu
      mobileMenu.classList.toggle("hidden");
    });
  </script>
   <script>
$(document).ready(function() {
    // Get the current URL path
    let path = window.location.pathname;

    // Remove any trailing slashes for consistency
    path = path.replace(/\/$/, "");

    // Set the active class based on the path
    $('#menu a, #mobile-menu a').each(function() {
        if ($(this).data('path') === path) {
            $(this).addClass('hactive');
        }
    });
});
</script>
  </section>
