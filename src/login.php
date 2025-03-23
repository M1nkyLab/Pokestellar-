<?php
session_start();

// Redirect if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: admin.php");
    exit;
}

$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to avoid XSS and SQL injection
    $username = htmlspecialchars(trim($_POST['username']));
    $password = htmlspecialchars(trim($_POST['password']));

    // Temporary credentials (Replace with database query)
    $valid_username = "admin";
    $valid_password_hash = password_hash("password123", PASSWORD_DEFAULT); // Use hashed password

    // Check if username and password match
    if ($username === $valid_username && password_verify($password, $valid_password_hash)) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - PokéStellar</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">
    <div class="bg-white p-8 rounded-lg shadow-lg w-96">
        <h2 class="text-2xl font-bold text-center text-gray-800">PokéStellar Admin Login</h2>

        <?php if ($error): ?>
            <p class="text-red-500 text-sm mt-2"><?php echo $error; ?></p>
        <?php endif; ?>

        <form method="POST" class="mt-4">
            <div class="mb-4">
                <label class="block text-gray-700">Username</label>
                <input type="text" name="username" class="w-full p-3 border rounded-lg" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Password</label>
                <input type="password" name="password" class="w-full p-3 border rounded-lg" required>
            </div>
            <button type="submit" class="w-full bg-red-600 text-white p-3 rounded-lg hover:bg-red-700">
                Login
            </button>
        </form>
    </div>
</body>
</html>
