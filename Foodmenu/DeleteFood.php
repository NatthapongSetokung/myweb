<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>delete</title>
</head>
<body>
    <?php
    include_once("connectdb.php");

    $menu_id = $_GET['id'];
    $sql = "DELETE FROM menu WHERE menu_id=$menu_id";
    if ($conn->query($sql) === true){
        header("Location: displayFood.php");
        exit();
    }else{
        echo "ผิดพลาด $sql <br>" .$conn->error ;
    }

    $conn->close();


    ?>
</body>
</html>