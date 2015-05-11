<?php
require_once './DataProvider.php';
require_once './entities/User.php';
require_once './helper/Utils.php';
        if(isset($_POST["btnChangeInfo"])){
            $username = $_POST["txtUsername"];
            $name = $_POST["txtName"];
            $email = $_POST["txtEmail"];
            $address = $_POST["txtAddress"];
            $phone = $_POST["txtPhone"];
            $dob = $_POST["datetimepicker2"];
            User::updateUser(new User('', $username, '', $name, $email, $dob, '', $phone, $address));
            Utils::RedirectTo ('profile.php');
        }

require_once './entities/User.php';
require_once './helper/Utils.php';
if(isset($_POST["btnChangePass"])){
    $oldpwd = $_POST["txtPassold"];
    $username = $_POST["txtUsername"];
    $newpwd = $_POST["txtPassnew"];
    User::changePassword($username, $oldpwd, $newpwd);
    Utils::RedirectTo('logout.php');
}