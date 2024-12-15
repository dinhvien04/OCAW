<?php
require("header.php");
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            text-align: center;
        }

        h1 {
            font-size: 300px;
            margin: 0;
            color: #ff6b6b;
        }

        p {
            font-size: 50px;
            margin: 10px 0;
        } 

        /* a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
        } */
        .custom-link {
          display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            background-color: #007BFF;
            text-decoration: none;
            border-radius: 5px;
}




        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Trang bạn đang tìm kiếm không tồn tại</p>
        <a href="/OCAW/index.php" class="custom-link">Trở về trang chủ</a>
    </div>
</body>
</html>
<?php
// require("footer.php");
?>