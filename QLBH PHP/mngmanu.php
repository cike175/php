<?php
require_once './helper/Utils.php';
session_start();

if ($_SESSION["IsLogin"] == 0) {
    Utils::RedirectTo('login.php');
}
$t = $_SESSION["CurrentUser"]["permission"];

if ($t != 2) {
    Utils::RedirectTo('login.php');
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
        <link rel="stylesheet" type="text/css" href="css/admin.css"/>
        <link rel="stylesheet" type="text/css" href="css/table.css"/>
        <!-- InstanceEndEditable -->
    </head>
    <body>
        <!-- InstanceBeginEditable name="BodyHead" -->
        <?php
        $flag = false;

        include_once './DataProvider.php';
        require_once './entities/Product.php';
        if (isset($_POST["btnThem"])) {
            $maname = $_POST["txtName"];
            $sql = "insert into manufacturers(MaName) values('" . $maname . "')";
            DataProvider::execQuery($sql);
        }

        if (isset($_POST["btnXoa"])) {
            $id = $_POST["txtID"];
            $sql = "delete from manufacturers where MaID=" . $id;
            $sqllist = "select * from products where Manufacturer=$id";

            $listproc = DataProvider::execQuery($sqllist);
            while ($row = mysql_fetch_array($listproc)) {
                $procid = $row["ProductID"];
                $path = "images/products/" . $procid;
                $sqlproc = "delete from products where ProductID=" . $procid;

                $files = glob("$path/*"); // get all file names
                foreach ($files as $file) { // iterate files
                    if (is_file($file))
                        unlink($file); // delete file
                }
                if (!rmdir($path)) {
                    echo "cannot remove dir";
                }
                DataProvider::execQuery($sqlproc);
                $sql_exist_order = "select * from orderdetails os left join orders od on os.OrderID=od.OrderID where od.Status=0 and os.ProductID=$procid";
                $array = DataProvider::execQuery($sql_exist_order);
                if (count($array) !== 0) {
                    while ($row2 = mysql_fetch_array($array)) {
                        $orderid = $row2["OrderID"];
                        $sql_delete_detail = "delete from orderdetails  where OrderID=$orderid and ProductID=$procid";
                        DataProvider::execQuery($sql_delete_detail);
                    }
                }
            }
            DataProvider::execQuery($sql);
        }

        if (isset($_POST["btnSua"])) {
            $id = $_POST["txtID"];
            $catName = $_POST["txtName"];
            $sql = "update manufacturers set Name='$catName' where MaID=" . $id;
            DataProvider::execQuery($sql);
        }

        $s_id = "";
        $s_catname = "";

        if (isset($_GET["id"])) {
            $flag = true;
            $s_id = $_GET["id"];
            $sql = "select * from manufacturers where MaID=" . $s_id;
            $list = DataProvider::execQuery($sql);
            $row = mysql_fetch_array($list);
            $s_catname = $row["MaName"];
        }
        ?>
        <!-- InstanceEndEditable -->
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
        <!-- InstanceBeginEditable name="Body Content" -->
        <div class="main-dash">
            <div class="menu-dash">
                <ul>
                    <a href="admin.php"><li class="tab "><i class="fa fa-home fa-2x"></i> Màn hình chính</li></a>
                    <li class="tab active"><i class="fa fa-th-list fa-2x"></i> Quản lý
                        <ul>
                            <a href="mngcat.php"><li class="tab2"><i class="fa fa-th-large"></i> Loại sản phẩm</li></a>
                            <a href="mngmanu.php"><li class="tab2 active"><i class="fa fa-th-large"></i> Nhà sản xuất</li></a>
                            <a href="mngorder.php"><li class="tab2"><i class="fa fa-th-large"></i> Đơn hàng</li></a>
                            <a href="mngproc.php"><li class="tab2"><i class="fa fa-th-large"></i> Sản phẩm</li></a>
                        </ul>   
                    </li>

                </ul>

            </div>
            <div class="content-dash">
                <div class="content-h4">Quản lý nhà sản xuất</div>
                <hr class="style-two"/>
                <br/>
                <div class="CSSTableGenerator" >
                    <table style="width: 450px !important;" >
                        <tr>
                            <td >
                                Mã nhà sản xuất
                            </td>
                            <td >
                                Tên nhà sản xuất
                            </td>
                            <td>
                                Chỉnh sửa
                            </td>
                            <td>
                                Xóa
                            </td>
                        </tr>
                        <?php
                        $sql = "select * from manufacturers";
                        $list = DataProvider::execQuery($sql);
                        while ($row = mysql_fetch_array($list)) {
                            ?>
                            <tr>
                                <td >
                                    <?php echo $row["MaID"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["MaName"]; ?>
                                </td>
                                <td>
                                    <a class="btn" href="mngmanu.php?id=<?php echo $row["MaID"]; ?>">Chọn</a>
                                </td>
                                <td>
                                    <a class="btn" href="mngmanudel.php?id=<?php echo $row["MaID"]; ?>">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <br/>
                <hr class="style-two"/>
                <div class="content-h4">Quản lý nhà sản xuất</div>
                <br/>
                <p>
                    <div class="form">
                        <form action="mngmanu.php" method="post" name="frmCat" id="frmCat">
                            <div class="label">Mã nhà sản xuất </div>
                            <input class="text" name="txtID" id="txtID" type="text" readonly="readonly" value="<?php if ($flag) echo $s_id; ?>" />
                            <div class="label">Tên nhà sản xuất </div>
                            <input class = "text" name="txtName" id="txtName" type="text" value="<?php if ($flag) echo $s_catname; ?>" />
                            <?php if (!$flag) { ?>
                                <input class = "btn" type="submit" name="btnThem" id="btnThem" value="Thêm"/>
                            <?php } else { ?>

                                <input class = "btn" type="submit" name="btnXoa" id="btnXoa" value="Xóa"/>
                                <input class = "btn" type="submit" name="btnSua" id="btnSua" value="Sửa"/>
                            <?php } ?>
                        </form>
                    </div>
                </p>
            </div>
        </div>
        <div class="clear"></div>
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
