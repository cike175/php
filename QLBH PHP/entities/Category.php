<?php
require_once './DataProvider.php';

class Category {

    var $catId, $catName;

    function __construct($catId, $catName) {
        $this->catId = $catId;
        $this->catName = $catName;
    }

    public function getCatId() {
        return $this->catId;
    }

    public function getCatName() {
        return $this->catName;
    }

    public function setCatId($catId) {
        $this->catId = $catId;
    }

    public function setCatName($catName) {
        $this->catName = $catName;
    }

    // Lấy danh sách danh mục đang có trong CSDL
    public static function loadAll() {
        $ret = array();
        $sql = "select * from categories";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $id = $row["ID"];
            $name = $row["Name"];
            $c = new Category($id, $name);
            
            array_push($ret, $c);
        }

        return $ret;
    }
    public static function loadById($id) {
        $ret = array();
        $sql = "select * from products where products.CatID = $id";
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
    public static function loadNameById($id) {
        require_once 'DataProvider.php';
        $sql = "select Name from categories where ID = $id";
        $list = DataProvider::execQuery($sql);
        while ($row = mysql_fetch_array($list)) {
            $_proName = $row["Name"];
            return $_proName;
        }
    }
	     public static function loadByIdoffset($id,$offset,$rowperpage) {
        $ret = array();
        $sql = "select * from products where products.CatID = $id order by ProductID LIMIT $offset,$rowperpage";
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
