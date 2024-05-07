<?php
session_start();
unset($_SESSION["login"]);
unset($_SESSION["email"]);
unset($_SESSION["name"]);
header("Location:index.php");
?>