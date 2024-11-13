<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proceed to delete the account
    header("Location: delete.php");  // Redirect to delete.php
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Account Deletion</title>
</head>
<body>
    <h1>Are you sure you want to delete your account?</h1>
    <form method="POST">
        <button type="submit">Yes, delete my account</button>
    </form>
    <a href="user_prof.php">No, take me back to my profile</a>
</body>
</html>
