<?php
if (isset($_POST['themsp'])) {
    // Lấy dữ liệu từ form
    $TenSanPham = isset($_POST['TenSanPham']) ? $_POST['TenSanPham'] : '';
    $GiaSanPham = isset($_POST['GiaSanPham']) ? $_POST['GiaSanPham'] : '';
    $NgayNhap = isset($_POST['NgayNhap']) ? $_POST['NgayNhap'] : '';
    $Soluong = isset($_POST['Soluong']) ? $_POST['Soluong'] : '';
    $BaoHanh = isset($_POST['BaoHanh']) ? $_POST['BaoHanh'] : '';
    $Mota = isset($_POST['Mota']) ? $_POST['Mota'] : '';
    $LoaiSanPham = isset($_POST['LoaiSanPham']) ? $_POST['LoaiSanPham'] : '';
    $HangSanXuat = isset($_POST['HangSX']) ? $_POST['HangSX'] : '';
    $Hinhsp = isset($_FILES['Hinhsp']['name']) ? $_FILES['Hinhsp']['name'] : '';

    // Kiểm tra file hình ảnh
    if (isset($_FILES['Hinhsp']) && $_FILES['Hinhsp']['error'] == 0) {
        $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filename = $_FILES["Hinhsp"]["name"];
        $filetype = $_FILES["Hinhsp"]["type"];
        $filesize = $_FILES["Hinhsp"]["size"];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        if (!array_key_exists($ext, $allowed)) {
            die("Lỗi: Vui lòng chọn đúng định dạng file.");
        }

        $maxsize = 5 * 1024 * 1024; // 5MB
        if ($filesize > $maxsize) {
            die("Lỗi: Kích thước file lớn hơn giới hạn cho phép.");
        }

        if (in_array($filetype, $allowed)) {
            // if (file_exists("../images/" . $filename)) {
            //     die("Lỗi: File hình ảnh đã tồn tại.");
            // } else {
            //     move_uploaded_file($_FILES["Hinhsp"]["tmp_name"], "../images/" . $filename);
            // }
        } else {
            die("Lỗi: Có vấn đề xảy ra khi upload file.");
        }
    } else {
        die("Lỗi: " . $_FILES["Hinhsp"]["error"]);
    }

    // Câu lệnh SQL để thêm sản phẩm
    $sql = "INSERT INTO sanpham (
        TenSanPham,
        HinhURL,
        GiaSanPham, 
        NgayNhap, 
        SoLuong, 
        MoTa, 
        MaLoaiSanPham, 
        MaHangSanXuat, 
        BaoHanh
    ) VALUES (
        '$TenSanPham',
        '$Hinhsp',
        '$GiaSanPham', 
        '$NgayNhap', 
        '$Soluong', 
        '$Mota', 
        '$LoaiSanPham', 
        '$HangSanXuat', 
        '$BaoHanh'
    )";

    // Thực thi câu lệnh SQL
    if (mysqli_query($connection, $sql)) {
        echo "<div class='list'>Thêm sản phẩm thành công. <a href='/qlySanPham'>Quay lại</a></div>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($connection);
    }
}
?>
<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/OCAW/index.php">Trang chủ</a> > 
            <a id="ba" href="/OCAW/adminpanel">Admin Panel</a> > 
            <a id="ba" href="/OCAW/qlySanPham/index.php?mod=panel">Quản lý sản phẩm</a> > 
            <font color="#008744">Thêm sản phẩm</font>
        </div>
    </div>
</div>
<div class="list">
    <form action='/OCAW/qlySanPham/index.php?mod=add' method='POST' enctype="multipart/form-data">
        <table>
            <tr>
                <td>
                    <p>Tên sản phẩm </p>
                    <p><input id="TenSanPham" type='text' size="50" name='TenSanPham' /></p>
                </td><td>
                    <p>Giá sản phẩm </p>
                    <p><input id="GiaSanPham" type='number' size="50" name='GiaSanPham' /></p>
                </td></tr>
                <tr><td>
                    <p>Ngày nhập hàng </p>
                    <p><input id="NgayNhap" type='date' size="50" name='NgayNhap' /></p>
                </td><td>
                    <p>Số lượng </p>
                    <p><input id="Soluong" type='number' size="50" name='Soluong' /></p>
                </td></tr>
                <tr><td>
                    <p>Bảo hành: </p>
                    <p><input id="BaoHanh" type='number' size="50" name='BaoHanh' /></p>
                </td><td>
                    <p>Loại sản phẩm </p>
                    <p><select name="LoaiSanPham">
                        <?php
                        $loai = "SELECT * FROM loaisanpham WHERE BiXoa = 0";
                        $loaisp = mysqli_query($connection, $loai);
                        while($row = mysqli_fetch_array($loaisp)) {
                            echo'<option value="'.$row["MaLoaiSanPham"].'">'.$row['TenLoaiSanPham'].'</option>';
                        }
                        ?>
                        </select></p>
                </td></tr></table>
        <p>Hãng sản xuất </p>
        <p><select name="HangSX">
                        <?php
                        $th = "SELECT * FROM hangsanxuat WHERE BiXoa = 0";
                        $thuonghieu = mysqli_query($connection, $th);
                        while($row1 = mysqli_fetch_array($thuonghieu)) {
                            echo'<option value="'.$row1["MaHangSanXuat"].'">'.$row1['TenHangSanXuat'].'</option>';
                        }
                        ?>
                        </select></p>
        <p>Mô tả </p>
        <p><textarea name="Mota" id="Mota" rows="10" cols="50"></textarea></p>
        <p>Hình sản phẩm:</p>
        <p><input id="hinh" type='file' name='Hinhsp' /></p>
        <p><input type='submit' name="themsp" value='Thêm sản phẩm' onclick=" return Check()" />
        <a href='/OCAW/qlySanPham/index.php?mod=panel'>Quay lại</a></p>
    </form>
</div>