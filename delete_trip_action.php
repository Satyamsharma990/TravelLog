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

// Delete only if the trip belongs to this user
$stmt = $conn->prepare("DELETE FROM trips WHERE id = ? AND user_id = ?");
stmt->bind_param("ii", $trip_id, $user_id);

if ($stmt->execute()) {
    header("Location: index.php?deleted=1");
} else {
    header("Location: index.php?error=delete_failed");
}
exit;
?>
