<?php
session_start();
unset($_SESSION["user"]);
header("refresh:2; url=index.php");
echo "YOU ARE NOW LOGGED OUT";
?>