<?php
$id=$_GET["id"];
$con = new mysqli('localhost', 'root', '', 'production_automation');
$ship = $con->query("delete from finished_product where id=$id");
header("Location:finished_product_list.php")
?>