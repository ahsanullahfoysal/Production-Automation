<?php
require_once('../database_con.php');
$id=$_GET['id'];
$delete_transfer=$con->query('delete from transfers where id='.$id);
$con->close();
header('location: transfers.php');
?>