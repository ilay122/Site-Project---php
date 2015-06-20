<?php
error_reporting(0);
session_start();
if(isset($_SESSION["user"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
if(isset($_POST['submit'])) {
    
    @mysql_connect("localhost","root","") or die("could not connect");
    mysql_select_db("test");
    $username=$_POST["username"];
    $password=$_POST["password"];
    
    $password=htmlspecialchars($password, ENT_QUOTES);
    $username=htmlspecialchars($username, ENT_QUOTES);

    $query="SELECT * FROM `protable` WHERE userN='$username' AND userP='$password'";
    $bla=mysql_query($query);
    $result= mysql_num_rows($bla);
    if($result>0){
        session_start();
        $_SESSION["user"]=$username;
        $row=mysql_fetch_row($bla);
        if($row[3] ==="true"){
            $_SESSION["admin"]="ye y no";
        }
        header("Location: http://localhost:12345/index.php");
        die();
    }
    else{
        $error="<p style='color:red'>username not found.</p> <br />";
    }
}


?>

<?php
require 'masterHead.php';
?>
    <div id="content">
        <form action="" id="login" method="post">
            ID number <input type="text" name="username" id="idNum" autocomplete="off" /><br />
            Password &nbsp <input type="password" name="password" id="password"  autocomplete="off" /> <br />
            <input type="submit" value="Submit" name="submit"class="tfbutton" />

        </form>
        <?php
        if(isset($error)){
            echo $error;
        }
        ?>
    </div>

<?php
require 'masterFoot.php';
?>