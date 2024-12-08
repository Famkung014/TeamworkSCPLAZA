<?php
// การตั้งค่าการเชื่อมต่อฐานข้อมูล
require_once 'classes/Database.php';
$db = new Database();
$conn = $db->connect();

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// กำหนดค่าวันที่เริ่มต้นและสิ้นสุดของเดือน
$first_day = date('Y-m-01');
$last_day = date('Y-m-t');

// กำหนดค่าพื้นฐาน
$status_color = [
    'ใหม่' => 'bg-primary',
    'ระหว่างดำเนินการ' => 'bg-warning',
    'เสร็จสิ้น' => 'bg-success',
];

// ตรวจสอบการส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST['search'])) {
        // ฟอร์มค้นหา
        $start_date = $_POST['start_date'] . " 00:00:00";
        $end_date = $_POST['end_date'] . " 23:59:59";
        $query = "SELECT * FROM `tb_maintenance` WHERE `Ma_Date` BETWEEN '$start_date' AND '$end_date'";
        if (!empty($Ma_Subject)) {
            $query .= " AND `Ma_Subject` LIKE '%$Ma_Subject%'";
        }
        $result = $conn->query($query);
    } elseif (isset($_POST['update_status'])) {
        // ฟอร์มแก้ไขสถานะ
        $Ma_ID = $_POST['Ma_ID'];
        $new_status = $_POST['status_id'];
        $update_query = "UPDATE `tb_maintenance` SET `status_id`='$new_status', `LastUpdate`=NOW() WHERE `Ma_ID`='$Ma_ID'";
        
        if ($conn->query($update_query) === TRUE) {
            $message = "แก้ไขสถานะสำเร็จ!";
        } else {
            $message = "เกิดข้อผิดพลาด: " . $conn->error;
        }
        // โหลดข้อมูลใหม่หลังแก้ไข
        $query = "SELECT * FROM `tb_maintenance`";
        $result = $conn->query($query);
    }
} else {
    // แสดงข้อมูลทั้งหมดเมื่อยังไม่ได้ค้นหา
    $query = "SELECT * FROM `tb_maintenance` WHERE `Ma_Date` BETWEEN '$first_day' AND '$last_day'";
    $result = $conn->query($query);
}
// แปลงรูปแบบวันที่
function formatDate($date) {
    return date('d M Y', strtotime($date));
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานการบำรุงรักษา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
function onStatusChange(selectElement, Ma_ID) {
    const currentStatus = selectElement.dataset.currentStatus;
    const newStatus = selectElement.value;

    // ตรวจสอบว่ามีการเปลี่ยนแปลงหรือไม่
    const saveButton = document.getElementById(`save-btn-${Ma_ID}`);
    const cancelButton = document.getElementById(`cancel-btn-${Ma_ID}`);
    const alertMessage = document.getElementById(`alert-${Ma_ID}`);

    if (currentStatus !== newStatus) {
        saveButton.style.display = 'inline-block'; // แสดงปุ่มบันทึก
        cancelButton.style.display = 'inline-block'; // แสดงปุ่มยกเลิก
        alertMessage.style.display = 'inline'; // แสดงข้อความแจ้งเตือน
    } else {
        saveButton.style.display = 'none'; // ซ่อนปุ่มบันทึก
        cancelButton.style.display = 'none'; // ซ่อนปุ่มยกเลิก
        alertMessage.style.display = 'none'; // ซ่อนข้อความแจ้งเตือน
    }
}

function onCancelChange(Ma_ID) {
    const dropdown = document.querySelector(`select[name="status_id"][onchange*="'${Ma_ID}'"]`);
    const saveButton = document.getElementById(`save-btn-${Ma_ID}`);
    const cancelButton = document.getElementById(`cancel-btn-${Ma_ID}`);
    const alertMessage = document.getElementById(`alert-${Ma_ID}`);

    // คืนค่าหมายเลขสถานะเดิมใน Dropdown
    dropdown.value = dropdown.dataset.currentStatus;

    // ซ่อนปุ่มและข้อความแจ้งเตือน
    saveButton.style.display = 'none';
    cancelButton.style.display = 'none';
    alertMessage.style.display = 'none';
}

    </script>
    
</head>
<body>
<div class="container mt-4">
    <h1 class="text-center">รายงานการบำรุงรักษา</h1>

    <!-- ฟอร์มค้นหาข้อมูล -->
    <form method="POST" class="mb-3">
    <div class="row">
        <div class="col-md-3">
            <label for="start_date" class="form-label">วันที่เริ่ม</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="<?= $first_day ?>" required>
        </div>
        <div class="col-md-3">
            <label for="end_date" class="form-label">วันที่สิ้นสุด</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="<?= $last_day ?>" required>
        </div>
        <div class="col-md-3">
            <label for="Ma_Subject" class="form-label">หัวข้อ</label>
            <input type="text" id="Ma_Subject" name="Ma_Subject" class="form-control" placeholder="ค้นหาหัวข้อ">
        </div>
        <div class="col-md-3 align-self-end">
            <button type="submit" name="search" class="btn btn-success">ค้นหา</button>
        </div>
    </div>
</form>


    <!-- แสดงข้อความสถานะ -->
    <?php if (isset($message)): ?>
        <div class="alert alert-info"><?= $message ?></div>
    <?php endif; ?>

    <!-- ตารางข้อมูล -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>หัวข้อ</th>
                <th>รายละเอียด</th>
                <th>วันที่</th>
                <th>สถานะ</th>
                <th>แก้ไขสถานะ</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                <td>
                    <a href="details.php?Ma_ID=<?= $row['Ma_ID'] ?>" class="text-primary">
                        <?= $row['Ma_ID'] ?>
                    </a>
                </td>
                    <td><?= $row['Ma_Subject'] ?></td>
                    <td><?= $row['Ma_detail'] ?></td>
                    <td><?= formatDate($row['Ma_Date']) ?></td>
                    <td>
                        <span class="badge <?= $status_color[$row['status_id']] ?? 'bg-secondary' ?>">
                            <?= $row['status_id'] ?>
                        </span>
                    </td>
                    <td>
                                 <form method="POST" class="d-inline">
                                                     <input type="hidden" name="Ma_ID" value="<?= $row['Ma_ID'] ?>">
        <select name="status_id" class="form-select form-select-sm d-inline w-auto" 
            onchange="onStatusChange(this, '<?= $row['Ma_ID'] ?>')"
            data-current-status="<?= $row['status_id'] ?>">
            <option value="ใหม่" <?= $row['status_id'] == "ใหม่" ? "selected" : "" ?>>ใหม่</option>
            <option value="ระหว่างดำเนินการ" <?= $row['status_id'] == "ระหว่างดำเนินการ" ? "selected" : "" ?>>ระหว่างดำเนินการ</option>
            <option value="เสร็จสิ้น" <?= $row['status_id'] == "เสร็จสิ้น" ? "selected" : "" ?>>เสร็จสิ้น</option>
        </select>
        <button type="submit" name="update_status" class="btn btn-primary btn-sm" 
            id="save-btn-<?= $row['Ma_ID'] ?>" style="display: none;">บันทึก</button>
        <button type="button" class="btn btn-secondary btn-sm" 
            id="cancel-btn-<?= $row['Ma_ID'] ?>" style="display: none;" 
            onclick="onCancelChange('<?= $row['Ma_ID'] ?>')">ยกเลิก</button>
        <span id="alert-<?= $row['Ma_ID'] ?>" style="display: none; color: red;">มีการเปลี่ยนแปลง</span>
    </form>
</td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
</body>
</html>
