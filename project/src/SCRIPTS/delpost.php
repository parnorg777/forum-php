<?php
require_once "../CLASSES/Post.php";

$post_id = $_GET["post_id"] ?? null;
$user_id = $_GET["user_id"] ?? null;

if ($post_id == "" || $user_id == "") {
  header("location: ../about.php");
  die;
}

$post = new Post([
  "post_id" => $post_id,
  "user_id" => $user_id,
]);
$post->delPost();

header("location: ../about.php");
