<?php
$id = $_GET['id'];
require_once('../database_con.php');
$result=$con->query("select shipping.invoice_id from shipping where order_id=$id")->fetch_assoc();
$data=$result['invoice_id'] ;


header('Content-Type: application/json;');
echo json_encode($data);
?>