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
<?php
include_once("connectdb.php");
$userId = $_GET["id"];
$sql = "select * from user_account where user_id=$userId";
$result = $conn->query($sql);
if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $UserId = $row["user_id"];
    $UserName = $row["username"];
    $Password = $row["pwd"];
    $UserGroup = $row["user_group"];
    $UserStatus = $row["user_status"];

    $G1="";
    $G2="";
    if ($UserGroup==1){
        $G1="checked";
    }else{
        $G2="checked";
    }

    $S1="";
    $S2="";
    if ($UserStatus==1){
        $S1="checked";
    }else{
        $S2="checked";
    }

    }else{
        echo "ไม่พบข้อมูลรหัส $userId";
    }

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ป้อนข้อมูล</title>
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
            width: 60%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff; 
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); 
        }

        form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }

        form input[type="text"],
        form input[type="number"] {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        form input[type="radio"] {
            margin-right: 10px;
        }

        form input[type="submit"] {
            background-color: #e1b12c; 
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            display: block;
            margin: 0 auto;
        }

        form input[type="submit"]:hover {
            background-color: #d4a017; 
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

    <h1>เพิ่มแก้ไขข้อมูลผู้ใช้</h1>
    <div>
        <form action="UpdateUser.php" method="POST">
        <?php
        echo "
            รหัสผู้ใช้: <input type='text' name='txtid' value=$UserId><br><br>
            ชื่อผู้ใช้: <input type='text' name='txtname' value=$UserName><br><br>
            รหัสผ่าน: <input type='text' name='txtpwd' value=$Password><br><br>
            
            ประเภทผู้ใช้งาน<br><br>
            <input type='radio' name='rdogroup' value='1' $G1>administrator<br><br>
            <input type='radio' name='rdogroup' value='2' $G2>User<br><br>
        
            สถานะการใช้งาน<br><br>
            <input type='radio' name='rdostatus' value='1' $S1>ปกติ<br><br>
            <input type='radio' name='rdostatus' value='2' $S2>ระงับการใช้งาน<br><br>
            <input type='submit' name='Update'>";
        
        ?>

        </form>
    </div>


    
</body>
</html>