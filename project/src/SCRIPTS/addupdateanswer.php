<?php
require_once "../CLASSES/Post.php";

$answer_id = $_POST["post_id"];
$answer_text = $_POST["text"];
$user_id = $_POST["user_id"];

if ($answer_id == "" || $answer_text == "") {
  header("location: ../about.php");
  die;
}

$answer = new Answer([
  "answer_id" => $answer_id,
  "user_id" => $user_id,
]);

$answer->setAnswer($answer_text);
header("location: ../about.php");
