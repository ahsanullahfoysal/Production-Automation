<?php
$con = new mysqli('localhost', 'root', '', 'production_automation');
$buyer = $con->query("SELECT buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id ")->fetch_all(MYSQLI_ASSOC);
echo "<pre>";
print_r($buyer);