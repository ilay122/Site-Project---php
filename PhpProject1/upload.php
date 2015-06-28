<?php
error_reporting(0);
session_start();
if(!isset($_SESSION["user"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
$target_dir = "Images/pegs/";
$uploadOk = 1;
$usermsg="";

function randomStr(){
    $chars="0123456789abcdefghijklmnopqersuvwxyz";
    $ret="";
    for($i=0;$i<11;$i++){
        $ret.=$chars[rand(0, strlen($chars))];
    }
    return $ret;
}

if(isset($_POST["submit"])) {
    
    $random= randomStr();
    $mainname= $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $target_file = $target_dir .$random;
    $imageFileType = pathinfo($mainname,PATHINFO_EXTENSION);
    $target_file.=".".$imageFileType;
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        $usermsg= "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        $usermsg= "File is not an image.";
        $uploadOk = 0;
    }
    if (file_exists($target_file)) {
        $usermsg= "Sorry, file already exists.";
        $uploadOk = 0;
    }

    else if ($_FILES["fileToUpload"]["size"] > 50000000) {
        $usermsg= "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    else if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" && $imageFileType !="bmp") {
        $usermsg= "Sorry, only JPG, JPEG, PNG, GIF & BMP files are allowed.";
        $uploadOk = 0;
    }
    
    if ($uploadOk != 0) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $txtfile=fopen("Images/pegs/$random.txt", "w");
            $title=$_POST["title"];
            $title=htmlspecialchars($title, ENT_QUOTES);
            $time=time();
            fwrite($txtfile,"$time\n");//1
            fwrite($txtfile,"$title\n");//2
            fwrite($txtfile,"$target_file\n");//3
            $user=$_SESSION["user"];
            $user.="\n";
            fwrite($txtfile,$user);//4
            fwrite($txtfile,"\n");//5 likes 
            fwrite($txtfile,"\n");//6 comments
            $usermsg= "The file has been uploaded.";
        } else {
            $usermsg= "Sorry, there was an error uploading your file.";
        }
    }
}

?>

<?php
require 'masterHead.php';
?>
    <div id="content">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            Title:
            <input type="text" autocomplete="off" name="title" required> <br /><br />
            Select image to upload:<br />
            <input class="tfbutton"autocomplete="off" type="file" name="fileToUpload" id="fileToUpload">
            <br /><br />
            <input class="tfbutton" type="submit" value="Upload Image" name="submit">
        </form>
        <?php
        
        if(isset($usermsg))
            echo $usermsg;
        ?>
    </div>

<?php
require 'masterFoot.php';
?>