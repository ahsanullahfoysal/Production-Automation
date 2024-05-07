<?php
require_once('database_con.php');
$order = $con->query("select orders.*,projects.name FROM orders JOIN projects ON orders.project_id=projects.id ")->fetch_all(MYSQLI_ASSOC);

echo "<pre>";
print_r( $order );