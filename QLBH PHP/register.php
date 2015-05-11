<?php
require_once './helper/Utils.php';
session_start();
if($_SESSION["IsLogin"] == 1){
    Utils::RedirectTo('index.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laptop Store</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Mobilestore Website Template | Home :: W3layouts</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"  media="all" />
        <meta name="keywords" content="Mobilestore iphone web template, Andriod web template, Smartphone web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
        <link href='http://fonts.googleapis.com/css?family=Varela+Round' rel='stylesheet' type='text/css'/>
        <link rel="stylesheet" href="css/responsiveslides.css"/>
        <link rel="stylesheet" href="css/demo.css"/>
        <link rel="stylesheet" type="text/css" href="css/style.css"/>
        <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css"/>
        <link rel="shortcut icon" href="images/favicon.ico" />
        <script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
        <script src="js/responsiveslides.min.js"></script>
        <script>
            // You can also use "$(window).load(function() {"
            $(function () {
                // Slideshow 1
                $("#slider2").responsiveSlides({
                    auto: true,
                    maxwidth: 1600,
                    speed: 600
                });
            });

        </script>
        <script>
            function changeCaptcha() {
                var path = document.getElementById("captcha");
                path.src = "captcha/captcha.php?" + Math.random();
            }
        </script>
        <script type="text/javascript">
            function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
            function Check() {
                var form = document.reg;
                if (form.txtID.value.length == 0) {
                    alert("Chưa nhập tên đăng nhập");
                    return false;
                }
                if (form.txtPassword.value.length <= 5) {
                    alert("Mật khẩu nhỏ hơn 5 ký tự");
                    return false;
                }
                if (form.txtRepeat.value != form.txtPassword.value) {
                    alert("Nhập lại Password sai");
                    return false;
                }
                if (form.txtName.value.length == 0) {
                    alert("Chưa nhập tên");
                    return false;
                }
                if (form.txtAddress.value.length == 0) {
                    alert("Chưa nhập địa chỉ");
                    return false;
                }
                if (form.txtEmail.value.length == 0) {
                    alert("Chưa nhập Email");
                    return false;
                }
                if (validateEmail(form.txtEmail.value) == false) {
                    alert("Email có định dạng không hợp lệ");
                    return false;
                }
                if (isNaN(form.txtPhone.value) == true || form.txtPhone.value.length == 0) {
                    alert("Số điện thoại không hợp lệ");
                    return false;
                }
                if (form.captchainput.value.length == 0) {
                    alert("Chưa nhập captcha");
                    return false;
                }


                return true;

            }
        </script>
        <!-- InstanceBeginEditable name="head" -->
        <link rel="stylesheet" type="text/css" href="css/register.css"/>
        <!-- InstanceEndEditable -->
    </head>
    <body>
        <!-- InstanceBeginEditable name="BodyHead" --><!-- InstanceEndEditable -->
        <?php
        require_once './entities/User.php';
        require_once './helper/Utils.php';
        $captcha = true;
        if (isset($_POST["btnDangky"])) {
            if (!empty($_REQUEST['captchainput'])) {
                if (empty($_SESSION['captcha']) || trim(strtolower($_REQUEST['captchainput'])) != $_SESSION['captcha']) {
                    $captcha = false;
                } else{
                    $captcha = true;
                }
                unset($_SESSION['captcha']);
            }
            if ($captcha == false) {
                echo "<script> alert('Capcha không hợp lệ'); </script>";
            } else {
                $username = $_POST["txtID"];
                if(User::checkUsername($username)>=1){
                    echo "<script> alert('Tên đăng nhập đã tồn tại'); </script>";
                }
                else{
                $password = $_POST["txtPassword"];
                $name = $_POST["txtName"];
                $address = $_POST["txtAddress"];
                $phone = $_POST["txtPhone"];
                $email = $_POST["txtEmail"];
                $dob=$_POST["datetimepicker2"];
                $user = new User(-1, $username, $password, $name, $email, $dob, 1, $phone, $address);
                $user->insertUser();
                Utils::RedirectTo("index.php");
                }
            }
        }
        ?>
        <div class="wrap">
            <!----start-Header---->
            <div class="image-slider">
                <!-- Slideshow 1 -->
                <ul class="rslides" id="slider2">
                    <li><img src="images/1.png" alt=""/></li>
                    <li><img src="images/2.png" alt=""/></li>
                    <li><img src="images/3.png" alt=""/></li>
                </ul>
            </div> 
            <div class="header">
                <div class="clear"> </div>
                <div class="header-top-nav">
                    <ul>
                        <?php
                    require_once './helper/Context.php';
                    require_once './helper/CartProcessing.php';

                    if (!Context::isLogged()) {
                        ?>
                        <li ><a href="register.php"><span style="color: #90c843">Đăng ký</span></a></li>
                        <li ><a href="login.php"><span style="color: #90c843">Đăng nhập</span></a></li>
                         <?php
} else {
    ?>
                        <a href="profile.php" class="cmd">Hi, <?php echo $_SESSION["CurrentUser"]["name"]; ?>!</a>
                        | 
                        <a href="logout.php" class="cmd">Thoát</a>
    <?php
}
?>
                        <li><a href="cart.php"><span>Giỏ hàng&nbsp;&nbsp;: </span></a><lable style="color: #90c843"> &nbsp;<?php echo CartProcessing::countQuantity(); ?> sản phẩm</lable></li>
                        <li><div class="search-bar">
                                <a href="search.php">Tìm kiếm chi tiết</a>
                            </div>
                        </li>
                    </ul>
                <div class="clear"> </div>
            </div>
        </div>
        <div class="clear"> </div>
        <div class="top-header">
            <div class="wrap">
                <!----start-logo---->
                <div class="logo">
                    <a href="index.html"><img src="images/logo.png" title="logo" /></a>
                </div>
                <!----end-logo---->
                <!----start-top-nav---->
                <div class="top-nav">
                    <ul>
                        <li><a href="index.php">Trang chủ</a></li>
                        <li><a href="store_2.php">Sản phẩm</a></li>
                        <li><a href="#">Thông tin thêm</a></li>
                        <li><a href="#">Liên hệ</a></li>
                    </ul>
                </div>
                <div class="clear"> </div>
            </div>
        </div>
        <div class="clear"> </div>
        <!----End-top-nav---->
        <!----End-Header---->
        <!----Body Editable---->
        <!-- InstanceBeginEditable name="Body Content" -->
        <div class="pattern" style="padding:10px">
            <div id="bg">
                <div class="module">
                    <ul>
                        <li class="tab"><img src="images/usericon.png" alt="" class="icon"/></li>
                    </ul>
                    <form method="post" class="form" id="reg" name="reg" onsubmit="return Check();">
                        <div class="content-h4"><h4 >Thông tin đăng nhập</h4></div>
                        <input type="text" placeholder="Tên đăng nhập" class="textbox" id="txtID" name="txtID" value="<?php echo isset($_POST['txtID']) ? $_POST['txtID'] : ''; ?>"/>
                        <input type="password" placeholder="Mật khẩu" class="textbox" id="txtPassword" name="txtPassword" value="<?php echo isset($_POST['txtPassword']) ? $_POST['txtPassword'] : ''; ?>"/>
                        <input type="password" placeholder="Nhập lại" class="textbox" id="txtRepeat" name="txtRepeat" value="<?php echo isset($_POST['txtRepeat']) ? $_POST['txtRepeat'] : ''; ?>"/>
                        <div class="content-h4">
                            <h4 >Thông tin cá nhân</h4>
                        </div>
                        <input type="text" placeholder="Họ tên" class="textbox" id="txtName" name="txtName" value="<?php echo isset($_POST['txtName']) ? $_POST['txtName'] : ''; ?>"/>
                        <input type="text" placeholder="Địa chỉ" class="textbox" id="txtAddress" name="txtAddress" value="<?php echo isset($_POST['txtAddress']) ? $_POST['txtAddress'] : ''; ?>"/>
                        <input type="text" placeholder="Email" class="textbox" id="txtEmail" name="txtEmail" value="<?php echo isset($_POST['txtEmail']) ? $_POST['txtEmail'] : ''; ?>"/>
                        <input type="text" placeholder="Số điện thoại" class="textbox" id="txtPhone" name="txtPhone" value="<?php echo isset($_POST['txtPhone']) ? $_POST['txtPhone'] : ''; ?>"/>
                        <input class="textbox" placeholder="Ngày sinh" type="text" id="datetimepicker2" readonly="readonly" name="datetimepicker2" value="<?php echo isset($_POST['datetimepicker2']) ? $_POST['datetimepicker2'] : ''; ?>"/>
                        <div class="content-h4">
                            <h4>Xác nhận</h4>
                        </div>
                        <img style="margin-left: 25%;cursor: pointer;"  id="captcha"  src="captcha/captcha.php" onclick="changeCaptcha();"/>
                        <input type="text" placeholder="Mã captcha" name="captchainput" id="captchainput" class="textbox" autocomplete="off" />
                        <input type="submit" value="Đăng ký" name="btnDangky" id="btnDangky" class="button" />
                    </form>
                </div>
            </div>
        </div>
        <link rel="stylesheet" type="text/css" href="css/jquery.datetimepicker.css"/>
        <script src="js/jquery.datetimepicker.js"></script>
        <script>
                            $('#datetimepicker2').datetimepicker({
                                timepicker: false,
                                format: 'Y-m-d',
                            });
        </script>
        <!-- InstanceEndEditable -->
        <!----End Body Editable---->
        <div class="footer">
            <div class="wrap">
                <div class="section group">
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">Thông tin về chúng tôi</h3>
                        <p>Thành viên trong nhóm</p>
                        <p>Huỳnh Chánh Kiệt, Nguyễn Anh Duy, Phan Thị Kim Thanh</p>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">N.A.D Systems</h3>
                       <p>Sinh viên lớp 12CK3 sử dụng template miễn phí này để thực hiện một trang web bán hàng.</p>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">Giáo viên giảng dạy</h3>
                        <p>Thầy Ngô Ngọc Đăng Khoa</p>
                         <p>Địa chỉ: 227 Nguyễn Văn Cừ, quận 5, Tp. Hồ Chí Minh</p>
                        <h3 style="color: #90c843">Đặt hàng trực tuyến</h3>
                        <p>01636-41-41-98</p>
                        <p>01636-41-41-98</p>
                    </div>
                    <div class="col_1_of_4 span_1_of_4 footer-lastgrid">
                        <h3 style="color: #90c843">Lyk Lynh</h3></br></br>
                        <h3 style="color: #90c843">Follow Us:</h3>
                        <ul>
                            <li><a href="#"><img src="images/twitter.png" title="twitter" />Twitter</a></li>
                            <li><a href="#"><img src="images/facebook.png" title="Facebook" />Facebook</a></li>
                            <li><a href="#"><img src="images/rss.png" title="Rss" />Rss</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <!-- InstanceEnd --></html>
