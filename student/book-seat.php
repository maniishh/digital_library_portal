<?php
require_once '../includes/db.php';
require_once '../includes/auth.php';
include '../includes/header.php';

function formatDateTime($datetime) {
  return date('d M Y, h:i A', strtotime($datetime));
}

$success = '';
$error = '';

$defaultFeeQuery = "SELECT daily_fee, half_month_fee, monthly_fee FROM table_seats WHERE is_active = 1 LIMIT 1";
$defaultResult = $conn->query($defaultFeeQuery);
$fee_data = $defaultResult->fetch_assoc() ?? ['daily_fee' => 0, 'half_month_fee' => 0, 'monthly_fee' => 0];

$studentData = ['name' => '', 'profile_photo' => 'default.png'];
if (isset($_SESSION['student_id'])) {
  $student_id = $_SESSION['student_id'];
  $stmt = $conn->prepare("SELECT name, profile_photo FROM table_students WHERE id = ?");
  $stmt->bind_param("i", $student_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $studentData = $result->fetch_assoc() ?? ['name' => '', 'profile_photo' => 'default.png'];
  $stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $student_name = trim($_POST['student_name']);
  $date = $_POST['date'];
  $till_date = $_POST['till_date'];
  $shift = $_POST['shift'];
  $start_time = $_POST['start_time'];
  $end_time = $_POST['end_time'];
  $seat_id = $_POST['seat_id'];
  $fees_type = $_POST['fees_type'];
  $payment_method = $_POST['payment_method'];
  $purpose = $_POST['purpose'];

  if (!isset($_SESSION['student_id'])) {
    $error = "You must be logged in to book a seat.";
  } else {
    if ($student_name && $date && $till_date && $shift && $start_time && $end_time && $seat_id && $fees_type && $purpose && $payment_method) {
      $id_proof = '';
      if (isset($_FILES['id_proof']) && $_FILES['id_proof']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['id_proof']['name'], PATHINFO_EXTENSION);
        $id_proof = uniqid() . '.' . $ext;
        move_uploaded_file($_FILES['id_proof']['tmp_name'], "../uploads/id_proofs/" . $id_proof);
      }

      $feeQuery = "SELECT seat_number, daily_fee, half_month_fee, monthly_fee FROM table_seats WHERE seat_id = ?";
      $stmtFee = $conn->prepare($feeQuery);
      $stmtFee->bind_param("s", $seat_id);
      $stmtFee->execute();
      $fee_result = $stmtFee->get_result();
      $fee_data = $fee_result->fetch_assoc();

      $seat_number = $fee_data['seat_number'];
      $daily_fee = $fee_data['daily_fee'];
      $half_month_fee = $fee_data['half_month_fee'];
      $monthly_fee = $fee_data['monthly_fee'];

      $start = new DateTime($date);
      $end = new DateTime($till_date);
      $days = $start->diff($end)->days + 1;

      if ($fees_type === 'monthly') {
        $months = max(1, ceil($days / 30));
        $amount = $months * $monthly_fee;
      } elseif ($fees_type === 'half_month') {
        $half_months = max(1, ceil($days / 15));
        $amount = $half_months * $half_month_fee;
      } else {
        $amount = $days * $daily_fee;
      }

      $stmt = $conn->prepare("INSERT INTO table_bookings (student_id, date, start_time, end_time, seat_id, till_date, shift, purpose, id_proof) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
      $stmt->bind_param("issssssss", $student_id, $date, $start_time, $end_time, $seat_id, $till_date, $shift, $purpose, $id_proof);

      if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;

        $stmtPay = $conn->prepare("INSERT INTO table_payments (student_id, amount, status, method, payment_date, booking_id) VALUES (?, ?, 'pending', ?, NOW(), ?)");
        $stmtPay->bind_param("idsi", $student_id, $amount, $payment_method, $booking_id);
        $stmtPay->execute();

        $updateSeat = $conn->prepare("UPDATE table_seats SET is_active = 0 WHERE seat_id = ?");
        $updateSeat->bind_param("s", $seat_id);
        $updateSeat->execute();

        $title = "New Seat Booking";
        $message = "\ud83d\udc68\u200d\ud83c\udf93 <strong>$student_name</strong> booked seat <strong>$seat_number</strong> from <strong>$date</strong> to <strong>$till_date</strong>.";
        $stmtNoti = $conn->prepare("INSERT INTO table_notifications (title, message) VALUES (?, ?)");
        $stmtNoti->bind_param("ss", $title, $message);
        $stmtNoti->execute();

        $payNotiTitle = "New Payment Received";
        $payNotiMsg = "\ud83d\udcb8 <strong>$student_name</strong> paid \u20b9<strong>" . number_format($amount, 2) . "</strong> via <strong>$payment_method</strong>.";
        $stmtPayNoti = $conn->prepare("INSERT INTO table_notifications (title, message) VALUES (?, ?)");
        $stmtPayNoti->bind_param("ss", $payNotiTitle, $payNotiMsg);
        $stmtPayNoti->execute();

        // Redirect to success page
        header("Location: payment-success.php?booking_id=$booking_id");
        exit;
      } else {
        $error = "Booking failed: " . $stmt->error;
      }
    } else {
      $error = "All fields are required.";
    }
  }
}
?>




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

