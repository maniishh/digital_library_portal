
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Digital Study Library</title>
  <canvas id="bgCanvas" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>
<script src="assets/js/canvas-bg.js"></script>


  <!-- ✅ Tailwind CSS CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    #canvas-bg {
      position: fixed;
      top: 0;
      left: 0;
      z-index: 0;
      width: 100vw;
      height: 100vh;
    }

    .glass {
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
    }
  </style>
</head>
<body class="relative bg-gray-900 text-white font-sans overflow-hidden">

  <!-- Canvas Animation Background -->
 <canvas id="canvas-bg" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>


  <!-- Header -->
 <?php
require_once 'includes/header-guest.php';

?>

  <!-- Hero Section -->
  <section class="h-screen w-full flex items-center justify-center text-center px-4 relative z-10">
    <div class="glass p-10 rounded-3xl shadow-xl max-w-2xl">
      <h2 class="text-4xl font-bold mb-4 drop-shadow">Your Peaceful Study Zone</h2>
      <p class="text-gray-300 mb-6">No lectures. No disturbance. Just reserve a seat and focus on your self-study goals.</p>
      <a href="register.php" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg text-lg font-medium hover:bg-indigo-700 transition">
        Get Started
      </a>
      <a href="login.php" class="inline-block px-6 py-3 bg-indigo-600 text-white rounded-lg text-lg font-medium hover:bg-indigo-700 transition">
        Login Here
      </a>
    </div>
  </section>

  <!-- Footer -->
  <footer class="absolute bottom-0 w-full text-center py-3 text-gray-400 text-sm z-10">
    &copy; <?= date('Y'); ?> Digital Study Library. All rights reserved.
  </footer>

  <script src="assets/js/canvas-bg.js"></script>
  <canvas id="canvas-bg" class="fixed top-0 left-0 w-full h-full -z-10"></canvas>

</body>
</html>
