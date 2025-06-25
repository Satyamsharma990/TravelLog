<?php
session_start();
require 'db.php';
$trips = $conn->query("SELECT trips.*, users.username
                       FROM trips JOIN users ON trips.user_id = users.id
                       ORDER BY travel_date DESC");
?>
<!DOCTYPE html><html lang="en"><head>
  <meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1">
  <title>TravelLog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head><body class="bg-gray-100">
  <?php include 'header.php'; ?>
  <div class="max-w-4xl mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6">All Travel Logs</h1>
    <?php while ($t = $trips->fetch_assoc()): ?>
      <article class="bg-white shadow rounded p-6 mb-6">
        <h2 class="text-2xl font-semibold text-blue-700">
          <?= htmlspecialchars($t['title']) ?>
          <span class="text-gray-500 text-base">(<?= htmlspecialchars($t['destination']) ?>)</span>
        </h2>
        <p class="text-sm text-gray-600">
          By <?= htmlspecialchars($t['username']) ?> • <?= htmlspecialchars($t['travel_date']) ?>
        </p>
        <p class="mt-3 whitespace-pre-line">
          <?= nl2br(htmlspecialchars($t['description'])) ?>
        </p>
      </article>
    <?php endwhile; ?>
  </div>
</body></html>
