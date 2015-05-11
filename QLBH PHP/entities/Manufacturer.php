<?php
require_once './DataProvider.php';

class Manufacturer {

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
        $sql = "SELECT * FROM manufacturers";
        $list = DataProvider::execQuery($sql);

        while ($row = mysql_fetch_array($list)) {
            $id = $row["MaID"];
            $name = $row["MaName"];
            $c = new Manufacturer($id, $name);
            
            array_push($ret, $c);
        }
        return $ret;
    }
        public static function loadNameById($id) {
        require_once 'DataProvider.php';
        $sql = "select MaName from manufacturers where MaID = $id";
        $list = DataProvider::execQuery($sql);
        while ($row = mysql_fetch_array($list)) {
            $_proName = $row["MaName"];
            return $_proName;
        }
    }
}
