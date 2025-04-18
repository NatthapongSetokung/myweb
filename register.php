<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once("connectdb.php");
    $username = $_POST["txtname"];
    $pwd = $_POST["txtpwd"];
    $userGroup = $_POST["rdogroup"];
    $userStatus = $_POST["rdostatus"];
    $sql = "insert into user_account(username,pwd,user_group,user_status) values('$username','$pwd','$userGroup','$userStatus')";
    if ($conn->query($sql) === true){
        echo "เพิ่มข้อมูลเรียบร้อย";
        header("Location: inputLogin.php");
        exit();
    }else{
        echo "ผิดพลาด $sql <br>" .$conn->error ;
    }

    $conn->close();

?>
</body>
</html>