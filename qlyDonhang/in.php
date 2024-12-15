<?php
// Tắt lỗi hiển thị để tránh xuất dữ liệu thừa trước khi tạo PDF
error_reporting(0);
ini_set('display_errors', 0);

// Bao gồm thư viện FPDF
require('../fpdf186/fpdf.php');

// Kiểm tra nếu có ID đơn hàng
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Kết nối với cơ sở dữ liệu
    include('../db.php');
    
    // Truy vấn dữ liệu đơn hàng
    $sql = "SELECT * FROM chitietdondathang WHERE MaDonDatHang = '$id'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);
    
    $sql1 = "SELECT * FROM dondathang WHERE MaDonDatHang = '$id'";
    $query1 = mysqli_query($connection, $sql1);
    $row1 = mysqli_fetch_array($query1);
    
    $sql2 = "SELECT * FROM taikhoan WHERE MaTaiKhoan = '".$row1['MaTaiKhoan']."'";
    $query2 = mysqli_query($connection, $sql2);
    $row2 = mysqli_fetch_array($query2);
    
    $sql5 = "SELECT * FROM tinhtrang WHERE MaTinhTrang = '".$row1['MaTinhTrang']."'";
    $query5 = mysqli_query($connection, $sql5);
    $row5 = mysqli_fetch_array($query5);

    // Khởi tạo đối tượng FPDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);

    // Thêm tiêu đề
    $pdf->Cell(0, 10, 'Hoa Don Mua Hang', 0, 1, 'C');
    $pdf->Ln(10); // Dấu cách giữa các dòng

    // Thông tin đơn hàng
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(50, 10, 'Ma Don Dat Hang:', 0, 0);
    $pdf->Cell(0, 10, $row['MaDonDatHang'], 0, 1);
    $pdf->Cell(50, 10, 'Ngay Dat Hang:', 0, 0);
    $pdf->Cell(0, 10, $row1['NgayLap'], 0, 1);
    $pdf->Cell(50, 10, 'Khach Hang:', 0, 0);
    $pdf->Cell(0, 10, $row2['HoTen'], 0, 1);
    $pdf->Cell(50, 10, 'Dien Thoai:', 0, 0);
    $pdf->Cell(0, 10, $row2['DienThoai'], 0, 1);
    $pdf->Cell(50, 10, 'Dia Chi:', 0, 0);
    $pdf->Cell(0, 10, $row2['DiaChi'], 0, 1);
    $pdf->Cell(50, 10, 'Tong Tien:', 0, 0);
    $pdf->Cell(0, 10, number_format($row1['TongThanhTien'], 0) . ' đ', 0, 1);
    $pdf->Cell(50, 10, 'Tinh Trang:', 0, 0);
    $pdf->Cell(0, 10, $row5['TenTinhTrang'], 0, 1);

    // Dữ liệu sản phẩm
    $pdf->Ln(10); // Dấu cách giữa thông tin đơn hàng và sản phẩm
    $pdf->Cell(0, 10, 'San Pham:', 0, 1);
    $pdf->SetFont('Arial', '', 10);
    
    // Lấy danh sách sản phẩm trong đơn hàng
    $stt = 1;
    $sql4 = "SELECT * FROM chitietdondathang WHERE MaDonDatHang = '$id'";
    $query4 = mysqli_query($connection, $sql4);
    while ($row4 = mysqli_fetch_array($query4)) {
        $sql3 = "SELECT * FROM sanpham WHERE MaSanPham = '".$row4['MaSanPham']."'";
        $query3 = mysqli_query($connection, $sql3);
        $row3 = mysqli_fetch_array($query3);
        $pdf->Cell(0, 10, $stt . '. ' . $row3['TenSanPham'] . ' - So Luong: ' . $row4['SoLuong'] . ' - Gia: ' . number_format($row4['GiaBan'], 0) . ' đ', 0, 1);
        $stt++;
    }

    // Xuất PDF và gửi tới trình duyệt
    $pdf->Output();
}
?>
