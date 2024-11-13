<?php
session_start();
include 'connection.php';

if (isset($_GET['booking_id'])) {
    $booking_id = $_GET['booking_id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $bookingDate = $_POST['bookingDate'];
        $bookingTime = $_POST['bookingTime'];
        $duration = $_POST['duration'];

        $query = "UPDATE bookings SET booking_date = ?, booking_time = ?, duration = ? WHERE id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ssii", $bookingDate, $bookingTime, $duration, $booking_id);

        if ($stmt->execute()) {
            header("Location: confirmation.php?booking_id=$booking_id");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $query = "SELECT * FROM bookings WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $booking_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $booking = $result->fetch_assoc();
}

?>

<form method="post">
    <label for="bookingDate">Booking Date:</label>
    <input type="date" name="bookingDate" value="<?php echo $booking['booking_date']; ?>" required>
    
    <label for="bookingTime">Booking Time:</label>
    <input type="time" name="bookingTime" value="<?php echo $booking['booking_time']; ?>" required>
    
    <label for="duration">Duration (hours):</label>
    <input type="number" name="duration" value="<?php echo $booking['duration']; ?>" required>
    
    <button type="submit">Update Booking</button>
</form>
