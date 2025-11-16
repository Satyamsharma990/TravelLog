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

// Fetch the trip (ensure user owns it)
$stmt = $conn->prepare("SELECT * FROM trips WHERE id = ? AND user_id = ?");
$stmt->bind_param("ii", $trip_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
$trip = $result->fetch_assoc();

if (!$trip) {
    // Trip does not exist or user does not own it
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Trip - TravelLog</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">

<?php include 'header.php'; ?>

<div class="max-w-xl mx-auto mt-12 bg-white shadow-xl rounded-xl p-8">

    <h1 class="text-3xl font-bold text-red-600 mb-4 text-center">Delete Trip?</h1>

    <p class="text-lg text-gray-700 mb-6 leading-relaxed text-center">
        Are you sure you want to permanently delete this trip?
    </p>

    <div class="bg-gray-50 border p-5 rounded mb-6">
        <h2 class="text-xl font-bold text-blue-700"><?= htmlspecialchars($trip['title']) ?></h2>
        <p class="text-gray-600">Destination: <?= htmlspecialchars($trip['destination']) ?></p>
        <p class="text-gray-600">Date: <?= htmlspecialchars($trip['travel_date']) ?></p>
    </div>

    <div class="flex justify-center gap-4">
        <a href="delete_trip_action.php?id=<?= $trip_id ?>"
            class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition">
            Yes, Delete
        </a>

        <a href="view_trip.php?id=<?= $trip_id ?>"
            class="bg-gray-300 text-gray-800 px-6 py-2 rounded-lg hover:bg-gray-400 transition">
            Cancel
        </a>
    </div>

</div>
<?php include 'footer.php'; ?>

</body>
</html>
