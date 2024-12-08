<?php


require_once 'classes/Database.php';
$db = new Database();
$conn = $db->connect();

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// จัดการข้อมูลเมื่อผู้ใช้ส่งฟอร์ม
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $device_name = $_POST["device_name"];
    $bulb_count =$_POST["bulb_count"];
    $customer_ID=generateNewCode($conn, 'sysemployee', 'empid', 'C');
    $sql = "INSERT INTO tb_customer (empid,FAmountLamp, FAmountSoftElec,Lastupdate) VALUES ('$customer_ID','$device_name', '$bulb_count',Now())";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<?php
session_start();
if (!isset($_SESSION["EMPID"])) {
    header("Location: login.php"); // ถ้ายังไม่ได้ล็อกอินให้กลับไปที่หน้า login
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>PHP Web App</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="dashboard-container">
<h1>Welcome, <?php echo $_SESSION["EMPID"]; ?>!</h1>
<h1>Search Member</h1>
    <form>
        <label for="name">Search by Name:</label>
        <input type="text" id="name" name="name" autocomplete="off">
    </form>

    <h2>Member Information</h2>
    <form>
        <label for="empid">Member ID:</label>
        <input type="text" id="empid" readonly><br><br>

        <label for="empname">Name:</label>
        <input type="text" id="empname" readonly><br><br>

        <label for="empsex">Phone:</label>
        <input type="text" id="empsex" readonly>
    </form>

    <script>
        $(document).ready(function() {
            $('#name').on('keyup', function() {
                let name = $(this).val();
                if (name.length > 0) {
                    $.ajax({
                        url: 'search.php',
                        type: 'POST',
                        data: { name: name },
                        success: function(response) {
                            let data = JSON.parse(response);
                            if (data.success) {
                                $('#empid').val(data.empid);
                                $('#empname').val(data.empname);
                                $('#empsex').val(data.empsex);
                            } else {
                                $('#empid').val('');
                                $('#empname').val('');
                                $('#empsex').val('');
                            }
                        }
                    });
                } else {
                    $('#empid').val('');
                    $('#empname').val('');
                    $('#empsex').val('');
                }
            });
        });
    </script>



<h1>บันทึกข้อมูล</h1>
    <form method="POST" action="">
        <label for="device_name">ชื่ออุปกรณ์:</label><br>
        <input type="number" id="device_name" name="device_name" required><br><br>
        <label for="bulb_count">จำนวนหลอดไฟ:</label><br>
        <input type="number" id="bulb_count" name="bulb_count" required><br><br>
        <button type="submit">บันทึก</button>
    </form>
    <a href="logout.php">Logout</a>

<h2>ข้อมูลที่บันทึกไว้</h2>
    <?php
    // ดึงข้อมูลจากฐานข้อมูล
    $sql = "SELECT empid,empname FROM sysemployee order by lastupdate desc limit 5";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<p>Device: " . $row["empid"] . ", Bulbs: " . $row["empname"] . "</p>";
        }
    } else {
        echo "No data found.";
    }
    ?>
    <?php
    function generateNewCode($conn, $tableName, $columnName, $prefix = '') {
        // คำสั่ง SQL เพื่อดึงรหัสสูงสุดจากฐานข้อมูล
        $query = "SELECT FcusID AS max_code FROM $tableName where FcusID LIKE 'C%' Order by FCusid desc";
        $result = $conn->query($query);
    
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $maxCode = $row['max_code'];
    
            if ($maxCode) {
                // ตัด Prefix ออกเพื่อแปลงส่วนตัวเลข
                $numericPart = intval(str_replace($prefix, '', $maxCode));
                $newCode = $prefix . str_pad($numericPart + 1, 6, '0', STR_PAD_LEFT); // เติม 0 ด้านหน้าให้ยาว 4 หลัก
            } else {
                // ถ้าไม่มีรหัสในระบบ
                $newCode = $prefix . str_pad(1, 6, '0', STR_PAD_LEFT);
            }
        } else {
            // กรณี Query ล้มเหลว หรือไม่มีข้อมูลในตาราง
            $newCode = $prefix . str_pad(1, 6, '0', STR_PAD_LEFT);
        }
        echo $newCode;
        return $newCode;
    }
    
    ?>
    </body>
</html>








