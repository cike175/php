
<?php
if (!isset($_GET["id"])) {
    header("Location: mngproc.php");
} else {
    $id = $_GET["id"];
    $sql = "delete from products where ProductID=" . $id;

    include_once("./DataProvider.php");
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
    header("Location: mngproc.php");
}
?>

