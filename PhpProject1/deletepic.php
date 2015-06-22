<?php
session_start();
if(!isset($_SESSION["admin"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
$path="Images/pegs/";
$pic=$_GET["src"];
$parts=explode("/", $pic);
$picname=$parts[2];

$path.=$picname;
unlink($path);

header("Location: http://localhost:12345/index.php");
    die();