<?php
$con = new mysqli('localhost', 'root', '', 'production_automation');
$id = $_GET['id'];
$delete = $con->query("delete from buyer_payment where id=$id");
// $con->close();


?>
<script>
    window.location.assign('buyer_pay_list.php')
</script>