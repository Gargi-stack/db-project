<?php
session_start();
include 'connection.php';
// Get booking ID and simulate payment details
$booking_id = (int)$_POST['booking_id'] ?? $_GET['booking_id'] ?? null;
$cardNumber = $_POST['cardNumber'] ?? null;
$expiry = $_POST['expiry'] ?? null;
$cvv = $_POST['cvv'] ?? null;

// Simulate payment processing
if ( $cardNumber && $expiry && $cvv) {
  
        header("Location:confirmationpage.php?booking_id=" . $booking_id);
        exit;

    $conn->close();
} else {
    echo "Payment details are missing.";
}
?>
