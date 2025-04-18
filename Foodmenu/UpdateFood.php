<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>
</head>
<body>
    <?php
    include_once("connectdb.php");

    $menu_id = $_POST['menu_id'];
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $menu_status = $_POST['menu_status'];

    $sql = "UPDATE menu SET
                menu_name='$menu_name',
                price=$price,
                category='$category',
                menu_status=$menu_status
            WHERE menu_id=$menu_id";
    
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