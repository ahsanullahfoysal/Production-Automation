<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM expense WHERE id=$id");
    $con->close();
    header("location: expense_list.php");
    

?>