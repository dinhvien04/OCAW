<?php
require "../header.php";

$mod = "mucluc";
if(isset($_GET["mod"]))
    $mod = $_GET["mod"];
    
// require "../footer.php";
switch ($mod) {
    case 'mucluc': 
        include "../SanPham/mucluc.php";
        break;
    case 'sanpham': 
        include "../SanPham/sanpham.php";
        break;
    case 'dssp': 
        include "../SanPham/dssp.php";
        break;  
    case 'timkiem': 
        include "../SanPham/timkiem.php";
        break;        
    default:
        include "../error.php";
        break;
}
// require "../footer.php";
?>