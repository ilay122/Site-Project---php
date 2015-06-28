<?php
error_reporting(0);
session_start();
$picsrc=$_GET["src"];

$path="Images/pegs/";
$parts=explode("/", $picsrc);
$picname=$parts[2];
$bla=$path.$picname;

if(!(isset($picsrc) && file_exists($bla) && count($parts)==3 && $parts[2] != "" && isset($_SESSION["user"]))){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
$path="Images/pegs/";
$picname= explode("/", $picsrc)[2];
$picwoebd=explode(".", $picname)[0];
$filename=$path.$picwoebd.".txt";

$user=$_SESSION["user"];
$user.=",";
$lines = file( $filename , FILE_IGNORE_NEW_LINES );
$names=  explode(",", $lines[4]);
$likesLine=$lines[4];
if(in_array($_SESSION["user"], $names)){
    $likesLine=  str_replace($user, "", $likesLine);
}
else{
    $likesLine.=$user;
}
$lines[4] = $likesLine;


file_put_contents( $filename , implode( "\n", $lines ) );


?>
<html>
    <head>
        
    </head>
    <body>
        <script> 
            window.close();
        </script>
    </body>
        
</html>