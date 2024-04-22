<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM suppliers WHERE id=$id");
    $con->close();
    header("location: supplier_list.php");
    

?>