<?php
require_once('../database_con.php');
$id=$_GET["id"];

$con->query('delete from project_materials where id='.$id);
$con->close();
header('location:assign_material_list.php');


?>