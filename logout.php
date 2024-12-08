<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php"); // กลับไปที่หน้า login
exit();
?>