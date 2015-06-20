<?php
session_start();
@mysql_connect("localhost","root","") or die("could not connect");
mysql_select_db("test");

if(isset($_POST["delete"])){
    $query="DELETE FROM `protable` WHERE userN='".$_POST["delete"]."'";
    mysql_query($query);
    $_SESSION["write"]="user deleted !";
    
}
else if(isset($_POST["submit"])){
    $where=$_POST["submit"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $admin="";
    
    if(isset($_POST["isadmin"])){
        $admin="true";
    }
    else{
        $admin="false";
    }
    $query="UPDATE `protable` SET `userN`='$username',`userP`='$password',`email`='$email',`isadmin`='$admin' WHERE userN='$where'";
    mysql_query($query);
    $_SESSION["write"]="info changed !";
    }
header("Location: http://localhost:12345/adminstuff.php");
die();
?>