<div class="min-h-screen bg-gray-100 py-10 px-4">
  <div class="max-w-xl mx-auto bg-white p-8 rounded-xl shadow-lg">
    <h2 class="text-2xl font-bold mb-4 text-center">📚 Book a Seat</h2>

    <div class="text-center mb-6">
      <img src="/digital-library-portal/uploads/profiles/<?= htmlspecialchars($studentData['profile_photo']) ?>" class="w-24 h-24 rounded-full mx-auto shadow border object-cover" />
      <p class="text-sm text-gray-700 mt-2 font-medium"><?= htmlspecialchars($studentData['name']) ?></p>
    </div>

    <?php if ($success): ?>
      <div class="mb-4 p-4 bg-green-100 text-green-700 rounded"><?= $success ?></div>
    <?php endif; ?>
    <?php if ($error): ?>
      <div class="mb-4 p-4 bg-red-100 text-red-700 rounded"><?= $error ?></div>
    <?php endif; ?>

    <form method="POST" enctype="multipart/form-data" class="space-y-5">
      <input type="hidden" name="student_name" value="<?= htmlspecialchars($studentData['name']) ?>" />

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>From Date</label>
          <input type="date" name="date" class="w-full px-4 py-2 border rounded bg-gray-50" required />
        </div>
        <div>
          <label>Till Date</label>
          <input type="date" name="till_date" class="w-full px-4 py-2 border rounded bg-gray-50" required />
        </div>
      </div>

      <div>
        <label>Shift</label>
        <select name="shift" class="w-full px-4 py-2 border rounded bg-gray-50" required>
          <option value="">-- Select Shift --</option>
          <option value="morning">Morning</option>
          <option value="afternoon">Afternoon</option>
          <option value="evening">Evening</option>
        </select>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label>Start Time</label>
          <input type="time" name="start_time" class="w-full px-4 py-2 border rounded bg-gray-50" required />
        </div>
        <div>
          <label>End Time</label>
          <input type="time" name="end_time" class="w-full px-4 py-2 border rounded bg-gray-50" required />
        </div>
      </div>

      <div>
        <label>Seat Number</label>
        <select name="seat_id" class="w-full px-4 py-2 border rounded bg-gray-50" required>
          <option value="">-- Select Seat --</option>
          <?php
          $seatQuery = "SELECT seat_id, seat_number FROM table_seats WHERE is_active = 0 ORDER BY seat_number ASC";
          $result = $conn->query($seatQuery);
          while ($row = $result->fetch_assoc()):
          ?>
            <option value="<?= $row['seat_id'] ?>"><?= $row['seat_number'] ?></option>
          <?php endwhile; ?>
        </select>
      </div>

      <div>
        <label>Fees Type</label>
        <select name="fees_type" class="w-full px-4 py-2 border rounded bg-gray-50" required>
          <option value="">-- Select --</option>
          <option value="daily">Per Day</option>
          <option value="half_month">Half Month</option>
          <option value="monthly">Monthly</option>
        </select>
      </div>

      <div class="bg-gray-100 p-3 rounded border text-sm">
        <p>🗓 Per Day Fee: ₹<?= number_format($fee_data['daily_fee']) ?></p>
        <p>🌓 Half Month Fee: ₹<?= number_format($fee_data['half_month_fee']) ?></p>
        <p>📅 Monthly Fee: ₹<?= number_format($fee_data['monthly_fee']) ?></p>
      </div>

      <div>
        <label>Purpose</label>
        <textarea name="purpose" class="w-full px-4 py-2 border rounded bg-gray-50" rows="3" required></textarea>
      </div>

      <div>
        <label>ID Proof</label>
        <input type="file" name="id_proof" accept=".pdf,.jpg,.jpeg,.png" class="w-full px-4 py-2 border rounded bg-gray-50" required />
      </div>
      <div>
  <label>Payment Method</label>
  <select name="payment_method" class="w-full px-4 py-2 border rounded bg-gray-50" required>
    <option value="">-- Select Method --</option>
    <option value="UPI">UPI</option>
    <option value="Cash">Cash</option>
    <option value="Card">Card</option>
    <option value="Netbanking">Netbanking</option>
  </select>
</div>


      <div class="pt-4">
        <button type="submit" class="w-full py-3 rounded-lg bg-indigo-600 hover:bg-indigo-700 text-white font-semibold shadow-lg">
          📥 Book Seat
        </button>
      </div>
    </form>
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
