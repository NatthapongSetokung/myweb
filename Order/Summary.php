<?php
include_once("connectdb.php");

session_start();
date_default_timezone_set('Asia/Bangkok');

$userName = $_COOKIE["username"] ?? "guest";

if (isset($_SESSION['cart'][$userName]) && !empty($_SESSION['cart'][$userName])) {
    $cart = $_SESSION['cart'][$userName];
    $menuIds = implode(',', array_keys($cart));

    $sql = "SELECT * FROM menu WHERE menu_id IN ($menuIds)";
    $result = $conn->query($sql);

    $orderDate = date("Y-m-d H:i:s");
    $orderGroupId = time(); 

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $menuId = $row["menu_id"];
            $menuName = $row["menu_name"];
            $price = $row["price"];
            $quantity = $cart[$menuId];
            $totalPrice = $price * $quantity;

            $Sql = "INSERT INTO summary ( order_group_id, menu_id, menu_name, price, quantity, total_price, order_date, user_name) 
                        VALUES ('$orderGroupId', '$menuId', '$menuName', '$price', '$quantity', '$totalPrice', '$orderDate', '$userName')";

            if ($conn->query($Sql) === TRUE) {
                echo "บันทึกคำสั่งซื้อเรียบร้อย: $menuName<br>";
            } else {
                echo "เกิดข้อผิดพลาด: " . $conn->error . "<br>";
            }
        }

        unset($_SESSION['cart'][$userName]);

        echo "<script>alert('ชำระเงินสำเร็จ'); window.location.href='../menu.php';</script>";
    } else {
        echo "ไม่พบรายการสินค้า";
    }
} else {
    echo "<center><h1>ตะกร้าสินค้าว่างเปล่า</h1></center>";
}
?>
