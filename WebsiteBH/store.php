<?php 
    if(isset($_POST['tensp'])){
        $tensp = $_POST['tensp'];
        $sqlsp = "SELECT * FROM `sanpham` WHERE `tensp` Like '$tensp%'";
        $getsp = mysqli_query($conn, $sqlsp);
    }
    else{
    $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] :24;
    $current_page=!empty($_GET['page']) ? $_GET['page'] :1;
    $offset= ($current_page -1) *$item_per_page;


    $sqlsp = "SELECT * FROM `sanpham` ORDER BY tensp LIMIT ".$item_per_page." OFFSET ".$offset;
    $getsp = mysqli_query($conn, $sqlsp);

    $total_sp =mysqli_query($conn,"SELECT * FROM `sanpham`");
    $total_sp = $total_sp->num_rows;
    $total_page =ceil($total_sp/$item_per_page);
    }

    $getth="SELECT * FROM `dm_thuonghieu`";
    $getnsx = mysqli_query($conn, $getth);
    $mang_nsx = [];

    while ($rowdata = mysqli_fetch_assoc($getnsx)) {
    $nsx = new ThuongHieu($rowdata);
    $mang_nsx[] = $nsx;
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
                <?php foreach($mang_nsx as $th){ ?>
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
            <?php include_once './page_product.php' ?>
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