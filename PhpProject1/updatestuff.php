<?php
session_start();
@mysql_connect("localhost","root","") or die("could not connect");
mysql_select_db("test");

if(isset($_POST["delete"])){
    $where=$_POST["delete"];
    $where=htmlspecialchars($where, ENT_QUOTES);
    $query="DELETE FROM `protable` WHERE userN='$where'";
    mysql_query($query);
    $_SESSION["write"]="user deleted !";
    
}
else if(isset($_POST["submit"])){
    $where=$_POST["submit"];
    $username=$_POST["username"];
    $password=$_POST["password"];
    $email=$_POST["email"];
    $admin="";
    
    $password=htmlspecialchars($password, ENT_QUOTES);
    $where=htmlspecialchars($where, ENT_QUOTES);
    $email=htmlspecialchars($email, ENT_QUOTES);
    $username=htmlspecialchars($username, ENT_QUOTES);
    
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
