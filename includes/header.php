<?php
if (session_status() === PHP_SESSION_NONE) session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <!-- Use CDN or build path correctly -->
<script src="https://cdn.tailwindcss.com"></script>

  <title>Digital Library Portal</title>
  
  <!-- Tailwind CSS -->
  <link href="/assets/css/tailwind.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/particles.js"></script>

  
  <!-- Font Awesome for Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">

  <!-- Custom Styles / JS -->
  <script src="/assets/js/main.js" defer></script>
  <script src="/assets/js/canvas-bg.js" defer></script>
</head>
<body class="bg-gray-50 text-gray-800">

  <!-- Navigation -->
  <header class="bg-white shadow-sm sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 flex justify-between items-center">
      
      <!-- Logo -->
      <a href="dashboard.php" class="text-xl font-bold text-blue-600">
        📚 Digital Library
      </a>

      <!-- Nav Links -->
      <nav class="space-x-6 text-sm sm:text-base">
        <a href="dashboard.php" class="hover:text-blue-600">Home</a>
        <a href="../student/book-seat.php" class="hover:text-blue-600">Book Seat</a>
        <a href="./my-bookings.php" class="hover:text-blue-600">My Bookings</a>
        <a href="./feedback.php" class="hover:text-blue-600">Feedback</a>
        <?php if (isset($_SESSION['student_id'])): ?>
          <a href="./dashboard.php" class="hover:text-blue-600">Dashboard</a>
          <a href="../student/logout.php" class="text-red-600 hover:underline">Logout</a>
        <?php else: ?>
          <a href="../login.php" class="hover:text-blue-600">Login</a>
          <a href="../register.php" class="hover:text-blue-600">Register</a>
        <?php endif; ?>
      </nav>
    </div>
  </header>

  <!-- Page Content -->
  <main class="pt-6 px-4">
