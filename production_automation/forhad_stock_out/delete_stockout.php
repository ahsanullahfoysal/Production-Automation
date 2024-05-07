<?php
    require_once('../database_con.php');
    $id=$_GET['id'];
    $con->query("DELETE FROM stock_out WHERE id=$id");
    $con->close();
    header("location: stockout_list.php");