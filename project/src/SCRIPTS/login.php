<?php
require_once "../CLASSES/User.php";
session_start();

$username = $_POST["username"];
$pass = $_POST["pass"];

if ($username == "" || $pass == "") {
  $_SESSION["error"] = "Заполните все поля";
  header("location: /");
  die;
} else {
  $user = new User([
    "username" => $username,
    "pass" => md5($pass),
  ]);
  $data = $user->checkUsernameAndPass();
}

if (!$data) {
  $_SESSION["error"] = "Неверный ЛОГИН или ПАРОЛЬ";
  header("location: /");
  die;
} else {
  $_SESSION["user"]["id"] = $data["id"];
  $_SESSION["user"]["name"] = $data["username"];
  header("location: ../about.php");
  die;
}
