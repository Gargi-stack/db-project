<?php
// Start session to access the user ID
session_start();
include 'connection.php';


// Check if form fields are set to avoid undefined index warnings
$user_id = isset($_POST['userid']) ? $_POST['userid'] : null;
$carType = isset($_POST['carType']) ? $_POST['carType'] : null;
$carModel = isset($_POST['carModel']) ? $_POST['carModel'] : null;
$bookingDate = isset($_POST['bookingDate']) ? $_POST['bookingDate'] : null;
$bookingTime = isset($_POST['bookingTime']) ? $_POST['bookingTime'] : null;
$duration = isset($_POST['duration']) ? $_POST['duration'] : null;

// Check if all required fields are filled and user_id exists
    // Prepare the SQL query
    $sql = "INSERT INTO bookings (user_id, car_type, car_model, booking_date, booking_time, duration) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssi", $user_id, $carType, $carModel, $bookingDate, $bookingTime, $duration);

    if ($stmt->execute()) {
        // Redirect to payment page with booking ID
        $booking_id = $stmt->insert_id;
        header("Location: payment.php?booking_id=" . $booking_id);
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close connections
    $stmt->close();


$conn->close();
?>
