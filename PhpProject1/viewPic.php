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
if(isset($_SESSION["admin"])){
        echo "<script> function deletepic(src) {
            var confirmed=confirm('are u sure u want to delete this picture ?');
            if(confirmed){
                var superconfrim=confirm('are u sure ?????????');
                if(superconfrim){
                    console.log(src);
                    window.location='http://localhost:12345/deletepic.php?src='+src;
                    }
                }
            };</script>";
        }
if(isset($_SESSION["user"])){
         echo '
             <script> 
             function likepic(src,name){
             window.open("http://localhost:12345/likepic.php?src="+src, "_blank" ,"toolbar=no, scrollbars=no, resizable=no, top=100000000, left=100000000, width=1, height=1");
             var likes=parseInt(document.getElementById(name).innerHTML);
             var button=name+"-";
             console.log(button);
             if(document.getElementById(button).style.backgroundColor=="red"){
                 likes--;
                 document.getElementById(button).style.backgroundColor="green";
             }
             else{
                 likes++;
                 document.getElementById(button).style.backgroundColor="red";
             }
             
             document.getElementById(name).innerHTML=likes;
             }
             </script>
         ';
     }
?>

<div id="content">
    <?php
    $path="Images/pegs/";
    $picname= explode("/", $picsrc)[2];
    $picwoebd=explode(".", $picname)[0];
    $txtfile=$path.$picwoebd.".txt";
    $myfile = fopen($txtfile, "r") or die("Unable to open file!");
    $text= fread($myfile,filesize($txtfile));
    $parts=  explode("\n", $text); //[1]-title [2]-src of pic [3]-writer [4]-likes
    $likes=  explode(",",$parts[4]);
    $num=count($likes)-1;
    echo "<h2> $parts[1]</h2> <br />";
    echo "<img src='$parts[2]' width='500px' /> <br />";
    echo "<h3>Uploaded by $parts[3] </h3>";
    echo "<h3>Number of likes : <span id='$picname'> $num</span></h3>";
    if(isset($_SESSION["admin"])){
            echo "<button class='tfbutton' type='button' value='$parts[2]'onclick='deletepic(\"$parts[2]\")'>Delete</button>";
        }
    if(isset($_SESSION["user"])){
        $color="green";
        if(in_array($_SESSION["user"], $likes))
            $color="red";
        echo "<button style='background-color:$color' id='$picname-' type='button' value='$parts[2]'onclick='likepic(\"$parts[2]\",\"$picname\")'>Like pic</button>";
       }
      
       
    if(isset($_SESSION["user"])){
        if(isset($_SESSION["msg"])){
            echo $_SESSION["msg"];
            $_SESSION["msg"]=null;
        }
        echo "<br /> <br /><br />";
        echo "<form action='postComment.php' method='get'>";
        echo "<input type='hidden' name='pic' value='$picsrc'/>";
        echo "<textarea name='text' rows='2' cols='60'></textarea> <br />";
        echo "<input type='submit' class='tfbutton' />";
        echo "</form>";
        echo "<br />";
    }
    for($i=5;$i<count($parts);$i++){
        echo $parts[$i];
    }
    echo "<br />";
    ?>
    
</div>
<?php
require 'masterFoot.php';
?>