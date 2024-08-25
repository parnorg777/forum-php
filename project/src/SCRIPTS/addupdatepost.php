<?php
require_once "../CLASSES/Post.php";

$post_id = $_POST["post_id"];
$post_text = $_POST["text"];
$user_id = $_POST["user_id"];

if ($post_id == "" || $post_text == "") {
  header("location: ../about.php");
  die;
}

$post = new Post([
  "post_id" => $post_id,
  "user_id" => $user_id,
]);

$post->setPost($post_text);
header("location: ../about.php");
