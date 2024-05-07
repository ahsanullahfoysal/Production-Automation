<?php
$id_a=$_POST['id_a'];
require_once('../database_con.php');
$data = $con->query('select orders.*,projects.name FROM orders JOIN projects ON orders.project_id=projects.id WHERE orders.id='.$id_a)->fetch_assoc();
header('Content-Type:Application/json');
echo json_encode($data);


?>