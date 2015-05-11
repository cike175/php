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
        <!-- InstanceBeginEditable name="head" --><!-- InstanceEndEditable -->
    </head>
    <body>
        <!-- InstanceBeginEditable name="BodyHead" --><!-- InstanceEndEditable -->
        <?php
        if (!isset($_SESSION['Cart'])) {
            $_SESSION['Cart'] = array();
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
        <div class="clear"> </div>
        <div class="left-side">

            <div class="content-h4">
                <h4 >Tìm kiếm sản phẩm</h4>

            </div>
            <div class="search-bar">
                <form method="get" id="search" name="search">
                    <input type="text" id="txtSearch" name="txtSearch" placeholder="Nhập từ khóa cần tìm kiếm" <?php if (isset($_GET["txtSearch"])) {
            echo "value='" . $_GET["txtSearch"] . "'";
        } ?> /><input type="submit" id="btnSearch" name="btnSearch" value="Tìm kiếm" />
                    <div class="content-h4">
                        <hr class="style-two"/>
                        <h4 >Tìm kiếm theo</h4>
                    </div>
                    <div id="checkbutton">
                        <input type="radio" name="radiog_lite" id="radio1" class="css-checkbox" value="name" <?php if (isset($_GET["radiog_lite"])) {
            if ($_GET["radiog_lite"] == "name") echo "checked='checked'";
        } ?> />
                        <label for="radio1" class="css-label radGroup1">Tên</label>
                        <br/>
                        <br/>

                        <input type="radio" name="radiog_lite" id="radio2" class="css-checkbox" value="manu" <?php if (isset($_GET["radiog_lite"])) {
            if ($_GET["radiog_lite"] == "manu") echo "checked='checked'";
        } ?>/>
                        <label for="radio2" class="css-label radGroup1">
                            Nhà sản xuất
                        </label>
                        <br/>
                        <br/>

                        <input type="radio" name="radiog_lite" id="radio3" value="price" class="css-checkbox" <?php if (isset($_GET["radiog_lite"])) {
            if ($_GET["radiog_lite"] == "price") echo "checked='checked'";
        } ?>/>
                        <label for="radio3" class="css-label radGroup1">Giá</label>
                        <br/>
                        <br/>

                        <input type="radio" name="radiog_lite" id="radio4" value="cat" class="css-checkbox" <?php if (isset($_GET["radiog_lite"])) {
            if ($_GET["radiog_lite"] == "cat") echo "checked='checked'";
        } ?>/>
                        <label for="radio4" class="css-label radGroup1">Loại</label>

                    </div>
                </form>
            </div>
        </div>
        <div class="right-side">
            <?php
            require_once './DataProvider.php';
            require_once './helper/Utils.php';
            $rowsPerPage = 10;
            $curPage = 1;
            if (isset($_GET['page']))
                $curPage = $_GET['page'];
            $offset = ($curPage - 1) * $rowsPerPage;


            if (isset($_GET["btnSearch"])) {
                if (!empty($_GET["txtSearch"])) {
                    $string = $_GET["txtSearch"];
                    if (!empty($_GET["radiog_lite"])) {
                        if ($_GET["radiog_lite"] == "name") {
                            $sql = "select * from products p where p.ProductName LIKE '%" . $string . "%' LIMIT $offset,$rowsPerPage";
                            $list = DataProvider::execQuery($sql);
                            $sql = "select count(*) from products p where p.ProductName LIKE '%" . $string . "%'";
                            $fullcount= DataProvider::execQuery($sql);
                            $row=  mysql_fetch_array($fullcount);
                            $number=$row[0];
                            
                        }
                        if ($_GET["radiog_lite"] == "manu") {
                            $sql = "select * from products p left join manufacturers manu on p.Manufacturer=manu.MaID where manu.MaName LIKE '%" . $string . "%' LIMIT $offset,$rowsPerPage";
                            $list = DataProvider::execQuery($sql);
                            $sql = "select count(*) from products p left join manufacturers manu on p.Manufacturer=manu.MaID where manu.MaName LIKE '%" . $string . "%'";
                            $fullcount= DataProvider::execQuery($sql);
                            $row=  mysql_fetch_array($fullcount);
                            $number=$row[0];
                            
                        }
                        if ($_GET["radiog_lite"] == "cat") {
                            $sql = "select * from products p left join categories cat on p.CatID=cat.ID where cat.Name LIKE '%" . $string . "%' LIMIT $offset,$rowsPerPage";
                            $list = DataProvider::execQuery($sql);
                            $sql = "select count(*) from products p left join categories cat on p.CatID=cat.ID where cat.Name LIKE '%" . $string . "%'";
                            $fullcount= DataProvider::execQuery($sql);
                            $row=  mysql_fetch_array($fullcount);
                            $number=$row[0];
                            
                        }
                        if ($_GET["radiog_lite"] == "price") {
                            if (strpos($string, '>=') !== false or strpos($string, '<=') !== false or strpos($string, '>') !== false or strpos($string, '<') !== false) {
                                $sql = "select * from products p  where p.NewPrice" . $string . " LIMIT $offset,$rowsPerPage";
                                $list = DataProvider::execQuery($sql);
                                $sql = "select count(*) from products p  where p.NewPrice" . $string;
                                $fullcount= DataProvider::execQuery($sql);
                                $row=  mysql_fetch_array($fullcount);
                                $number=$row[0];
                                
                            } else {
                                $sql = "select * from products p  where p.NewPrice=" . $string . " LIMIT $offset,$rowsPerPage";
                                $list = DataProvider::execQuery($sql);
                                $sql = "select count(*) from products p  where p.NewPrice=" . $string;
                                $fullcount= DataProvider::execQuery($sql);
                                $row=  mysql_fetch_array($fullcount);
                                $number=$row[0];
                            }
                        }
                    }
                    $number_of_pages = ceil($number / $rowsPerPage);
                }
                
            }
            ?>
            <div class="section group">
                <?php
                if (isset($list)) {
                    while ($row = mysql_fetch_array($list)) {
                        $id = $row["ProductID"];
                        $name = $row["ProductName"];
                        $price = $row["NewPrice"];
                        ?>
                        <div class="grid_1_of_4 images_1_of_4 products-info" style="height:280px;" >
                            <img src="images/products/<?php echo $id; ?>/image.jpg"/>
                            <a href="single.php?proID=<?php echo $id; ?>"><?php echo $name; ?></a>
                            <h3 style="color: #F7503D"><?php echo number_format($price, 0); ?></h3>
                            
                        </div>
        <?php
    }
}
?>

            </div>
            <div>
                 <?php
                 if(isset($number_of_pages)){
            for($page = 1; $page <= $number_of_pages; $page++)
		{
			if($page == $curPage)
				echo "<a><div class='pagebutton pageactive'>$page</div></a>";
			else
                        {
                           $url = $_SERVER["REQUEST_URI"];
                           $query = parse_url($url, PHP_URL_QUERY); 
                           if(strpos($url, "page=")==false){
                               echo "<a href='".$url."&page=$page'>"."<div class='pagebutton'>$page</div>"."</a> ";
                           }
                           else 
                           {
                               $page_current="&page=".$curPage;
                               $page_next="&page=".$page;
                               $new_path=str_replace($page_current, $page_next, $url);
                               echo "<a href='".$new_path."'>"."<div class='pagebutton'>$page</div>"."</a> ";
                           }
                        }
		}
                 }
            ?>
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
    </body>
    <!-- InstanceEnd --></html>
