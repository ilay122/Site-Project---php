<?php
session_start();
session_destroy();
header("Location: http://localhost:12345/index.php");
die();
?>