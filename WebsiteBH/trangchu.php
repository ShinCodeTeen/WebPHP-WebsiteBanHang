
<?php 
ob_start();
session_start();
include_once './ketnoi.php';
include_once './allClass.php';
if(!$_SESSION['username']){
    header("Location:Login.php");
}

$makh= $_SESSION['makhachhang'];
$sqlkh="SELECT * FROM account_customer where makh='$makh'";
$getkh=mysqli_query($conn,$sqlkh);
$kh=mysqli_fetch_array($getkh);
$sqldm="SELECT * FROM `dm_sanpham`";
$getdm = mysqli_query($conn, $sqldm);

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NamDuong-ShopWeb</title>
    
    <link rel="stylesheet" href="Trangchu.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <header>
        <div id="top-header">
            <div class="container">
                <ul class="header-links pull-left">
                    <li><a href="#"><i class='bx bxs-phone' ></i>+84 326-831-447</a></li>
                    <li><a href="#"><i class='bx bxl-gmail' ></i> namduongstore@gmail.com</a></li>
                    <li><a href="#"><i class='bx bx-map-pin'></i> Vinh Yen - Vinh Phuc</a></li>
                </ul>
                <ul class="header-links pull-right">
                    <li><a href="trangchu.php?page_layout=ac"><i class='bx bx-user-circle' ></i><?php echo $kh['ten'];?></a></li>
                    <li><a href="logout.php" onclick="return logout();"> <i class='bx bx-log-out' ></i> Log out</a></li>
                </ul>
            </div>
        </div>
        <div id="header">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="header-logo">
                            <a href="#" class="logo">
                                <p>NamDuong.Store</p>
                            </a>
                        </div>
                    </div>
                    
                   

                    <div class="cart">
                        <a href="trangchu.php?page_layout=giohang">
                            <i class='bx bx-cart' ></i>
                        <p>Giỏ Hàng</p></a>
                    </div>
               
                </div>
             
            </div>
      
        </div>
    
    </header>


    <nav id="navigation">
            <div id="responsive-nav">
                <ul class="main-nav nav navbar-nav">
                    <li class="active"><a href="trangchu.php?page_out=home">Home</a></li>
                    <?php 
                    while ($dm =mysqli_fetch_array($getdm)){ ?>
                    <li><a href="trangchu.php?page_layout=storedm&madm=<?=$dm['madm']; ?>"><?php echo $dm['tendm']?></a></li>

                    <?php }?>
                </ul>
            </div>    
    </nav>

    <?php 
    if(isset($_GET['page_layout'])){
        switch ($_GET['page_layout']) {
            case 'home':
                include_once'./store.php';
                break;
            case 'dathang':
                    include_once'./dathang.php';
                    break;
            case 'thongtinsp':
                include_once'./sanpham.php';
                break;

            case 'giohang':
                include_once'./giohang.php';
                break;
            case 'storedm':
                include_once'./sanphamdm.php';
                break;
            case 'sanphamtk':
                    include_once'./sanphamtk.php';
                break;
            case 'xemsp':
                    include_once'./xemsp.php';
                break;
            
            case 'ac':
                    include_once'./customAC.php';
                break;
            case 'logout':
                    include_once'./logout.php';
                break;
        }
    }
    else{
        include_once'./store.php';
    }
    ?>

    <footer id="footer">
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="footer">
                        <h3 class="footer-title">About Us</h3>
                        <p>Cửa hàng Nam Dương thành lập năm 2022 với đa dạng mặt hàng và các thương hiệu nổi tiếng. Sản phẩm chính hãng, uy tín, bảo hành, hỗ trợ 24/24</p>
                        <ul class="footer-links">
                        <li><a href="#"><i class='bx bxs-phone' ></i>+84 326-831-447</a></li>
                    <li><a href="#"><i class='bx bxl-gmail' ></i> namduongstore@gmail.com</a></li>
                    <li><a href="#"><i class='bx bx-map-pin'></i> Vinh Yen - Vinh Phuc</a></li>
                        </ul>
                    </div>
             


                    <div class="footer">
                        <h3 class="footer-title">Danh Mục</h3>
                        <ul class="footer-links">
                            <li><a href="#">Điện thoại</a></li>
                            <li><a href="#">Máy tính</a></li>
                            <li><a href="#">Phụ Kiện</a></li>
                          
                        </ul>
                    </div>
               

                 
                    <div class="footer">
                        <h3 class="footer-title">Information</h3>
                        <ul class="footer-links">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Orders and Returns</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                 

                
                    <div class="footer">
                        <h3 class="footer-title">Service</h3>
                        <ul class="footer-links">
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
                            </ul>
                    </div>
                    
                </div>  
      
           
            </div>
        </div>
    </footer>
<script>
    function logout(){
        var conf=confirm('Đăng xuất tài khoản của bạn?');
        return conf;
    }
</script>