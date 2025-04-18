<?php
session_start();

if (isset($_GET["id"])) {
    $removeId = $_GET["id"];

    $user = $_COOKIE["username"];
    if (isset($_SESSION['cart'][$user][$removeId])) {
        unset($_SESSION['cart'][$user][$removeId]); 
    }

    header("Location: addTocart.php");
    exit(); 
} else {

    echo "ไม่มีสินค้าที่ระบุ!";
}
?>

