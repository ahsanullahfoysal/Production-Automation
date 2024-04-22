<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM users WHERE id=$id");
    $con->close();
    header("location: orders_list.php");
    

?>