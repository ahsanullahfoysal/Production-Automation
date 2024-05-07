<?php
// $con=new mysqli('localhost','root','','production_automation');
require_once('../database_con.php');
$id=$_GET['id'];
$data=$con->query("select purchase.*,raw_materials.name from purchase join raw_materials on purchase.material_id=raw_materials.id where invoice_id=$id")->fetch_all(MYSQLI_ASSOC);
header("Content-Type:Application/json");
echo json_encode($data);