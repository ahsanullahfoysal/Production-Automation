<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM orders WHERE id=$id");
    $con->close();
    header("location: orders_list.php");
    

?>