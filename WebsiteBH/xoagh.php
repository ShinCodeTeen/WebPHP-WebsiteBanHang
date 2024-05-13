<?php 
    session_start();
    include_once './ketnoi.php';
    $maspxoa = $_GET['masp'];
    $makh= $_SESSION['makhachhang'];
    $xoadm = "DELETE FROM `giohang` WHERE masp ='$maspxoa' AND userid=$makh";
    $query = mysqli_query($conn,$xoadm);
    $newLocation = "http://localhost/WebsiteBH/trangchu.php?page_layout=giohang";
    header("Location: " . $newLocation);
  
?>