<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM users WHERE id=$id");
    $con->close();
    header("location: users_list.php");
    

?>
