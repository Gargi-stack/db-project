<?php
session_start();
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch bookings for the logged-in user
$query = "SELECT * FROM bookings WHERE user_id = ? ORDER BY booking_date DESC";
$stmt = $conn->prepare($query);

// Check for errors in query preparation
if ($stmt === false) {
    die('Error preparing the statement: ' . $conn->error);
}

$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if there are any bookings
if ($result->num_rows > 0) {
    $bookings = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $bookings = [];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('your-background-image.jpg'); /* Add your background image */
            background-size: cover;
            background-position: center;
            margin: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            height: 100vh;
            text-align: center;
            padding: 20px;
        }

        .booking-box {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 800px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
        }

        .booking-box h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .booking-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .booking-list th, .booking-list td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .booking-list th {
            background-color: #16c2d5;
            color: white;
        }

        .booking-list td a {
            color: #16c2d5;
            text-decoration: none;
        }

        .booking-list td a:hover {
            text-decoration: underline;
        }

        .back-btn {
            padding: 10px 20px;
            background-color: #16c2d5;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }

        .back-btn:hover {
            background-color: #2f4ae6;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="booking-box">
        <h2>Your Bookings</h2>

        <?php if (!empty($bookings)) { ?>
            <table class="booking-list">
                <thead>
                    <tr>
                        <th>Booking ID</th>
                        <th>Car Type</th>
                        <th>Car Model</th>
                        <th>Booking Date</th>
                        <th>Booking Time</th>
                        <th>Duration</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($bookings as $booking) { ?>
                        <tr>
                            <td><?php echo $booking['booking_id']; ?></td>
                            <td><?php echo $booking['car_type']; ?></td>
                            <td><?php echo $booking['car_model']; ?></td>
                            <td><?php echo $booking['booking_date']; ?></td>
                            <td><?php echo $booking['booking_time']; ?></td>
                            <td><?php echo $booking['duration']; ?> hours</td>
                            <td>
                                <a href="edit_booking.php?booking_id=<?php echo $booking['booking_id']; ?>">Edit</a> |
                                <a href="delete_booking.php?booking_id=<?php echo $booking['booking_id']; ?>">Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>You have no bookings yet.</p>
        <?php } ?>
    </div>

    <a href="homepage.php" class="back-btn">Back to Dashboard</a>
</div>

</body>
</html>
