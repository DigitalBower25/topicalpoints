<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 - Page Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="text-center">
    <h1 class="text-6xl font-bold text-gray-800">404</h1>
    <p class="text-xl text-gray-600 mt-4">Oops! The page you're looking for doesn't exist.</p>
    <?php session_start(); if(!isset($_SESSION['USERNAME'])){?>
    <a href="/" 
       class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
      Go Back Home
    </a>
    <?php } else {?>
     <a href="/Profile" 
       class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition">
      Go Back Home
    </a>
    
    <?php } ?>
  </div>
</body>
</html>
