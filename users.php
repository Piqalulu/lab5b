<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "Lab_5b");
$result = $conn->query("SELECT id, matric, name, accessLevel FROM users");
echo "<a href='logout.php'>Logout</a><br>";
echo "<table border='1'><tr><th>Matric</th><th>Name</th><th>Access Level</th><th>Action</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['matric']}</td>
        <td>{$row['name']}</td>
        <td>{$row['accessLevel']}</td>
        <td>
            <a href='edit.php?id={$row['id']}'>Update</a> | 
            <a href='delete.php?id={$row['id']}'>Delete</a>
        </td>
    </tr>";
}
echo "</table>";
