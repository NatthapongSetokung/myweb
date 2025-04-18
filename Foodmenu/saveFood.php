<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save</title>
</head>
<body>
    <?php
    include_once("connectdb.php");
    $menu_name = $_POST['menu_name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $menu_status = $_POST['menu_status'];

    $sql = "INSERT INTO menu (menu_name, price, category, menu_status)
            VALUES ('$menu_name', $price, '$category', $menu_status)";

    if ($conn->query($sql) === true){
        echo "เพิ่มข้อมูลเรียบร้อย";
        header("Location: displayFood.php");
        exit();
    }else{
        echo "ผิดพลาด $sql <br>" .$conn->error ;
    }

    $conn->close();

?>
</body>
</html>