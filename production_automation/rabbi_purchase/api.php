<?php
$id = $_GET['id'];
require_once('../database_con.php');
$result=$con->query("select * from raw_materials where id=$id");

$data=$result->fetch_assoc();

header('Content-Type: application/json;');
echo json_encode($data);
?>