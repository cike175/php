<?php
class Product {
    var $proID, $proName, $sortDes, $fullDes, $newPrice, $oldPrice, $catID, $quantity, $view, $dateAdd, $manuID;
    function __construct($proID, $proName, $sortDes, $fullDes, $newPrice, $oldPrice, $catID, $quantity, $view, $dateAdd, $manuID) {
        $this->proID = $proID;
        $this->proName = $proName;
        $this->sortDes = $sortDes;
        $this->fullDes = $fullDes;
        $this->newPrice = $newPrice;
        $this->oldPrice = $oldPrice;
        $this->catID = $catID;
        $this->quantity = $quantity;
        $this->view = $view;
        $this->dateAdd = $dateAdd;
        $this->manuID = $manuID;
    }
    public function getProID() {
        return $this->proID;
    }
    public function getProName() {
        return $this->proName;
    }
    public function getSortDes() {
        return $this->sortDes;
    }
    public function getFullDes() {
        return $this->fullDes;
    }
    public function getNewPrice() {
        return $this->newPrice;
    }
    public function getOldPrice() {
        return $this->oldPrice;
    }
    public function getCatID() {
        return $this->catID;
    }
    public function getQuantity() {
        return $this->quantity;
    }
    public function getView() {
        return $this->view;
    }
    public function getDateAdd() {
        return $this->dateAdd;
    }
    public function getManuID() {
        return $this->manuID;
    }
    public function setProID($proID) {
        $this->proID = $proID;
    }
    public function setProName($proName) {
        $this->proName = $proName;
    }
    public function setSortDes($sortDes) {
        $this->sortDes = $sortDes;
    }
    public function setFullDes($fullDes) {
        $this->fullDes = $fullDes;
    }
    public function setNewPrice($newPrice) {
        $this->newPrice = $newPrice;
    }
    public function setOldPrice($oldPrice) {
        $this->oldPrice = $oldPrice;
    }
    public function setCatID($catID) {
        $this->catID = $catID;
    }
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
    public function setView($view) {
        $this->view = $view;
    }
    public function setDateAdd($dateAdd) {
        $this->dateAdd = $dateAdd;
    }
    public function setManuID($manuID) {
        $this->manuID = $manuID;
    }
    
    public static function loadAll() {
        $ret = array();
        require_once 'DataProvider.php';
        $sql = "select * from products";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function loadById($id) {
        $ret = array();
       // require_once 'DataProvider.php';
        $sql = "select * from products where products.Manufacturer = $id";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function loadByProId($id) {
        require_once 'DataProvider.php';
        $sql = "select * from products where products.productID = $id";
        $list = DataProvider::execQuery($sql);
        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            return new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
        }
    }
	    public static function loadByIdoffset($id,$offset,$rowperpage) {
        $ret = array();
       // require_once 'DataProvider.php';
        $sql = "select * from products where products.Manufacturer = $id order by ProductID LIMIT $offset, $rowperpage";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function loadAlloffset($offset,$rowperpage) {
        $ret = array();
        require_once 'DataProvider.php';
        $sql = "select * from products p order by p.ProductID LIMIT $offset,$rowperpage";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function loadTop10() {
        $ret = array();
        require_once 'DataProvider.php';
        $sql = "select * from products p ORDER BY p.`View` desc limit 20";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function loadTop10Date() {
        $ret = array();
        require_once 'DataProvider.php';
        $sql = "select * from products p ORDER BY p.DateAdd desc limit 10";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function View($id){
        require_once 'DataProvider.php';
        $sql = "update products set view = view + 1 where productID = $id";
        DataProvider::execQuery($sql);
    }
    
            public static function loadTop10Buy() {
        $ret = array();
        require_once 'DataProvider.php';
        $sql = "SELECT
p.ProductID,
p.ProductName,
p.ShortDes,
p.LongDes,
p.NewPrice,
p.OldPrice,
p.CatID,
p.Quantity,
p.`View`,
p.DateAdd,
p.Manufacturer,
Sum(ord.Amount) AS Buy
from products p LEFT JOIN orderdetails ord on p.ProductID=ord.ProductID LEFT JOIN orders ordd on ord.OrderID=ordd.OrderID
where ordd.`Status`=1
group by ordd.OrderID,p.ProductID,p.ProductName,p.CatID,p.DateAdd,p.LongDes,p.ShortDes,p.Manufacturer,p.NewPrice,p.OldPrice,p.Quantity,p.`View`
order by Buy DESC
limit 10";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function load5NSX($id) {
        $ret = array();
       // require_once 'DataProvider.php';
        $sql = "select * from products where products.Manufacturer = $id order by ProductID DESC LIMIT 5";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
    public static function load5Cate($id) {
        $ret = array();
       // require_once 'DataProvider.php';
        $sql = "select * from products where products.CatID = $id ORDER BY ProductID DESC LIMIT 5";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $_proID = $row["ProductID"];
            $_proName = $row["ProductName"];
            $_sortDes = $row["ShortDes"]; 
            $_fullDes = $row["LongDes"]; 
            $_newPrice = $row["NewPrice"]; 
            $_oldPrice = $row["OldPrice"];
            $_catID = $row["CatID"];
            $_quantity = $row["Quantity"];
            $_view = $row["View"];
            $_dateAdd = $row["DateAdd"];
            $_manuID = $row["Manufacturer"];
            $c = new Product($_proID, $_proName, $_sortDes, $_fullDes, $_newPrice,$_oldPrice, $_catID, $_quantity, $_view, $_dateAdd, $_manuID);            
            array_push($ret, $c);
        }
        return $ret;
    }
}
