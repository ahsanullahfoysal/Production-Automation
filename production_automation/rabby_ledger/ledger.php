<?php
require_once("../header.php");
$buyername = $con->query("SELECT b.id, b.company_name FROM orders o JOIN buyers b ON o.buyer_id=b.id JOIN buyer_payment bp ON o.buyer_id=bp.buyer_id GROUP BY b.company_name;")->fetch_all(MYSQLI_ASSOC);
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyer Ledger</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buyer Ledger</li>
                    </ol>
                </div>
            </div>
            <!-- date here -->

            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Buyer Ledger</h3>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Name</th>
                                    <th>Payable</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th style="width: 220px">Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($buyername as $i => $p) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $p['company_name'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $buyer_id = $p['id'];
                                            $payable = $con->query("SELECT SUM(o.quantity*o.rate) as payable FROM buyers b JOIN orders o ON b.id=o.buyer_id WHERE b.id=$buyer_id;")->fetch_assoc()['payable'];
                                            echo (int)$payable;
                                            ?>
                                        </td>
                                        <td>
                                            <?php
                                            $paid = $con->query("SELECT SUM(amount) as paid FROM buyer_payment WHERE buyer_id=$buyer_id;")->fetch_assoc()['paid'];
                                            echo (int)$paid;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo ($payable - $paid) ?>
                                        </td>
                                        <td>
                                            <a href="ledger_view.php?id=<?php echo $buyer_id ?>"
                                                class="btn btn-primary btn-sm" target="_blank">View Ledger</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>