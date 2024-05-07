<?php
require_once('../database_con.php');
$id=$_GET['id'];

$con->query("delete from material_wastage where id=$id");
$con->close();
header("location:material_wastage_list.php");

?>