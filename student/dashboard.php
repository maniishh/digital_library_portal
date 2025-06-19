<?php
session_start();
if (!isset($_SESSION['student_id']))  {
  header("Location: ../login.php");
  exit();
}

include '../includes/db.php';
include '../includes/header.php';

$user_id = $_SESSION['student_id'];

$query = "SELECT name, profile_photo FROM table_students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
?>




<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Student Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function showTime() {
      const now = new Date();
      const time = now.toLocaleTimeString();
      document.getElementById("current-time").textContent = time;
    }
    setInterval(showTime, 1000);
  </script>
  <div id="particles-js"></div>
<style>
  #particles-js {
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;
    top: 0; left: 0;
    background: linear-gradient(135deg, #1e293b, #312e81); /* dark navy to indigo */
  }
</style>
</head>
<body class="bg-gradient-to-br from-indigo-50 to-purple-100 min-h-screen text-gray-50">



  <div class="max-w-6xl mx-auto py-10 px-4">
    <div class="flex items-center justify-between mb-8">
      <div>
        <h1 class="text-3xl font-bold text-gray-50">Welcome, <?= htmlspecialchars($user['name']) ?> 👋</h1>
        <p class="text-sm text-gray-50">Your digital study hub</p>
        <p class="text-xs text-gray-100 mt-1">Current Time: <span id="current-time"></span></p>
      </div>
      <div class="flex items-center gap-4">
<img src="../uploads/profile_photos/<?= htmlspecialchars($user['profile_photo']) ?>" class="w-14 h-14 rounded-full object-cover border-2 border-blue-500" alt="Profile Photo" />
        <a href="./logout.php" class="text-sm text-red-500 hover:underline">Logout</a>
      </div>
    </div>

    <div class="flex flex-col sm:flex-row sm:justify-center gap-4 mb-6 text-center">
      <a href="../reports/generate-report.php" target="_blank" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
        📄 Download PDF Report
      </a>
      <a href="../reports/export-csv.php" class="bg-green-600 hover:bg-green-700 text-white font-semibold px-6 py-2 rounded-lg shadow-md transition duration-200">
        📁 Export as CSV
      </a>
    </div>

    

    <hr class="mb-10 border-gray-300">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      <!-- Dashboard Cards -->
      <a href="book-seat.php" class="bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-3">
          <div class="text-3xl">📚</div>
          <div>
            <h2 class="text-xl font-semibold">Book a Seat</h2>
            <p class="text-sm text-gray-600">Reserve your study table.</p>
          </div>
        </div>
      </a>

      <a href="my-bookings.php" class="bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-3">
          <div class="text-3xl">📅</div>
          <div>
            <h2 class="text-xl font-semibold">My Bookings</h2>
            <p class="text-sm text-gray-600">See current & past bookings.</p>
          </div>
        </div>
      </a>

      <a href="./timer.php" class="bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-3">
          <div class="text-3xl">⏱</div>
          <div>
            <h2 class="text-xl font-semibold">Study Timer</h2>
            <p class="text-sm text-gray-600">Track your sessions.</p>
          </div>
        </div>
      </a>

      <a href="payment.php" class="bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-3">
          <div class="text-3xl">💳</div>
          <div>
            <h2 class="text-xl font-semibold">Payments</h2>
            <p class="text-sm text-gray-600">Pay for seat usage.</p>
          </div>
        </div>
      </a>

      <a href="feedback.php" class="bg-white rounded-2xl p-6 shadow-xl hover:shadow-2xl transition transform hover:-translate-y-1">
        <div class="flex items-center gap-3">
          <div class="text-3xl">💬</div>
          <div>
            <h2 class="text-xl font-semibold">Feedback</h2>
            <p class="text-sm text-gray-600">Share your experience.</p>
          </div>
        </div>
      </a>

      <div class="bg-white rounded-2xl p-6 shadow-xl text-center">
        <img src="../uploads/profile_photos/<?= htmlspecialchars($user['profile_photo']) ?>" class="w-20 h-20 rounded-full mx-auto object-cover border-2 border-indigo-500 mb-2" alt="Profile Photo" />
        <h2 class="text-lg font-semibold">🎓 <?= htmlspecialchars($user['name']) ?></h2>
        <p class="text-sm text-gray-500">Student</p>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js"></script>
<script>
const ctx1 = document.getElementById('monthlyChart').getContext('2d');
const chart1 = new Chart(ctx, {
  type: 'bar',
  data: {
    labels: <?= json_encode($chartLabels) ?>,
    datasets: [{
      label: 'Total Amount (₹)',
      data: <?= json_encode($chartData) ?>,
      backgroundColor: 'rgba(59, 130, 246, 0.5)',
      borderColor: 'rgba(59, 130, 246, 1)',
      borderWidth: 1
    }]
  },
  options: {
    responsive: true,
    scales: {
      y: {
        beginAtZero: true,
        ticks: {
          callback: function(value) {
            return '₹' + value;
          }
        }
      }
    }
  }
});

particlesJS("particles-js", {
  particles: {
    number: { value: 60, density: { enable: true, value_area: 800 } },
    color: { value: ["#c7d2fe", "#e0e7ff", "#f0f9ff"] },
    shape: { type: ["circle", "star"] },
    opacity: { value: 0.4, random: true },
    size: { value: 3, random: true },
    move: {
      enable: true,
      speed: 1.5,
      direction: "none",
      random: true,
      straight: false,
      bounce: false
    },
    line_linked: {
      enable: true,
      distance: 120,
      color: "#93c5fd",
      opacity: 0.2,
      width: 1
    }
  },
  interactivity: {
    detect_on: "canvas",
    events: {
      onhover: { enable: true, mode: "grab" },
      onclick: { enable: true, mode: "push" }
    },
    modes: {
      grab: { distance: 140, line_linked: { opacity: 0.3 } },
      push: { particles_nb: 4 }
    }
  },
  retina_detect: true
});
</script>

<?php include '../includes/footer.php'; ?>

</body>
</html>
