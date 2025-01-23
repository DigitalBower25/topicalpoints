<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Articles</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:ital,wght@0,200..1000;1,20..1000&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: "Nunito", sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header Section -->
<section class="flex flex-col">
    <header class="flex flex-wrap justify-between items-center py-4 px-4 md:px-8 lg:px-16 w-full text-base font-bold text-white bg-gray-800" id="navbar">

                <div class="flex items-center">
            
                <img loading="lazy" src="" alt="Onest logo" class="w-10 h-10 mr-2" />
                <h1 class="text-lg md:text-xl font-bold hidden sm:block md:hidden">Onest</h1>
                </div>
             <!-- Hamburger Icon for Mobile -->
        <button id="menu-toggle" class="block md:hidden text-white-800 focus:outline-none ">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
        </button>   

             <nav class="hidden md:flex md:top-auto  md:space-x-4 w-36  md:justify-center items-center  md:space-y-0  flex-col md:flex-col absolute 
             md:relative   md:w-auto  p-4 md:p-0  z-10 sm:relative bg-gray-800 md:left-0 order-3 md:order-2 top-20 left-30 lg:top-0   mt-3" id="nav-menu">
                <ul class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-6">
                  <li><a href="#" class="flex items-center hover:text-gray-300">Home</a></li>
                  <li><a href="#" class="flex items-center hover:text-gray-300">Latest Articles</a></li>
                  <li><a href="#" class="flex items-center hover:text-gray-300">Pricing</a></li>
                  <li><a href="#" class="flex items-center hover:text-gray-300">Contact</a></li>
                </ul>
              </nav>
              <div class="flex items-center space-x-4 mt-4 md:mt-0 order-2 md:order-3">
                <button class="px-4 py-2 rounded bg-white bg-opacity-10 hover:bg-opacity-20 transition-colors">
                  Sign In
                </button>
                <button class="flex items-center px-4 py-2 text-sky-500 bg-white rounded shadow-lg hover:bg-gray-100 transition-colors">
                 <span>Post Articles</span>
                </button>
              </div>
        
    </header>
    <main class="flex overflow-hidden relative flex-col pb-80 w-full min-h-fit max-md:pb-24 max-md:max-w-full">
        <img loading="lazy" src="https://cdn.builder.io/api/v1/image/assets/TEMP/dcbe15c909a089bd512411f64b25af9824690e7e06cdd2539cfe3dbe9f49ffad?placeholderIfAbsent=true&apiKey=adaf5d65c8c545829286d5c204fd87f8" alt="" class="object-cover absolute inset-0 size-full" />
      <section class="flex relative flex-col justify-center items-center self-center top-12 mb-0 ml-6 w-full max-md:mt-10 md:top-32 max-md:mb-2.5 md:w-full max-md:max-w-full">
              <h2 class="text-4xl font-bold text-center text-white leading-[86px] max-md:max-w-full max-md:text-4xl max-md:leading-[53px]">
          Browse over 95,00,000 <br /> classified Aricles listing.
        </h2>
        <form class="">
            <div class="flex flex-col md:flex-row items-center space-y-4 md:space-y-0 md:space-x-4 bg-white p-4 rounded-lg shadow-md w-full max-w-4xl mx-auto">
                <!-- Search by ads title, keyword -->
                <div class="flex items-center space-x-2 border-b md:border-b-0 md:border-r pr-0 md:pr-4 w-full md:w-auto">
                    <i class="fas fa-search text-blue-500"></i>
                    <input type="text" placeholder="Search by ads title, keyword..." class="outline-none text-gray-500 w-full md:w-auto">
                </div>
                <!-- Locations -->
                <div class="flex items-center space-x-2 border-b md:border-b-0 md:border-r pr-0 md:pr-4 w-full md:w-auto">
                    <div class="hidden lg:hidden md:hidden sm:hidden "><i class="fas fa-map-marker-alt text-blue-500"></i>
                    <span class="text-gray-500">Locations</span></div>
                </div>
                <!-- Select Category -->
                <div class="flex items-center space-x-2 border-b md:border-b-0 md:border-r pr-0 md:pr-4 w-full md:w-auto">
                   <div class="hidden lg:hidden md:hidden sm:hidden "> <i class="fas fa-layer-group text-blue-500"></i>
                    <span class="text-gray-500">Select Category</span>
                    <i class="fas fa-chevron-down text-gray-500"></i></div>
                </div>
                <!-- Search Button -->
                <button class="flex items-center space-x-2 bg-blue-500 text-white px-4 py-2 rounded-lg w-full md:w-auto">
                    <i class="fas fa-search"></i>
                    <span>Search</span>
                </button>
            </div>
            </form>
    </section>
    </main>
