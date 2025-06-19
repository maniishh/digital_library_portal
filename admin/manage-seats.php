<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
requireAdmin(); // restrict to admin

include '../includes/header-admin.php';

// Add seat
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_seat'])) {
  $seat_number = trim($_POST['seat_number']);
  if ($seat_number !== '') {
    $stmt = $conn->prepare("INSERT INTO table_seats (seat_number, is_active) VALUES (?, 1)"); // is_active: 1 means available
    $stmt->bind_param("s", $seat_number);
    $stmt->execute();
  }
}

// Delete seat
if (isset($_GET['delete'])) {
  $seat_id = intval($_GET['delete']);
  $conn->query("DELETE FROM table_seats WHERE seat_id = $seat_id");
}
?>

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Manage Seats - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Particles.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>

 <style>

  #particles-js {
    text-decoration-color: white;
    color: white;
    position: fixed;
    width: 100%;
    height: 100%;
    z-index: -1;
    top: 0; left: 0;
    background: linear-gradient(135deg,rgb(64, 20, 169),rgb(83, 5, 67)); /* Tailwind slate-800 to slate-900 */
  }
</style>
</head>
<body class="bg-gray-50 min-h-screen font-sans relative">

  <div id="particles-js"></div>

  <div class="max-w-5xl mx-auto px-6 py-10 relative z-10">
    <h2 class="text-2xl font-bold mb-6 text-gray-50">🪑 Manage Seats</h2>

    <!-- Add New Seat -->
    <form method="POST" class="mb-8 flex gap-4 items-end">
      <div class="flex-1">
        <label class="block text-sm text-gray-50 mb-1">Seat Number</label>
        <input type="text" name="seat_number" class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400" required />
      </div>
      <button type="submit" name="add_seat" class="px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Add Seat
      </button>
    </form>

    <!-- Seat List Table -->
    <div class="bg-white shadow rounded overflow-x-auto">
      <table class="min-w-full text-sm text-left border">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-3 border-b">#</th>
            <th class="px-4 py-3 border-b">Seat Number</th>
            <th class="px-4 py-3 border-b">Status</th>
            <th class="px-4 py-3 border-b text-right">Action</th>
          </tr>
        </thead>
        <tbody class="text-gray-700 divide-y divide-gray-200">
          <?php
          $result = $conn->query("SELECT * FROM table_seats ORDER BY seat_id ASC");
          $i = 1;
          if ($result->num_rows > 0):
            while ($row = $result->fetch_assoc()):
          ?>
            <tr>
              <td class="px-4 py-3"><?= $i++ ?></td>
              <td class="px-4 py-3"><?= htmlspecialchars($row['seat_number']) ?></td>
              <td class="px-4 py-3">
                <span class="inline-block px-2 py-1 text-xs rounded
                  <?= ($row['is_active'] == 1) ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' ?>">
                  <?= ($row['is_active'] == 1) ? 'Available' : 'Booked' ?>
                </span>
              </td>

              <td class="px-4 py-3 text-right">
                <a href="?delete=<?= $row['seat_id'] ?>" 
                   onclick="return confirm('Are you sure you want to delete this seat?')"
                   class="text-red-500 hover:text-red-700">
                   Delete
                </a>
              </td>
            </tr>
          <?php endwhile; else: ?>
            <tr>
              <td colspan="4" class="text-center py-6 text-gray-500">No seats added yet.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  

<script>
  particlesJS("particles-js", {
    particles: {
      number: { value: 70, density: { enable: true, value_area: 900 } },
      color: { value: ["#f3f4f6", "#d1d5db", "#e0e7ff"] }, // light gray whites and soft light blue glow
      shape: { type: "circle" },
      opacity: { value: 0.3, random: true },
      size: { value: 3, random: true },
      move: {
        enable: true,
        speed: 1.2,
        direction: "none",
        random: true,
        straight: false,
        bounce: false
      },
      line_linked: {
        enable: true,
        distance: 120,
        color: "#e0e7ff", // soft blue line
        opacity: 0.15,
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


</body>
</html>

<?php include '../includes/footer.php'; ?>
