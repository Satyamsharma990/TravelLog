<?php
session_start();
require 'db.php';

// Search filter
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : "";

$query = "
    SELECT trips.*, users.username 
    FROM trips 
    JOIN users ON trips.user_id = users.id
";

if ($search !== "") {
    $query .= " WHERE title LIKE '%$search%' OR destination LIKE '%$search%'";
}

$query .= " ORDER BY travel_date DESC";

$trips = $conn->query($query);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>TravelLog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50">

<?php include 'header.php'; ?>

<!-- HERO SECTION -->
<div class="bg-cover bg-center h-64 flex items-center justify-center"
     style="background-image:url('https://images.unsplash.com/photo-1500530855697-b586d89ba3ee?auto=format&fit=crop&w=1600&q=60');">
    <h1 class="text-5xl font-bold text-white bg-orange-600 bg-opacity-80 px-6 py-3 rounded-xl">
        Welcome to TravelLog ✈️
    </h1>
</div>

<div class="max-w-5xl mx-auto p-6">

    <!-- Search -->
    <form method="GET" class="mb-6 flex">
      <input type="text" name="search"
             class="w-full p-3 border rounded-l-lg focus:outline-none"
             placeholder="Search by title or destination...">
      <button class="bg-orange-600 hover:bg-orange-700 text-white px-6 rounded-r-lg">Search</button>
    </form>

    <h2 class="text-3xl font-bold mb-6 text-orange-700">All Travel Logs</h2>

    <?php if ($trips->num_rows == 0): ?>
      <p class="text-gray-700 bg-white p-5 rounded shadow text-center">No trips found.</p>
    <?php endif; ?>

    <!-- TRIPS GRID -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <?php while ($t = $trips->fetch_assoc()): ?>
        <article class="bg-white shadow-lg rounded-xl p-6 border-l-4 border-orange-600">
          <h2 class="text-2xl font-bold text-orange-700">
            <?= htmlspecialchars($t['title']) ?>
          </h2>
          <p class="text-gray-500 italic"><?= htmlspecialchars($t['destination']) ?></p>

          <p class="text-sm text-gray-600 mt-1">
            By <strong><?= htmlspecialchars($t['username']) ?></strong> • <?= $t['travel_date'] ?>
          </p>

          <p class="mt-3 text-gray-800 line-clamp-3">
            <?= nl2br(htmlspecialchars($t['description'])) ?>
          </p>

          <div class="mt-4">
            <a href="view_trip.php?id=<?= $t['id'] ?>"
               class="text-orange-600 hover:underline font-semibold">Read more →</a>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

</div>

<?php include 'footer.php'; ?>
</body>
</html>
