<?php
$id=$_GET["id"];
require_once('../database_con.php');
$ship = $con->query("delete from shipping where id=$id");
header("Location:shipping_list.php")
?>