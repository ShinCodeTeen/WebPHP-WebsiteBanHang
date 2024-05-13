<?php

include './ketnoi.php';
$sqlgh = "SELECT * FROM `giohang` where userid ='$makh'";
$getgh = mysqli_query($conn, $sqlgh);

?>

<link rel="stylesheet" href="giohang.css">
<body>
    <h2>Giỏ hàng của bạn </h2>
    <div class="cart-container">
        <?php while ($gh = mysqli_fetch_array($getgh)){ 
                $masp = $gh['masp'];
                $sqlsp = "SELECT * FROM `sanpham` WHERE masp = '$masp'";
                $getsp = mysqli_query($conn,$sqlsp);
                $sp = mysqli_fetch_array($getsp);        ?>
        <div class="product">
            <div class="product-img">
                <img src="./img/<?php echo $sp['anh']?>" alt="Product Image">
            </div>
            <div class="product-info">
                <h2 class="product-name"><?php echo $sp['tensp']?></h2>
                <p class="product-price">Giá : <?php echo $sp['gianiemyet']?>₫</p>
                
             

                <input name="sl_sp" id="sl_sp" type="number" value="<?=$gh['sl']?>" class="product-quantity">   
            </div>
            <div class="product-actions">
           
            <a onclick="return xoagiohang();" href="xoagh.php?masp=<?php echo $sp['masp'];?>" class="remove-product"><i class='bx bx-x'></i></a>       
            </div>
        </div>
        <?php }?>
        <div class="gh_action">
        
        <a  href="trangchu.php?page_layout=dathang" class="dathang"><i class='bx bx-check'></i>Đặt Hàng</a>
        </div>
       
    </div>
</body>

<script>
function xoagiohang(){
  var conf=confirm('Xóa sản phẩm khỏi giỏ hàng của bạn ?');
  return conf;
}

</script>