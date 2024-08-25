<?php
session_start();

$post_id = $_GET["post_id"] ?? null;

if ($post_id == "") {
    header("location: ../about.php");
    die;
}

$_SESSION["answer"]["post_id"] = $post_id;

header("location: ../about.php");
