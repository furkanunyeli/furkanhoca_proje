<?php
require ("ayar.php");
session_start();
setcookie("rememberuser","", time() - (60*60),"/");
setcookie("rememberpass","", time() - (60*60),"/");
session_destroy();
redirect("../../index.php");
?>
