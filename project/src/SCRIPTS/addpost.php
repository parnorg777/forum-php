<?php
require_once "../CLASSES/Post.php";

$user_id = $_POST["user_id"];
$post_text = $_POST["text"];

if ($user_id == "" || $post_text == "") {
  header("location: ../about.php");
  die;
}

$post = new Post([
  "post_text" => $post_text,
  "user_id" => $user_id,
]);
$post->addPost();

header("location: ../about.php");
