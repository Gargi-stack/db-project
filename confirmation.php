<?php
session_start();
include 'connection.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    // Retrieve booking details
    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();

    if ($booking) {
        echo "<h2>Booking Confirmation</h2>";
        echo "<p>Booking ID: " . $booking['id'] . "</p>";
        echo "<p>Car Type: " . $booking['car_type'] . "</p>";
        echo "<p>Car Model: " . $booking['car_model'] . "</p>";
        echo "<p>Booking Date: " . $booking['booking_date'] . "</p>";
        echo "<p>Booking Time: " . $booking['booking_time'] . "</p>";
        echo "<p>Duration: " . $booking['duration'] . " hours</p>";
        echo "<a href='edit_booking.php?booking_id=" . $booking['id'] . "'>Edit Booking</a> | ";
        echo "<a href='delete_booking.php?booking_id=" . $booking['id'] . "'>Delete Booking</a>";
    } else {
        echo "<p>Booking not found.</p>";
    }
}
?>
