<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"]; 
    //update sql 
    if (isset($_POST['updatesp'])) {
        if(isset($_POST["TenSanPham"])) { $TenSanPham = $_POST['TenSanPham']; }
        if(isset($_POST["GiaSanPham"])) { $GiaSanPham = $_POST['GiaSanPham']; }
        if(isset($_POST["NgayNhap"])) { $NgayNhap = $_POST['NgayNhap']; }
        if(isset($_POST["Soluong"])) { $Soluong = $_POST['Soluong']; }
        if(isset($_POST["BaoHanh"])) { $BaoHanh = $_POST['BaoHanh']; }
        if(isset($_POST["Mota"])) { $Mota = $_POST['Mota']; }
        if(isset($_POST["LoaiSanPham"])) { $LoaiSanPham = $_POST['LoaiSanPham']; }
        if(isset($_POST["HangSX"])) { $HangSanXuat = $_POST['HangSX']; }

        $Hinhsp = isset($_FILES['Hinhsp']['name']) ? $_FILES['Hinhsp']['name'] : '';

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


    $sql = "UPDATE sanpham
            SET TenSanPham  = '$TenSanPham',
                HinhURL     = '$Hinhsp',
                GiaSanPham  = '$GiaSanPham',
                NgayNhap    = '$NgayNhap',
                SoLuong     = '$Soluong',
                BaoHanh  = '$BaoHanh',
                MoTa        = '$Mota',
                MaLoaiSanPham = '$LoaiSanPham',
                MaHangSanXuat = '$HangSanXuat'
            WHERE 
                MaSanPham = '$id'";

            if (mysqli_query($connection, $sql)) {
                echo "<div class='list'>Cập nhật sản phẩm thành công. <a href='/OCAW/qlySanPham'>Quay lại</a></div>";
                exit;
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($connect);
                exit;
            }
        }
    







    ////////////////////////
    $sql = "SELECT * FROM sanpham WHERE MaSanPham='$id'";
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_array($query);
?>

<div id="vien">
    <div class="center">
        <div id="ban">
            <a id="ba" href="/OCAW/index.php">Trang chủ</a> > 
            <a id="ba" href="/OCAW/adminpanel">Admin Panel</a> > 
            <a id="ba" href="/OCAW/qlySanPham/index.php?mod=panel">Quản lý sản phẩm</a> > 
            <font color="#008744">Cập nhật sản phẩm</font>
        </div>
    </div>
</div>
<div class="list">
<?php
echo '<form action="/OCAW/qlySanPham/index.php?mod=update&id='.$id.'" method="POST" enctype="multipart/form-data">';

// echo '<form action="/OCAW/qlySanPham/index.php?mod=update&id='.$id.'" method="POST" >';
?>
    <table>
        <tr>
            <td>
                <p>Tên sản phẩm </p>
                <?php
                echo'<p><input id="TenSanPham" type="text" size="50" name="TenSanPham" value="'.$row['TenSanPham'].'"/></p>';
                ?>
                </td><td>
                <p>Giá sản phẩm </p>
                <?php
                echo'<p><input id="GiaSanPham" type="number" size="50" name="GiaSanPham" value="'.$row['GiaSanPham'].'" /></p>';
                ?>
                </td></tr><tr><td>
                <p>Ngày nhập hàng </p>
                <?php
                echo'<p><input id="NgayNhap" type="text" size="50" name="NgayNhap" value="'.$row['NgayNhap'].'"/></p>';
                ?>
                </td><td>
                <p>Số lượng hàng </p>
                <?php
                echo'<p><input id="Soluong" type="number" size="50" name="Soluong" value="'.$row['SoLuong'].'"/></p>';
                ?>
                </td></tr><tr><td>
                <p>Loại sản phẩm </p>
                    <p><select name="LoaiSanPham">
                        <?php
                        $loai = "SELECT * FROM loaisanpham WHERE BiXoa = 0";
                        $loaisp = mysqli_query($connection, $loai);
                        while($row2 = mysqli_fetch_array($loaisp)) {
                            echo'<option value="'.$row2["MaLoaiSanPham"].'">'.$row2['TenLoaiSanPham'].'</option>';
                        }
                        ?>
                        </select></p>
                </td><td>
                <p>Bảo hành </p>
                <?php
                echo'<p><input id="BaoHanh" type="number" size="50" name="BaoHanh" value="'.$row['BaoHanh'].'"/></p>';
                ?>
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
            <?php
            echo'<p><textarea name="Mota" id="Mota" rows="10" cols="50">'.$row['MoTa'].'</textarea></p>';
            ?>
          
          <p>Hình sản phẩm:</p>
        <p><input id="hinh" type='file' name='Hinhsp' /></p> 
            <p><input type='submit' name="updatesp" value='Cập nhật sản phẩm' onclick=" return Check()" />
            <a href='/OCAW/qlySanPham/index.php?mod=panel'>Quay lại</a></p>
    </form>
</div>
<?php

}
?>