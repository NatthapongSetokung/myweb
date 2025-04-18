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
    <title>หน้าร้านค้า</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f5; 
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
            width: 90%; 
            margin: 30px auto;
            border-collapse: collapse;
            background-color: #ffffff; 
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        table th, table td {
            padding: 15px; 
            text-align: center;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #5d3fd3; 
            color: white;
            text-transform: uppercase;
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
            cursor: pointer;
        }

        a {
            text-decoration: none;
            color: #5d3fd3; 
            font-weight: bold;
            font-size: 14px;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #e1b12c; 
        }

        a[href="../menu.php"],
        a[href="bomb.php"],
        a[href="Summary.php"] {
            display: block;
            text-align: center;
            background-color: #e1b12c;
            color: white;
            padding: 12px 20px; 
            border-radius: 5px;
            width: 220px; 
            margin: 5px auto;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        a[href="../menu.php"]:hover,
        a[href="bomb.php"]:hover,
        a[href="Summary.php"]:hover {
            background-color: #d4a017;
            transform: scale(1.05); 
        }

        .textX {
            font-size: 26px; 
            font-weight: bold; 
            color: #5d3fd3; 
            text-align: center; 
            margin: 20px auto; 
            background-color: #fdf5e6; 
            padding: 15px 25px; 
            border-radius: 10px; 
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: inline-block; 
            border: 2px solid #e1b12c; 
        }

        .textX span {
            color: #d9534f; 
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="login">
        <img src="icon/login.png" width="25" height="25">
        <ul>
            <?php
            echo "<li>ชื่อบัญชี: $username</li>";
            echo "<li>สิทธิ: $userGroup</li>";
            ?>
        </ul>
    </div>

<?php
include_once("connectdb.php");

if (isset($_SESSION['cart'][$username]) && !empty($_SESSION['cart'][$username])) {

    $cart = $_SESSION['cart'][$username];
    $menuid = implode(',', array_keys($cart));

    $sql = "SELECT * FROM menu WHERE menu_id IN ($menuid)";
    $menu = $conn->query($sql);
    $total = 0;

    echo "<table><br><br>
            <tr style='background-color:burlywood'>
                <td width='50px'>รหัสเมนูอาหาร</td>
                <td width='150px'>ชื่อเมนูอาหาร</td>
                <td width='150px'>ราคา</td>
                <td width='100px'>หมวดหมู่</td>
                <td width='100px'>จำนวน</td>
                <td width='100px'>รวมเงิน</td>
            </tr>";

    while ($row = $menu->fetch_assoc()) {
        $MenuId = $row["menu_id"];
        $MenuName = $row["menu_name"];
        $Price = $row["price"];
        $Category = $row["category"];
        $qty = $cart[$MenuId];
        $result = $Price * $qty;
        $total += $result;

        echo "<tr>
                <td>$MenuId</td>
                <td>$MenuName</td>
                <td>$Price</td>
                <td>$Category</td>
                <td>$qty</td>
                <td>$result</td>
              </tr>";
    }

    echo "</table>";
    echo "<center><div class='textX'>
            รวมเป็นเงินทั้งสิ้น = $total</div></center><br>";

    echo "<div class='button-container'>
            <a href='Summary.php'>ชำระค่าอาหาร</a><br>
            <a href='bomb.php'>ลบทุกอย่างออกจากตะกร้า</a><br>
          </div>";
} else {
    echo "<center><h1>ตะกร้าสินค้าว่างเปล่า</h1></center>";
    echo "<a href='../menu.php'>กลับหน้าเมนู</a><br>";
}
?>
</body>
</html>
