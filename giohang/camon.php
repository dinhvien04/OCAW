<?php
// Gọi file kết nối cơ sở dữ liệu
include('../db.php');

// Kiểm tra nếu có các tham số từ GET
if (isset($_GET['partnerCode']) && isset($_GET['orderId']) && isset($_GET['amount']) && isset($_GET['orderInfo']) && isset($_GET['transId']) && isset($_GET['payType'])) {
    // Lấy dữ liệu từ GET
    $partnerCode = $_GET['partnerCode'];
    $orderId = $_GET['orderId'];
    $amount = $_GET['amount'];
    $orderInfo = $_GET['orderInfo'];
    $orderType = isset($_GET['orderType']) ? $_GET['orderType'] : ''; // Nếu có thể lấy từ GET
    $transId = $_GET['transId'];
    $payType = $_GET['payType'];
    $code_cart = "CART" . $orderId;

    // Kiểm tra và tạo đơn hàng mới
    $sql = "SELECT MaDonDatHang FROM dondathang WHERE orderId = '$orderId' LIMIT 1";
    $result = mysqli_query($connection, $sql);
    
    if (!$result) {
        die("Lỗi truy vấn SQL: " . mysqli_error($connection));  // Kiểm tra lỗi truy vấn
    }
    
    $row = mysqli_fetch_array($result);
    
    if ($row) {
        // Nếu đã tồn tại đơn hàng với orderId này, lấy MaDonDatHang
        $maddh = $row['MaDonDatHang'];
    } else {
        // Nếu chưa có đơn hàng, tạo mới
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $ngaylap = date("Y-m-d H:i:s"); // Lấy ngày giờ hiện tại
        $tongtien = $amount;
         // Tổng tiền từ Momo trả về
         $user = $_SESSION['username'];
         $nguoidung = "SELECT * FROM taikhoan WHERE TenDangNhap = '$user'";
         $ngdung = mysqli_query($connection, $nguoidung);
         $ngd = mysqli_fetch_array($ngdung);
         $users = $ngd['MaTaiKhoan']; // Lấy userId từ session

        // Kiểm tra nếu session userId không tồn tại
        if (!$user) {
            die("Không có thông tin người dùng trong session.");
        }

        // Thêm đơn hàng mới vào bảng dondathang
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $ngaylap = date("Y-m-d H:i:s");
        $orderId = time();
        $them = "INSERT INTO dondathang (NgayLap, TongThanhTien, MaTaiKhoan, MaTinhTrang) VALUES ('$ngaylap','$tongtien','$users', 1)";
        $them2 = mysqli_query($connection, $them);

        // Lấy MaDonDatHang mới nhất
        $ddh = "SELECT * FROM dondathang ORDER BY MaDonDatHang DESC LIMIT 1";
        $tvddh = mysqli_query($connection, $ddh);
        $dondathang = mysqli_fetch_array($tvddh);
        $maddh = $dondathang['MaDonDatHang'];
        
        $tvsp="SELECT * FROM sanpham WHERE MaSanPham IN ("; 
foreach($_SESSION['cart'] as $id => $value) { 
    $tvsp.=$id.","; 
}
$tvsp=substr($tvsp, 0, -1).") ORDER BY MaSanPham ASC"; 
$sp = mysqli_query($connection, $tvsp);
while ($r = mysqli_fetch_array($sp)) {
    $sl = $_SESSION['cart'][$r['MaSanPham']]['soluong'];
    $giasp = $r['GiaSanPham'];
    $masp = $r['MaSanPham'];
    $add = "INSERT INTO chitietdondathang (
        SoLuong,
        GiaBan,
        MaDonDatHang,
        MaSanPham
    ) VALUES (
        '$sl',
        '$giasp',
        '$maddh',
        '$masp'
    )";
    $themct = mysqli_query($connection, $add);
}
    }

    // Lưu thông tin giao dịch MOMO vào bảng momo
    $insertMomoQuery = "INSERT INTO momo (partnerCode, orderId, amount, orderInfo, orderType, transId, payType, code_cart) 
                        VALUES ('$partnerCode', '$orderId', '$amount', '$orderInfo', '$orderType', '$transId', '$payType', '$code_cart')";

    if (mysqli_query($connection, $insertMomoQuery, $them2)) {
        // Sau khi lưu giao dịch, chuyển hướng tới trang chi tiết đơn hàng
        echo '<div class="list">Giao dịch MOMO thành công. <a href="/OCAW/donhang/index.php?mod=chitiet&id=' . $maddh . '">Xem chi tiết đơn hàng</a></div>';
        unset($_SESSION['cart']);
    } else {
        echo "Lỗi lưu giao dịch MOMO: " . mysqli_error($connection);
    }

    // Đóng kết nối sau khi thực hiện xong
    mysqli_close($connection);
} else {
    echo "Không có thông tin giao dịch hợp lệ.";
}
?>
