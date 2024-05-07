<?php
$id=$_GET["id"];
require_once('../database_con.php');
$ship = $con->query("delete from material_wastage_sale where id=$id");
header("Location:mat_was_sel_list.php")
?>