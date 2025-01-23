<header class="mx-auto bg-white shadow border-solid relative">
    <!-- Apply the custom breakpoint for padding at 796px width -->
    <div class="container mx-auto px-4 py-4 flex justify-between items-center sm:px-10 md:px-24 lg:px-32 custom:px-8 relative">
        <div class="flex items-center">
            <img alt="Logo" class="mr-2 border-solid border-2 border-grey-300 p-0" height="50" src="assets/img/logo.png" width="96">
            <span class="text-lg md:text-xl font-bold hidden sm:block md:hidden"> Topicalpoints </span>
        </div>

        <!-- Hamburger Icon for Mobile -->
        <button id="menu-toggle" class="block md:hidden text-gray-800 z-40 relative  focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>
        
        <!-- Navigation Links -->
        <nav id="nav-menu" class="hidden md:flex md:space-x-4 flex-col md:flex-row flex-wrap absolute top-16 left-0 right-0 md:static bg-white md:bg-transparent p-4 md:p-0 shadow md:shadow-none z-20 md:z-auto">
            <a class="text-gray-800 hover:text-blue-500" href="home">Home</a>
            <span class="hidden md:inline-block border-l border-gray-300 h-5 ml-2"></span>
            <a class="text-gray-800 hover:text-blue-500" href="blogList">Latest Articles</a>
            <span class="hidden md:inline-block border-l border-gray-300 h-5 ml-2"></span>
            
            <?php if (isset($_SESSION['username'])) { ?>
                <a class="text-gray-800 hover:text-blue-500" href="pricing">Billing</a>
            <?php } else { ?>            
                <a class="text-gray-800 hover:text-blue-500" id="pricing-link" href="#pricing">Pricing</a>
            <?php } ?>
            
            <span class="hidden md:inline-block border-l border-gray-300 h-5 ml-2"></span>
            <a class="text-gray-800 hover:text-blue-500" href="contact">Contact</a>
        </nav>

        <!-- User/Profile Section -->
        <div class="flex items-center space-x-4">
            <?php if (isset($_SESSION['username'])) { ?>
                <div class="relative">
                    <!-- User Dropdown Toggle -->
                    <button id="userDropdownButton" type="button" class="flex items-center space-x-2">
                        <i class="fas fa-user-circle text-2xl text-gray-800"></i>    
                        <a href="#" class="hidden md:block text-sm font-medium text-gray-700"><?php echo isset($_SESSION['username']) ? 'My Profile' : 'Sign in'; ?></a>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="userDropdown" class="hidden absolute right-0 mt-4 w-48 bg-white text-gray-800 rounded-lg shadow-lg z-50">
                        <ul class="py-1 text-gray-700">
                            <li><a href="profile" class="block px-4 py-2 hover:bg-gray-100">MyProfile</a></li>
                            <li><a href="Logout" class="block px-4 py-2 hover:bg-gray-100">Logout</a></li>
                        </ul>
                    </div>
                </div>
                
                <button class="bg-blue-500 text-white px-4 py-2 rounded text-sm" onclick="location.href = 'postarticle';">
                    Post an Article
                </button>
            <?php } else { ?>
                <a class="text-gray-800 hover:text-blue-500" href="signin"><i class="fas fa-user-circle text-2xl text-gray-800"></i> Sign In</a>
                <button class="bg-blue-500 text-white px-4 py-2 rounded text-sm" onclick="location.href = 'signin';">Post an Article</button>
            <?php } ?>
        </div>
    </div>
</header>




<div id="preloader" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden z-50">
  <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-blue-500"></div>
</div>






