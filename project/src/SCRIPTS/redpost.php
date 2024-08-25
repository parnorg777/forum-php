<?php
require_once "../CLASSES/Post.php";
session_start();

$post_id = $_GET["post_id"] ?? null;

if ($post_id == "") {
  header("location: ../about.php");
  die;
}

$post = new Post([
  "post_id" => $_GET["post_id"],
]);
$data = $post->getPostID();

$_SESSION["post"]["id"] = $data["id"];
$_SESSION["post"]["text"] = $data["post_text"];

header("location: ../about.php");
