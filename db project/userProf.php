<?php
session_start();

$host = 'localhost';
$db = 'transport'; //change to db name
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($_SESSION['user_id'])) {
        echo "<script>alert('Please log in to access your profile.'); window.location.href = 'userlogin.php';</script>";
        exit();
    }

    $userId = $_SESSION['id'];
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?"); //change table name change id with primary key
    $stmt->execute([$userId]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Profile update
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username']; //cahneg all these vars
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];

        $updateStmt = $pdo->prepare("UPDATE users SET username = ?, email = ?, phone = ?, address = ? WHERE id = ?");
        $updateStmt->execute([$username, $email, $phone, $address, $userId]);

        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

       // echo "<script>alert('Profile updated successfully!');</script>";
    }
} catch (PDOException $e) {
    echo "Database connection failed: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Port+Lligat+Slab&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">





    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@0,400..800;1,400..800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&family=Port+Lligat+Slab&display=swap" rel="stylesheet">



    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;0,900;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">




    <link rel="stylesheet" href="userProf.css">
</head>
<body>
    <header>
    <h1>User Profile</h1>
    </header>
    <div class="profile-container">
        <form method="POST" action="userProf.php">
            <div class="profile-content">
                <div class="user-details">
                    <h2>Profile Details</h2>
                    <div class="detail-item">
                        <strong>Username:</strong>
                        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" readonly> <!--change $ -->
                    </div>
                    <div class="detail-item">
                        <strong>Email:</strong>
                        <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
                    </div>
                    <div class="detail-item">
                        <strong>Phone Number:</strong>
                        <input type="tel" name="phone" id="phone" value="<?= htmlspecialchars($user['phone']) ?>" readonly>
                    </div>
                    <div class="detail-item">
                        <strong>Address:</strong>
                        <input type="text" name="address" id="address" value="<?= htmlspecialchars($user['address']) ?>" readonly>
                    </div>
                </div>
            </div>
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
 //this is for the editing part @hamdan
            document.getElementById('editButton').addEventListener('click', function () {
            document.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
            document.getElementById('saveButton').style.display = 'inline-block';
            document.getElementById('editButton').style.display = 'none';
        });

    </script>
</body>
</html>
