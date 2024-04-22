<?php
$code=$_GET["code"];
$con=new mysqli("localhost","root","","production_automation");
$bundle=$con->query("SELECT bundles.*,buyers.company_name from bundles join orders on orders.id=bundles.order_id join buyers on buyers.id=orders.buyer_id  where bundle_code='$code' ")->fetch_assoc();

$_id=$bundle['order_id'];

$order=$con->query("SELECT processing_steps.title,processing_steps.project_id,worker_assign.order_id FROM processing_steps JOIN worker_assign ON processing_steps.id=worker_assign.processing_steps_id Where worker_assign.order_id='$_id'")->fetch_assoc();
$p_id=$order['project_id'];
$p=$con->query("select projects.name from projects where id='$p_id'")->fetch_assoc();

$plus= [$bundle,$p,$order];
header('Content-type:application/json');
echo json_encode($plus,true);
?>
