<?php
require_once('../database_con.php');
$id = $_GET['id'];
$delete = $con->query("delete from error_reports where id=$id");
// $con->close();


?>
<script>
    window.location.assign('error_report_list.php')
</script>