<?php
// เชื่อต่อกับฐานข้อมูล MySQL
$servername = "localhost";
$username = "root"; // ใส่ชื่อผู้ใช้ MySQL
$password = ""; // ใส่รหัสผ่าน MySQL
$database = "nofk5";

$conn = new mysqli($servername, $username, $password, $database);

// เช็คการเชื่อต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}