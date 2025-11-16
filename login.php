<?php
session_start();
require 'db.php';

$error = "";

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $pass  = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, password FROM users WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user && password_verify($pass, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit;
    }

    $error = "Invalid email or password";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<div class="max-w-md mx-auto mt-14 p-8 bg-white shadow-xl rounded-xl">

  <h1 class="text-3xl text-center text-orange-700 font-bold mb-6">Welcome Back</h1>

  <?php if ($error): ?>
    <p class="bg-red-100 text-red-700 p-3 rounded text-center mb-4"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-5">

    <input name="email" type="email"
           class="w-full p-3 border rounded" placeholder="Email" required>

    <div class="relative">
      <input id="password" name="password" type="password"
             class="w-full p-3 border rounded" placeholder="Password" required>
      <button type="button" onclick="togglePass()"
              class="absolute right-3 top-2 text-sm text-orange-600">Show</button>
    </div>

    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold">
      Sign In
    </button>

    <p class="text-center text-gray-600">
      Don't have an account?
      <a href="register.php" class="text-orange-600 hover:underline font-semibold">Register</a>
    </p>

  </form>
</div>

<script>
function togglePass() {
    let x = document.getElementById("password");
    x.type = x.type === "password" ? "text" : "password";
}
</script>

<?php include 'footer.php'; ?>
</body>
</html>
