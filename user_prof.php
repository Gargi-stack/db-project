<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch the current user details
$userId = $_SESSION['user_id'];
$sql = "SELECT username, email FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'] ? password_hash($_POST['password'], PASSWORD_DEFAULT) : $user['password'];

    // Update user details in the database
    $updateSql = "UPDATE users SET username = ?, email = ?, password = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("sssi", $username, $email, $password, $userId);

    if ($updateStmt->execute()) {
        $_SESSION['username'] = $username;
        echo "<p>Profile updated successfully!</p>";
    } else {
        echo "<p>Error updating profile. Please try again.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <link rel="stylesheet" href="user_prof.css">
</head>
<body>
    <div class="container">
        <h2>User Profile</h2>
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($user['username']); ?>" required>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
            
            <label for="password">New Password (leave blank to keep current password):</label>
            <input type="password" id="password" name="password">

            <button type="submit" class="submit">Update Profile</button>
            <div class="logout">
                <a href="logout.php" class="logout-button">Logout</a>
            </div>
            
            <button type="button" id="editButton">Edit Profile</button>
            <button type="submit" id="saveButton" style="display:none;">Save Changes</button>

            <div class="delete">
                <a href="delete.php" class="delete-button">Delete Account</a>
            </div>
        </form>
    </div>
    <script>
            document.getElementById('editButton').addEventListener('click', function () {
            document.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
            document.getElementById('saveButton').style.display = 'inline-block';
            document.getElementById('editButton').style.display = 'none';
        });

    </script>
</body>
</html>
