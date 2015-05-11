<?php
require_once './helper/Utils.php';
session_start();

if($_SESSION["IsLogin"] == 0){
    Utils::RedirectTo('login.php');
}
$t = $_SESSION["CurrentUser"]["permission"];

if($t != 2){
    Utils::RedirectTo('login.php');
}
?>
<?php
include_once("./DataProvider.php");
if (!isset($_GET["id"])) {
    header("Location: mngorder.php");
} else {
    $ID = $_GET["id"];
    $sqlcheck="select * from orders where OrderID=$ID";
    $list=  DataProvider::execQuery($sqlcheck);
    $row=  mysql_fetch_array($list);
    $status=$row["Status"];
    if($status==0){
        $sql_new = "select * from orderdetails where OrderID=$ID";
        $procinlist=DataProvider::execQuery($sql_new);
        while($row=  mysql_fetch_array($procinlist)){
            $id_proc=$row["ProductID"];
            $amount=$row["Amount"];
            $sql_update="update products set Quantity=Quantity + $amount where ProductID=$id_proc";
            DataProvider::execQuery($sql_update);
        }
            
    }
    $sql = "delete from orderdetails where OrderID=" . $ID;
    DataProvider::execQuery($sql);
    $sql = "delete from orders where OrderID=" . $ID;
    DataProvider::execQuery($sql);
    header("Location: mngorder.php");
    }
?>