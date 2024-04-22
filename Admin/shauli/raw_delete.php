<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM raw_materials WHERE id=$id");
    $con->close();
    header("location: raw_list.php");
    

?>