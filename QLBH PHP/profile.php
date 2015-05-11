<?php
session_start();
require_once './helper/Utils.php';
if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
    Utils::RedirectTo('login.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laptop Store</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bán laptop | Thông tin cá nhân :: Laptop uy tín</title>
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
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <script type="text/javascript" src="js/domtab.js"></script>
        <link rel="stylesheet" type="text/css" href="css/domtab.css"/>
        <!-- InstanceEndEditable -->
    </head>
    <body>
        <?php
        require_once './entities/User.php';
        if (!isset($_SESSION['Cart'])) {
            $_SESSION['Cart'] = array();
            }
            $username = $_SESSION["CurrentUser"]["username"];
            $_SESSION['CurrentUser'] = (array) User::getInfo($username);
        
        ?>
        <!-- 
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
                        <li><a href="store_2.php">Sản phẩm</a></li>
                        <li><a href="#">Thông tin thêm</a></li>
                       <?php
                       $t = $_SESSION["CurrentUser"]["permission"];
  
                        if ($t == 2) {
                       ?> 
                        <li><a href="admin.php">Admin</a></li>
                        <?php  } else { ?>
                        <li><a href="#">Liên hệ</a></li>
                        <?php } ?>
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
        <form action="updateProfile.php" method="post" name="frmProfile" id="frmProfile">
            <div class="domtab">
                <ul class="domtabs">
                    <li><a href="#t1"><i class="fa fa-user fa-2x"></i><br/>Thông tin</a></li>
                    <li><a href="#t2"><i class="fa fa-exclamation-triangle  fa-2x"></i><br/>Đổi mật khẩu</a></li>
                </ul>
                <div>
                    <p>
                 <?php
                 $username = $_SESSION["CurrentUser"]["username"];

    $name = $_SESSION["CurrentUser"]["name"];
    $email = $_SESSION["CurrentUser"]["email"];
    $address = $_SESSION["CurrentUser"]["address"];
    $phone = $_SESSION["CurrentUser"]["phone"];
    $dob = $_SESSION["CurrentUser"]["dob"];
    $dob = strtotime($dob);
    $newformat = date('Y-m-d',$dob);
?>       
                        <h2><a name="t1" id="t1">Tên đăng nhập</a></h2>
                        <input class="text uneditable" name="txtUsername" id="txtUsername" type="text" readonly="readonly" value="<?php echo $username; ?>"/>
                        <h2><a name="t1" id="t1">Họ tên</a></h2>
                        <input class = "text" name="txtName" id="txtName" type="text" value="<?php echo $name; ?>"/>
                        <h2><a name="t1" id="t1">Email</a></h2>
                        <input class = "text" name="txtEmail" id="txtEmail" type="text" value="<?php echo $email ?>"/>
                        <h2><a name="t1" id="t1">Địa chỉ</a></h2>
                        <input class = "text" name="txtAddress" id="txtAddress" type="text" value="<?php echo $address; ?>"/>
                        <h2><a name="t1" id="t1">Số điện thoại</a></h2>
                        <input class = "text" name="txtPhone" id="txtPhone" type="text" value="<?php echo $phone; ?>"/>
                        <h2><a name="t1" id="t1">Ngày sinh</a></h2>
                        <input class="text" type="text" id="datetimepicker2" readonly="readonly" name="datetimepicker2" value="<?php echo $newformat; ?>"/>
                        <input class = "btn2" type="submit" name="btnChangeInfo" id="btnChangeInfo" value="Thay đổi"/>
                    </p>
                </div>
                <div>
                    <p>
                        <h2><a name="t2" id="t2">Mật khẩu cũ</a></h2>
                        <input class = "text" name="txtPassold" id="txtPassold" type="password" />
                        <h2><a name="t2" id="t2">Mật khẩu mới</a></h2>
                        <input class = "text" name="txtPassnew" id="txtPassnew" type="password" />
                        <h2><a name="t2" id="t2">Nhập lại</a></h2>
                        <input class = "text" name="txtRetype" id="txtRetype" type="password" />
                        
                        <input class = "btn2" type="submit" name="btnChangePass" id="btnChangePass" value="Thay đổi"/>
                    </p>
                </div>
            </div>
        </form>
        <div class="clear"> </div>
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
