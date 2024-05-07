<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM suppliers WHERE id=$id");
    $con->close();
    header("location: supplier_list.php");
    

?>