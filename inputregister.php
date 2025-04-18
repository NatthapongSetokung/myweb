<!DOCTYPE html>
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
    <h1>ลงทะเบียนข้อมูลผู้ใช้</h1>
    <div>
        <form action="register.php" method="POST">
        ชื่อผู้ใช้: <input type="text" name="txtname"><br><br>
        รหัสผ่าน: <input type="text" name="txtpwd"><br><br>

        <input type="hidden" name="rdogroup" value="2" checked>

        <input type="hidden" name="rdostatus" value="1" checked>

        <input type="submit" name="Save"> 

        </form>
    </div>


    
</body>
</html>