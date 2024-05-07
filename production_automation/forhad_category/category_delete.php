<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM category WHERE id=$id");
    $con->close();
    header("location: category_list.php");
    

?>