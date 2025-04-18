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
    $userId = $_GET["id"];
    $sql = "delete from user_account where user_id=$userId";
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