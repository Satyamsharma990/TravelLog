<?php if (!isset($_SESSION)) session_start(); ?>
<nav class="bg-blue-600 text-white px-6 py-3 flex justify-between">
  <a href="index.php" class="text-xl font-bold">TravelLog</a>
  <div>
    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="add_trip.php" class="mx-2 hover:underline">Add Trip</a>
      <a href="logout.php"   class="hover:underline">Logout</a>
    <?php else: ?>
      <a href="login.php"    class="mx-2 hover:underline">Login</a>
      <a href="register.php" class="hover:underline">Register</a>
    <?php endif; ?>
  </div>
</nav>
