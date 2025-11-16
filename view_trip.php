<?php
session_start();
require 'db.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

$id = intval($_GET['id']);

$stmt = $conn->prepare("
    SELECT trips.*, users.username 
    FROM trips 
    JOIN users ON trips.user_id = users.id
    WHERE trips.id = ?
");
$stmt->bind_param("i", $id);
$stmt->execute();
$trip = $stmt->get_result()->fetch_assoc();

if (!$trip) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($trip['title']) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<div class="max-w-3xl mx-auto mt-12 bg-white shadow-xl rounded-xl p-8 border-l-4 border-orange-600">

  <h1 class="text-4xl font-bold text-orange-700 mb-3"><?= htmlspecialchars($trip['title']) ?></h1>

  <p class="text-gray-600 text-lg italic mb-2">
    Destination: <?= htmlspecialchars($trip['destination']) ?>
  </p>

  <p class="text-gray-500 text-sm">
    Posted by <strong><?= htmlspecialchars($trip['username']) ?></strong>
    • <?= $trip['travel_date'] ?>
  </p>

  <hr class="my-5">

  <p class="text-gray-800 whitespace-pre-line text-lg leading-relaxed">
    <?= nl2br(htmlspecialchars($trip['description'])) ?>
  </p>

  <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $trip['user_id']): ?>
    <div class="mt-6 flex space-x-4">
      <a href="edit_trip.php?id=<?= $trip['id'] ?>"
         class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded">Edit</a>

      <a href="delete_trip.php?id=<?= $trip['id'] ?>"
         class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded"
         onclick="return confirm('Are you sure?')">Delete</a>
    </div>
  <?php endif; ?>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
