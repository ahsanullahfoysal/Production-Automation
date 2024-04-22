<?php
    $con = new mysqli('localhost', 'root', '', 'production_automation');
    $id=$_GET['id'];
    $con->query("DELETE FROM departments WHERE id=$id");
    $con->close();
    header("location: department_list.php");
    

?>