<?php
$Ma_ID = $_GET['Ma_ID'];
require_once 'classes/Database.php';
$db = new Database();
$conn = $db->connect();

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_POST) {
    $new_status = $_POST['status_id'];
    $sql = "UPDATE `tb_maintenance` SET `status_id`='$new_status', `LastUpdate`=NOW() WHERE `Ma_ID`='$Ma_ID'";
    if ($conn->query($sql) === TRUE) {
        echo "สถานะถูกแก้ไขสำเร็จ";
    } else {
        echo "ข้อผิดพลาด: " . $conn->error;
    }
}
$result = $conn->query("SELECT * FROM `tb_maintenance` WHERE `Ma_ID`='$Ma_ID'");
$row = $result->fetch_assoc();
?>

<form method="POST">
    <label>สถานะใหม่:</label>
    <select name="status_id">
        <option value="ใหม่" <?= $row['status_id'] == "ใหม่" ? "selected" : "" ?>>ใหม่</option>
        <option value="ระหว่างดำเนินการ" <?= $row['status_id'] == "ระหว่างดำเนินการ" ? "selected" : "" ?>>ระหว่างดำเนินการ</option>
        <option value="เสร็จสิ้น" <?= $row['status_id'] == "เสร็จสิ้น" ? "selected" : "" ?>>เสร็จสิ้น</option>
    </select>
    <button type="submit">อัปเดต</button>
</form>
