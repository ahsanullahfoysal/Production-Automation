<?php
$id=$_GET["id"];
require_once('../database_con.php');
$ship = $con->query("delete from finished_product where id=$id");
header("Location:finished_product_list.php")
?>