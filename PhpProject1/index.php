<?php
require 'masterHead.php';
?>
<div id="content">
    <div id="pictures">
        <?php
            $dirname = "Images/pegs/";
            $images = glob($dirname.'*');
            foreach($images as $image) {
            echo '<img src="'.$image.'" />';
            }
        ?>
    </div>
</div>

<?php
require 'masterFoot.php';
?>