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
$menuId = $_GET["id"];
$sql = "SELECT * FROM menu WHERE menu_id=$menuId";
$result = $conn->query($sql);

if ($result->num_rows == 1){
    $row = $result->fetch_assoc();
    $MenuId = $row["menu_id"];
    $MenuName = $row["menu_name"];
    $Price = $row["price"];
    $Category = $row["category"];
    $Menustatus = $row["menu_status"];

    $S1="";
    $S0="";
    if ($Menustatus==1){
        $S1="checked";
    }else{
        $S0="checked";
    }

    }else{
        echo "ไม่พบข้อมูลรหัส $menuId";
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
    
    <h1>เพิ่มแก้ไขข้อมูลเมนูอาหาร</h1>
    <div>
        <form action="UpdateFood.php" method="POST">
        <?php
        echo "
            <label>รหัสเมนูอาหาร:</label> 
            <input type='text' name='menu_id' value=$MenuId><br><br>
            <label>ชื่อเมนูอาหาร:</label>
            <input type='text' name='menu_name' value=$MenuName ><br><br>
            <label>ราคา:</label>
            <input type='number' name='price' value=$Price><br><br>
            <label>หมวดหมู่:</label>
            <input type='text' name='category'value=$Category><br><br>
            <label>สถานะ:</label><br><br>
            <input type='radio' name='menu_status' value='1' $S1>ขาย<br><br>
            <input type='radio' name='menu_status' value='0' $S0>ระงับการขาย<br><br>
            <input type='submit' name='เพิ่มสินค้า'>";
        
        ?>

        </form>
    </div>
 
</body>
</html>