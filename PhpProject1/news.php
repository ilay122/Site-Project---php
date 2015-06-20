<?php
require 'masterHead.php';
?>

<div id="content">
    <?php
    $xml=simplexml_load_file("news.xml") or die("Error: Cannot create object");
    $xmlArray = array();
    foreach ($xml as $event_date) $xmlArray[] = $event_date;
    $xmlArray = array_reverse($xmlArray);
    foreach($xmlArray as $new) {
        echo "<p>";
        echo "<h1>"; echo $new->header; echo "</h1>";
        echo "<h2> upload date : ";echo $new->date;  echo "</h2>";
        echo "written by :<b> ";echo $new->writer;echo "</b></br> </br>";
        echo $new->content . "</br> </br>";
        echo "</p>";
    } 
    ?>
</div>
<?php
require 'masterFoot.php';
?>