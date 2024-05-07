<?php
$i = $_GET['id'];
require_once('../database_con.php');
$query = $con->query('delete from purchase where id='.$i);
header('Location: purchase_list.php');
?>