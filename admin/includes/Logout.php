<?php
session_destroy();
//include("../config.php");
//session_start();
unset($_SESSION["myusername"]);
header("Location: " . $base_url ."/admin/login.php");
?>
