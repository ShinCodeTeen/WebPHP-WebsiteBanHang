
<?php
     if (isset($_POST['dathang'])) {
        
        $tennguoinhan = $_POST['tennguoinhan'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];
        $ghichu = $_POST['ghichu'];
        
        $inserthoadon = "INSERT INTO `hoadon`( `makh`) VALUES ('$makh')";
        $ishd = mysqli_query($conn, $inserthoadon);
        $sqlmahd = "SELECT MAX(id) AS maxid FROM hoadon WHERE makh =$makh";
        $getmahd = mysqli_query($conn, $sqlmahd);
        $mahds= mysqli_fetch_array($getmahd);
        $mahd = $mahds['maxid'];
        $sqltt="SELECT SUM(sp.gianiemyet*gh.sl) as tongtien
        FROM sanpham sp
        JOIN giohang gh on gh.masp = sp.masp
        AND gh.userid =$makh";
        $gettt = mysqli_query($conn, $sqltt);
        $ghkh = "SELECT * FROM `giohang` where userid ='$makh'";
        $getghkh = mysqli_query($conn, $ghkh);
        while($giohang = mysqli_fetch_array($getghkh)){
            $masp = $giohang['masp'];
            $sl = $giohang['sl'];

            $themdh = "INSERT INTO `donhang`( `mahd`, `masp`, `sl`) VALUES ('$mahd','$masp','$sl')";
            $themdonhang = mysqli_query($conn, $themdh);

            $deletgh = "DELETE FROM `giohang` WHERE userid = '$makh' AND masp = '$masp'";
            $delet = mysqli_query($conn, $deletgh);

            
        }
        
        $tt = mysqli_fetch_array($gettt);
        $tongsotien = $tt['tongtien'];
      
        $sqldongiao="INSERT INTO `dongiao`(`mahd`, `tennguoinhan`, `sdt`, `diachi`, `ghichu`, `tongtien`) VALUES ('$mahd','$tennguoinhan','$sdt','$diachi','$ghichu','$tongsotien')";
        $themdongiao = mysqli_query($conn, $sqldongiao);
        $affectedRows = mysqli_affected_rows($conn);
        if($affectedRows>0){
        echo '<script>';
            echo 'alert("Đặt hàng thành công!");';
            echo 'window.location.href = "trangchu.php?page_layout=home";';
            echo '</script>';
        }
        else{
            echo '<script>';
            echo 'alert("Vui lòng thao tác lại!!");';
            echo '</script>';
        } 
      
    
    
    }
 

     
    


    $sqlgh = "SELECT * FROM `giohang` where userid ='$makh'";
    $getgh = mysqli_query($conn, $sqlgh);
    $sqltt="SELECT SUM(sp.gianiemyet*gh.sl) as tongtien
    FROM sanpham sp
    JOIN giohang gh on gh.masp = sp.masp
    AND gh.userid =$makh";
     $gettt = mysqli_query($conn, $sqltt);
     $tt = mysqli_fetch_array($gettt);
    
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Đặt hàng</title>
    <link type="text/css" rel="stylesheet" href="dathang.css" />
</head>
<body>
    <div class="container">
        <div class="donhang_inf">
        <?php while ($gh = mysqli_fetch_array($getgh)){ 
                $masp = $gh['masp'];
                $sqlsp = "SELECT * FROM `sanpham` WHERE masp = '$masp'";
                $getsp = mysqli_query($conn,$sqlsp);
                $sp = mysqli_fetch_array($getsp);        ?>
            <div class="product">
                <div class="product-img">
                    <img src="./img/<?=$sp['anh']?>" alt="Product 1">
                </div>
                <div class="product-info">
                    <div class="in_sp">
                    <h3 class="product-name"><?=$sp['tensp']?></h3>
                    <p class="product-price"><?=$sp['gianiemyet']?>đ</p>
                    </div>
                   
                    <p class="product-count">x<?=$gh['sl']?></p>
                </div>
            </div>
            <?php } ?>
          <div class="tong_tien">
            <h3>Tổng Tiền:</h3>
            <p><?=$tt['tongtien']?>đ</p>
          </div>
        </div>

        <div class="giaohang_inf">
            <h2>Thông tin giao hàng</h2>
            <form method="post">
                <div>
                    <label for="name">Họ và tên:</label>
                    <input type="text" id="name" name="tennguoinhan" placeholder="Nhập tên người nhận..."required>
                </div>
                <div>
                    <label for="address">Địa chỉ:</label>
                    <input type="text" id="address" name="diachi"placeholder="Nhập địa chỉ người nhận..." required>
                </div>
                <div>
                    <label for="phone">Số điện thoại:</label>
                    <input type="tel" id="phone" name="sdt" placeholder="Nhập số điện thoại người nhận..."required>
                </div>
                
                <div>
                    <label for="notes">Ghi chú:</label>
                    <textarea id="notes" name="ghichu"placeholder="Ghi chú..."></textarea>
                </div>
                <button type="submit" name="dathang">Đặt hàng</button>
            </form>
        </div>
    </div>
</body>
</html>