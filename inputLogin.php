<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f3f0; 
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        form {
            background: #5d3fd3; 
            padding: 20px 30px;
            border: 2px solid #e1b12c; 
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            color: white; 
            width: 350px;
        }
        form label {
            font-weight: bold;
            margin-bottom: 8px;
            display: block;
        }
        form input[type="text"],
        form input[type="password"] {
            width: 93%; 
            padding: 10px; 
            margin-bottom: 15px;
            border: 1px solid #e1b12c; 
            border-radius: 5px;
            font-size: 14px;
            color: #5d3fd3; 
            background-color: #fff; 
        }
        form input[type="submit"] {
            width: 100%; 
            padding: 10px;
            background-color: #e1b12c; 
            color: #5d3fd3; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        form input[type="submit"]:hover {
            background-color: #d4a017; 
        }

        form a {
            color: #fff; 
            text-decoration: underline;
            font-weight: bold;
            display: inline-block;
            margin-top: 10px;
        }
        form a:hover {
            color: #e1b12c;
        }
        
    </style>
</head>
<body>
    <form action="login.php" method="post">
        <label> Username :</label>
        <input type="text" name="name">
        <label> Password :</label>
        <input type="password" name="pass">
        <input type="submit" value="Login">
        <br> <center><a href = 'inputregister.php'> ลงทะเบียนผู้ใช้ใหม่ </a></center>
    </form>
</body>
</html>
