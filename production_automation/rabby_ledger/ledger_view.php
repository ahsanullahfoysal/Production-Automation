<?php
require_once('../database_con.php');
$buyer_id = $_GET['id'];
$orders = $con->query("SELECT (o.quantity*o.rate) as camount, b.company_name as name FROM buyers b JOIN orders o ON b.id=o.buyer_id WHERE b.id=$buyer_id;")->fetch_all(MYSQLI_ASSOC);

$payment = $con->query("SELECT amount as pay, method as m FROM buyer_payment WHERE buyer_id=$buyer_id;")->fetch_all(MYSQLI_ASSOC);

date_default_timezone_set('Asia/Dhaka');
$currentDate = date('Y-m-d H:i:s');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="col-12 text-center">
            <p class="fw-bold">Payra Limited</p>
            <p>A/10, Block: E,Jakir Hossain Road, Dhaka-1207</p>
            <p>Phone: 01711431632, 01618854501, 01618854502</p>
        </div>
        <div class=" col-12 text-center">
            <h1 class="fw-bold">Customer Ledger</h1>
        </div>
        <div class="row">
            <div class="col-6 text-start">
                <p>Customer Name: <?php echo $orders[0]["name"] ?></p>
            </div>
            <div class="col-6 text-end">
                <p>Date: <?php echo $currentDate; ?></p>
                <p>From Date:</p>
                <p>Thru Date:</p>
            </div>
        </div>
        <div class="row">
            <table class="col-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>SL</th>
                            <th>Date</th>
                            <th>Operation</th>
                            <th class="text-end">Debit Amount</th>
                            <th class="text-end">Credit Amount</th>
                            <th class="text-end">Amount Balance</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- orders -->
                        <?php
                            $abalance = 0;
                            $tcredit = 0;
                            foreach($orders as $o) { 
                            $credit = (int)$o["camount"];
                            $tcredit += $credit;
                            ?>
                        <tr>
                            <td>1</td>
                            <td></td>
                            <td>Invoice</td>
                            <td class="text-end"></td>
                            <td class="text-end"><?php echo $credit ?></td>
                            <td class="text-end"><?php echo $abalance -= $credit; ?></td>
                        </tr>
                        <?php } ?>
                        <!-- payment -->
                        <?php
                            $tpay = 0;
                            foreach($payment as $p) {
                            $pm = $p["pay"];
                            $tpay += $pm;
                            ?>
                        <tr>
                            <td>2</td>
                            <td></td>
                            <td><?php echo $p["m"]; ?></td>
                            <td class="text-end"><?php echo $pm; ?></td>
                            <td class="text-end"></td>
                            <td class="text-end"><?php echo $abalance += $pm; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-end">Taransactional Total</th>
                            <th class="text-end"><?php echo $tpay ?></th>
                            <th class="text-end"><?php echo $tcredit ?></th>
                            <th class="text-end"><?php echo $abalance ?></th>
                        </tr>
                    </tfoot>
                </table>
            </table>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</html>