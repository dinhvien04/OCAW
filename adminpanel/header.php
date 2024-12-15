<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    require "../db.php";
    require "../func.php";
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="/OCAW/giaodien/mystyle.css">
    <link rel="icon" href="/OCAW/images/V.png">
    <title>Trang quản lý của ADMIN</title>
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
    <div class="header">
        <div class="topbar">
            <div class="center"><a href="/OCAW/index.php"><font color="#fff">Trang chủ chính</font></a> |
                <span><a href="/OCAW/adminpanel"><font color="#fff">Trang quản lý của ADMIN</font></a></span>
                <ul class="listtopbar">
                    <li><a href="/"><i style='font-size:12px' class='fas'>&#xf007;</i> 
                    <?php
                        if(isset($_SESSION['username']) && $_SESSION['username']) {
                            $username = $_SESSION['username'];
                            $sql = "SELECT * FROM taikhoan WHERE TenDangNhap='$username'";
                            $query = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_array($query);
                            if ($row['Quyen'] == 1) {
                                echo '<font color="red">'.$username.'</font>';
                            } else {
                                echo $username;
                            }
                        } else {
                            ?> 
                            Tài khoản
                            <?php
                        }
                        ?>
                    </a>
                    <ul id="loginout">
                    <?php
                    if(isset($_SESSION['username']) && $_SESSION['username']) {
                        if ($row['Quyen'] == 1) {
                            echo'<li id="adm"><a href="/OCAW/AdminPanel.php">Admin Panel</a></li>';
                        }    
                        echo'
                        <li id="login"><a href="/OCAW/taikhoan/index.php?&id='.$row['MaTaiKhoan'].'">Trang tài khoản</a></li>
                        <li id="reg"><a href="/OCAW/dangxuat.php">Đăng xuất</a></li>';
                    } else {
                        echo'<li id="login"><a href="/OCAW/dangnhap.php">Đăng nhập</a></li>
                        <li id="reg"><a href="/OCAW/dangky.php">Đăng kí</a></li>';
                    }
                        ?>
                    </ul>
                    </li>
                </ul>
            </div>
        </div> 

     
