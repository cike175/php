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
        <!--(document).ready-->

                            <!--<script type="text/javascript" src="js/jquery-1.3.2.js"></script>-->
        <script type="text/javascript" src="js/jquery.livequery.js"></script>
        <link href="css/style1.css" rel="stylesheet" />
        <script type="text/javascript">
            $(document).ready(function () {
                var Arrays = new Array();
                $('.add-to-cart-button').click(function () {
                    var thisID = $(this).parent().parent().attr('id').replace('detail-', '');
                    var itemname = $(this).parent().find('.item_name').html();
                    var itemprice = $(this).parent().find('.price').html();
                    if (include(Arrays, thisID))
                    {
                        var price = $('#each-' + thisID).children(".shopp-price").find('em').html();
                        var quantity = $('#each-' + thisID).children(".shopp-quantity").html();
                        quantity = parseInt(quantity) + parseInt(1);
                        var total = parseInt(itemprice) * parseInt(quantity);
                        $('#each-' + thisID).children(".shopp-price").find('em').html(total);
                        $('#each-' + thisID).children(".shopp-quantity").html(quantity);
                        var prev_charges = $('.cart-total span').html();
                        prev_charges = parseInt(prev_charges) - parseInt(price);
                        prev_charges = parseInt(prev_charges) + parseInt(total);
                        $('.cart-total span').html(prev_charges);
                        $('#total-hidden-charges').val(prev_charges);
                    }
                    else
                    {
                        Arrays.push(thisID);
                        var prev_charges = $('.cart-total span').html();
                        prev_charges = parseInt(prev_charges) + parseInt(itemprice);
                        $('.cart-total span').html(prev_charges);
                        $('#total-hidden-charges').val(prev_charges);
                        var Height = $('#cart_wrapper').height();
                        $('#cart_wrapper').css({height: Height + parseInt(45)});
                        $('#cart_wrapper .cart-info').append('<div class="shopp" id="each-' + thisID + '"><div class="label">' + itemname + '</div><div class="shopp-price"> $<em>' + itemprice + '</em></div><span class="shopp-quantity">1</span><img src="images/remove.png" class="remove" /><br class="all" /></div>');
                    }
                });
                $('.remove').livequery('click', function () {
                    var deduct = $(this).parent().children(".shopp-price").find('em').html();
                    var prev_charges = $('.cart-total span').html();
                    var thisID = $(this).parent().attr('id').replace('each-', '');
                    var pos = getpos(Arrays, thisID);
                    Arrays.splice(pos, 1, "0")
                    prev_charges = parseInt(prev_charges) - parseInt(deduct);
                    $('.cart-total span').html(prev_charges);
                    $('#total-hidden-charges').val(prev_charges);
                    $(this).parent().remove();
                });
                $('#Submit').livequery('click', function () {
                    var totalCharge = $('#total-hidden-charges').val();
                    $('#cart_wrapper').html('Total Charges: $' + totalCharge);
                    return false;
                });
                // this is for 2nd row's li offset from top. It means how much offset you want to give them with animation
                var single_li_offset = 600;
                var current_opened_box = -1;
                $('#wrap li').click(function () {
                    var thisID = $(this).attr('id');
                    var $this = $(this);
                    var id = $('#wrap li').index($this);
                    if (current_opened_box == id) // if user click a opened box li again you close the box and return back
                    {
                        $('#wrap .detail-view').slideUp('slow');
                        return false;
                    }
                    $('#cart_wrapper').slideUp('slow');
                    $('#wrap .detail-view').slideUp('slow');
                    // save this id. so if user click a opened box li again you close the box.
                    current_opened_box = id;
                    var targetOffset = 0;
                    // below conditions assumes that there are four li in one row and total rows are 4. How ever if you want to increase the rows you have to increase else-if conditions and if you want to increase li in one row, then you have to increment all value below. (if(id<=3)), if(id<=7) etc
                    if (id <= 3)
                        targetOffset = 600;
                    else if (id <= 7)
                        targetOffset = single_li_offset + 400;
                    else if (id <= 11)
                        targetOffset = single_li_offset * 2 + 300;
                    else if (id <= 15)
                        targetOffset = single_li_offset * 3 + 200;
                    $("html:not(:animated),body:not(:animated)").animate({scrollTop: targetOffset}, 800, function () {
                        $('#wrap #detail-' + thisID).slideDown(500);
                        return false;
                    });
                });
                $('.close a').click(function () {
                    $('#wrap .detail-view').slideUp('slow');
                });
                $('.closeCart').click(function () {
                    $('#cart_wrapper').slideUp();
                });
                $('#show_cart').click(function () {
                    $('#cart_wrapper').slideToggle('slow');
                });
            });
            function include(arr, obj) {
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i] == obj)
                        return true;
                }
            }
            function getpos(arr, obj) {
                for (var i = 0; i < arr.length; i++) {
                    if (arr[i] == obj)
                        return i;
                }
            }
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
            if(isset($_GET["catID"])) {
                $_manu = $_GET["catID"];
            } else
                Utils::RedirectTo("index.php");
            
            
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
        <!-- InstanceBeginEditable name="Body Content" --><div class="clear"> </div>
        <div class="wrap">
            <div class="content">
                <div class="content-grids">
                    <div align="left" style="min-height:800px;">
                        <div id="cart_wrapper" align="center">
                            <form action="#" id="cart_form" name="cart_form">
                                <div class="cart-info"> </div>
                                <div class="cart-total" style="">
                                    <b style="color: #90c843">Tổng giá trị:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <span style="color: #90c843">$0</span>
                                    <input type="hidden" name="total-hidden-charges" id="total-hidden-charges" style="color: #90c843" value="0" />
                                </div>
                                <button type="submit" id="Submit" style="color: #90c843">Kiểm tra</button>
                            </form>
                        </div>
                        <div id="wrap" align="center">
                            <a id="show_cart" href="javascript:void(0)">Xem giỏ hàng của tôi</a>
                            <ul>
                                <?php
