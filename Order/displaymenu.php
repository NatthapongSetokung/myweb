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
?>

<?php
include_once("connectdb.php");

$search = "";

if (isset($_GET['search'])) {
    $search = $_GET['search'];
}

$sql = "SELECT * FROM menu WHERE menu_name LIKE '%$search%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ร้านค้า</title>
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

        a {
            text-decoration: none;
            color: #5d3fd3; 
            font-weight: bold;
            font-size: 14px;
        }

        a:hover {
            color: #e1b12c; 
        }

        a[href="addTocart.php"],
        a[href="../menu.php"], 
        a[href="displaymenu.php"]{
            display: block;
            text-align: center;
            background-color: #e1b12c;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            width: 200px;
            margin: 5px auto;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        a[href="addTocart.php"]:hover,
        a[href="../menu.php"]:hover, 
        a[href="displaymenu.php"]:hover {
            background-color: #d4a017;
        }

        a[href='addTocart.php'] img {
            display: block;
            margin: 20px auto;
            border: 2px solid #e1b12c;
            border-radius: 5px;
            padding: 5px;
            transition: all 0.3s ease;
        }

        a[href='addTocart.php'] img:hover {
            border-color: #d4a017;
            background-color: #fdf5e6;
        }

    </style>
</head>
<body>
    <div class ="login">
        <IMG src="icon/login.png" width="25" height="25">
        <ul>
            <?php
            echo"<li>ชื่อบัญชี:$username </li>";
            echo"<li>สิทธิ:$userGroup</li>";
            ?>
        </ul>
    </div>

    <form method="GET">
    <?php     
    if ($result->num_rows > 0) {
        echo "  <input type='text' name='search' placeholder='ค้นหาเมนูอาหาร' 
                style='width: 250px;' value='$search'>
                <input type='submit' value='ค้นหา'>";
                
        echo "<table>
                <tr style='background-color:burlywood'>
                    <td>เลือก</td>
                    <td>รายการสินค้า</td>
                    <td>ราคา</td>
                    <td>หมวดหมู่</td>
                </tr>";
        
        while ($row = $result->fetch_assoc()) {
            $MenuId = $row["menu_id"];
            $MenuName = $row["menu_name"];
            $Price = $row["price"];
            $Category = $row["category"];

            echo "<tr>
                    <td><a href='addTocart.php?id=$MenuId'>
                    <img src='icon/cart.png' width='25' height='25'></a></td>
                    <td>$MenuName</td>
                    <td>$Price</td>
                    <td>$Category</td>
                </tr>";
        }
        echo "</table>";
        echo "<a href='addTocart.php'>ตะกร้า</a><br>
            <a href='../menu.php'>กลับหน้าเมนู</a><br>";
    } else {
        echo "<h1>ไม่พบข้อมูลเมนูอาหาร<h1>
            <a href='../menu.php'>ย้อนกลับ</a><br>";

    }
    ?>
</form>
</body>
</html>