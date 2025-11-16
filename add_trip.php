<?php
session_start();
if (!isset($_SESSION['user_id'])) { header("Location: login.php"); exit; }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Add Trip</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto mt-12 p-8 bg-white shadow-xl rounded-xl">
  <h1 class="text-3xl font-bold text-center text-orange-700">Add New Trip</h1>

  <?php
  require 'db.php';
  $error = "";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {

      $uid = $_SESSION['user_id'];
      $title = trim($_POST['title']);
      $destination = trim($_POST['destination']);
      $date = $_POST['travel_date'];
      $description = trim($_POST['description']);

      if ($title && $destination && $date && $description) {

          $stmt = $conn->prepare("
              INSERT INTO trips (user_id, title, destination, travel_date, description)
              VALUES (?, ?, ?, ?, ?)
          ");
          $stmt->bind_param("issss", $uid, $title, $destination, $date, $description);

          if ($stmt->execute()) {
              header("Location: index.php?added=1");
              exit;
          }
      }

      $error = "All fields are required.";
  }
  ?>

  <?php if ($error): ?>
      <p class="bg-red-100 text-red-700 p-3 rounded text-center mb-4"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-5">

    <input name="title" placeholder="Trip Title"
           class="w-full p-3 border rounded">

    <input name="destination" placeholder="Destination"
           class="w-full p-3 border rounded">

    <input type="date" name="travel_date"
           class="w-full p-3 border rounded">

    <textarea name="description" placeholder="Description"
              class="w-full p-3 border rounded h-32"></textarea>

    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold">
      Save Trip
    </button>
  </form>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
