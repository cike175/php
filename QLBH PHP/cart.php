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
                <script type="text/javascript">
            function putProID(cmd, masp) {
                $("#hCmd").val(cmd);
                $("#hProId").val(masp);

                document.form1.submit();
            }
        </script>

        <!-- InstanceBeginEditable name="head" -->
                <script src="js/jquery.shopping.js"></script>
                <link rel="stylesheet" type="text/css" href="css/cart.css"/>
                <script>
                $(function() {
                    
                    var subtotal = document.querySelector('.js-subtotal'),
                    itemList = document.querySelector('.item-list'),
                    priceFields = document.querySelectorAll('.item .js-item-price'),
                    taxes = document.querySelector('.js-taxes'),
                    shipping = document.querySelector('.js-shipping'),
                    total = document.querySelector('.js-total'),
                    checkoutButton = document.querySelector('.js-checkout-button'),
            //modalWrapper = document.querySelector('.js-modal-wrapper'),
            initialList = itemList.innerHTML

            function loop (which, callback) {
              var len = which.length
              
              while (len--) {
                callback(which[len], len)
            }
        }

        function handleCalculations () {
          var subTotalPrice = 0,
          taxesPrice = 0
          
          loop(priceFields, function (price) {
            subTotalPrice += +price.textContent.substr(1)
        })
          
          subTotalPrice = subTotalPrice.toFixed(2)
          
          taxesPrice = (subTotalPrice * 0.05).toFixed(2)
          
          subtotal.textContent = '$' + subTotalPrice
          taxes.textContent = '$' + taxesPrice
          shipping.textContent = subTotalPrice !== '0.00' ? '$5.00' : 'Free'
          
          total.textContent = '$' + ((+subTotalPrice) + (+taxesPrice) + (+subTotalPrice > 0 ? 5 : 0)).toFixed(2)
        }

        function changeQuantity (emitter, action) {
          var action = emitter.classList.contains('js-item-increase') ? 'increase' : 'decrease',
          quantityField = emitter.parentElement.querySelector('span'),
          quantity = +quantityField.getAttribute('data-quantity'),
          price
          
          if (action === 'increase') {
            emitter.nextElementSibling.classList.remove('decrease--disabled')
        } else if (action === 'decrease') {
            if (quantity === 2) {
              emitter.classList.add('decrease--disabled')
          } else if (quantity === 1) {
              return
          }
        }

        quantityField.innerHTML = '<b>' + (action === 'increase' ? ++quantity : --quantity) + '</b> ' + (quantity > 1 ? 'copies' : 'copy')
        quantityField.setAttribute('data-quantity', quantity)

        price = emitter.parentElement.parentElement.parentElement.querySelector('.js-item-price')

        price.textContent = '$' + (quantity * price.getAttribute('data-price')).toFixed(2)

        handleCalculations()
        }

        function removeItem (emitter) {
          var item = emitter.parentElement.parentElement,
          len = priceFields.length,
          marginBottom = len > 1 ? parseInt(getComputedStyle(item).marginBottom, 10) : 0
          
          item.classList.add('item--disappearing')
          item.style.marginTop = -(item.offsetHeight + marginBottom) + 'px'
          
          setTimeout(function () {
            itemList.removeChild(item)
            
            priceFields = document.querySelectorAll('.item .js-item-price')
            
            if (!priceFields.length) {
              itemList.innerHTML = '<li class="item empty-hint"><p>Bummer, you removed all items! Wanna <a class="js-restore-list">start over again</a>?</li>'
              itemList.firstElementChild.classList.add('is-visible')
          }
          
          handleCalculations()
        }, 500)
        }

        function restoreList () {
          itemList.firstElementChild.classList.remove('is-visible')
          
          setTimeout(function () {
            itemList.style.minHeight = itemList.offsetHeight + 'px'
            itemList.classList.add('appearing', 'delayed')
            itemList.innerHTML = initialList
            itemList.style.maxHeight = itemList.offsetHeight + 'px'
            itemList.classList.remove('appearing')
            priceFields = document.querySelectorAll('.item .js-item-price')
            handleCalculations()
        }, 500)
          
          setTimeout(function () {
            itemList.style.minHeight = 0
            itemList.style.maxHeight = 'none'
            itemList.classList.remove('delayed')
        }, 1500)
        }

        itemList.addEventListener('click', function (e) {
          var target = e.target,
          classList = target.classList
          
          if (classList.contains('js-item-increase') || classList.contains('js-item-decrease')) {
            changeQuantity(target)
        } else if (classList.contains('js-item-remove')) {
            removeItem(target)
        } else if (classList.contains('js-restore-list')) {
            restoreList()
        }
        })

        checkoutButton.addEventListener('click', function () {
          modalWrapper.classList.add('is-visible')
        })

        modalWrapper.addEventListener('click', function () {
          modalWrapper.classList.remove('is-visible')
        })

        setTimeout(function () {
          modalWrapper.style.display = 'block'
        }, 250)
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
        require_once './helper/Context.php';
        require_once './helper/Utils.php';

        if (!Context::isLogged()) {
            Utils::RedirectTo('login.php?retUrl=cart.php');
        }

        require_once '/helper/CartProcessing.php';

        // cập nhật giỏ hàng (xoá/sửa)

        if (isset($_POST['hCmd'])) {
            $cmd = $_POST['hCmd']; // X/S
            $masp = $_POST['hProId'];

            if ($cmd == 'X') {
                CartProcessing::removeItem($masp);
            } else if ($cmd == 'S') {
                //$sl = $_POST["sl_".$masp];
                $sl = $_POST["sl_$masp"];
                CartProcessing::updateItem($masp, $sl);
            }
        }

        // lập hoá đơn

        require_once './entities/Order.php';
        require_once './entities/OrderDetail.php';
        require_once './entities/Product.php';

        if (isset($_POST['btnLapHD'])) {
            $date = time();
            $user = $_SESSION['CurrentUser']['id'];

            $total = 0;
            foreach ($_SESSION['Cart'] as $masp => $solg) {
                $p = Product::loadByProId($masp);
                $amount = $p->getNewPrice() * $solg;
                $total += $amount;
            }

            $o = new Order(-1, $date, $user, $total, 0);
            $o->add();

            // thêm nhiều dòng chi tiết hoá đơn

            foreach ($_SESSION['Cart'] as $masp => $solg) {
                $p = Product::loadByProId($masp);

                $amount = $p->getNewPrice() * $solg;
                $detail = new OrderDetail($o->getOrderID(), $masp, $solg);
                $detail->add();
            }

            // huỷ giỏ hàng

            unset($_SESSION['Cart']);

            // nạp lại trang hiện tại

            $query = $_SERVER['PHP_SELF'];
            $path = pathinfo($query);
            $url = $path['basename'];
            Utils::RedirectTo($url);
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
        <form id="form1" name="form1" method="post" action="">
                            <input type="hidden" id="hCmd" name="hCmd" />
                            <input type="hidden" id="hProId" name="hProId" />
        <div class='content-padding'>
         <div class="content-h4" style="text-align:center;">
                            <h4 >Giỏ hàng</h4>
                             
                        </div>
        <ul class='item-list'>
<?php
                                    require_once './entities/Product.php';

                                    $total = 0;
                                    foreach ($_SESSION['Cart'] as $masp => $solg) {
                                        $p = Product::loadByProId($masp);
                                        ?>          
            <li class='item'>
                 
            <div class='item__information'>
                <div class='item__image'>
                    <img src="images/products/<?php echo $p->getProID(); ?>/image.jpg" >
            </div>
            <div class='item__body'>
                <h2 class='item__title'><?php echo $p->getProName();?></h2>
                <p class='item__description'><?php echo $p->getSortDes();?></p>
            </div>
            <div class='item__price js-item-price' data-price='11.99'><?php echo number_format($p->getNewPrice()); ?></div>
        </div>
                <table id="cart" width="100%" border="1" cellspacing="0" cellpadding="4">
                <tr>
                    <td align="center"><img src="imgs/delete-icon.png" title="Xoá" style="cursor: pointer" onclick="putProID('X', <?php echo $masp; ?>);" /></td>
                                  <!--          <td align="center"><img src="imgs/Actions-document-save-icon.png" title="Cập nhật" style="cursor: pointer" onclick="putProID('S', <?php echo $masp; ?>);" /></td>
               --> </tr>
                    </table>
        <!--<div class='item__interactions'>
            <p class='item__quantity'>
            <a class='js-item-increase' title='Add another copy'>+</a>
            <a class='js-item-decrease decrease--disabled' title='Remove a copy'>-</a>
          -->  <span data-quantity='1'>
              <b><?php echo $solg; ?></b>
              sản phẩm
          </span>
      <!-- </p>
        <a class='item__remove js-item-remove' title='Remove this item'>&times;</a>
        </div>
        -->
        </li>  
<?php 
          $total += $p->getNewPrice() * $solg;
        
          }
          ?>
        
        </ul>
        <div class='summary js-summary'>
          <ul class='steps'>
            <li>
              <b>Tổng hàng:</b>
              <span class='sum js-subtotal'><?php echo CartProcessing::countQuantity(); ?></span>
          </li>
          <li>
              <b>Thuế VAT(10%):</b>
              <span class='sum js-taxes'><?php echo number_format(($total*10)/100); ?></span>
          </li>
          <li>
              <b>Phí vận chuyển:</b>
              <span class='sum js-shipping'><?php echo '0 VND'; ?></span>
          </li>
        </ul>
        <ul class='checkout'>
            <li>
              <b>Tổng cộng:</b>
              <span class='sum js-total'><?php echo number_format($total); ?></span>
          </li>
          <li>
              <button  type="submit" class="cart-button" id="btnLapHD" name="btnLapHD" onclick="add();">Đặt Hàng</button>
          </li>
        </ul>
        </div>
    </div>
        </form>>
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
