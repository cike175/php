<?php

define("SERVER", "localhost");
define("DATABASE", "qlbh");
define("USERNAME", "root");
define("PASSWORD", "");

class DataProvider {

    public static function execQuery($sql) {
        $connection = mysql_connect(SERVER, USERNAME, PASSWORD) 
                or die("Could not connect to " . SERVER . ".");
        mysql_select_db(DATABASE, $connection);
        mysql_query("set names 'utf8'");
        $result = mysql_query($sql, $connection);
        if (!$result)
            die("Query failed: " . mysql_error());
        mysql_close($connection);
        return $result;
    }

    public static function execNonQueryIdentity($sql) {
        $cn = mysql_connect(SERVER, USERNAME, PASSWORD) or
                die("Không thể kết nối vào máy chủ");
        mysql_select_db(DATABASE, $cn);
        mysql_query("set names 'utf8'");
        if (!mysql_query($sql, $cn))
            die("Lỗi truy vấn: " . mysql_error());
        $id = mysql_insert_id();
        mysql_close($cn);
        return $id;
    }

}

?>