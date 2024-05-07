<?php
$i = $_GET['id'];
require_once('../database_con.php');
$query = $con->query('delete from purchase where invoice_id='.$i);
header('Location: purchase_list2.php');
?>