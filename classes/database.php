<?php
class Database {
    private $host = "db-mysql-sgp1-prain-do-user-9062807-0.b.db.ondigitalocean.com";  // ชื่อโฮสต์
    private $user = "doadmin";       // ชื่อผู้ใช้ฐานข้อมูล
    private $password = "AVNS_tS0wrKJAfA9zcj4OfEf";       // รหัสผ่านฐานข้อมูล
    private $dbname = "erp_system";  // ชื่อฐานข้อมูล
    private $dbname2 = "erp_systemtdo";
    private $port="25060";

    private $conn;

    // ฟังก์ชันเชื่อมต่อฐานข้อมูล
    public function connect() {
        try {
            // สร้างการเชื่อมต่อฐานข้อมูล
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname, port: $this->port);
            
            // ตรวจสอบการเชื่อมต่อ
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }

            return $this->conn; // คืนค่าการเชื่อมต่อเมื่อสำเร็จ
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); // แสดงข้อผิดพลาด
            return null;
        }
    }

    // ฟังก์ชันปิดการเชื่อมต่อฐานข้อมูล
    public function disconnect() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
<?php
class Databasetdo {
    private $host = "db-mysql-sgp1-prain-do-user-9062807-0.b.db.ondigitalocean.com";  // ชื่อโฮสต์
    private $user = "doadmin";       // ชื่อผู้ใช้ฐานข้อมูล
    private $password = "AVNS_tS0wrKJAfA9zcj4OfEf";       // รหัสผ่านฐานข้อมูล
    private $dbname = "erp_systemtdo";  // ชื่อฐานข้อมูล
    private $dbname2 = "erp_systemtdo";
    private $port="25060";

    private $conn;

    // ฟังก์ชันเชื่อมต่อฐานข้อมูล
    public function connect() {
        try {
            // สร้างการเชื่อมต่อฐานข้อมูล
            $this->conn = new mysqli($this->host, $this->user, $this->password, $this->dbname, port: $this->port);
            
            // ตรวจสอบการเชื่อมต่อ
            if ($this->conn->connect_error) {
                throw new Exception("Connection failed: " . $this->conn->connect_error);
            }

            return $this->conn; // คืนค่าการเชื่อมต่อเมื่อสำเร็จ
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage(); // แสดงข้อผิดพลาด
            return null;
        }
    }

    // ฟังก์ชันปิดการเชื่อมต่อฐานข้อมูล
    public function disconnect() {
        if ($this->conn) {
            $this->conn->close();
        }
    }
}
?>
