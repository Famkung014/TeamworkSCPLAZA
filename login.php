<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css"> <!-- ใส่ CSS เพื่อให้ดูสวยงาม -->
</head>
<body>
    <div class="login-container">
        <h2>Login</h2>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required><br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
            <label for="sitejob">หน้างาน:</label>
            <select id="sitejob" name="sitejob">
                <option value="SC">SCPLAZA&สายใต้</option>
                <option value="TDO">โรงเกลือมาร์เก็ต</option>
            </select>
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>


<?php
$dropdown = $_POST['sitejob'] ?? null;
if ($dropdown== "SC") {
    require_once 'classes/Database.php';
    $db = new Database();
    $conn = $db->connect();
}else{
    require_once 'classes/Database.php';
    $db = new Databasetdo();
    $conn = $db->connect();
}


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // ตรวจสอบผู้ใช้ในฐานข้อมูล
    $sql = "SELECT * FROM sysemployee WHERE empid='$username' AND Password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start(); 
        $_SESSION["EMPID"] = $username;
     header("Location: teamwork.php"); // ไปที่หน้า dashboard
    } else {
        echo "รหัสผิดพาด";
    }
}

$conn->close();
?>
