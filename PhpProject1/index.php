<?php
require 'masterHead.php';
?>
<div id="content">
    <div id="pictures">
        <?php
            $dirname = "Images/pegs/";
            $images = glob($dirname.'*');
            usort($images, create_function('$a,$b', 'return filemtime($a) - filemtime($b);'));
            for($i=0;$i<count($images)/2;$i++){
                $temp=$images[$i];
                $images[$i]=$images[count($images)-$i-1];
                $images[count($images)-$i-1]=$temp;
            }
            foreach($images as $image) { 
                echo '<img src="'.$image.'" />';
            }
        ?>
    </div>
</div>

<?php
require 'masterFoot.php';
?>