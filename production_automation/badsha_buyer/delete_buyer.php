<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM buyers WHERE id=$id");
    $con->close();
    header("location: buyer_list.php");
    
?>