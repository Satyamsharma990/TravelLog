<?php
session_start();
require 'db.php';

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if (!$username || !$email || !$pass || !$confirm) {
        $error = "All fields are required.";
    }
    elseif ($pass !== $confirm) {
        $error = "Passwords do not match!";
    }
    else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE email=?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        if ($stmt->get_result()->num_rows > 0) {
            $error = "Email already registered!";
        } else {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            if ($stmt->execute()) {
                $success = "Account created successfully!";
                header("refresh:2;url=login.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<div class="max-w-md mx-auto mt-14 p-8 bg-white shadow-xl rounded-xl">

  <h1 class="text-3xl text-center text-orange-700 font-bold mb-6">Create Account</h1>

  <?php if ($error): ?>
    <p class="bg-red-100 text-red-700 p-3 rounded text-center mb-4"><?= $error ?></p>
  <?php endif; ?>

  <?php if ($success): ?>
    <p class="bg-green-100 text-green-700 p-3 rounded text-center mb-4"><?= $success ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-5">

    <input name="username" placeholder="Username"
           class="w-full p-3 border rounded">

    <input name="email" type="email" placeholder="Email"
           class="w-full p-3 border rounded">

    <input name="password" type="password" placeholder="Password"
           class="w-full p-3 border rounded">

    <input name="confirm_password" type="password"
           placeholder="Confirm Password" class="w-full p-3 border rounded">

    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold">
      Register
    </button>
  </form>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
