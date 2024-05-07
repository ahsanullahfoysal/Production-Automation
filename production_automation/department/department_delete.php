<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM departments WHERE id=$id");
    $con->close();
    header("location: department_list.php");
    

?>