require_once './entities/Product.php';

$list = Product::loadById($_manu);
$n = count($list);
if($n == 0) { ?></br></br></br><?php echo "Không có sản phẩm"; }
else {
for ($i = 0; $i < $n; $i++) {
    $name = $list[$i]->getProName();
    $id = $list[$i]->getProId();
    $longDes = $list[$i]->getFullDes();
    $price = $list[$i]->getNewPrice();
    ?>
                                <li id="<?php echo $id; ?>">
                                    <img src="images/products/<?php echo $id; ?>/image.jpg" class="items" alt="" width="200" height="285"/>
                                    <br clear="all" />
                                    <div style="color: #90c843"><?php echo $name; ?></div>
                                </li>
                                
                                <!-- Detail Boxes for above four li -->
                                <div class="detail-view" id="detail-<?php echo $id; ?>">
                                    <div class="close" align="right">
                                        <a href="javascript:void(0)" style="color: #90c843">x</a>
                                    </div>
                                    <img src="images/products/<?php echo $id; ?>/image.jpg" class="detail_images" alt="" width="200" height="285"/>
                                    <div class="detail_info">
                                        <label class='item_name' style="color: #90c843"><a href="single.php?proID=<?php echo $id; ?>"><?php echo $name; ?></a></label>
                                        <br clear="all" /><br clear="all" />
                                        <span style="color: #90c843">Giá tiền: </span> <span class="price" style="color: #F7503D"><?php echo number_format($price, 0); ?> <span style="color: #90c843">VNĐ</span></span></br></br>
                                        <br clear="all" />
                                        <?php echo $longDes; ?>
                                         
                                        <br clear="all" /></br> </br> </br> </br> </br>
                                        <button  class="add-to-cart-button">Đặt Hàng</button>
                                    </div>
                                </div>
<?php } } ?>
                                
                                <!---->
                                <br clear="all" />
                            </ul>
                            <br clear="all" />
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-sidebar">
                    <h4 style="color: #90c843">Nhà sản xuất</h4>
                    <ul>
<?php
require_once './entities/Manufacturer.php';

$nsx = Manufacturer::loadAll();
for ($i = 0, $n = count($nsx); $i < $n; $i++) {
    $name = $nsx[$i]->getCatName();
    $id = $nsx[$i]->getCatId();
    ?>                       
                        <li><a href="store.php?catID=<?php echo $id; ?>"><?php echo $name; ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
        </div>
     <!--   <div class="clear"> </div>
        <div style="margin-left:75px;">
            <a href="store.php"><div class="pagebutton pageactive">1</div></a>
            <a href="store.php"><div class="pagebutton pageactive">2</div></a>
            <a href="store.php"><div class="pagebutton">3</div></a>
            <a href="store.php"><div class="pagebutton">4</div></a>
        </div>-->
        <div class="clear"> </div>
        </div><!-- InstanceEndEditable -->
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
