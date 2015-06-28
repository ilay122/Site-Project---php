<?php
require 'masterHead.php';
?>
<div id="content">
    <?php
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
    <div id="pictures">
        <?php
            $dirname = "Images/pegs/";
            $images = glob($dirname.'*.txt');
            //usort($images, create_function('$a,$b', 'return filectime($a) - filectime($b);'));
            $filesdates=array();
            foreach($images as $image){
                $myfile = fopen($image, "r") or die("Unable to open file!");
                $date=  fgets($myfile);
                $filesdates[$date]=$image;
            }
            ksort($filesdates);
            $filesdates=array_reverse($filesdates);
            /*
            for($i=0;$i<count($images)/2;$i++){
                $temp=$images[$i];
                $images[$i]=$images[count($images)-$i-1];
                $images[count($images)-$i-1]=$temp;
            }
            
             */
            foreach($filesdates as $key =>$image) {
                $myfile = fopen($image, "r") or die("Unable to open file!");
                $text= fread($myfile,filesize($image));
                $parts=  explode("\n", $text); //[1]-title [2]-src of pic [3]-writer [5]-likes
                $src=$parts[2];
                $name=  explode("/", $src);
                $picname=$name[2];
                $likes=  explode(",",$parts[4]);
                $num=count($likes)-1;
                echo "<h2> $parts[1]</h2>";
                echo "<a href='viewPic.php?src=$parts[2]'> <img src='$parts[2]' /> </a>";
                echo "<br />";
                echo "Number of likes : <span id='$picname'> $num</span>";
                echo "<br />";
                if(isset($_SESSION["admin"])){
                    echo "<button class='tfbutton' type='button' value='$parts[2]'onclick='deletepic(\"$parts[2]\")'>Delete</button>";
                }
                
                if(isset($_SESSION["user"])){
                    $color="green";
                    if(in_array($_SESSION["user"], $likes))
                            $color="red";
                    echo "<button style='background-color:$color' id='$picname-' type='button' value='$parts[2]'onclick='likepic(\"$parts[2]\",\"$picname\")'>Like pic</button>";
                }
                
            }
        ?>
    </div>
</div>

<?php
require 'masterFoot.php';
?>