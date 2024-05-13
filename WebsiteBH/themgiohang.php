<?php
    session_start();
    include './ketnoi.php';
    $makh= $_SESSION['makhachhang'];
    $masp = $_GET['masp'];
    
    $themgh = "CALL UpdateGioHang($makh, '$masp', 1);";
    $query = mysqli_query($conn,$themgh);
    $affectedRows = mysqli_affected_rows($conn);
    if($affectedRows>0){
    echo '<script>';
        
        echo 'window.location.href = "trangchu.php";';
        echo 'alert("Đã thêm vào giỏ!");';
        echo '</script>';
    }
    else{
        echo '<script>';
        echo 'alert("Vui lòng thao tác lại!!");';
        echo '</script>';
    } 
  
?>