<?php
$id=$_GET["id"];
$con = new mysqli('localhost', 'root', '', 'production_automation');
$ship = $con->query("delete from shipping where id=$id");
header("Location:shipping_list.php")
?>