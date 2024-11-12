<?php
include 'connection.php';
// Get form data
$name = isset($_POST['name']) ? $_POST['name'] : '';
$dob = isset($_POST['dob']) ? $_POST['dob'] : '';
$gender = isset($_POST['gender']) ? $_POST['gender'] : '';
$contact = isset($_POST['contact']) ? $_POST['contact'] : '';
$licenseNumber = isset($_POST['licenseNumber']) ? $_POST['licenseNumber'] : '';

// Calculate age from DOB
$dobDate = new DateTime($dob);
$today = new DateTime();
$age = $today->diff($dobDate)->y;

// Check if user already exists by license number
$sql = "SELECT * FROM users WHERE licenseNumber = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $licenseNumber);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // User exists, show a welcome message
    echo "<script>alert('Welcome back! Redirecting to home page.'); window.location.href = 'homepage.html';</script>";
} else {
    // User does not exist, insert into database
    $insert_sql = "INSERT INTO users (name, dob, age, gender, contact, licenseNumber) VALUES (?, ?, ?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("ssisss", $name, $dob, $age, $gender, $contact, $licenseNumber);

    if ($insert_stmt->execute()) {
        echo "<script>alert('Registration successful! Redirecting to home page.'); window.location.href = 'homepage.html';</script>";
    } else {
        echo "Error: " . $insert_stmt->error;
    }
}

// Close connections
$stmt->close();
$insert_stmt->close();
$conn->close();
?>
