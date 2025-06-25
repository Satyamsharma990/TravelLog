<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: login.php'); exit; }

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $uid   = $_SESSION['user_id'];
  $title = $conn->real_escape_string($_POST['title']);
  $dest  = $conn->real_escape_string($_POST['destination']);
  $date  = $_POST['travel_date'];
  $desc  = $conn->real_escape_string($_POST['description']);

  $conn->query("INSERT INTO trips (user_id,title,destination,travel_date,description)
                VALUES ($uid,'$title','$dest','$date','$desc')");
  header('Location: index.php'); exit;
}
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Add Trip - TravelLog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head><body class="bg-gray-100">
  <?php include 'header.php'; ?>
  <div class="max-w-lg mx-auto mt-10 p-6 bg-white shadow rounded">
    <h1 class="text-3xl font-bold mb-4 text-center">Add New Trip</h1>
    <form method="POST" class="space-y-4">
      <input name="title"       placeholder="Trip title"  class="w-full p-3 border rounded" required>
      <input name="destination" placeholder="Destination" class="w-full p-3 border rounded" required>
      <input name="travel_date" type="date"               class="w-full p-3 border rounded" required>
      <textarea name="description" placeholder="Description" class="w-full p-3 border rounded h-32" required></textarea>
      <button class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">Save Trip</button>
    </form>
  </div>
</body></html>

