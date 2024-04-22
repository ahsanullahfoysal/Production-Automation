<?php
$con = new mysqli('localhost', 'root', '', 'production_automation');
$id=$_GET['id'];
$delete_transfer=$con->query('delete from transfers where id='.$id);
$con->close();
header('location: transfers.php');
?>