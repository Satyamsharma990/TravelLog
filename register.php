<?php
session_start();
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $username = $conn->real_escape_string($_POST['username']);
  $email    = $conn->real_escape_string($_POST['email']);
  $passHash = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $conn->query("INSERT INTO users (username, email, password)
                VALUES ('$username', '$email', '$passHash')");
  header('Location: login.php');
  exit;
}
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Register - TravelLog</title>
 <script src="https://cdn.tailwindcss.com"></script>
</head><body class="bg-gray-100">
  <?php include 'header.php'; ?>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-semibold mb-4 text-center">Create Account</h1>
    <form method="POST" class="space-y-4">
      <input name="username" placeholder="Username" class="w-full p-3 border rounded" required>
      <input name="email"    type="email" placeholder="Email" class="w-full p-3 border rounded" required>
      <input name="password" type="password" placeholder="Password" class="w-full p-3 border rounded" required>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Register</button>
    </form>
  </div>
</body></html>
