<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM units WHERE id=$id");
    $con->close();
    header("location: unit_list.php");
    

?>