<?php
include('../db.php'); // Bao gồm file kết nối cơ sở dữ liệu

// Kiểm tra kết nối cơ sở dữ liệu
if (!$connection) {
    die("Lỗi: Không thể kết nối cơ sở dữ liệu. " . mysqli_connect_error());
}

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "UPDATE sanpham SET BiXoa = 1 WHERE MaSanPham = '$id'";
    $result = mysqli_query($connection, $sql);
}
ChangeURL("../qlySanPham");
?>