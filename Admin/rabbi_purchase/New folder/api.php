<?php
$id = $_GET['id'];
$con=new PDO('mysql:host=localhost;dbname=production_automation','root','');
$result=$con->query("select * from raw_materials where id=$id");

$data=$result->fetch(PDO::FETCH_ASSOC);

header('Content-Type: application/json;');
echo json_encode($data);
?>