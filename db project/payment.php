<?php
session_start();
$booking_id = $_GET['booking_id'] ?? null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Page</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<h2>Confirm Your Payment</h2>
<p>Booking ID: <?php echo htmlspecialchars($booking_id); ?></p>
<!-- Display more booking details here if needed -->

<form action="confirmationpage.php" method="POST">
    <input type="hidden" name="booking-id" value="<?php echo $booking_id; ?>">

    <label for="cardNumber">Card Number:</label>
    <input type="text" id="cardNumber" name="cardNumber" required  placeholder="1234 5678 9012 3456">

    <label for="expiry">Expiry Date:</label>
    <input type="text" id="expiry" name="expiry" required placeholder="MM/YY">

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" required pattern="[0-9]{3}" placeholder="123">

    <button type="submit">Submit Payment</button>
</form>

</body>
</html>
