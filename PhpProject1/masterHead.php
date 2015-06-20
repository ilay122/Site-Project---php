<?php
session_start();
$ProtectedLink="";
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>PEGS ARE GODS</title>
    <meta charset="UTF-8" />
    <link href="StyleSheet1.css" rel="stylesheet" />
    <link rel="shortcut icon" href="http://cdn.akamai.steamstatic.com/steamcommunity/public/images/avatars/0f/0fb7149773d3533ca7486cc162b2193152770789.jpg" />
    <script src="jquery-1.10.2.js"></script>
    <script src="jquery-ui.js"></script>
    <script src="dropit.js"></script>
    <script>
        function myFunction() {
            window.open("http://localhost:12345/chat.php", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=500, left=500, width=400, height=400");
        };
        function func() {
            alert('You have found a secret ! if you are on the main page drag the pictures !');
            $(".mainpagepic").draggable();
        }
        $(document).ready(function () {
            /* drop menu */
            $('.menu').dropit();
            $("#pictures img").addClass('mainpagepic');

            /* time && date updating every second */
            window.setInterval(function () {
                var clock = new Date();
                var mintues = clock.getMinutes();
                var hours = clock.getHours();
                var seconds = clock.getSeconds();

                if (mintues < 10)
                    mintues = "0" + mintues;
                if (hours < 10)
                    hours = "0" + hours;
                if (seconds < 10)
                    seconds = "0" + seconds;

                var now = clock.getDate() + "/" + clock.getMonth() + 1 + "/" + clock.getFullYear() + " " + hours + ":" + mintues + ":" + seconds;
                document.getElementById("date").innerHTML = now;
            }, 1000);
            /* end of time updating*/

            //$(".mainpagepic").draggable();

        });
    </script>
</head>
<body>
    <div id="header">
        <!--header-->
        <img src="Images/imglogo.png" id="logo" />
        <div id="nav">
            <ul class="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../about.php">About</a></li>
                <li><a href="../support.php">Supporting Sites</a></li>
                <?php
                if(isset($_SESSION['user'])){
                    $ProtectedLink = "<li> <a href='../logout.php'> Logout </a> </li>";
                    $ProtectedLink .= "<li> <a href='../upload.php'> Upload Pics </a> </li>";
                }
                else{
                    $ProtectedLink = "<li> <a href='../login.php'> Login</a> </li>";
                    $ProtectedLink.="<li> <a href='../register.php'> Register </a> </li>";
                }
                echo ($ProtectedLink);
                ?>
                <li class="dropit-trigger dropit-open">
                    <a href="#">More</a>
                    <ul class="dropit-submenu">
                        <li><a href="../news.php">News</a></li>
                        <?php
                        
                            if(isset($_SESSION["admin"])){
                                echo"<li> <a href='../insertnews.php'>Adding News </a> </li>";
                                echo"<li> <a href='../adminstuff.php'>Admin Panel </a> </li>";
                            }
                            if(isset($_SESSION["user"])){
                                echo "<li><a href='#' onclick='myFunction()'> Chat</a> </li>";
                            }
                        ?>
                        
                    </ul>
                </li>
                <li>
                    <form method="get" action="http://lmgtfy.com/" id="search1">
                        <input type="text" name="abcd" size="21" maxlength="120" required placeholder="Google Search" />
                        <input type="submit" value="search" class="tfbutton" />
                    </form>
                </li>
            </ul>
        </div>
    </div>
    



 