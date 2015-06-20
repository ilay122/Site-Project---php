<?php

$ProtectedLink="";
?>
   <!--/content-->
    <div id="footer">
        <!--footer-->
        <table>
            <tr>
                <td>

                    <a href="index.php">Home</a>
                </td>
                <td>
                    <a href="about.php">About</a>
                </td>

                <td>
                    <a href="support.php">Supporting Sites</a>
                </td>


                <?php
                if(isset($_SESSION['user'])){
                    $ProtectedLink = "<td> <a href='../logout.php'> Logout </a> </td>";
                    $ProtectedLink .= "<td> <a href='../upload.php'> Upload Pics </a> </td>";
                    if(!isset($_SESSION["admin"])){
                        $ProtectedLink.="<td> <b> you are connected to :".$_SESSION['user']." </b></td>";
                    }
                    else{
                        $ProtectedLink.="<td> <b> you are connected to :".$_SESSION['user']. "(admin) </b></td>";
                    }
                }
                else{
                    $ProtectedLink = "<td> <a href='../login.php'> Login</a> </li>";
                    $ProtectedLink.="<td> <a href='../register.php'> Register </a> </td>";
                    $ProtectedLink.="<td>you are not connected</td>";
                }
                echo ($ProtectedLink);
                ?>

                <td>
                    <p id="date"></p>
                </td>
                <td>
                    <button onclick="func()"></button>
                </td>
            </tr>
        </table>
    </div>
    <!--footer-->
    </div>
    </div>
</body>
</html>
