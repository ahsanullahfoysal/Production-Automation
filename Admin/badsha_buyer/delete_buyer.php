<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM buyers WHERE id=$id");
    $con->close();
    header("location: buyer_list.php");
    
?>