<footer class="bg-gray-900 text-gray-400 px-16 " id="footer">
    <div class=" grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-16 p-5">
         <div class="">
            <img alt="Logo" class="mr-2 bg-gray-100" height="75" src="assets/img/logo.png" width="100">
        </div>
        <div class="">
            <h3 class="text-white text-xl font-bold mb-4">Topical Points</h3>
            <p>4517 Washington Ave. Manchester, <br>Kentucky 39495</p>
            <p>Phone: (405) 555-0128</p>
            <p>Mail: info@topicalpoints.com</p>
        </div>
        
        <div class="">
            <h3 class="text-white text-xl font-bold mb-4">Quick Links</h3>
            <ul>
                <li>
                    <a class="hover:text-white" href="#"> About </a>
                </li>
                <li>
                    <a class="hover:text-white" href="home/#pricing"> Get Pricing </a>
                </li>
                <li>
                    <a class="hover:text-white" href="signup"> Post a Article </a>
                </li>
                <li>
                    <a class="hover:text-white" href="blogList"> Blog </a>
                </li>
            </ul>
        </div>
 <div class="">
            
        </div>
    </div>

    <div class="container mx-auto px-4 mt-8 text-center text-gray-500">
        <p>Topical Points - Classified Listing © <?= date('Y'); ?>. Design by Digital Bower</p>
        <p>
            <a class="hover:text-white" href="#"> Privacy Policy </a>
            |
            <a class="hover:text-white" href="#"> Terms &amp; Condition </a>
        </p>
    </div>
   
</footer>


<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

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

    // Hide the nav menu when resizing to a non-mobile view
    window.addEventListener('resize', () => {
        if (!isMobileView()) {
            navMenu.classList.add('hidden');
        }
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var pricingLink = document.getElementById("pricing-link");
    
        if (window.location.pathname === "/index.php") {
            pricingLink.href = "#pricing";
        } else {
            pricingLink.href = "index#pricing";
        }
    });
    
    document.addEventListener('DOMContentLoaded', function () {
    const userDropdownButton = document.getElementById('userDropdownButton');
    const userDropdown = document.getElementById('userDropdown');

    // Toggle dropdown when button is clicked
    userDropdownButton.addEventListener('click', function (event) {
      event.stopPropagation(); // Prevent click from propagating to the document
      userDropdown.classList.toggle('hidden');
    });

    // Close the dropdown when clicking anywhere outside of it
    document.addEventListener('click', function (event) {
      if (!userDropdown.contains(event.target) && !userDropdownButton.contains(event.target)) {
        userDropdown.classList.add('hidden');
      }
    });
  });
  
  function showPreloader() {
  document.getElementById('preloader').classList.remove('hidden');
}

function hidePreloader() {
  document.getElementById('preloader').classList.add('hidden');
}

// Example AJAX call
function makeAjaxCall() {
  showPreloader();

  // Simulating an AJAX call
  setTimeout(() => {
    // Your AJAX code here (e.g., fetching data)
    hidePreloader();
  }, 2000);
}

// Call the function to see the preloader


</script>
