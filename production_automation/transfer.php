<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With");
require_once('database_con.php');
$data = json_decode(file_get_contents('php://input'), true);

$code=$data['bundle_code'];
$id=$_GET['machine_id'];

$bquery="select * from bundles where bundle_code='$code'";
$bundle=$con->query($bquery)->fetch_assoc();
$order_id=$bundle['order_id'];
$bundle_id=$bundle['id'];


$wquery="select * from worker_assign where machine_id =$id and order_id=$order_id";
$worker=$con->query($wquery)->fetch_assoc();
$processing_steps_id =$worker['processing_steps_id'];
// echo json_encode($worker,true);exit;

$transfer=$con->query("select * from transfers where order_id=$order_id and bundle_id=$bundle_id and processing_steps_id=$processing_steps_id")->fetch_all();
$time=date('Y-m-d h:i:s');
if(count($transfer)==0){
    $con->query("insert into transfers(order_id,bundle_id,processing_steps_id,received_date)value($order_id,$bundle_id,$processing_steps_id,'$time')");
}else{
    $con->query("update transfers set transfer_date='$time' where order_id=$order_id and bundle_id=$bundle_id and processing_steps_id=$processing_steps_id");
}
echo json_encode($data,true);