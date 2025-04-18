<?php
include_once("connectdb.php");

if (isset($_COOKIE["username"]) and isset($_COOKIE["UserGroup"])) {
    $username = $_COOKIE["username"];
    $userGroup = $_COOKIE["UserGroup"];
} else {
    echo '<script>
        alert("ยังไม่ได้ login");
        window.location.href="inputLogin.php";
    </script>';
    exit();
}
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .login {
            width: 97%;
            height: 70px;
            text-align: right;
            padding: 10px 20px;
            margin: 20px auto;
            background-color: #5d3fd3; 
            color: white;
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
        }

        .login ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .login ul li {
            font-size: 14px;
        }

        .login img {
            margin-right: 10px;
            vertical-align: middle; 
        }

        h1 {
            text-align: center;
            color: #5d3fd3;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background-color: #ffffff; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        table th, table td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5d3fd3; 
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:nth-child(odd) {
            background-color: #ffffff;
        }

        table tr:hover {
            background-color: #f1c40f; 
            color: white;
        }

        a {
            text-decoration: none;
            color: #5d3fd3; 
            font-weight: bold;
            font-size: 14px;
        }

        a:hover {
            color: #e1b12c; 
        }

        .button-container {
            text-align: center;
            margin: 30px auto;
            padding-top: 20px;
        }

        .button-container a {
            display: inline-block;
            margin: 0 10px;
            padding: 10px 20px;
            background-color: #e1b12c; 
            color: white;
            border-radius: 5px;
            text-transform: uppercase;
            font-weight: bold;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
            transition: all 0.3s ease;
        }

        .button-container a:hover {
            background-color: #d4a017; 
        }

        table a img {
            display: inline-block;
            margin: 0;
            transition: transform 0.2s ease;
        }

        table a img:hover {
            transform: scale(1.2); 
        }
    </style>
</head>
<body>
    <div class="login">
        <img src="icon/login.png" width="25" height="25">
        <ul>
            <?php
            echo "<li>ชื่อบัญชี: $username </li>";
            echo "<li>สิทธิ: $userGroup</li>";
            ?>
        </ul>
    </div>

    <?php
    if (isset($_GET["id"])) {
        $mId = $_GET["id"];
        $qty = 1;
        $_SESSION['cart'][$username][$mId] = ($_SESSION['cart'][$username][$mId] ?? 0) + $qty;
    }

    if (!empty($_SESSION['cart'][$username])) {
        echo "<table>
                <tr style='background-color: burlywood;'>
                    <td>รหัสเมนูอาหาร</td>
                    <td>จำนวน</td>
                    <td>ลบสินค้า</td>
                </tr>";

        foreach ($_SESSION['cart'][$username] as $key => $value) {
            echo "<tr>
                    <td>$key</td>
                    <td>$value</td>
                    <td><a href='DeleteItem.php?id=$key'>
                        <img src='icon/delete.png' width='30px'></a></td>
                </tr>";
        }

        echo "</table>";
        echo "<div class='button-container'>
                <a href='Showcart.php'>คำนวณค่าอาหาร</a> 
                <a href='displaymenu.php'>ซื้อสินค้าเพิ่ม</a>
                <a href='../menu.php'>กลับหน้าเมนู</a>
            </div>";
    } else {
        echo "<center> <h1>ตะกร้าสินค้าว่างเปล่า</h1></center>";
        echo "<div class='button-container'>
                <a href='displaymenu.php'>ซื้อสินค้าเพิ่ม</a>
            </div>";
    }
    ?>
</body>
</html>
