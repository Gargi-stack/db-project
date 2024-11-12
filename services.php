<?php
include 'connection.php'; // Include the database connection file

// Fetch vehicles from the database
$vehicles_sql = "SELECT * FROM vehicles";
$vehicles_result = $conn->query($vehicles_sql);

// Fetch drivers from the database
$drivers_sql = "SELECT * FROM drivers WHERE status = 'Active'";  // Active drivers
$drivers_result = $conn->query($drivers_sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transport Management System - Homepage</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <header>
        <h1>Welcome to the Transport Management System</h1>
    </header>

    <nav>
        <ul>
            <li><a href="view-vehicles.php">View All Vehicles</a></li>
            <li><a href="view-drivers.php">View All Drivers</a></li>
            <li><a href="book-car.php">Book a Car</a></li>
        </ul>
    </nav>

    <div class="content">
        <!-- Vehicles Section -->
        <section class="vehicle-section">
            <h2>Our Vehicles</h2>
            <table class="vehicle-table">
                <thead>
                    <tr>
                        <th>Vehicle Type</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Capacity</th>
                        <th>General Info</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($vehicles_result->num_rows > 0) {
                        // Output vehicle data in rows
                        while($vehicle = $vehicles_result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $vehicle['vehicle_type'] . '</td>';
                            echo '<td>' . $vehicle['make'] . '</td>';
                            echo '<td>' . $vehicle['model'] . '</td>';
                            echo '<td>' . $vehicle['capacity'] . ' ' . $vehicle['capacity_type'] . '</td>';
                            echo '<td>' . $vehicle['general_info'] . '</td>';
                            echo '<td><img src="' . $vehicle['image'] . '" alt="' . $vehicle['make'] . ' ' . $vehicle['model'] . '" width="100"></td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='6'>No vehicles found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>

        <!-- Drivers Section -->
        <section class="driver-section">
            <h2>Our Active Drivers</h2>
            <table class="driver-table">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($drivers_result->num_rows > 0) {
                        // Output driver data in rows
                        while($driver = $drivers_result->fetch_assoc()) {
                            echo '<tr>';
                            echo '<td>' . $driver['first_name'] . '</td>';
                            echo '<td>' . $driver['last_name'] . '</td>';
                            echo '<td>' . $driver['email'] . '</td>';
                            echo '<td>' . $driver['phone_number'] . '</td>';
                            echo '<td>' . $driver['status'] . '</td>';
                            echo '</tr>';
                        }
                    } else {
                        echo "<tr><td colspan='5'>No active drivers found.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </section>
    </div>

    <!-- Buttons to View All Vehicles & Drivers -->
    <div class="button-container">
        <a href="view-vehicles.php" class="btn">View All Vehicles</a>
        <a href="view-drivers.php" class="btn">View All Drivers</a>
    </div>

    <footer>
        <p>&copy; 2024 Transport Management System. All Rights Reserved.</p>
    </footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
