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
    <title>Menu</title>
    <style> 

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

       
        body {
            font-family: Arial, sans-serif;
            background-color: #f3f3f3; 
            margin: 0;
            padding: 0;
        }

        a {
            text-decoration: none;
            color: #5d3fd3; 
            font-size: 14pt;
            font-weight: bold;
        }

        a:hover {
            color: #e1b12c; 
        }

        div {
            margin: 20px;
            text-align: center;
        }

        p a {
            display: inline-block;
            margin: 10px;
            padding: 10px 15px;
            background-color: #e1b12c; 
            color: #5d3fd3; 
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        p a:hover {
            background-color: #d4a017; 
            color: white; 
        }

        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin: 0 auto;
            width: 80%;
            max-width: 400px; 
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            margin: 20px auto;
        }

        .container a {
            display: block; 
            width: 80%; 
            max-width: 250px; 
            padding: 12px 0; 
            margin: 10px auto; 
            background-color: #e1b12c; 
            color: #5d3fd3; 
            text-decoration: none;
            text-align: center;
            font-weight: bold;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        .container a:hover {
            background-color: #d4a017;
        }


    </style>
</head>
<body>
<div class="login">
    <img src="icon/login.png" width="25" height="25" alt="User Icon">
    <ul>
        <?php
            echo"<li>ชื่อบัญชี:$username </li>";
            echo"<li>สิทธิ:$userGroup</li>";
        ?>
    </ul>
</div>
<div class="container">
    <div>
        <p><a href="Foodmenu/displayFood.php">ดูตารางเมนูอาหาร</a></p>
        <p><a href="User/displayUser.php">ดูข้อมูลผู้ใช้</a></p>
        <p><a href="Order/displaymenu.php">สั่งอาหาร</a></p>
        <p><a href="Ordersummary/displaySummary.php">สรุปยอดขาย</a></p>
        <p><a href="inputlogin.php">ออกจากระบบ</a></p>
    </div>
</div>
</body>
</html>
