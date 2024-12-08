<?php
require_once 'classes/Database.php';
session_start();
$db = new Database();
$conn = $db->connect();

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['name'])) {
    $name = $conn->real_escape_string($_POST['name']);

    // ค้นหาข้อมูลจากชื่อ
    $query = "SELECT empid,empname,empsex FROM sysemployee   WHERE empname LIKE '%$name%' LIMIT 1";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode([
            'success' => true,
            'empid' => $row['empid'],
            'empname' => $row['empname'],
            'empsex' => $row['empsex']
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No member found']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

$conn->close();
?>