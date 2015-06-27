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
                $parts=  explode("\n", $text); //[1]-title [2]-src of pic [3]-writer
                echo "<h2> $parts[1]</h2>";
                echo "<a href='viewPic.php?src=$parts[2]'> <img src='$parts[2]' /> </a>";
                if(isset($_SESSION["admin"])){
                    echo "<br /><button class='tfbutton' type='button' value='$parts[2]'onclick='deletepic(\"$parts[2]\")'>Delete</button>";
                }
                
                
            }
        ?>
    </div>
</div>

<?php
require 'masterFoot.php';
?>