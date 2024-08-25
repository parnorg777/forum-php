<?php
require_once "../CLASSES/Post.php";

$answer_id = $_GET["answer_id"] ?? null;
$user_id = $_GET["user_id"] ?? null;

if ($answer_id == "" || $user_id == "") {
  header("location: ../about.php");
  die;
}

$answer = new Answer([
  "answer_id" => $answer_id,
  "user_id" => $user_id,
]);
$answer->delAnswer();

header("location: ../about.php");
