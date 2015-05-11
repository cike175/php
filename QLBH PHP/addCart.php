<?php
session_start();

?>
<?php
        require_once './helper/CartProcessing.php';

        // đặt hàng

        if (isset($_POST["btnDatHang"])) {
            $masp = $_POST["proid"];
            $solg = 1;
            CartProcessing::addItem($masp, $solg);
        }
        echo '<pre>';
var_dump($_SESSION);
echo '</pre>';
        ?>