<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $conn->query("DELETE FROM users WHERE id=$id");
}
header("Location: users.php");
