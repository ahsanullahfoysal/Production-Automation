<?php
$id=$_GET["id"];
$con = new mysqli('localhost', 'root', '', 'production_automation');
$ship = $con->query("delete from material_wastage_sale where id=$id");
header("Location:mat_was_sel_list.php")
?>