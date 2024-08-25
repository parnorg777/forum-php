<?php
require_once "../CLASSES/Post.php";

$post_id = $_POST["post_id"];
$answer_text = $_POST["text"];
$user_id = $_POST["user_id"];

if ($post_id == "" || $answer_text == "") {
  header("location: ../about.php");
  die;
}

$answer = new Answer([
  "answer_text" => $answer_text,
  "post_id" => $post_id,
  "user_id" => $user_id,
]);

$answer->addAnswer();

header("location: ../about.php");
