<?php
include_once("connectdb.php");
$inputuser = $_POST["name"];
$inputpass = $_POST["pass"];
$sql = "SELECT * from user_account where username='$inputuser'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $UserName = $row["username"];
    $Password = $row["pwd"];
    $UserGroup = $row["user_group"];
    $UserStatus = $row["user_status"];

    if ($Password === $inputpass) {
        if ($UserGroup == 1 and $UserStatus == 1) {
            setcookie("username", "$UserName", 0, "/");
            setcookie("UserGroup", "ผู้ดูแลระบบ", 0, "/");
            header("Location:menu.php");
            exit();
        } else if ($UserGroup == 2 and $UserStatus == 1) {
            setcookie("username", "$UserName", 0, "/");
            setcookie("UserGroup", "ผู้ใช้ทั่วไป", 0, "/");
            header("Location:menu.php");
            exit();
        } else {
            echo "ระงับสิทธิการใช้งาน!";
        }
    } else {
        echo "รหัสผ่านไม่ถูกต้อง!";
    }
} else {
    echo "ไม่พบชื่อผู้ใช้งาน!";
}
?>
