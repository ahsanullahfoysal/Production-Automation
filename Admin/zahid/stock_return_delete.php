<?php 
$con = new mysqli('localhost', 'root', '', 'production_automation');
$id=$_GET['id'];
$con->query("delete from stock_return where id=$id");
$con->close();
header('location: stock_return_list.php');