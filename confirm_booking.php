<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch booking data from the form
    $user_id = $_SESSION['user_id'];
    $carType = $_POST['carType'];
    $carModel = $_POST['carModel'];
    $bookingDate = $_POST['bookingDate'];
    $bookingTime = $_POST['bookingTime'];
    $duration = $_POST['duration'];

    // Insert booking data into database
    $query = "INSERT INTO bookings (user_id, car_type, car_model, booking_date, booking_time, duration) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("issssi", $user_id, $carType, $carModel, $bookingDate, $bookingTime, $duration);

    if ($stmt->execute()) {
        $booking_id = $stmt->insert_id;
        header("Location: confirmation.php?booking_id=$booking_id");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
