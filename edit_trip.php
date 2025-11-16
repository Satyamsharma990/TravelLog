<?php
session_start();
require 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$trip_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM trips WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $trip_id, $user_id);
$stmt->execute();
$trip = $stmt->get_result()->fetch_assoc();

if (!$trip) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $title = trim($_POST['title']);
    $destination = trim($_POST['destination']);
    $date = $_POST['travel_date'];
    $description = trim($_POST['description']);

    if ($title && $destination && $date && $description) {
        $stmt = $conn->prepare("
            UPDATE trips SET title=?, destination=?, travel_date=?, description=?
            WHERE id=? AND user_id=?
        ");
        $stmt->bind_param("ssssii", $title, $destination, $date, $description, $trip_id, $user_id);

        if ($stmt->execute()) {
            header("Location: view_trip.php?id=$trip_id&updated=1");
            exit;
        }
    }

    $error = "All fields are required.";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Edit Trip</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto mt-12 p-8 bg-white shadow-xl rounded-xl">

  <h1 class="text-3xl font-bold text-orange-700 text-center">Edit Trip</h1>

  <?php if ($error): ?>
    <p class="bg-red-100 text-red-700 p-3 rounded text-center mb-4"><?= $error ?></p>
  <?php endif; ?>

  <form method="POST" class="space-y-5">

    <input name="title" value="<?= htmlspecialchars($trip['title']) ?>"
           class="w-full p-3 border rounded" placeholder="Trip Title">

    <input name="destination" value="<?= htmlspecialchars($trip['destination']) ?>"
           class="w-full p-3 border rounded" placeholder="Destination">

    <input type="date" name="travel_date" value="<?= htmlspecialchars($trip['travel_date']) ?>"
           class="w-full p-3 border rounded">

    <textarea name="description"
              class="w-full p-3 border rounded h-32"><?= htmlspecialchars($trip['description']) ?></textarea>

    <button class="w-full bg-orange-600 hover:bg-orange-700 text-white py-3 rounded-lg font-semibold">
      Save Changes
    </button>
  </form>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
