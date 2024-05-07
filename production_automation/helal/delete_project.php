<?php
require_once('../database_con.php');
$id=$_GET['id'];
$delete_project=$con->query('delete from projects where id='.$id);
$con->close();
header('location: project_manage.php');
?>