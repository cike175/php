<?php
require_once './entities/User.php';
require_once './helper/Utils.php';
if(isset($_POST['btnChangePass'])){
    $oldpwd = $_POST['txtPassold'];
    $username = $_POST['txtUsername'];
    $newpwd = $_POST["txtPassnew"];
    User::changePassword($username, $oldpwd, $newpwd);
    Utils::RedirectTo('profile.php');
}

