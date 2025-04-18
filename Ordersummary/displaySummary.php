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

$search = "";
$lastGroup = null;

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM summary WHERE user_name LIKE '%$search%' ORDER BY order_group_id DESC";
$result = $conn->query($sql);

$totalSql = "SELECT SUM(total_price) AS total_sales FROM summary";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalSales = $totalRow['total_sales'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สรุปยอดขาย</title>
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

        form {
            text-align: center;
            margin: 20px;
        }

        table {
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        table th, table td {
            padding: 10px;
            text-align: center;
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
            background-color: #d4a017; 
            color: white;
        }

        input[type="text"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            width: 70%;
        }

        input[type="submit"] {
            background-color: #e1b12c; 
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #d4a017; 
        }

        a[href="../menu.php"], 
        a[href="displaySummary.php"]{
            display: block;
            text-align: center;
            background-color: #e1b12c;
            color: white;
            padding: 12px 20px; 
            border-radius: 5px;
            width: 220px; 
            margin: 20px auto;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            text-decoration: none;
        }

        a[href="../menu.php"]:hover, 
        a[href="displaySummary.php"]:hover{
            background-color: #d4a017;
            transform: scale(1.05);
            text-decoration: none; 
        }

        .final-total {
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
    </style>
</head>
<body>
    <div class ="login">
        <IMG src="icon/login.png" width="25" height="25">
        <ul>
            <?php
            echo "<li>ชื่อบัญชี:$username</li>";
            echo "<li>สิทธิ:$userGroup</li>";
            ?>
        </ul>
    </div>

    <form method="GET">
    <?php
        if ($result->num_rows > 0) {
            $currentGroup = null;
            $groupTotal = 0;

            echo " 
            <input type='text' name='search' placeholder='ค้นหารายชื่อผู้ซื้อ' 
            style='width: 500px;' value=$search >
            <input type='submit' value='ค้นหา'>";

            while ($row = $result->fetch_assoc()) {
                $orderId = $row["order_id"];
                $orderGroupId = $row["order_group_id"];
                $menuId = $row["menu_id"];
                $menuName = $row["menu_name"];
                $price = $row["price"];
                $quantity = $row["quantity"];
                $totalPrice = $row["total_price"];
                $orderDate = $row["order_date"];
                $userName = $row["user_name"];
            
                if ($orderGroupId !== $currentGroup) {
                    if (!is_null($currentGroup)) {
                        echo "<tr style='background-color: #f1c40f; font-weight: bold;'>
                                <td colspan='5'>ยอดรวมคำสั่งซื้อ</td>
                                <td colspan='3'> $groupTotal บาท</td>
                            </tr></table>";
                        $groupTotal = 0;
                    }
            
                    echo "<h2 style='text-align:center; color:#5d3fd3;'>คำสั่งซื้อเลขที่: $orderGroupId</h2>";
                    echo "<table>
                            <tr style='background-color:burlywood'>
                                <th>รายการคำสั่งซื้อ</th>
                                <th>รหัสเมนู</th>
                                <th>ชื่อเมนู</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <th>วันที่สั่งซื้อ</th>
                                <th>ผู้สั่งอาหาร</th>
                            </tr>";
            
                    $currentGroup = $orderGroupId;
                }
            
                echo "<tr>
                        <td>$orderId</td>
                        <td>$menuId</td>
                        <td>$menuName</td>
                        <td>$price</td>
                        <td>$quantity</td>
                        <td>$totalPrice</td>
                        <td>$orderDate</td>
                        <td>$userName</td>
                    </tr>";
            
                $groupTotal += $totalPrice;
            }

            echo "<tr style='background-color: #f1c40f; font-weight: bold;'>
                    <td colspan='5'> ยอดรวมคำสั่งซื้อ </td>
                    <td colspan='3'> $groupTotal บาท </td>
                </tr></table>";

            echo "<div class='final-total'>
                ยอดขายรวมทั้งหมด: $totalSales บาท
                </div>";

            echo "<a href='../menu.php'>กลับหน้าเมนู</a>";
        } else {
            echo "<center><h2>ไม่พบข้อมูลในฐานข้อมูล</h2></center>
                <a href='../menu.php'>ย้อนกลับ</a>";
        }
    ?>
    </form>
</body>
</html>
