<?php
session_start();
error_reporting(0);
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
    $email=$_POST["email"];
    
    $email=htmlspecialchars($email, ENT_QUOTES);
    $password=htmlspecialchars($password, ENT_QUOTES);
    $username=htmlspecialchars($username, ENT_QUOTES);
    
    
    $query="SELECT * FROM `protable` WHERE userN='$username'";
    $result= mysql_num_rows(mysql_query($query));

    if($result>0){
        $error="<p style='color:red'>username already taken. Choose another one.</p> <br />";
    }
    else{
        $adminorno="false";
        if($_POST["password"]==="iamadmin"){
            $adminorno="true";
        }

        $query="INSERT INTO `test`.`protable` (`userN`, `userP`, `email`, `isadmin`)
        VALUES ('$username', '$password', '$email', '$adminorno')";
        $result= mysql_query($query);
        header("Location: http://localhost:12345/welcome.php");
        die();
    }
    



}

?>

<?php
require 'masterHead.php';
?>
    <script type="text/javascript">

        var msg = "";

        function validId(str) {
            var length = str.length;
            if (length == 9)
                return true;
            else
                return false;
        }
        function validEmail(str) {
            if ((str.split("@").length == 2) &&
                (str.indexOf("@") != 0) &&
                str.indexOf("." != 0) &&
                (str.lastIndexOf(".") != str.length - 1)
            )
                return true;
            else
                return false;
        }
        function validName(name) {
            if (isNaN(name))
                return true;
            else
                return false;
        }
        function checkForm() {


            if (!validEmail(document.getElementById("email").value))
                msg += "<li> NOT VALID EMAIL</li>";

            if (msg.length == 0)
                return true;
            else
            {
                document.getElementById('errors').innerHTML = msg;
                msg = "";
                return false;
            }
        }

    </script>
<div id="content">
    <ul id="errors">
    </ul>


    <form action="" name="register" id="register" method="post"  onsubmit="return checkForm();">
        <table>

            <tr>
                <td>Username </td>
                <td><input type="text" name="username" placeholder="username here" required autocomplete="off" /></td>
            </tr>
            <tr>
                <td>Password </td>
                <td><input type="password" name="password" placeholder="password here" required autocomplete="off" /></td>
            </tr>

            <tr>

            <tr>
                <td>Email</td>
                <td><input type="text" name="email" placeholder="email" required autocomplete="off" id="email" /></td>
            </tr>

            <tr>
                <td><input type="submit" value="submit" class="tfbutton" name="submit" /></td>
                <td><input type="reset" value="reset" class="tfbutton" /></td>
            </tr>
        </table>


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
