<?php
session_start();
error_reporting(0);
if(!isset($_SESSION["admin"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
if(isset($_POST["submit"])){
    $head=$_POST["header"];
    $text=$_POST["content"];
    $date=date("Y-m-d H:i:s");
    $writer=$_SESSION["user"];
    
    $head=htmlspecialchars($head, ENT_QUOTES);
    $text=htmlspecialchars($text, ENT_QUOTES);
    
    $xml = simplexml_load_file('news.xml');
    $news=$xml->addChild('report');
    $news->addChild('header', $head);
    $news->addChild('date', $date);
    $news->addChild('writer', $writer);
    $news->addChild('content', $text);
    file_put_contents('news.xml', $xml->asXML());
    
    $msg="News uploaded";
}
?>
<?php
require 'masterHead.php';
?>
<div id="content">
    <form action="" method="post">
            
            Title for the news <input type="text" name="header" placeholder="Header" /> <br /><br /><br />

             Main content : <br /> 
                <textarea cols="50" rows="8" name="content" placeholder="What Should I Write ???"></textarea>
                
            <br />
             <input type="submit" value="Submit" name="submit" class="tfbutton" />
             <input type="reset" value="Reset" class="tfbutton"/>
             
        </form>
    <?php
    if(isset($msg)){
        echo $msg;
    }
    ?>
</div>
<?php
require 'masterFoot.php';
?>