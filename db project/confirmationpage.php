<?php
session_start();
include 'connection.php';

// Get booking ID from URL
$booking_id = $_GET['booking_id'] ?? null;

if ($booking_id) {
    try {
        // Prepare the query to fetch booking details
        $sql = "SELECT booking_id, car_type, car_model, booking_date, booking_time, duration, status FROM bookings WHERE booking_id = :booking_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':booking_id', $booking_id, PDO::PARAM_INT);
        $stmt->execute();

        // Fetch the booking details
        $booking = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$booking) {
            echo "Booking not found.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        exit;
    }
} else {
    echo "No booking ID provided.";
    exit;
}

$conn = null; // Close the connection
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Booking Confirmed</h2>

<div class="confirmation-details">
    <p>Thank you! Your booking has been confirmed.</p>
    <p><strong>Booking ID:</strong> <?php echo htmlspecialchars($booking['booking_id']); ?></p>
    <p><strong>Car Type:</strong> <?php echo htmlspecialchars($booking['car_type']); ?></p>
    <p><strong>Car Model:</strong> <?php echo htmlspecialchars($booking['car_model']); ?></p>
    <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($booking['booking_date']); ?></p>
    <p><strong>Booking Time:</strong> <?php echo htmlspecialchars($booking['booking_time']); ?></p>
    <p><strong>Duration:</strong> <?php echo htmlspecialchars($booking['duration']); ?> hours</p>
    <p><strong>Status:</strong> <?php echo htmlspecialchars($booking['status']); ?></p>
</div>

<a href="index.html" class="btn">Return to Homepage</a>

</body>
</html>
