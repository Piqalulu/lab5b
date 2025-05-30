<!-- register.php -->
<?php
$conn = new mysqli("localhost", "root", "", "Lab_5b");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $accessLevel = $_POST['accessLevel'];

    $sql = "INSERT INTO users (matric, name, password, accessLevel) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $matric, $name, $password, $accessLevel);
    $stmt->execute();
    echo "Registration successful. <a href='login.php'>Login</a>";
}
?>
<form method="POST">
    Matric: <input type="text" name="matric" required><br>
    Name: <input type="text" name="name" required><br>
    Password: <input type="password" name="password" required><br>
    Access Level: 
    <select name="accessLevel">
        <option value="lecturer">Lecturer</option>
        <option value="student">Student</option>
    </select><br>
    <button type="submit">Register</button>
</form>
