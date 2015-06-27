<?php
$picsrc=$_GET["src"];

$path="Images/pegs/";
$parts=explode("/", $picsrc);
$picname=$parts[2];
$bla=$path.$picname;

if(!(isset($picsrc) && file_exists($bla) && count($parts)==3 && $parts[2] != "")){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
require 'masterHead.php';
?>

<div id="content">
    <?php
    $path="Images/pegs/";
    $picname= explode("/", $picsrc)[2];
    $picwoebd=explode(".", $picname)[0];
    $txtfile=$path.$picwoebd.".txt";
    $myfile = fopen($txtfile, "r") or die("Unable to open file!");
    $text= fread($myfile,filesize($txtfile));
    $parts=  explode("\n", $text); //[1]-title [2]-src of pic [3]-writer
    
    echo "<h2> $parts[1]</h2> <br />";
    echo "<img src='$parts[2]' width='500px' /> <br />";
    echo "<h3>Uploaded by $parts[3] </h3>";
    
    if(isset($_SESSION["user"])){
        if(isset($_SESSION["msg"])){
            echo $_SESSION["msg"];
            $_SESSION["msg"]=null;
        }
        echo "<form action='postComment.php' method='get'>";
        echo "<input type='hidden' name='pic' value='$picsrc'/>";
        echo "<textarea name='text' rows='2' cols='60'></textarea> <br />";
        echo "<input type='submit' class='tfbutton' />";
        echo "</form>";
        echo "<br />";
    }
    for($i=4;$i<count($parts);$i++){
        echo $parts[$i];
    }
    echo "<br />";
    ?>
    
</div>
<?php
require 'masterFoot.php';
?>