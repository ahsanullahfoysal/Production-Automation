<?php
$id = $_GET['id'];
require_once('../database_con.php');
$pidq = $con->query("select project_id as pid from orders where id=$id")->fetch_assoc();
$pid = $pidq["pid"];
$result=$con->query("SELECT * FROM processing_steps WHERE project_id=$pid;");

$data=$result->fetch_all(MYSQLI_ASSOC);

header('Content-Type: application/json;');
echo json_encode($data);
?>