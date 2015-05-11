<?php
require_once './DataProvider.php';

class User {

    var $id, $username, $password, $name, $email, $dob, $permission, $phone, $address;

    function __construct($id, $username, $password, $name, $email, $dob, $permission, $phone, $address) {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->name = $name;
        $this->email = $email;
        $this->dob = $dob;
        $this->permission = $permission;
        $this->phone = $phone;
        $this->address = $address;
    }

    public function getId() {
        return $this->id;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getName() {
        return $this->name;
    }
    public function getPhone() {
        return $this->phone;
    }
    public function getAddress() {
        return $this->address;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getDob() {
        return $this->dob;
    }

    public function getPermission() {
        return $this->permission;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDob($dob) {
        $this->dob = $dob;
    }
    public function setAddress($address) {
        $this->address = $address;
    }
    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setPermission($permission) {
        $this->permission = $permission;
    }

    public function insert() {

        $str_username = str_replace("'", "''", $this->username);
        $str_name = str_replace("'", "''", $this->name);
        $str_email = str_replace("'", "''", $this->email);
        $enc_pwd = md5($this->password);
        $str_dob = date('Y-m-d H:i:s', $this->dob);

        $sql = "insert into users (Username, Password, Name, Email, DOB, Permission, Phone, Address) "
                . "values('$str_username', '$enc_pwd', '$str_name', '$str_email', '$str_dob', $this->permission, $this->phone, $this->address)";

        //echo $sql;

        DataProvider::execQuery($sql);
    }

    public function login() {
        $ret = false;

        $str_username = str_replace("'", "''", $this->username);
        //$enc_pwd = $this->password;
        $enc_pwd = md5($this->username.$this->password);
        $sql = "select * from users where Username='$str_username' and Password='$enc_pwd'";
        $list = DataProvider::execQuery($sql);

        if ($row = mysql_fetch_array($list)) {

            $this->id = $row["ID"];
            $this->username = $row["Username"];
            $this->password = $row["Password"];
            $this->name = $row["Name"];
            $this->email = $row["Email"];
            $this->dob = strtotime($row["DOB"]);
            $this->permission = $row["Permission"];
            $this->phone = $row["Phone"];
            $this->address = $row["Address"];
            
            $ret = true;
        }

        return $ret;
    }

    public static function changePassword($username, $pwd, $newPwd) {

        $enc_pwd = md5($username.$pwd);
        $enc_new_pwd = md5($username.$newPwd);

        $sql = "update users set Password = '$enc_new_pwd' "
                . "where Username = '$username' and Password = '$enc_pwd'";

        return DataProvider::execQuery($sql);
    }

    public static function getInfo($username) {
        $p = NULL;
        $sql = "select * from users where Username='$username'";
        $list = DataProvider::execQuery($sql);
        if ($row = mysql_fetch_array($list)) {
            $p = new User(
                    $row["ID"],
                    $username, "",
                    $row["Name"],
                    $row["Email"], 
                    strtotime($row["DOB"]),
                    $row["Permission"],
                    $row["Phone"],
                    $row["Address"]
            );
        }
        return $p;
    }
    
    public function insertUser() {
        $username = $this->username;
        $name = $this->name;
        $password = md5($this->username.$this->password);
        $address = $this->address;
        $phone = $this->phone;
        $email = $this->email;
        $dob = $this->dob;
        $permission = $this->permission;
        $sql = "insert into users(Username,Password,Name,Email,DOB,Permission,Phone,Address) "
                . "values('$username','$password','$name','$email','$dob','$permission','$phone','$address')";
        DataProvider::execQuery($sql);
    }

    public static function checkUsername($username) {
        $numb = 0;
        $sql = "select * from users where Username='$username'";
        $list = DataProvider::execQuery($sql);
        while ($row = mysql_fetch_array($list)) {
            $numb++;
        }
        return $numb;
    }
    public static function updateUser($user) {
        $username = $user->username;
        $name = $user->name;
        $address = $user->address;
        $phone = $user->phone;
        $email = $user->email;
        $dob = $user->dob;
        $sql = "update users set Name = '$name',Email = '$email',DOB = '$dob',Phone = '$phone',Address = '$address' where Username = '$username'";
        DataProvider::execQuery($sql);
    }
}
