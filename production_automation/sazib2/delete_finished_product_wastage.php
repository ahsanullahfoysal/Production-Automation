<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $waste=$con->query("DELETE FROM finished_product_wastage WHERE id=$id");
    $con->close();
    header("location: list_finished_product_wastage.php");
    

?>