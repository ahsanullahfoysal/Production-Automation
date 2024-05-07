<?php
require_once('../database_con.php');
$id= $_GET['id'];
$query=$con->query("delete from supplier_payment where id=$id");
$con->close();
header('location: supplier_payment_list.php');
?>