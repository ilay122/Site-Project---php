<?php
session_start();
$picsrc=$_GET["pic"];
$picsrc=str_replace("%2F", "/", $picsrc);

$path="Images/pegs/";
$parts=explode("/", $picsrc);
$picname=$parts[2];
$bla=$path.$picname;

if(!(isset($picsrc) && file_exists($bla) && isset($_GET["text"]) &&isset($_SESSION["user"]) && count($parts)==3)){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
if(strlen($_GET["text"]) < 60){
$path="Images/pegs/";
$picname= explode("/", $picsrc)[2];
$picwoebd=explode(".", $picname)[0];
$txtfile=$path.$picwoebd.".txt";
$lines = file( $txtfile , FILE_IGNORE_NEW_LINES );
$comline=$lines[5];

$text=$_GET["text"];
$text=htmlspecialchars($text, ENT_QUOTES);
$user=$_SESSION["user"];
$comment="<div class='comments'> <b> $user</b> $text </div>";
$comline.=$comment;
$lines[5] = $comline;
file_put_contents( $txtfile , implode( "\n", $lines ) );
}
else{
    $_SESSION["msg"]="Comment too long !";
}
header("Location: http://localhost:12345/viewPic.php?src=$picsrc");
die();
?>