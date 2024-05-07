<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM units WHERE id=$id");
    $con->close();
    header("location: unit_list.php");
    

?>