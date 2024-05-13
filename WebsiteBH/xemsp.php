<?php
$masp = $_GET['masp'];
$sqlsp = "SELECT * FROM `sanpham` WHERE masp = '$masp'";
                $getsp = mysqli_query($conn,$sqlsp);
                $sp = mysqli_fetch_array($getsp);
?>

<link rel="stylesheet" href="xem.css">

<div class="container">
    <div class="sanpham_img">
    <img src="./img/<?=$sp['anh']?>" alt="Product Image">
    </div>
    <div class="sanpham_inf">
        <h2><?=$sp['tensp']?> </h2>
        <p>Thông số sản phẩm : <?=$sp['thongso']?></p>
        <h4 class="product-price">Giá : <?php echo $sp['gianiemyet'];?>₫ <del class="product-old-price"><?php echo $sp['giaban'];?>₫</del></h4>
        
        <a class="add-to-cart-btn a_sp" href="themgiohang.php?masp=<?=$sp['masp'];?>">
            <i class='bx bxs-cart-add'></i>
            <span class="tooltipp">Thêm vào giỏ</span>
        </a>
        
    </div>
    
</div>