</section>
<!-- How it Works Section -->
<section class="py-6 bg-gray-200">
    <div class="container mx-auto px-6 md:px-20 lg:px-32">
        <h2 class="text-3xl font-semibold text-center mb-6 md:mb-8 lg:mb-12">How it Works</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2 gap-6 md:gap-8 lg:gap-12 p-4">
                 <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 my-4">
                    <div class="text-red-500 text-4xl mb-4">
                        <i class="fas fa-user-plus"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Create Your Account</h3>
                    <p class="text-gray-600">
                        Sign up for a free account on Topical Points to start sharing and discovering articles today!
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 my-4">

                    <div class="text-yellow-500 text-4xl mb-4">
                        <i class="fas fa-podcast"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Submit Your Article</h3>
                    <p class="text-gray-600">
                        Upload your article in the 'Submit Article' section, following our guidelines for best results.
                    </p>
                </div>
               <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 my-4">

                    <div class="text-purple-500 text-4xl mb-4">
                        <i class="fa fa-book-open"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Engage</h3>
                    <p class="text-gray-600">
                        Explore and interact with fellow writers and readers by commenting on and sharing articles!
                    </p>
                </div>
                <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 my-4">

                    <div class="text-green-500 text-4xl mb-4">
                        <i class="fa fa-credit-card"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-2">Promote Your Work
                    </h3>
                    <p class="text-gray-600">
                        Boost your article's visibility by sharing it on social media and encouraging discussions!
                    </p>
                </div>
            </div>
        </div>
</section>


<section class="py-6 bg-gray-200">
    <div class="container mx-auto px-6 md:px-20 lg:px-32">
    <h1 class="text-4xl font-bold text-center mb-8">
     Featured Articles
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-1 lg:grid-cols-2 gap-6 md:gap-8 lg:gap-12 p-4">
     <!-- Ad 1 -->
    <div class="border rounded-lg overflow-hidden shadow-lg">
    <div class="flex flex-col sm:flex-row">
        <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg">
        <div class="p-4 w-full sm:w-2/3">
            <div class="flex items-center mb-2">
                <span class="text-sm text-red-500 font-semibold">Vehicles</span>
            </div>
            <h2 class="text-lg font-semibold mb-2">
                Apple iPhone 7 Plus (32 GB)
                <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">Hot price (Used)</span>
            </h2>
            <div class="flex items-center text-gray-500 text-sm mb-2 space-x-4">
                <i class="fas fa-user"></i>
                <span>Jerome Bell</span>
                <i class="fas fa-map-marker-alt"></i>
                <span>United States</span>
                <i class="fas fa-clock"></i>
                <span>2 hours</span>
            </div>
        </div>
    </div>
