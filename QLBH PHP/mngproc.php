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
﻿<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
        <script src="ckeditor/ckeditor.js"></script>
        <script type="text/javascript">
            function openUploader(value)
            {
                value = "upload.php?id=" + value;
                var width = 450, height = 200;
                var left = (screen.availWidth - width) / 2;
                var top = (screen.availHeight - height) / 2;

                window.open(value, "", "width=" + width + ",height=" + height + ",top=" + top + ",left=" + left + ",location=0, resizable=0");
            }
        </script>

        <!-- InstanceEndEditable -->
    </head>
    <body>
        <!-- InstanceBeginEditable name="BodyHead" -->
        <?php
        $flag = false;
        $getid = "";

        include_once './DataProvider.php';
        include_once './entities/Product.php';
        if (isset($_POST["btnThem"])) {
            $name = $_POST["txtProductName"];
            $shortdes = $_POST["txtShortDes"];
            $fulldes = $_POST['editor1'];
            $newprice = $_POST["txtNewPrice"];
            $oldprice = $_POST["txtOldPrice"];
            $catid = $_POST["frmCat"];
            $quantity = $_POST["txtQuantity"];
            $dateadd = $_POST["datetimepicker2"];
            $manuid = $_POST["frmManu"];

            $sql = "insert into products(ProductName,ShortDes,LongDes,NewPrice,OldPrice,CatID,Quantity,DateAdd,Manufacturer,View) values('$name','$shortdes','$fulldes','$newprice','$oldprice','$catid','$quantity','$dateadd','$manuid',0)";
            DataProvider::execQuery($sql);
        }

        if (isset($_POST["btnXoa"])) {
            $id = $_POST["txtProductID"];
            $path = "images/products/" . $id;
            $sql = "delete from products where ProductID=" . $id;

            $files = glob("$path/*"); // get all file names
            foreach ($files as $file) { // iterate files
                if (is_file($file))
                    unlink($file); // delete file
            }
            if (!rmdir($path)) {
                echo "cannot remove dir";
            }
            $sql_exist_order = "select * from orderdetails os left join orders od on os.OrderID=od.OrderID where od.Status=0 and os.ProductID=$id";
            $array = DataProvider::execQuery($sql_exist_order);
            if (count($array) !== 0) {
                while ($row2 = mysql_fetch_array($array)) {
                    $orderid = $row2["OrderID"];
                    $sql_delete_detail = "delete from orderdetails  where OrderID=$orderid and ProductID=$id";
                    DataProvider::execQuery($sql_delete_detail);
                }
            }
            DataProvider::execQuery($sql);
        }

        if (isset($_POST["btnSua"])) {

            $id = $_POST["txtProductID"];
            $name = $_POST["txtProductName"];
            $shortdes = $_POST["txtShortDes"];
            $fulldes = $_POST['editor1'];
            $newprice = $_POST["txtNewPrice"];
            $oldprice = $_POST["txtOldPrice"];
            $catid = $_POST["frmCat"];
            $quantity = $_POST["txtQuantity"];
            $dateadd = $_POST["datetimepicker2"];
            $manuid = $_POST["frmManu"];
            $sql = "update products set ProductName='$name',ShortDes='$shortdes',LongDes='$fulldes',NewPrice='$newprice',OldPrice='$oldprice',Quantity='$quantity',CatID='$catid',Manufacturer='$manuid',DateAdd='$dateadd' where ProductID=" . $id;
            DataProvider::execQuery($sql);
        }

        $s_id = "";
        $s_catname = "";
        $proc = "";

        if (isset($_GET["id"])) {
            $flag = true;
            $s_id = $_GET["id"];
            $sql = "select * from products where ProductID=" . $s_id;
            $list = DataProvider::execQuery($sql);
            $row = mysql_fetch_array($list);
            $proc = new Product($row["ProductID"], $row["ProductName"], $row["ShortDes"], $row["LongDes"], $row["NewPrice"], $row["OldPrice"], $row["CatID"], $row["Quantity"], $row["View"], $row["DateAdd"], $row["Manufacturer"]);
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
                            <a href="mngmanu.php"><li class="tab2"><i class="fa fa-th-large"></i> Nhà sản xuất</li></a>
                            <a href="mngorder.php"><li class="tab2"><i class="fa fa-th-large"></i> Đơn hàng</li></a>
                            <a href="mngproc.php"><li class="tab2 active"><i class="fa fa-th-large"></i> Sản phẩm</li></a>
                        </ul>   
                    </li>

                </ul>

            </div>
            <div class="content-dash">
                <div class="content-h4">Quản lý sản phẩm</div>
                <hr class="style-two"/>
                <br/>
                <div class="CSSTableGenerator" >
                    <table style="width: 850px !important">
                        <tr>
                            <td >
                                Mã SP
                            </td>
                            <td >
                                Tên SP
                            </td>
                            <td >
                                Giá mới
                            </td>
                            <td >
                                Số lượng
                            </td>
                            <td >
                                Loại
                            </td>
                            <td >
                                HSX
                            </td>
                            <td >
                                Ngày thêm
                            </td>
                            <td>
                                Chỉnh sửa
                            </td>
                            <td>
                                Xóa
                            </td>
                        </tr>
                        <?php
                        $sql = "select p.ProductID,p.ProductName,p.NewPrice,p.Quantity,c.Name,m.MaName,p.DateAdd from products p,categories c,manufacturers m where p.CatID=c.ID and p.Manufacturer=m.MaID order by p.ProductID";
                        $list = DataProvider::execQuery($sql);
                        while ($row = mysql_fetch_array($list)) {
                            ?>
                            <tr>
                                <td >
                                    <?php echo $row["ProductID"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["ProductName"]; ?>
                                </td>
                                <td>
                                    <?php echo number_format($row["NewPrice"]); ?>
                                </td>
                                <td>
                                    <?php echo $row["Quantity"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["Name"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["MaName"]; ?>
                                </td>
                                <td>
                                    <?php echo $row["DateAdd"]; ?>
                                </td>
                                <td>
                                    <a class="btn" href="mngproc.php?id=<?php echo $row["ProductID"]; ?>">Chọn</a>
                                </td>
                                <td>
                                    <a class="btn" href="mngprocdel.php?id=<?php echo $row["ProductID"]; ?>">Xóa</a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <br/>
                <hr class="style-two"/>
                <div class="content-h4">Quản lý sản phẩm</div>
                <br/>
                <p>
                    <div class="form">
                        <form action="mngproc.php" method="post" name="frmCat" id="frmCat">
                            <div class="label">Mã sản phẩm </div>
                            <input class="text" name="txtProductID" id="txtProductID" type="text" readonly="readonly" value="<?php
                            if ($flag) {
                                echo $proc->getProID();
                                $getid = $proc->getProID();
                            } else {
                                $sql = "show table status like 'products'";
                                $list = DataProvider::execQuery($sql);
                                $row = mysql_fetch_array($list);
                                $nextid = $row["Auto_increment"];
                                echo $nextid;
                                $getid = $nextid;
                            }
                            ?>" />
                            <div class="label">Tên sản phẩm </div>
                            <input class = "text" name="txtProductName" id="txtProductName" type="text" value="<?php if ($flag) echo $proc->getProName(); ?>" />
                            <div class="label">Mô tả ngắn </div>
                            <input class = "text" name="txtShortDes" id="txtShortDes" type="text" value="<?php if ($flag) echo $proc->getSortDes(); ?>" />
                            <div class="label">Mô tả đầy đủ </div>
                            <textarea class="ckeditor" cols="80" id="editor1" name="editor1" rows="10">
                                <?php if ($flag) echo $proc->getFullDes(); ?>
                            </textarea>
                            <div class="label">Upload hình ảnh </div>
                            <input class = "btn" type="button" name="btnUpload" id="btnUpload" value="Upload" onclick="openUploader(<?php echo $getid; ?>);" />
                            <div class="label">Giá mới </div>
                            <input class = "text" name="txtNewPrice" id="txtNewPrice" type="text" value="<?php if ($flag) echo $proc->getNewPrice(); ?>" />
                            <div class="label">Giá cũ </div>
                            <input class = "text" name="txtOldPrice" id="txtOldPrice" type="text" value="<?php if ($flag) echo $proc->getOldPrice(); ?>" />
                            <div class="label">Số lượt xem </div>
                            <input class = "text" name="txtView" id="txtView" readonly="readonly" type="text" value="<?php if ($flag) echo $proc->getView(); ?>" />
                            <div class="label">Số lượng</div>
                            <input class = "text" name="txtQuantity" id="txtQuantity" type="text" value="<?php if ($flag) echo $proc->getQuantity(); ?>" />
                            <div class="label">Ngày thêm </div>
                            <input class="text" type="text" id="datetimepicker2" readonly="readonly" name="datetimepicker2" value="<?php if ($flag) echo $proc->getDateAdd(); ?>"/>
                            <div class="label">Loại sản phẩm </div>
                            <div class="select-style"  >
                                <select name="frmCat">
                                    <?php
                                    $sql = "select * from categories";
                                    $list = DataProvider::execQuery($sql);
                                    while ($row = mysql_fetch_array($list)) {
                                        if ($flag and $row["ID"] == $proc->getCatID())
                                            echo "<option selected value='" . $row["ID"] . "'> " . $row["Name"] . "</option>";
                                        else
                                            echo "<option value='" . $row["ID"] . "'> " . $row["Name"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="label">Hãng sản xuất </div>
                            <div class="select-style">
                                <select name="frmManu">
                                    <?php
                                    $sql = "select * from manufacturers";
                                    $list = DataProvider::execQuery($sql);
                                    while ($row = mysql_fetch_array($list)) {
                                        if ($flag and $row["MaID"] == $proc->getManuID())
                                            echo "<option selected value='" . $row["MaID"] . "'> " . $row["MaName"] . "</option>";
                                        else
                                            echo "<option value='" . $row["MaID"] . "'> " . $row["MaName"] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php if (!$flag) { ?>
                                <input class = "btn" type="submit" name="btnThem" id="btnThem" value="Thêm"/>
                            <?php } else {
                                ?>

                                <input class = "btn" type="submit" name="btnXoa" id="btnXoa" value="Xóa"/>
                                <input class = "btn" type="submit" name="btnSua" id="btnSua" value="Sửa"/>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                </p>


            </div>

        </div>
        <div class="clear"></div>
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
