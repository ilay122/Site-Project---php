<?php
session_start();
error_reporting(0);
if(!isset($_SESSION["admin"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>
<?php
require 'masterHead.php';
?>
<div id="content">
    <?php
    $connection = mysql_connect('localhost', 'root', ''); 
    mysql_select_db('test');
    
    $query = "SELECT * FROM `protable`"; 
    $result = mysql_query($query);
    
    echo "<table border='1'>"; 
    
    echo "<th>Username</th>";
    echo "<th>Password</th>";
    echo "<th>Email </th>";
    echo "<th>is Admin </th>";
    echo "<th> Submit</th>";
    echo "<th> Delete</th>";
    while($row = mysql_fetch_array($result)){   
        echo "<form action='updatestuff.php' method='post'>";
        
        echo "<tr>";
       
        echo "<td> <input type='text' name='username' value='".$row["userN"]."' /></td>";
        echo "<td><input type='text' name='password' value='".$row["userP"]."' /> </td>";
        echo "<td><input type='text' name='email' value='".$row["email"]."' /> </td>";
        
        if($row["isadmin"]==="true"){
            echo "<td><input type='checkbox' name='isadmin' value='true' checked /> </td>";
        }
        else{
            echo "<td><input type='checkbox' name='isadmin' value='true'/> </td>";
        }
        
        echo "<td><button name='submit' value='" . $row[userN] . "' type='submit' class='tfbutton'>Submit</button> </td>";
        echo "<td><button name='delete' value='" . $row[userN] . "' type='submit' class='tfbutton'>Delete</button> </td>";
        echo "</tr>";
        
        echo "</form>";
    }
    echo "</table>";
    echo "</br />";
    if(isset($_SESSION["write"])){
        echo $_SESSION["write"];
        $_SESSION["write"]=null;
    }
    ?>
</div>

<?php
require 'masterFoot.php';
?>