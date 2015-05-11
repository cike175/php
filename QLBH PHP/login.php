<?php
require_once './helper/Utils.php';
session_start();

if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
} else if($_SESSION["IsLogin"] == 1){
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
        <!-- InstanceBeginEditable name="head" -->
        <link rel="stylesheet" type="text/css" href="css/register.css"/>
        <!-- InstanceEndEditable -->
    </head>
    <body>
        <?php
			if (!isset($_SESSION['Cart'])) {
				$_SESSION['Cart'] = array();
			}
		?>
        <!-- InstanceBeginEditable name="PHP_Init" -->
<?php
        

        // Login

        require_once './entities/User.php';

        if (isset($_POST["btnDangNhap"])) {

            $uid = $_POST["txtTenDN"];
            $pwd = $_POST["txtMK"];

            $u = new User(-1, $uid, $pwd, '', '', time(), 0, '', '');
            $loginRet = $u->login();

            if ($loginRet) {
                $_SESSION["IsLogin"] = 1; // đã đăng nhập
                $_SESSION["CurrentUser"] = (array) $u;

                /*$remember = isset($_POST["chkGhiNho"]) ? true : false;
                
                if ($remember) {
                    $expire = time() + 15 * 24 * 60 * 60;
                    setcookie("UserName", $uid, $expire);
                }*/
                $t = $_SESSION["CurrentUser"]["permission"];
                if($t == 2)
                    $url = 'admin.php';
                else
                    $url = 'index.php';
                if (isset($_GET["retUrl"])) {
                    $url = $_GET["retUrl"];
                }
                
                
                Utils::RedirectTo($url);
            } else {
                echo '<script>alert ("ĐĂNG NHẬP KHÔNG THÀNH CÔNG");</script>';
            }
        }
        ?>
        <!-- InstanceBeginEditable name="BodyHead" --><!-- InstanceEndEditable -->
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
                </div>
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
                        <li><a href="about.html">Về chúng tôi</a></li>
                        <li><a href="store.php">Sản phẩm</a></li>
                        <li><a href="contact.html">Liên hệ</a></li>
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
                <div class="module" style="height:365px">
                    <ul>
                        <li class="tab"><img src="images/usericon.png" alt="" class="icon"/></li>
                    </ul>
                    <form class="form" method="post">
                        <div class="content-h4"><h4 >Thông tin đăng nhập</h4></div>
                        <input type="text" id="txtDN" name="txtTenDN" placeholder="Tên đăng nhập" class="textbox" />
                        <input type="password" id="txtMK" name="txtMK" placeholder="Mật khẩu" class="textbox" />
                        <input type="submit" id="btnDangNhap" name="btnDangNhap" value="Đăng nhập" class="button" />
                    </form>
                </div>
            </div>
        </div>
        <!-- InstanceEndEditable -->
        <!----End Body Editable---->
        <div class="footer">
            <div class="wrap">
                <div class="section group">
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">Thông tin về chúng tôi</h3>
                        <p>Sinh viên lớp 12CK3 sử dụng template miễn phí này để thực hiện một trang web bán hàng.</p>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">Giáo viên giảng dạy</h3>
                        <p>Thầy Ngô Ngọc Đăng Khoa</p>
                        <p>Thành viên trong nhóm</p>
                        <p>Huỳnh Chánh Kiệt, Nguyễn Anh Duy, Phan Thị Kim Thanh</p>
                    </div>
                    <div class="col_1_of_4 span_1_of_4">
                        <h3 style="color: #90c843">N.A.D Systems</h3>
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
