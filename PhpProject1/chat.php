<?php
session_start();
if(!isset($_SESSION["user"])){
    header("Location: http://localhost:12345/notallowed.php");
    die();
}
?>

<html>
    <head>
        <title> Chat </title>
        <script src="jquery-1.10.2.js"></script>
        <script src="jquery-ui.js"></script>
        
        <style type="text/css">
            .chat_wrapper {
                    width: 500px;
                    margin-right: auto;
                    margin-left: auto;
                    background: #CCCCCC;
                    border: 1px solid #999999;
                    padding: 10px;
                    font: 12px 'lucida grande',tahoma,verdana,arial,sans-serif;
            }
            .chat_wrapper .message_box {
                    background: #FFFFFF;
                    height: 150px;
                    overflow: auto;
                    padding: 10px;
                    border: 1px solid #999999;
            }
            .chat_wrapper .panel input{
                    padding: 2px 2px 2px 5px;
            }
            .system_msg{color: #BDBDBD;font-style: italic;}
            .user_name{font-weight:bold;}
            .user_message{color: #88B6E0;}
    </style>
    </head>
    <?php 
        $colours = array('007AFF','FF7000','FF7000','15E25F','CFC700','CFC700','CF1100','CF00BE','F00');
        $user_colour = array_rand($colours);
    ?>
    <body>
        <div class="chat_wrapper">
            <div class="message_box" id="message_box"></div>
            <div class="panel">
                
                <input type="text" name="message" id="message" placeholder="Message" maxlength="80" style="width:60%" />
                
                <button id="send-btn">Send</button>
            </div>
        </div>
    </body>

    <script>
        $(document).ready(function(){
        var wsUri = "ws://213.57.154.27:13579/server.php";   //ip of server
        websocket = new WebSocket(wsUri); 

        websocket.onopen = function(ev) { // 
            $('#message_box').append("<div class=\"system_msg\">Connected!</div>"); 
        }
        $(document).keypress(function (e) {
         var key = e.which;
            if(key == 13){      
                 $('#send-btn').click();
                return false;  
             }
        }); 
        
        $('#send-btn').click(function(){  
            var mymessage = $('#message').val(); 
            var myname = '<?php echo $_SESSION["user"]?>';
            mymessage = $("<div>").text(mymessage).html();

            if(mymessage == ""){ //emtpy message?
                alert("Enter Some message Please!");
                return;
            }

            
            var msg = {
            message: mymessage,
            name: myname,
            color : '<?php echo $colours[$user_colour]; ?>'
            };
            //convert and send data to server
            websocket.send(JSON.stringify(msg));
            $('#message').val(''); 
        });

        //#### Message received from server?
        websocket.onmessage = function(ev) {
            var msg = JSON.parse(ev.data); 
            var type = msg.type; 
            var umsg = msg.message; 
            var uname = msg.name; 
            var ucolor = msg.color; 

            if(type == 'usermsg') 
            {
                $('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
            }
            if(type == 'system')
            {
                $('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
            }
            
            var elem = document.getElementById('message_box');
            elem.scrollTop = elem.scrollHeight;
            
            
        };
        websocket.onerror   = function(ev){$('#message_box').append("<div class=\"system_error\">Error Occurred - "+ev.data+"</div>");}; 
        websocket.onclose   = function(ev){$('#message_box').append("<div class=\"system_msg\">Connection Closed</div>");}; 
});
    </script>
</html>