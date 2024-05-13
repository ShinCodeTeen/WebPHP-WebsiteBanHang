<?php 
    $madm =$_GET['madm'];

    $sqlsp = "SELECT * FROM `sanpham` WHERE `madm` = '$madm'";
    $getsp = mysqli_query($conn, $sqlsp);

    $getthsp="SELECT * FROM `dm_thuonghieu` WHERE `madm` ='$madm'";
    $getthuonghieu = mysqli_query($conn, $getthsp);
    $mang_th = [];

while ($rowdata = mysqli_fetch_assoc($getthuonghieu)) {
    $th = new ThuongHieu($rowdata);
    $mang_th[] = $th;
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NamDuong - ShopWeb</title>
    <link type="text/css" rel="stylesheet" href="store.css" />
</head>
<body>
<div class="header-search">
        <h3>Hot Deals</h3>
            <form>
                                
                <input name="tensp" id="inp_tensp" placeholder="Nhập tên sản phẩm...">
                
            </form>
        </div>


    <div class="container">
        
    <form>

        <div class="thuonghieu">
            <h3 class="aside-title">Thương Hiệu</h3>
                <?php foreach($mang_th as $th){ ?>
                    <div class="checkbox-filter">
                    <input type="checkbox" name="options[]" value="<?php echo $th->math; ?>">
                        <div class="input-checkbox">
                            <label for="brand-1">
						        <label><?php echo $th->tenth; ?></label>
						       
						    </label>
                        </div>
                    </div>
                <?php }?>
                    
        </div>
        </form>
        <div class="sanpham">
        
            <?php while ($sp = mysqli_fetch_array($getsp)){ ?>
                <div class="product">
                    <div class="product-img">
                        <img src="./img/<?php echo $sp['anh'];?>" alt="">  
                    </div>
                    <div class="product-body">
                        <h3 class="product-name"><a href="#"><?php echo $sp['tensp'];?></a></h3>
                        <h4 class="product-price"><?php echo $sp['gianiemyet'];?>₫ <del class="product-old-price"><?php echo $sp['giaban'];?>₫</del></h4>
                      
                    </div>
                    
                        <div class="product-btns btn_sp">

                            <a class="quick-view a_sp" href="trangchu.php?page_layout=xemsp&masp=<?=$sp['masp']?>">
                            <i class='bx bxs-zoom-in' ></i>
                                <span class="tooltipp">Xem thêm</span>
                            </a>
                        </div>
                        <div class="add-to-cart btn_sp">
                            <a class="add-to-cart-btn a_sp" href="themgiohang.php?masp=<?=$sp['masp'];?>">
                                <i class='bx bxs-cart-add'></i>
                                <span class="tooltipp">Thêm vào giỏ</span>
                            </a>
                        </div>
                    
                    
               
                </div>
               
            <?php }?>
          
        </div>
    </div>
        
</body>

</html>
<script>
  var checkboxes = document.querySelectorAll('.checkbox-filter input[type="checkbox"]');
  checkboxes.forEach(function(checkbox) {
    checkbox.addEventListener('change', function() {
      var selectedOptions = Array.from(checkboxes)
        .filter(function(checkbox) {
          return checkbox.checked;
        })
        .map(function(checkbox) {
          return checkbox.value;
        });

      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Xử lý phản hồi từ máy chủ
          document.querySelector('.sanpham').innerHTML = xhr.responseText;
        }
      };
      xhr.open('GET', 'get_product.php?options=' + encodeURIComponent(selectedOptions.join(',')), true);
      xhr.send();
    });
  });

  var inp_tensp = document.getElementById('inp_tensp');
inp_tensp.addEventListener('input', function() {
    var tensp = inp_tensp.value;
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            // Xử lý phản hồi từ máy chủ
            document.querySelector('.sanpham').innerHTML = xhr.responseText;
        }
    };
    xhr.open('GET', 'tk_product.php?tensp=' + encodeURIComponent(tensp), true);
    xhr.send();
});
</script>