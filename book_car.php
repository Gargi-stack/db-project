<?php
session_start();
include 'connection.php';
// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in to book a car.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book a Car</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <h1>Book a Car</h1>

    <div class="form-container">
        <form id="carBookingForm" action="confirm_booking.php" method="post">
            <!-- User ID - Automatically fetched from session -->
            <input type="hidden" id="userid" name="userid" value="<?php echo $_SESSION['user_id']; ?>">

            <!-- Select Car Type -->
            <label for="carType">Select Car Type:</label>
            <select id="carType" name="carType" onchange="updateCarOptions()" required>
                <option value="">-- Select Type --</option>
                <option value="manual">Manual</option>
                <option value="automatic">Automatic</option>
            </select>

            <!-- Select Car Model Based on Type -->
            <label for="carModel">Select Car Model:</label>
            <select id="carModel" name="carModel" required>
                <option value="">-- Select Model --</option>
            </select>

            <!-- Booking Date -->
            <label for="bookingDate">Booking Date:</label>
            <input type="date" id="bookingDate" name="bookingDate" required>

            <!-- Booking Time -->
            <label for="bookingTime">Booking Time:</label>
            <input type="time" id="bookingTime" name="bookingTime" required>

            <!-- Duration -->
            <label for="duration">Number of Hours:</label>
            <input type="number" id="duration" name="duration" min="1" placeholder="Enter hours" required>

            <!-- Submit Button -->
            <button type="submit">Confirm Booking</button>
        </form>
    </div>

    <script>
        function updateCarOptions() {
            const carType = document.getElementById("carType").value;
            const carModel = document.getElementById("carModel");

            // Clear previous options
            carModel.innerHTML = '<option value="">-- Select Model --</option>';

            // Car options based on the selected type
            const manualCars = [
                { value: 'manual_wagonR', text: 'WagonR' },
                { value: 'manual_Baleno', text: 'Baleno' },
                { value: 'manual_swift', text: 'Swift' }
            ];

            const automaticCars = [
                { value: 'automatic_wagonR', text: 'WagonR' },
                { value: 'automatic_Nexon', text: 'Nexon' },
                { value: 'automatic_Alto', text: 'Alto' }
            ];

            let options = [];

            if (carType === "manual") {
                options = manualCars;
            } else if (carType === "automatic") {
                options = automaticCars;
            }

            options.forEach(option => {
                const opt = document.createElement("option");
                opt.value = option.value;
                opt.textContent = option.text;
                carModel.appendChild(opt);
            });
        }
    </script>

</body>
</html>