</div>

     <!-- Ad 2 -->
     <div class="border rounded-lg overflow-hidden shadow-lg">
      <div class="flex flex-col sm:flex-row">
       <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="300"/>
       <div class="p-4 w-full sm:w-2/3">
        <div class="flex items-center mb-2">
         <span class="text-sm text-red-500 font-semibold">
          Vehicles
         </span>
        </div>
        <h2 class="text-lg font-semibold mb-2">
         Apple iPhone 7 Plus (32 GB)
         <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">
          Hot price (Used)
         </span>
        </h2>
        <div class="flex items-center text-gray-500 text-sm mb-2">
         <i class="fas fa-user mr-1">
         </i>
         Jerome Bell
         <i class="fas fa-map-marker-alt ml-4 mr-1">
         </i>
         United States
         <i class="fas fa-clock ml-4 mr-1">
         </i>
         2 hours
        </div>
        
       </div>
      </div>
     </div>
     <!-- Ad 3 -->
     <div class="border rounded-lg overflow-hidden shadow-lg">
        <div class="flex flex-col sm:flex-row">
         <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="300"/>
         <div class="p-4 w-full sm:w-2/3">
          <div class="flex items-center mb-2">
           <span class="text-sm text-red-500 font-semibold">
            Vehicles
           </span>
          </div>
          <h2 class="text-lg font-semibold mb-2">
           Apple iPhone 7 Plus (32 GB)
           <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">
            Hot price (Used)
           </span>
          </h2>
          <div class="flex items-center text-gray-500 text-sm mb-2">
           <i class="fas fa-user mr-1">
           </i>
           Jerome Bell
           <i class="fas fa-map-marker-alt ml-4 mr-1">
           </i>
           United States
           <i class="fas fa-clock ml-4 mr-1">
           </i>
           2 hours
          </div>
          
         </div>
        </div>
       </div>
     <!-- Ad 4 -->
     <div class="border rounded-lg overflow-hidden shadow-lg">
        <div class="flex flex-col sm:flex-row">
         <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="300"/>
         <div class="p-4 w-full sm:w-2/3">
          <div class="flex items-center mb-2">
           <span class="text-sm text-red-500 font-semibold">
            Vehicles
           </span>
          </div>
          <h2 class="text-lg font-semibold mb-2">
           Apple iPhone 7 Plus (32 GB)
           <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">
            Hot price (Used)
           </span>
          </h2>
          <div class="flex items-center text-gray-500 text-sm mb-2">
           <i class="fas fa-user mr-1">
           </i>
           Jerome Bell
           <i class="fas fa-map-marker-alt ml-4 mr-1">
           </i>
           United States
           <i class="fas fa-clock ml-4 mr-1">
           </i>
           2 hours
          </div>
          
         </div>
        </div>
       </div>
     <!-- Ad 5 -->
     <div class="border rounded-lg overflow-hidden shadow-lg">
        <div class="flex flex-col sm:flex-row">
         <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="300"/>
         <div class="p-4 w-full sm:w-2/3">
          <div class="flex items-center mb-2">
           <span class="text-sm text-red-500 font-semibold">
            Vehicles
           </span>
          </div>
          <h2 class="text-lg font-semibold mb-2">
           Apple iPhone 7 Plus (32 GB)
           <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">
            Hot price (Used)
           </span>
          </h2>
          <div class="flex items-center text-gray-500 text-sm mb-2">
           <i class="fas fa-user mr-1">
           </i>
           Jerome Bell
           <i class="fas fa-map-marker-alt ml-4 mr-1">
           </i>
           United States
           <i class="fas fa-clock ml-4 mr-1">
           </i>
           2 hours
          </div>
          
         </div>
        </div>
       </div>
     <!-- Ad 6 -->
     <div class="border rounded-lg overflow-hidden shadow-lg">
        <div class="flex flex-col sm:flex-row">
         <img alt="Apple iPhone 7 Plus (32 GB)" class="w-full sm:w-1/3 object-cover" height="200" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="300"/>
         <div class="p-4 w-full sm:w-2/3">
          <div class="flex items-center mb-2">
           <span class="text-sm text-red-500 font-semibold">
            Vehicles
           </span>
          </div>
          <h2 class="text-lg font-semibold mb-2">
           Apple iPhone 7 Plus (32 GB)
           <span class="text-xs bg-blue-100 text-blue-500 px-2 py-1 rounded-full">
            Hot price (Used)
           </span>
          </h2>
          <div class="flex items-center text-gray-500 text-sm mb-2">
           <i class="fas fa-user mr-1">
           </i>
           Jerome Bell
           <i class="fas fa-map-marker-alt ml-4 mr-1">
           </i>
           United States
           <i class="fas fa-clock ml-4 mr-1">
           </i>
           2 hours
          </div>
          
         </div>
        </div>
       </div>
    </div>
    <div class="text-center mt-8">
     <button class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition duration-300">
      View All
      <i class="fas fa-arrow-right ml-2">
      </i>
     </button>
    </div>
   </div>
