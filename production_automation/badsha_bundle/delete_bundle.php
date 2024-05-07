<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM bundles WHERE id=$id");
    $con->close();
    header("location: bundle_list.php");
?>