<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>การแจ้งซ่อมบำรุง</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>การแจ้งซ่อมบำรุง</h1>
    <form action="submit_request.php" method="post" enctype="multipart/form-data">
        <fieldset>
            <legend>ข้อมูลผู้แจ้ง</legend>
            <label for="name">ชื่อผู้แจ้ง:</label>
            <input type="text" id="name" name="requester_name" required>
            <label for="department">แผนก:</label>
            <select id="department" name="department">
                <option value="IT">IT</option>
                <option value="HR">HR</option>
                <option value="Production">Production</option>
            </select>
        </fieldset>

        <fieldset>
            <legend>รายละเอียดงานซ่อม</legend>
            <label for="date_reported">วันที่แจ้ง:</label>
            <input type="datetime-local" id="date_reported" name="date_reported" required>
            <label for="date_required">วันที่ต้องการให้ซ่อมเสร็จ:</label>
            <input type="datetime-local" id="date_required" name="date_required" required>
            <label for="issue_title">เรื่อง:</label>
            <input type="text" id="issue_title" name="issue_title" required>
            <label for="description">รายละเอียด:</label>
            <textarea id="description" name="description" rows="4"></textarea>
            <label for="urgency">ความเร่งด่วน:</label>
            <select id="urgency" name="urgency">
                <option value="low">ต่ำ</option>
                <option value="medium">กลาง</option>
                <option value="high">สูง</option>
            </select>
            <label for="images">รูปประกอบ:</label>
            <input type="file" id="images" name="images[]" multiple accept="image/*">
        </fieldset>

        <button type="submit">บันทึก</button>
    </form>
</body>
</html>
