<?php
session_start();
session_destroy();
setcookie("rester_connecte", "", time());
header("location: index.html");
?>