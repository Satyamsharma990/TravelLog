<?php
session_start();
require 'db.php';

$err = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $email = $conn->real_escape_string($_POST['email']);
  $pass  = $_POST['password'];

  $u = $conn->query("SELECT * FROM users WHERE email='$email'")->fetch_assoc();
  if ($u && password_verify($pass, $u['password'])) {
    $_SESSION['user_id'] = $u['id'];
    header('Location: index.php'); exit;
  }
  $err = "Invalid credentials!";
}
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login - TravelLog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head><body class="bg-gray-100">
  <?php include 'header.php'; ?>
  <div class="max-w-md mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-2xl font-semibold mb-4 text-center">Login</h1>
    <?php if ($err): ?><p class="text-red-600 text-center mb-3"><?= $err ?></p><?php endif; ?>
    <form method="POST" class="space-y-4">
      <input name="email" type="email" placeholder="Email" class="w-full p-3 border rounded" required>
      <input name="password" type="password" placeholder="Password" class="w-full p-3 border rounded" required>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Sign In</button>
    </form>
  </div>
</body></html>
