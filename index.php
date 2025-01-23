<!DOCTYPE html>
<?php session_start();error_reporting(0);include('connect.php'); ?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon">
  <title>Topical Points - Home </title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
      integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  <link rel="stylesheet" href="style.css" />
</head>
<style>
  .line-clamp-1 {
  display: -webkit-box;
  -webkit-line-clamp: 1;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

.line-clamp-4 {
  display: -webkit-box;
  -webkit-line-clamp: 4;
  -webkit-box-orient: vertical;
  overflow: hidden;
  text-overflow: ellipsis;
}

</style>
<body>
    <header
      class="w-full max-container header-bg mx-auto flex justify-between lg:justify-end items-center p-4 md:px-20 bg-opacity-50"
    >
      <button
        id="imenu-btn"
        class="block lg:hidden text-white focus:outline-none"
      >
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-8 w-8"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor"
          stroke-width="2"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M4 6h16M4 12h16M4 18h16"
          />
        </svg>
      </button>
 <?php if (!isset($_SESSION['username'])) { ?>
      <button
        class="text-white px-4 py-2 rounded-full text-xl font-semibold flex items-center gap-2"  onclick="location.href='signIn'"
      >
        <img src="assets/person.svg" class="w-5 h-5" /> 
        Sign in
      </button>
      <?php } else {?>
       <div class="relative">
          <button id="dropdown-btn"
        class="text-white px-4 py-2 rounded-full text-xl font-semibold flex items-center gap-2"  
      >
        <img src="<?php echo ($_SESSION['propic']!=='')?$_SESSION['propic']:'assets/person.svg'?>" class="w-8 h-8 rounded-full" />
        <?php echo ($_SESSION['firstname']!=='')?$_SESSION['firstname']:'Sign out'?> <i class="fas fa-chevron-down ml-auto mt-auto text-sm"></i>
      </button>
      
       <!-- Dropdown Menu -->
     <!-- Dropdown Menu -->
    <div id="dropdown-menu" class="hidden absolute right-0 mt-4 w-48 shadow-lg header-bg">
      <a href="dashboard" class="block px-4 py-2 text-gray-700 hover:header-bg text-white hover:text-gray-900" >My Profile</a>
      <a href="Logout" class="block px-4 py-2 text-gray-700 hover:header-bg text-white hover:text-gray-900 "  >Logout</a>
    </div>
  </div>
      <?php } ?>
    </header>
    <nav
      id="mobile-menu"
      class="hidden bg-gray-700 text-white p-4 space-y-4 lg:hidden"
    >
      <a href="/" class="block hover:text-yellow-500">Home</a>
      <a href="blogList" class="block hover:text-yellow-500">View Articles</a>
      <a href="/#pricing" class="block hover:text-yellow-500">Pricing</a>
      <a href="contact" class="block hover:text-yellow-500">Contact Us</a>
       <?php if (isset($_SESSION['username'])) { ?>

             <?php if($_SESSION['usertype']=='admin'){?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='demoArticles'">
                    Post an Article
                  </button> <?php }else{ ?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='postarticle'">
                    Post an Article
                  </button>
                   <?php } ?>
       
      <?php }else{ ?>
      <button
        class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
      onclick="location.href='signIn'">
        Post an Article
      </button>
      <?php } ?>
    </nav>
    <section
      class="w-full max-container md:px-[40px] lg:px-[100px] mx-auto flex flex-col items-center justify-center banner-bg text-center p-6"
    >
      <img src="/assets/logo.png" alt="Topical Points Logo" class="h-32 mb-6" onclick="location.href='index'"/>

      <nav
        id="menu"
        class="hidden lg:flex gap-2 md:gap-8 my-5 text-base md:text-3xl"
      >
        <a href="/" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">Home</a>
        <a href="blogList" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg"
          >View Articles</a
        >
        <a href="/#pricing" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg">Pricing</a>
        <a href="contact" class="hover:bg-[#ff914d] py-2 px-4 rounded-lg"
          >Contact Us</a
        >
      </nav>

      <h1 class="md:text-7xl text-3xl font-extrabold text-yellow-500 mb-10">
        Award-winning <br />creative agency <br />in the country
      </h1>
 <?php if (isset($_SESSION['username'])) { ?>

             <?php if($_SESSION['usertype']=='admin'){?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='demoArticles'">
                    Post an Article
                  </button> <?php }else{ ?>
                  <button
                    class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
                  onclick="location.href='postarticle'">
                    Post an Article
                  </button>
                   <?php } ?>
       
      <?php }else{ ?>
      <button
        class="px-10 py-4 text-xl font-bold rounded-full bg-[#ff914d] text-black hover:bg-red-600 hover:text-white"
      onclick="location.href='signIn'">
        Post an Article
      </button>
      <?php } ?>
    </section>

  <!-- Section with Image and Text -->
  <section
    class="w-full max-container md:px-[40px] lg:px-[100px] mx-auto px-8 py-16">
    <div class="flex flex-col md:flex-row items-center gap-4 md:gap-20">
      <!-- Image Section -->
      <div class="md:w-1/2">
        <img
          src="assets/img/banner2.jpg"
          alt="Laptop Image"
          class="rounded-lg" />
      </div>

      <!-- Text Section -->
      <div class="md:w-1/2 w-full text-center md:text-left">
        <h1 class="text-3xl md:text-6xl font-medium mb-4">Your Gateway to Knowledge</h1>
        <p class="text-xl italic mb-6">
         Curated Content Across Topics.<br />
        </p>
        <p class="text-xl mb-6">
           Explore a wide range of articles crafted to expand your knowledge and spark curiosity. From trending topics to in-depth insights, our collection is designed to keep you updated and inspired.
        </p>
      </div>
    </div>
  </section>
  <!-- Cards Section -->
  <section
    class="w-full max-container md:px-[40px] lg:px-[100px] mx-auto px-3 py-3 md:py-16">
    <div class="text-left mb-8">
      <p class="text-gray-500">New on the Articles</p>
      <h2 class="text-3xl md:text-6xl font-medium">
       Recently Posted Articles
      </h2>
    </div>

    <!-- Category Buttons -->
    <div class="flex w-full overflow-x-scroll lg:overflow-x-visible  space-x-3 category">
      <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white bg-black text-white whitespace-nowrap">
        All
      </button>
      
      <?php $sql = "SELECT categories FROM categories"; $result = $conn->query($sql);if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {?>
                             <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap"><?= $row["categories"];?></span>
                           </button> <?php }} ?>
     
      <!-- <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap"> Market
      </button>     <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap">
        Investment
      </button>
      <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap">
       Design
      </button>
      <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap">
       Trends
      </button>
      <button class="px-6 py-0 h-auto md:py-2 border border-black inline-block text-sm md:text-base rounded-full hover:bg-black hover:text-white whitespace-nowrap">
        Guides
      </button> -->
      <button class="bg-[#ff914d] px-6 py-3 rounded-full font-semibold text-base whitespace-nowrap" onclick="location.href='blogList'">
        View All
      </button>
    </div>
    
    <!-- Cards Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 mt-6 lg:grid-cols-3 gap-y-10 md:gap-4 lg:gap-12" id="article-container">
      <!-- Card 1 -->
     
     <!-- <div class="bg-[#f5f5f5] shadow rounded-2xl overflow-hidden">
        <img
          src="assets/card-image.jpg"
          alt="Card Image"
          class="w-full h-56 object-cover" />
        <div class="p-6">
          <h3 class="text-xl font-semibold mb-2">
            Your Article Title Goes Here
          </h3>
          <p class="text-gray-600 mb-4">
            There is just enough space here for several lines of text.
          </p>
          <div class="flex items-center space-x-4">
            <img
              src="https://via.placeholder.com/40"
              alt="Avatar"
              class="w-10 h-10 border-4 border-[#f4ee35] rounded-full" />
            <div>
              <p class="text-lg font-semibold">Author Name</p>
              <p class="text-sm">22 Nov 2024</p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-[#f5f5f5] shadow rounded-2xl overflow-hidden">
        <img
          src="assets/card-image.jpg"
          alt="Card Image"
          class="w-full h-56 object-cover" />
        <div class="p-6">
          <h3 class="text-xl font-semibold mb-2">
            Your Article Title Goes Here
          </h3>
          <p class="text-gray-600 mb-4">
            There is just enough space here for several lines of text.
          </p>
          <div class="flex items-center space-x-4">
            <img
              src="https://via.placeholder.com/40"
              alt="Avatar"
              class="w-10 h-10 border-4 border-[#f4ee35] rounded-full" />
            <div>
              <p class="text-lg font-semibold">Author Name</p>
              <p class="text-sm">22 Nov 2024</p>
            </div>
          </div>
        </div>
      </div>
      <!-- Repeat Card 2 and Card 3 as needed -->
    </div>
  </section>
  <section
    class="md:px-[40px] lg:px-[100px] max-container mx-auto md:my-20 py-7 px-4 bg-blck-g md:py-20">
    <div class="text-center mb-8">
      <p class="text-gray-500 mb-4">How We Make it Happen</p>
      <h2 class="text-3xl md:text-6xl font-medium mb-4">
        How it Works
      </h2>
    </div>
    <div class="grid grid-cols-2 lg:grid-cols-4 lg:gap-0 gap-10 justify-between">
      <!-- Service Item -->
      <div class="col-span-1 text-center px-4 md:px-10">
        <img
          src="assets/icon1.png"
          alt="Placeholder icon for submission service"
          class="w-32 h-32 mb-4 mx-auto" />
        <h3 class="text-lg font-semibold mb-2">Create Your Account</h3>
        <p class="text-sm text-gray-600">
          Sign up for a free account on Topical Points to start sharing and discovering articles today!
        </p>
      </div>
      <div class="col-span-1 text-center px-4 md:px-10">
        <img
          src="assets/icon2.png"
          alt="Placeholder icon for submission service"
          class="w-32 h-32 mb-4 mx-auto" />
        <h3 class="text-lg font-semibold mb-2">Submit Your Article</h3>
        <p class="text-sm text-gray-600">
          Upload your article in the 'Submit Article' section, following our guidelines for best results.
        </p>
      </div>
      <div class="col-span-1 text-center px-4  md:px-10">
        <img
          src="assets/icon3.png"
          alt="Placeholder icon for submission service"
          class="w-32 h-32 mb-4 mx-auto" />
        <h3 class="text-lg font-semibold mb-2">Engage</h3>
        <p class="text-sm text-gray-600">
          Explore and interact with fellow writers and readers by commenting on and sharing articles!
        </p>
      </div>
      <div class="col-span-1 text-center px-4  md:px-10">
        <img
          src="assets/icon4.png"
          alt="Placeholder icon for submission service"
          class="w-32 h-32 mb-4 mx-auto" />
        <h3 class="text-lg font-semibold mb-2">Promote Your Work</h3>
        <p class="text-sm text-gray-600">
           Boost your article's visibility by sharing it on social media and encouraging discussions!
        </p>
      </div>
      <!-- Additional Service Items duplicated to match reference -->
      <!-- ... -->
    </div>
  </section>

    <!-- Pricing Section -->
  <section class="my-10 md:my-0 px-4" id="pricing">
        <div class="text-center mb-8 px-4">
      <p class="text-gray-500 mb-4">Your Content Budget</p>
      <h2 class="text-3xl md:text-6xl font-medium mb-4">
        Pricing Post Articles
      </h2>
    </div>
    <div
      class="grid sm:grid-cols-2 jjustify-center lg:grid-cols-3 max-container md:mt-20  gap-4 w-full md:px-[40px] lg:px-[160px] mx-auto text-white">
      <!-- Standard Plan -->
      <div class="bg-[#3a302f] rounded-xl shadow-lg p-8 w-full  text-center">
        <h2 class="text-2xl font-bold mb-4">Starter</h2>
        <p class="text-gray-400 mb-6">
           Get Started with Quality Articles.
        </p>
        <p class="text-4xl font-bold mb-2">
           $50 <span class="text-lg font-normal">/article</span>
        </p>
        <p class="text-gray-400 mb-6">
          <br />
        </p>
        <ul class="space-y-4 mb-6 text-left">
          <li>✔ Article remains active for 1 month</li>
          <li>✔ Access to advanced formatting tools (images, tables, etc.)</li>
          <li>✔ Email support available for article-related queries</li>
          <li>✔ Minimal display ads on published articles</li>
        </ul>
        <div class="text-left">
          <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold"  onclick="location.href='signIn'">
            Get Started
          </button>
        </div>
      </div>

      <!-- Premium Plan -->
      <div class="bg-[#3a302f] rounded-xl shadow-lg lg:scale-110 p-8 w-full  text-center border-2 border-red-500">
        <h2 class="text-2xl font-bold mb-4 flex justify-center items-center">
          Pro
          <span class="ml-2 bg-blue-500 text-white text-xs font-semibold py-1 px-2 rounded-md">POPULAR</span>
        </h2>
        <p class="text-gray-400 mb-6">
           Boost Your Visibility and Reach
        </p>
        <p class="text-4xl font-bold mb-2">
         $100 <span class="text-lg font-normal">/article</span>
        </p>
        <p class="text-gray-400 mb-6">
          <br />
        </p>
        <ul class="space-y-4 mb-6 text-left">
           <li>✔ Article remains active for 3 months</li>
          <li>✔ Access to premium formatting options images, tables, videos etc.)</li>
          <li>✔ Minimal display ads on published articles</li>
          <li>✔ Moderate SEO improve visibility search</li>
        </ul>
        <div class="text-left">
          <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold"  onclick="location.href='signIn'">
            Get Started
          </button>
        </div>
      </div>

      <!-- Premium Plus Plan -->
      <div class="bg-[#3a302f] rounded-xl shadow-lg p-8 w-full  text-center">
        <h2 class="text-2xl font-bold mb-4">Business</h2>
        <p class="text-gray-400 mb-6">
          Quality Content, Exceptional Service
        </p>
        <p class="text-4xl font-bold mb-2">
           $300<span class="text-lg font-normal">/article</span>
        </p>
        <p class="text-gray-400 mb-6">
         <br />
        </p>
        <ul class="space-y-4 mb-6 text-left">
           <li>✔ Article remains active for 1 year.</li>
          <li>✔ Update up to 2 times on active period.</li>
          <li>✔ Access to premium formatting.</li>
          <li>✔ Priority email support.</li>
          <li>✔ Minimal display ads.</li>
          <li>✔ Advanced SEO improve visibility in search</li>
        </ul>
        <div class="text-left">
          <button class="bg-[#f34f67] text-white py-2 px-4 rounded-full w-auto font-semibold"  onclick="location.href='signIn'">
            Get Started
          </button>
        </div>
      </div>
    </div>
  </section>

  
  <?php include('footer.php');?>
  <script src="assets/js/jquery-3.7.1.min.js"></script>
     <script>
        $(document).ready(function() {
            
            
            
            
            
            function fetchArticles(page = 1) {
                $.ajax({
                    url: 'fetch/fetchArticle.php',
                    type: 'GET',
                    data: {
                        page: page,
                        limit: 3
                    },
                    dataType: 'json',
                    success: function(data) {
                        const container = $('#article-container');
                        container.empty();
                        console.log(data);
                        if(data.articles.length>0){
                        data.articles.forEach(function(article) {
                            // Convert comma-separated tags into an array
                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];
                            const content = article.content;
                            const articleHTML = ` <a href="article/${article.slug}" ><div class="bg-[#f5f5f5] shadow rounded-2xl overflow-hidden" >
                                                     <img
                                                          src="${article.image}"
                                                          alt="Card Image"
                                                          class="w-full h-56 object-cover" />
                                                        <div class="p-6">
                                                          <h3 class="text-xl font-semibold mb-2 min-h-[55px]">
                                                            ${article.title}
                                                          </h3>
                                                          <p class="text-gray-600 mb-4 line-clamp-3 min-h-[62px] md:min-h-[65px]">
                                                            ${content}
                                                          </p>
                                                          <div class="flex items-center space-x-4">
                                                            <img
                                                              src="https://via.placeholder.com/40"
                                                              alt="Avatar"
                                                              class="w-10 h-10 border-4 border-[#f4ee35] rounded-full" />
                                                            <div>
                                                              <p class="text-lg font-semibold">${article.author}</p>
                                                              <p class="text-sm">${article.date}</p>
                                                            </div>
                                                          </div>
                                                        </div>
                                                      </div></a>`;
                                                                            container.append(articleHTML);
                        });

                    
                    }else{
                      const inarticles = `<div class="flex no-data flex-col items-center justify-center p-8 bg-gray-100 rounded-lg shadow-md mb-4">
                                            <div class="bg-blue-100 p-6 rounded-full mb-4">
                                                <img src="assets/img/no-data.png" alt="No data available" class="w-24 h-24 object-contain">
                                            </div>
                                            <h2 class="text-xl font-semibold text-gray-700 mb-2">No Data Available</h2>
                                            <p class="text-gray-500 text-center max-w-sm">
                                                It looks like there’s nothing to display right now. Please check back later or try refreshing the page.
                                            </p>
                                        </div>`;
                                         container.removeClass('lg:grid-cols-3');
                                         container.addClass('lg:grid-cols-1');
                                         container.append(inarticles);
                    }
                    /* ,
                                        error: function(error) {
                                            console.error('Error fetching articles:', error);
                                            swal('Error fetching articles:');
                                        } */
}
                });
            }
           
            fetchArticles();
            
       
            $('.category button').on('click', function() {
                // Remove 'bg-black' and 'text-white' from all buttons
            $('.category button').removeClass('bg-black text-white');

            // Add 'bg-black' and 'text-white' to the clicked button
            $(this).addClass('bg-black text-white');
              var category = ($(this).text()).trim(); // Get the button text
              if(category=='All'){
                  fetchArticles();
              }else{
              $.ajax({
            url: 'fetch/getCategory.php', // Update with the correct path to your backend script
            type: 'GET', // or 'POST' depending on your backend logic
            dataType: 'json',
            data: { category: category, page: 1,
                        limit: 3 }, // Pass category if needed for filtering
            success: function(data) {
                const container = $('#article-container');
                        container.empty();
                        console.log(data);
                        if(data.articles.length>0){
                        data.articles.forEach(function(article) {
                            // Convert comma-separated tags into an array
                            const tags = article.tags ? article.tags.split(',').map(tag => tag.trim()) : [];
                            const content = article.content;
                            const articleHTML = `  <a href="article/${article.slug}">
  <div class="bg-[#f5f5f5] shadow rounded-2xl overflow-hidden flex flex-col h-full">
    <img
      src="${article.image}"
      alt="Card Image"
      class="w-full h-56 object-cover"
    />
    <div class="p-6 flex flex-col flex-grow">
      <h3 class="text-xl font-semibold mb-2 line-clamp-1">
        ${article.title}
      </h3>
      <p class="text-gray-600 mb-4 line-clamp-4 flex-grow">
        ${content}
      </p>
      <div class="flex items-center space-x-4 mt-auto">
        <img
          src="https://via.placeholder.com/40"
          alt="Avatar"
          class="w-10 h-10 border-4 border-[#f4ee35] rounded-full"
        />
        <div>
          <p class="text-lg font-semibold">${article.author}</p>
          <p class="text-sm">${article.date}</p>
        </div>
      </div>
    </div>
  </div>
</a>
`;                                                                           container.removeClass('lg:grid-cols-1');
                        container.addClass('lg:grid-cols-3');    
                                                                            container.append(articleHTML);
                        });

                    
                    }else{
                      const inarticles = `<div class="flex no-data flex-col items-center justify-center p-8 bg-gray-100 rounded-lg shadow-md mb-4">
    <div class="bg-blue-100 p-6 rounded-full mb-4">
        <img src="assets/img/no-data.png" alt="No data available" class="w-24 h-24 object-contain">
    </div>
    <h2 class="text-xl font-semibold text-gray-700 mb-2">No Data Available</h2>
    <p class="text-gray-500 text-center max-w-sm">
        It looks like there’s nothing to display right now. Please check back later or try refreshing the page.
    </p>
</div>
`;                      container.removeClass('lg:grid-cols-3');
                        container.addClass('lg:grid-cols-1');
                        container.append(inarticles);
                    }
                    /* ,
                                        error: function(error) {
                                            console.error('Error fetching articles:', error);
                                            swal('Error fetching articles:');
                                        } */

            
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX error:', textStatus, errorThrown);
            }
        });
              }
            });
        });
        
        
    </script>
    
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
 <script>
    // JavaScript to toggle mobile menu visibility
    const menuBtn = document.getElementById("imenu-btn");
    const mobileMenu = document.getElementById("mobile-menu");

    menuBtn.addEventListener("click", () => {
      // Toggle the 'hidden' class to show or hide the menu
      mobileMenu.classList.toggle("hidden");
    });
  </script>

</body>

</html>