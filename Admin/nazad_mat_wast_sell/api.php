<?php
$id = $_GET['id'];
$con=new mysqli("localhost","root","","production_automation");
// $result=$con->query("select * from material_wastage where material_id=$id");
$result=$con->query("select sum(quantity) from material_wastage where material_id=$id")->fetch_assoc();
$data=$result['sum(quantity)'] ;



header('Content-Type: application/json;');
echo json_encode($data);
?>