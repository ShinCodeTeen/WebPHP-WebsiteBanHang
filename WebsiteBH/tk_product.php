<?php



include './ketnoi.php';

class Sanpham{
    public $masp;
    public $tensp;
    public $giaban;
    public $gianiemyet;
    public $anh;
    public function __construct($row){
        $this->masp = $row['masp'];
        $this->tensp = $row['tensp'];
        $this->giaban = $row['giaban'];
        $this->anh = $row['anh'];
        $this->gianiemyet= $row['gianiemyet'];
    }
}
$listSP = array();
if (isset($_GET['tensp'])) {

    $Sanphamtk = $_GET['tensp'];
    $sql = "SELECT * FROM sanpham WHERE  tensp LIKE ?";
    $stmt = $conn->prepare($sql);
    $param = $Sanphamtk . '%'; // Thêm ký tự '%' vào cuối để tìm kiếm bắt đầu bằng Sanphamtk
    $stmt->bind_param("s", $param);
    $stmt->execute();
    $query = $stmt->get_result();
    while ($row = $query->fetch_assoc()) {
        $listSP[] = new Sanpham($row); 
    }
    foreach($listSP as $sp) {
      // Đổ dữ liệu vào form HTML
      echo '<div class="product">';
      echo '<div class="product-img">'; 
      echo '<img src="./img/' . $sp->anh . '" alt="">';
      echo '</div>';
      echo '<div class="product-body">';
      echo '<h3 class="product-name"><a href="#">' . $sp->tensp . '</a></h3>';
      echo '<h4 class="product-price">' . $sp->gianiemyet . '₫ <del class="product-old-price">' . $sp->giaban . '₫</del></h4>';
      echo '</div>';
      echo '<div class="product-btns btn_sp">';
      echo '<a class="quick-view a_sp" href="trangchu.php?page_layout=xemsp&masp='.$sp->masp.'">';
      echo '<i class="bx bxs-zoom-in"></i>';
      echo '<span class="tooltipp">Xem thêm</span>';
      echo '</a>';
      echo '</div>';
      echo '<div class="add-to-cart btn_sp">';
      echo '<a class="add-to-cart-btn a_sp" href="themgiohang.php?masp='.$sp->masp.'">';
      echo '<i class="bx bxs-cart-add"></i>';
      echo '<span class="tooltipp">Thêm vào giỏ</span>';
      echo '</a>';
      echo '</div>';
      echo '</div>';
    }
 

  // Đảm bảo rằng kết nối cơ sở dữ liệu được đóng sau khi hoàn thành
}

?>