<?php
if (isset($_GET['mod']) && $_GET['mod'] == 'huydonHang') {
    // Xóa toàn bộ giỏ hàng
    unset($_SESSION['cart']);
    $_SESSION['message'] = "đơn hàng đã hủy thành công";
    // Chuyển hướng về trang giỏ hàng
    ChangeURL("../giohang");
    exit();
}



?>