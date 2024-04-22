<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM bundles WHERE id=$id");
    $con->close();
    header("location: bundle_list.php");
?>