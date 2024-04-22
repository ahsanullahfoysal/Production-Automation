<?php
$con=new mysqli("localhost","root","","production_automation");
$id=$_GET["id"];

$con->query('delete from project_materials where id='.$id);
$con->close();
header('location:assign_material_list.php');


?>