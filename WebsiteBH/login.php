<?php
    ob_start();
    session_start();
    include_once './ketnoi.php';

    if (isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra tên người dùng và mật khẩu
        $sql = "SELECT * FROM account_customer WHERE username='$username' AND password='$password'";
        $query = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($query);
        $acc = mysqli_fetch_assoc($query);
        if ($rows > 0) {
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            $_SESSION['makhachhang'] = $acc['makh'];
            echo '<script>';
            echo 'alert("Đăng nhập thành công!");';
            echo 'window.location.href = "trangchu.php";'; // Chuyển hướng đến trang khác
            echo '</script>';
        } else {
            echo '<script>';
            echo 'alert("Tên đăng nhập hoặc mật khẩu không đúng!");';
            echo '</script>';
        }
    }

    if(isset($_POST['signup'])) {
        $username = $_POST['newusername'];
        $password = $_POST['newpassword'];
        $ten = $_POST['ten'];
        $sdt = $_POST['sdt'];
        $diachi = $_POST['diachi'];

        $sql = "INSERT INTO `account_customer`(`username`, `password`, `ten`, `sdt`, `diachi`) VALUES ('$username','$password','$ten','$sdt','$diachi')";
        $query = mysqli_query($conn, $sql);
        $affectedRows = mysqli_affected_rows($conn);
        if($affectedRows>0){
        echo '<script>';
            echo 'alert("Đăng kí thành công!");';
            echo 'window.location.href = "login.php";';
            echo '</script>';
        }
        else{
            echo '<script>';
            echo 'alert("Dữ liệu bạn nhập bị trùng hoặc không đúng!");';
            echo '</script>';
        }
    }
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="login.css">
    <title>Login | NamDuongStore</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form method="post">
                <h1>Create Account</h1>
                <input type="text" name="ten" placeholder="Nhập tên của bạn">
                <input type="text" name="sdt" placeholder="Nhập số điện thoại">
                <input type="text" name="diachi" placeholder="Nhập địa chỉ">
                <input type="text" name="newusername" placeholder="Username">
                <input type="password" name="newpassword" placeholder="Password">
                <button name="signup" > Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form method="post">
                <h1>Sign In</h1>

                <input type="text" name="username" placeholder="Username">
                <input type="password" name="password" placeholder="Password">
                <a href="#">Forget Your Password?</a>
                <button type="submit" name="login">Sign In</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Bạn đã có tài khoản mua sắm ? Đăng nhập vào tài khoản của bạn !!</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Friend!</h1>
                    <p>Bạn chưa có tài khoản của mình? Hãy tạo tài khoản mua sắm của bạn !!</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>


</body>
<script>
    const container = document.getElementById('container');
    const registerBtn = document.getElementById('register');
    const loginBtn = document.getElementById('login');

    registerBtn.addEventListener('click', () => {
        container.classList.add("active");
    });

    loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
    });
</script>

</html>