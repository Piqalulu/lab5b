<?php
session_start();
$conn = new mysqli("localhost", "root", "", "Lab_5b");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE matric=?");
    $stmt->bind_param("s", $matric);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($user = $result->fetch_assoc()) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;
            header("Location: users.php");
        } else {
            $error = "Invalid password!";
        }
    } else {
        $error = "User not found!";
    }
}
?>
<form method="POST">
    Matric: <input type="text" name="matric" required><br>
    Password: <input type="password" name="password" required><br>
    <button type="submit">Login</button>
</form>
<p><a href="register.php">Register</a> here if you have not.</p>
