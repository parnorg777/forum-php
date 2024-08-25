<?php
require_once "../CLASSES/Post.php";
session_start();

$answer_id = $_GET["answer_id"] ?? null;

echo $answer_id;

$answer = new Answer([
  "answer_id" => $answer_id,
]);

$data = $answer->getAnswerID();

$_SESSION["answer"]["answer_id"] = $data["id"];
$_SESSION["answer"]["answer_text"] = $data["answer_text"];

header("location: ../about.php");
