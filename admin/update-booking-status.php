<?php
require_once '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'], $_POST['action'])) {
    $booking_id = intval($_POST['booking_id']);
    $action = $_POST['action'];

    // Only allow 'approve' or 'reject' actions
    if (!in_array($action, ['approve', 'reject'])) {
        header("Location: bookings.php?msg=" . urlencode("Invalid action"));
        exit;
    }

    // Determine new status
    $newStatus = ($action === 'approve') ? 'approved' : 'rejected';

    // Prepare SQL to update approval_status
    $stmt = $conn->prepare("UPDATE table_bookings SET approval_status = ? WHERE id = ?");
    if (!$stmt) {
        header("Location: bookings.php?msg=" . urlencode("Failed to prepare SQL statement"));
        exit;
    }

    $stmt->bind_param("si", $newStatus, $booking_id);

    if ($stmt->execute()) {
        $msg = ($action === 'approve') ? "✅ Booking approved successfully!" : "❌ Booking rejected successfully!";
        header("Location: bookings.php?msg=" . urlencode($msg));
        exit;
    } else {
        header("Location: bookings.php?msg=" . urlencode("❗ Database error while updating status"));
        exit;
    }
} else {
    // Invalid access
    header("Location: bookings.php?msg=" . urlencode("Invalid request"));
    exit;
}
