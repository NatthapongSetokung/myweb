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
    $UserId = $_POST["txtid"];
    $username = $_POST["txtname"];
    $pwd = $_POST["txtpwd"];
    $userGroup = $_POST["rdogroup"];
    $userStatus = $_POST["rdostatus"];
    
    $sql ="update user_account 
    set username='$username',
    pwd='$pwd',
    user_group=$userGroup,
    user_status=$userStatus  where user_id=$UserId";
    
    if ($conn->query($sql) === true){
        header("Location: displayUser.php");
        exit();
    }else{
        echo "ผิดพลาด $sql <br>" .$conn->error ;
    }

    $conn->close();



?>
</body>
</html>