<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM users WHERE id=$id");
    $user = $result->fetch_assoc();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $accessLevel = $_POST['accessLevel'];
    $stmt = $conn->prepare("UPDATE users SET name=?, accessLevel=? WHERE id=?");
    $stmt->bind_param("ssi", $name, $accessLevel, $id);
    $stmt->execute();
    header("Location: users.php");
}
?>
<form method="POST">
    <h2>Update User</h2>
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" value="<?= $user['name'] ?>" required><br>
    Access Level: 
    <select name="accessLevel">
        <option value="lecturer" <?= $user['accessLevel']=='lecturer'?'selected':'' ?>>Lecturer</option>
        <option value="student" <?= $user['accessLevel']=='student'?'selected':'' ?>>Student</option>
    </select><br>
    <button type="submit">Update</button>
    <a href="users.php">Cancel</a>
</form>
