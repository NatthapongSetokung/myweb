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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>หน้าต่างผู้ใช้งาน</title>
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
        a[href="displayUser.php"] {
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
        a[href="displayUser.php"]:hover {
            background-color: #d4a017;
        }

        a[href='forminputUser.php'] img {
            display: block;
            margin: 20px auto;
            border: 2px solid #e1b12c;
            border-radius: 5px;
            padding: 5px;
            transition: all 0.3s ease;
        }

        a[href='forminputUser.php'] img:hover {
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
        $sql = "SELECT * FROM user_account WHERE username LIKE '%$search%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0){
            if ($userGroup == "ผู้ดูแลระบบ") {
                echo "<a href = 'forminputUser.php'> <img src='icon/add.png' width = 30px ></a>";
            }

            echo " 
                    <input type='text' name='search' placeholder='ค้นหาผู้ใช้' 
                    style='width: 665px;' value=$search >
                    <input type='submit' value='ค้นหา'>";

        echo "
        <table >
            <tr style = 'background-color:burlywood'>
                <td width = 50 px >No.</td>
                <td width = 50 px >ID</td>
                <td width = 150 px>ชื่อผู้ใช้</td>
                <td width = 150 px>รหัสผ่าน</td>
                <td width = 100 px>กลุ่มผู้ใช้</td>
                <td width = 100 px>สถานะผู้ใช้</td>";
                if ($userGroup == "ผู้ดูแลระบบ") {
                    echo"
                    <td width = 50 px>แก้ไข</td>
                    <td width = 50 px>ลบ</td>";
                }
                echo "</tr>";
        
            $No =0;
            while ($row = $result->fetch_assoc()){
                $UserId = $row["user_id"];
                $UserName = $row["username"];
                $Password = $row["pwd"];
                $UserGroup = $row["user_group"];
                $UserStatus = $row["user_status"];
                $No++;

                if($UserGroup == 1){
                    $UserGroup = "administrator";
                }else{
                    $UserGroup = "User";
                }

                if($UserStatus == 1){
                    $UserStatus = "ปกติ";
                }else{
                    $UserStatus = "ระงับการใช้งาน";
                }

                echo "
                    <tr>
                        <td>$No</td>
                        <td>$UserId</td>
                        <td>$UserName</td>
                        <td>$Password</td>
                        <td>$UserGroup</td>
                        <td>$UserStatus</td>";
                        if ($userGroup == "ผู้ดูแลระบบ") {
                        echo "  
                                <td><a href = 'formeditUser.php? id=$UserId'>
                                <img src='icon/edit.png' width = 30px ></a></td>
                                <td><a href = 'DeleteUser.php? id=$UserId'> 
                                <img src='icon/delete.png' width = 30px ></a></td>";
                        }
                        echo"</tr>";
        
            }
            echo"</table>";
            echo "<a href='../menu.php'>กลับหน้าเมนู</a><br>";
        }else{
            echo "<h1>ไม่ทราบข้อมูลผู้ใช้<h1>
            <a href='../menu.php'>ย้อนกลับ</a><br>";
        }
        
        ?>
    </form>
</body>
</html>