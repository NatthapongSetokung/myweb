<?php
include_once("connectdb.php");

if (isset($_COOKIE["username"]) and isset($_COOKIE["UserGroup"])) {
    $username = $_COOKIE["username"];
    $userGroup = $_COOKIE["UserGroup"];
} else {
    $username = "ไม่ได้เข้าสู่ระบบ"; 
    $userGroup = "ไม่มีสิทธิ์";
    echo '<script>
        alert("ยังไม่ได้ login");
        window.location.href="inputLogin.php";
    </script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าต่างสินค้า</title>
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
            width: 95%;
            margin: 20px auto;
            border-collapse: collapse;
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

        a[href="../menu.php"], 
        a[href="displayFood.php"] {
            display: block;
            text-align: center;
            background-color: #e1b12c;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            width: 200px;
            margin: 20px auto;
            font-weight: bold;
            text-transform: uppercase;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        a[href="../menu.php"]:hover, 
        a[href="displayFood.php"]:hover {
            background-color: #d4a017;
        }

        a[href='inputFood.php'] img {
            display: block;
            margin: 20px auto;
            border: 2px solid #e1b12c;
            border-radius: 5px;
            padding: 5px;
            transition: all 0.3s ease;
        }

        a[href='inputFood.php'] img:hover {
            border-color: #d4a017;
            background-color: #fdf5e6;
        }

        form {
            text-align: center;
            margin-top: 20px;
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
    
    <form method="GET" >
        <?php
        include_once("connectdb.php");

        $userGroup = isset($_COOKIE['UserGroup']) ? $_COOKIE['UserGroup'] : null;

        $search = "";

        if (isset($_GET['search'])) {
            $search = $_GET['search'];
        }

        $sql = "SELECT * FROM menu WHERE menu_name LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            
            if ($userGroup == "ผู้ดูแลระบบ") {
                echo "<a href='inputFood.php'><img src='icon/add.png' width=30px></a>";
            }

            echo " 
                    <input type='text' name='search' placeholder='ค้นหาเมนูอาหาร' 
                    style='width: 828px;' value=$search >
                    <input type='submit' value='ค้นหา'>";

            echo "
            <table>
                <tr style='background-color:burlywood'>
                    <td width='50px'>No.</td>
                    <td width='50px'>รหัสเมนูอาหาร</td>
                    <td width='150px'>ชื่อเมนูอาหาร</td>
                    <td width='150px'>ราคา</td>
                    <td width='100px'>หมวดหมู่</td>
                    <td width='100px'>สถานะ</td>";
                    if ($userGroup == "ผู้ดูแลระบบ") {
                        echo "
                        <td width=50px>แก้ไข</td>
                        <td width=50px>ลบ</td>";
                }
                echo "</tr>";

            $No = 0;
            while ($row = $result->fetch_assoc()) {
                $MenuId = $row["menu_id"];
                $MenuName = $row["menu_name"];
                $Price = $row["price"];
                $Category = $row["category"];
                $Menustatus = $row["menu_status"];
                $No++;

                if($Menustatus == 1){
                    $Menustatus = "ขาย";
                }else{
                    $Menustatus = "ระงับการขาย";
                }

                echo "
                    <tr>
                        <td>$No</td>
                        <td>$MenuId</td>
                        <td>$MenuName</td>
                        <td>$Price</td>
                        <td>$Category</td>
                        <td>$Menustatus</td>";
                        if ($userGroup == "ผู้ดูแลระบบ") {
                        echo "
                                <td><a href='Foodedit.php?id=$MenuId'>
                                <img src='icon/edit.png' width=30px></a></td>
                                <td><a href='DeleteFood.php?id=$MenuId'> 
                                <img src='icon/delete.png' width=30px></a></td>";
                        }
                        echo "</tr>";
            }
            echo "</table>";
            echo "<a href='../menu.php'>กลับหน้าเมนู</a><br>";
        } else {
            echo "<h1>ไม่พบข้อมูลเมนูอาหาร<h1>
                <a href='../menu.php'>ย้อนกลับ</a><br>";
        }
        ?>
    </form>
</body>
</html>