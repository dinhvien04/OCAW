<?php
require("header.php");
?>
<?php

require("db.php"); // Kết nối cơ sở dữ liệu

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy dữ liệu từ form
    $name = htmlspecialchars($_POST['name'] ?? '');
    $email = htmlspecialchars($_POST['email'] ?? '');
    $message = htmlspecialchars($_POST['message'] ?? '');

    // Kiểm tra dữ liệu nhập
    if (!empty($name) && !empty($email) && !empty($message)) {
        // Sử dụng MySQLi với Prepared Statements
        $sql = "INSERT INTO lienhe (HoTen, email, NoiDung) VALUES (?, ?, ?)";
        $stmt = $connection->prepare($sql);

        if ($stmt) {
            // Gắn dữ liệu vào câu lệnh
            $stmt->bind_param("sss", $name, $email, $message);

            // Thực thi câu lệnh
            if ($stmt->execute()) {
                echo "<p style='color: green; text-align: center;'>Gửi liên hệ thành công!</p>";
            } else {
                echo "<p style='color: red; text-align: center;'>Lỗi khi gửi liên hệ: " . $stmt->error . "</p>";
            }

            // Đóng statement
            $stmt->close();
        } else {
            echo "<p style='color: red; text-align: center;'>Lỗi chuẩn bị câu lệnh: " . $connection->error . "</p>";
        }
    } else {
        echo "<p style='color: red; text-align: center;'>Vui lòng điền đầy đủ thông tin.</p>";
    }
}

// Đóng kết nối
$connection->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Liên Hệ</title>
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
            max-width: 600px;
            margin: 0 auto;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        form {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: space-between;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
            width: 100%;
        }
        input, textarea {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
        }
        button {
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            align-self: flex-end;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <header>
        <h1>Liên Hệ Với Chúng Tôi</h1>
    </header>
    <div class="container">
        <form action="#" method="post">
            <label for="name">Họ và Tên</label>
            <input type="text" id="name" name="name" placeholder="Nhập họ và tên của bạn" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>

            <label for="message">Nội Dung</label>
            <textarea id="message" name="message" rows="5" placeholder="Nhập nội dung cần liên hệ" required></textarea>

            <button type="submit">Gửi Liên Hệ</button>
        </form>
    </div>
</body>
</html>

<?php
require("footer.php");
?>