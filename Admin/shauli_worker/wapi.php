<?php
$id = $_GET['id'];
$con=new PDO('mysql:host=localhost;dbname=production_automation','root','');
$pidq = $con->query("select project_id as pid from orders where id=$id")->fetch(PDO::FETCH_ASSOC);
$pid = $pidq["pid"];
$result=$con->query("SELECT * FROM processing_steps WHERE project_id=$pid;");

$data=$result->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json;');
echo json_encode($data);
?>