</section>
<section class="py-6 bg-gray-300">
    <div class="container mx-auto px-6 md:px-20 lg:px-32">
    <h1 class="text-3xl font-bold text-center mb-8">
     Recently Posted Articles
    </h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
     <!-- Card 1 -->
     <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-xs mx-auto">
      <div class="relative">
       <img alt="Red sports car parked on a cobblestone driveway" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/NhZQoHvt34boClJbueSQIJvP7MMdGz1pOhBvAhkvLxFEijyJA.jpg" width="600"/>
       <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-2 py-1">
        URGENTS
       </div>
      </div>
      <div class="p-4">
       <div class="flex items-center text-gray-500 text-sm mb-2  bg-white">
        <i class="fas fa-graduation-cap mr-2">
        </i>
        <span>
         Education
        </span>
       </div>
       <h2 class="text-lg font-semibold mb-2">
        Toyota Fielder G HYBRID WXB PE...
       </h2>
       <div class="flex items-center text-gray-500 text-sm mb-2  bg-white">
        <i class="fas fa-map-marker-alt mr-2">
        </i>
        <span>
         Brazil
        </span>
       </div>
       <div class="text-red-500 text-lg font-bold">
        $1,200.00
       </div>
      </div>
     </div>
     <!-- Card 2 -->
     <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-xs mx-auto">
      <img alt="Dining room with wooden table and chairs" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/iHhDW05Xw75fE6xfNqerns5OQli5qOUtoxddZVwUUfvwQcUOB.jpg" width="600"/>
      <div class="p-4">
       <div class="flex items-center text-gray-500 text-sm mb-2  bg-white">
        <i class="fas fa-car mr-2">
        </i>
        <span>
         Vehicles
        </span>
       </div>
       <h2 class="text-lg font-semibold mb-2">
        Canon EOS Rebel SL3 / EOS 250D
       </h2>
       <div class="flex items-center text-gray-500 text-sm mb-2  bg-white">
        <i class="fas fa-map-marker-alt mr-2">
        </i>
        <span>
         New Mexico
        </span>
       </div>
       <div class="text-red-500 text-lg font-bold">
        $1,500.00
       </div>
      </div>
     </div>
     <!-- Card 3 -->
     <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-xs mx-auto">
      <img alt="House model with keys on a wooden table" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/BPseKqY7bP0rc6pshfOEjisV1uV0DT6qX1TKn68INeuWIOKnA.jpg" width="600"/>
      <div class="p-4">
       <div class="flex items-center text-gray-500 text-sm mb-2 bg-white">
        <i class="fas fa-graduation-cap mr-2">
        </i>
        <span>
         Education
        </span>
       </div>
       <h2 class="text-lg font-semibold mb-2">
        Apple iPhone 7 Plus (32 GB) 📱 Hot...
       </h2>
       <div class="flex items-center text-gray-500 text-sm mb-2 bg-white">
        <i class="fas fa-map-marker-alt mr-2">
        </i>
        <span>
         United States
        </span>
       </div>
       <div class="text-red-500 text-lg font-bold">
        $2,300.00
       </div>
      </div>
     </div>
     <!-- Card 4 -->
     <div class="bg-white rounded-lg shadow-md overflow-hidden max-w-xs mx-auto">
      <div class="relative">
       <img alt="Modern houses along a canal with green lawns" class="w-full h-48 object-cover" height="400" src="https://storage.googleapis.com/a1aa/image/Gme5za98G5RaTirbfRxcxFJFXzJamzLP2W6I2IJ4JSgJEHlTA.jpg" width="600"/>
       <div class="absolute top-0 left-0 bg-red-500 text-white text-xs font-bold px-2 py-1">
        URGENTS
       </div>
      </div>
      <div class="p-4">
       <div class="flex items-center text-gray-500 text-sm mb-2  bg-white">
        <i class="fas fa-industry mr-2">
        </i>
        <span>
         Business Industry
        </span>
       </div>
       <h2 class="text-lg font-semibold mb-2">
        DORMAK Lift, 06 Person 07 Stops
       </h2>
       <div class="flex items-center text-gray-500 text-sm mb-2 bg-white">
        <i class="fas fa-map-marker-alt mr-2">
        </i>
        <span>
         Maine
        </span>
       </div>
       <div class="text-red-500 text-lg font-bold">
        $220.00
       </div>
      </div>
     </div>
    </div>
   </div>
</section>
<!-- Footer Section -->
<footer class="py-16 bg-white-100 text-gray-800">
            <div class="container mx-auto px-8">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-16 ">
                    <div>
                        
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-4">Contact</h3>
                        <p>4517 Washington Ave. Manchester, Kentucky 39495</p>
                        <p>Phone: (406) 555-0120</p>
                        <p>Email: anthony@company.com</p>
                    </div>
                    
                    <div>
                        <h3 class="text-lg font-semibold mb-4 ">Quick Links</h3>
                        <ul>
                            <li><a href="#" class="text-white-600">Latest Articles</a></li>
                            <li><a href="#" class="text-white-600">Pricing</a></li>
                            <li><a href="#" class="text-white-600">Contact</a></li>
                            <li><a href="#" class="text-white-600">Post Articles</a></li>
                        </ul>
                    </div>
                </div>
                <div class="container mx-auto px-4 mt-8 text-center text-gray-800">
                    <p>Adfinity - Classified Listing © 2021. Design by Digital Bower</p>
                    <p>
                        <a class="hover:text-white" href="#"> Privacy Policy </a>
                        |
                        <a class="hover:text-white" href="#"> Terms &amp; Condition </a>
                    </p>
                </div>
                <div class="scroll-to-top justify-end flex">
                    <a href="#navbar" class="arrow-up">
                        <i class="fa fa-angle-up"></i>
                    </a>
                </div>
            </div>
</footer>
<script>
        const menuToggle = document.getElementById('menu-toggle');
    const navMenu = document.getElementById('nav-menu');

   
      function isMobileView() {
        return window.innerWidth < 768; // Tailwind's md breakpoint (768px)
    }

    // Toggle the nav menu when clicking the hamburger button
    menuToggle.addEventListener('click', (e) => {
        if (isMobileView()) {
            navMenu.classList.toggle('hidden');
            e.stopPropagation(); // Prevent the click from reaching the document and closing the menu immediately
        }
    });

    // Hide the nav menu when clicking outside of it (only on mobile)
    document.addEventListener('click', (e) => {
        if (isMobileView() && !navMenu.contains(e.target) && !menuToggle.contains(e.target)) {
            navMenu.classList.add('hidden');
        }
    });
</script>

</body>
</html>
