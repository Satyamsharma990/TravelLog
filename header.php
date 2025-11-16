<?php 
if (!isset($_SESSION)) session_start(); 
?>

<!-- Navigation Bar -->
<nav class="bg-orange-600 text-white px-6 py-4 shadow-md">
  <div class="max-w-6xl mx-auto flex items-center justify-between">
    
    <!-- Logo -->
    <a href="index.php" class="text-2xl font-bold hover:text-amber-200 transition">
      TravelLog ✈️
    </a>

    <!-- Desktop Menu -->
    <div class="hidden md:flex items-center space-x-6 text-lg">

      <a href="index.php" class="hover:text-amber-200 transition">Home</a>

      <?php if (isset($_SESSION['user_id'])): ?>
        <a href="add_trip.php" class="hover:text-amber-200 transition">Add Trip</a>

        <a href="logout.php"
           class="bg-white text-orange-600 px-4 py-1 rounded-lg font-semibold hover:bg-amber-100 transition">
          Logout
        </a>

      <?php else: ?>

        <a href="login.php" class="hover:text-amber-200 transition">Login</a>

        <a href="register.php"
           class="bg-white text-orange-600 px-4 py-1 rounded-lg font-semibold hover:bg-amber-100 transition">
          Register
        </a>

      <?php endif; ?>
    </div>

    <!-- Mobile Menu Button -->
    <button id="menuBtn" class="md:hidden text-white text-3xl">
      ☰
    </button>

  </div>

  <!-- Mobile Menu -->
  <div id="mobileMenu" class="md:hidden hidden bg-orange-700 px-6 py-3 space-y-3">
    <a href="index.php" class="block hover:text-amber-200">Home</a>

    <?php if (isset($_SESSION['user_id'])): ?>
      <a href="add_trip.php" class="block hover:text-amber-200">Add Trip</a>
      <a href="logout.php" class="block hover:text-amber-200">Logout</a>
    <?php else: ?>
      <a href="login.php" class="block hover:text-amber-200">Login</a>
      <a href="register.php" class="block hover:text-amber-200">Register</a>
    <?php endif; ?>
  </div>
</nav>

<!-- Single Clean Mobile Menu Script -->
<script>
document.addEventListener("DOMContentLoaded", function () {
    const menuBtn = document.getElementById('menuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });
});
</script>
