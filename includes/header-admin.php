<?php
if (session_status() == PHP_SESSION_NONE) session_start();
?>

<!-- Canvas Background -->
<canvas id="canvas-bg" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>
<script src="../assets/js/canvas-bg.js"></script>
<!-- Canvas -->
<canvas id="canvas-bg" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>

<!-- Tailwind via CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Canvas Script -->
<script src="/digital-library-portal/assets/js/canvas-bg.js"></script>
<!-- Tailwind CSS via CDN -->
<script src="https://cdn.tailwindcss.com"></script>

<!-- Canvas Background -->
<canvas id="canvas-bg" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>
<script src="/digital-library-portal/assets/js/canvas-bg.js"></script>

<!-- Admin Header -->
<header class="relative z-10 bg-gradient-to-r from-indigo-600 via-purple-600 to-pink-600 backdrop-blur-sm text-white shadow-md border-b border-white/20 px-6 py-4">
  <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
    <h1 class="text-3xl font-bold tracking-wide">📊 Admin Dashboard</h1>
    <nav class="flex flex-wrap gap-4 text-sm font-medium">
      <a href="/digital-library-portal/admin/index.php" class="hover:underline hover:text-white transition-all duration-200">Dashboard</a>
      <a href="/digital-library-portal/admin/manage-seats.php" class="hover:underline hover:text-white transition-all duration-200">Manage Seats</a>
      <a href="/digital-library-portal/admin/bookings.php" class="hover:underline hover:text-white transition-all duration-200">Bookings</a>
      <a href="/digital-library-portal/admin/payments.php" class="hover:underline hover:text-white transition-all duration-200">Payments</a>
      <a href="/digital-library-portal/admin/messages.php" class="hover:underline hover:text-white transition-all duration-200">Messages</a>
      <div class="flex items-center gap-4">
  <?php include 'bell-icon.php'; ?>
</div>
      <a href="/digital-library-portal/logout.php" class="text-red-300 hover:text-red-400 transition font-semibold">Logout</a>
    

    </nav>
  </div>
</header>
