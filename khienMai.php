<?php
require("header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Khuyến Mãi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        .promotion {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .promotion h2 {
            margin-top: 0;
            color: #333;
        }
        .promotion p {
            color: #666;
        }
        .promotion .btn {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 15px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .promotion .btn:hover {
            background-color: #218838;
        }
        .promotion img {
            max-width: 100%;
            border-radius: 5px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Chào mừng đến với Trang Khuyến Mãi</h1>
    </header>
    <div class="container">
        <div class="promotion">
            <img src="/OCAW/images/50.jpg" alt="Khuyến mãi 50%">
            <h2>Giảm giá 50% tất cả sản phẩm!</h2>
            <p>Áp dụng từ ngày 1/12/2024 đến 31/12/2024.</p>
            <a href="#"  class="btn">Xem chi tiết</a>
        </div>
        <div class="promotion">
            <img src="/OCAW/images/free.png" alt="Miễn phí vận chuyển">
            <h2>Miễn phí vận chuyển đơn hàng trên 600.000đ</h2>
            <p>Chỉ áp dụng trong tháng 11/2024.</p>
            <a href="#" class="btn">Xem chi tiết</a>
        </div>
        <div class="promotion">
            <img src="/OCAW/images/quato.png" alt="Quà tặng đặc biệt">
            <h2>Quà tặng đặc biệt cho khách hàng mới</h2>
            <p>Đăng ký tài khoản để nhận ngay ưu đãi!</p>
            <a href="#" class="btn">Đăng ký ngay</a>
        </div>
    </div>
</body>
</html>

<?php
require("footer.php");
?>