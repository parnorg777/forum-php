<?php
require_once "../CLASSES/User.php";
session_start();

$username = $_POST["username"];
$pass = $_POST["pass"];
$repass = $_POST["repass"];

if ($username == "" || $pass == "") {
    $_SESSION["error"] = "Заполните все поля";
    header("location: ../regist.php");
    die;
} else if (strlen($username) <= 1 || strlen($username) > 25) {
    $_SESSION["error"] = "Недопустимая длина имени";
    header("location: ../regist.php");
    die;
} else if (strlen($pass) < 12 || strlen($pass) > 40) {
    $_SESSION["error"] = "Недопустимая длина пороля";
    header("location: ../regist.php");
    die;
} else if ($pass != $repass) {
    $_SESSION["error"] = "Пароли не совпадают";
    header("location: ../regist.php");
    die;
} else {
    $user = new User([
        "username" => $username,
        "pass" => md5($pass),
    ]);
    $data = $user->checkUsername();
}

if ($data) {
    $_SESSION["error"] = "Такой пользователь уже существует";
    header("location: ../regist.php");
} else {
    $user->registUser();
    $_SESSION["mess"] = "Пользователь зарегистрирован";
    header("location: /");
}
