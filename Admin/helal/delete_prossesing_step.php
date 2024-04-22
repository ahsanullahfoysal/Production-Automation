<?php
$con = new mysqli('localhost', 'root', '', 'production_automation');
$id=$_GET['id'];
$p_id=$con->query('select * FROM `processing_steps` where id='.$id)->fetch_assoc();
$p_idd=($p_id['project_id']) ;
$delete_project_step=$con->query('DELETE FROM `processing_steps` WHERE id='.$id);
$con->close();
header('location: edit_project.php?id='.$p_idd );
?>