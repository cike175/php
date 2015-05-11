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
<?php
require_once './entities/Category.php';
include_once("./DataProvider.php");
if (!isset($_GET["id"])) {
    header("Location: mngcat.php");
} else {
    $id = $_GET["id"];
    $sql = "delete from categories where ID=" . $id;
    $sqllist = "select * from products where CatID=$id";

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
    header("Location: mngcat.php");
}
?>
/* 
* To change this license header, choose License Headers in Project Properties.
* To change this template file, choose Tools | Templates
* and open the template in the editor.
*/

