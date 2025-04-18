<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database</title>
</head>
<body>
    <?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $database = "fooddb";

    $conn = new mysqli($host,$username,$password,$database);
    if ($conn->connect_error) {
        die("เชื่อมต่อฐานข้อมูลไม่สำเร็จ! " . $conn->connect_error);
    }
    ?>
    
</body>
</html>