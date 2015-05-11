<?php
session_start();

if (!isset($_SESSION["IsLogin"])) {
    $_SESSION["IsLogin"] = 0; // chưa đăng nhập
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/frontend.dwt.php" codeOutsideHTMLIsLocked="false" -->
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Laptop Store</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Bán laptop | Trang chủ :: Laptop uy tín</title>
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
        <link rel="stylesheet" type="text/css" href="css/smoothzoom.css"/>
        <script>
            $(document).ready(function () {
                $(".menu_body").hide();
                //toggle the componenet with class menu_body
                $(".menu_head").click(function () {
                    $(this).next(".menu_body").slideToggle(600);
                    var plusmin;
                    plusmin = $(this).children(".plusminus").text();
                    if (plusmin == '+')
                        $(this).children(".plusminus").text('-');
                    else
                        $(this).children(".plusminus").text('+');
                });
            });
        </script>
        <!-- InstanceEndEditable -->
    </head>
    <body>
        
        <?php
			if (!isset($_SESSION['Cart'])) {
				$_SESSION['Cart'] = array();
			}
		?>
        <?php
                require_once './helper/Utils.php';
            if(isset($_GET["proID"])) {
                $_id = $_GET["proID"];
            } else
                Utils::RedirectTo("index.php");  
        ?>
        <?php
        require_once './helper/CartProcessing.php';
       // require_once './helper/Utils.php';
        // đặt hàng

        if (isset($_POST["btnDatHang"])) {
            $masp = $_POST["proid"];
            $solg = 1;
            CartProcessing::addItem($masp, $solg);
        }
        ?>
        <?php
require_once './entities/Product.php';
require_once './entities/Manufacturer.php';
require_once './entities/Category.php';
Product::View($_id);
$pro = Product::loadByProId($_id);
$manu = Manufacturer::loadNameById($pro->getManuID());
$cat = Category::loadNameById($pro->getCatID());
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
                        <li><a href="store.php">Sản phẩm</a></li>
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
        <div class="clear"> </div>
        <div class="wrap">
            <div class="content">
                <div class="content-grids">
                    <div class="details-page">
                        <div class="back-links">
                            <ul>
                                <li><a href="index.php">Trang chủ</a><img src="images/arrow.png" alt=""></li>
                                <li><a href="#">Chi tiết sản phẩm</a><img src="images/arrow.png" alt=""></li>
                                <li><a href="#"><?php echo $pro->getProName(); ?></a></li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="detalis-image">
                        <img src="images/products/<?php echo $pro->getProID(); ?>/image.jpg"  rel="zoom"/>
                       
                    </div>
                    <div class="detalis-image-details">
                        <br />
                        <div class="brand-value">
                            <h3><?php echo $pro->getProName(); ?></h3>
                            <div class="left-value-details">
                                <ul>
                                    <li>Giá tiền:</li>
                                    <li><span><?php  echo $pro->getNewPrice(); ?></span></li>
                                    <li><h5><?php echo $pro->getOldPrice(); ?></h5></li>
                                    <br />
                                    <li><p>.</p></li>
                                    <br />
                                    <li><p>Lượt xem: <?php echo $pro->getView(); ?></p></li>
                                    <br />
                                    <li><p>Số lượng: <?php echo $pro->getQuantity(); ?></p></li>
                                </ul>
                            </div>
                            <div class="right-value-details">
                                <a href="#"></a>
                                <p></p>
                            </div>

                        </div>
                        <div class="details-categories">
                            <ul>
                                <li><h3>Dòng sản phẩm:</h3></li>
                                <li class="active1"><a href="store_2.php?catID=<?php echo $pro->getCatID(); ?>"><span><?php echo $cat; ?></span></a></li><br/>
                                <li><h3>Nhà sản xuất:</h3></li>
                                <li class="active1"><a href="store_2.php?manuID=<?php echo $pro->getManuID(); ?>"><span><?php echo $manu; ?></span></a></li>
                            </ul>
                        </div>
                        <div class="clear"> </div>
                        <div class="brand-history">
                            <p>
                                <h3>Xuất xứ :</h3>
                                <p>Việt Nam</p>
                            </p>
                            <?php
        if (Context::isLogged()) {
            
            ?>         <form method="post" action=""> 
                <input class = "text" name="proid" id="proid" type="text" value="<?php echo $pro->getProID(); ?>" style="visibility:hidden; width: 1%" />
                                    <button  type="none" class="cart-button" id="btnDatHang" name="btnDatHang" onclick="add();">Đặt Hàng</button>
                                    </form>
                                        <?php } ?> 
                        </div>
                        <div class="clear"> </div>
                    </div>
                    <div class="clear"> </div>
                    <div class="menu_container">
                        <p class="menu_head"/>Mô tả chi tiết<span class="plusminus">+</span></p>
                        <div class="menu_body" style="display: none;">
                            <p><?php echo $pro->getFullDes(); ?></p>
                        </div>
                        <p class="menu_head">Thông tin sản phẩm<span class="plusminus">+</span></p>
                        <div class="menu_body" style="display: none;">
                            <p><?php echo $pro->getProName(); ?></br><?php echo $pro->getSortDes(); ?></p>
                        </div>
                    </div>
                </div>
                <div class="content-sidebar">
                <h4 >Loại sản phẩm</h4>
                <ul>
                    <?php
                    require_once './entities/Category.php';

                    $nsx = Category::loadAll();
                    for ($i = 0, $n = count($nsx); $i < $n; $i++) {
                        $name = $nsx[$i]->getCatName();
                        $id = $nsx[$i]->getCatId();
                        ?>                        
                        <li><a href="store_2.php?catID=<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php } ?>
                </ul>
                <h4 >Nhà sản xuất</h4>
                <ul>
                    <?php
                    require_once './entities/Manufacturer.php';

                    $nsx = Manufacturer::loadAll();
                    for ($i = 0, $n = count($nsx); $i < $n; $i++) {
                        $name = $nsx[$i]->getCatName();
                        $id = $nsx[$i]->getCatId();
                        ?>                        
                        <li><a href="store_2.php?manuID=<?php echo $id; ?>"><?php echo $name; ?></a></li>
                    <?php } ?>
                </ul>
                
            </div>
                <div class="content-grids">
                    <h4>Sản phẩm cùng loại</h4>
                    
                    <div class="section group">
                        <?php
                        require_once './entities/Product.php';
                    $ds = Product::load5Cate($pro->getCatID());
for ($z = 0, $n1 = count($ds); $z < $n1; $z++) {
    ?>
                        <div class="grid_1_of_4 images_1_of_4 products-info" style="height:280px;">
                            <img src="images/products/<?php echo $ds[$z]->getProID(); ?>/image.jpg" />
                            <a href="single.php?proID=<?php echo $ds[$z]->getProID(); ?>"><?php echo $ds[$z]->getProName(); ?></a>
                            <h3><?php echo $ds[$z]->getNewPrice(); ?></h3>
                        </div>
                    
   <?php } ?>       
                        </div>
                    <h4>Sản phẩm cùng nhà sản xuất</h4>
                    <div class="section group">
                        <?php
                        require_once './entities/Product.php';
                    $ds2 = Product::load5NSX($pro->getManuID());
for ($x = 0, $n2 = count($ds2); $x < $n2; $x++) {
    ?>
                        <div class="grid_1_of_4 images_1_of_4 products-info" style="height:280px;" >
                            <img src="images/products/<?php echo $ds2[$x]->getProID(); ?>/image.jpg"/>
                            <a href="single.php?proID=<?php echo $ds2[$x]->getProID(); ?>"><?php echo $ds2[$x]->getProName(); ?></a>
                            <h3><?php echo $ds2[$x]->getNewPrice(); ?></h3>
                        </div>
                    
   <?php } ?>       
                        </div>
                </div>
            </div>
        </div>
        <div class="clear"> </div>
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
        <script type="text/javascript" src="js/easing.js"></script>
	<script type="text/javascript" src="js/smoothzoom.min.js"></script>
        <script type="text/javascript">
		 $(window).load( function() {
		 $('img').smoothZoom({
        	// Options go here
        		});
		 });
	</script>
    </body>
<!-- InstanceEnd --></html>
