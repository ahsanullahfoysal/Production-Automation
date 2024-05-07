<?php
require_once("../header.php");
$return = $con->query("SELECT * from return_from_buyer")->fetch_all(MYSQLI_ASSOC);

?>
<div class="content-wrapper" style="min-height: 650px;">

    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="card card-primary">
                <div class="card-body">
                    <div class="row">
                        <div class="card-header" >
                            <h1>Return From Buyer</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-2 offset-8 text-right mb-2">
                            <a href="<?php echo $_SESSION['base_url'] ?>/nazad_return_from_buyer/return_add.php"
                                class="btn btn-warning">Add Return Product</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">

                            <table id="example1" class="table table-bordered table-striped dataTable no-footer"
                                border="1" role="grid" aria-describedby="example1_info">
                                <thead style="background-color: #79a0e0">
                                    <tr role="row">
                                        <th>SL</th>
                                        <th>Date</th>
                                        <th>Return From</th>
                                        <th>Invoice ID</th>
                                        <th>Product Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody id="itembody">
                                    <?php
                                    $rate = '';
                                    $quan = '';
                                    foreach ($return as $i => $v) { ?>
                                        <tr role="row" class="odd">
                                            <td>
                                                <?php echo ++$i ?>
                                            </td>
                                            <td>
                                                <?php echo $v['date'] ?>
                                            </td>
                                            <td>
                                                <?php $name = $con->query("SELECT buyers.company_name FROM buyers JOIN orders ON buyers .id=orders.buyer_id WHERE orders.id=" . $v['order_id'])->fetch_assoc();
                                                echo $name['company_name'] ?>
                                            </td>
                                            <td>
                                                <?php ?>
                                                <?php $invoice = $con->query("select shipping.invoice_id from shipping where order_id=" . $v['order_id'])->fetch_assoc();
                                                echo $invoice['invoice_id'] ?>
                                            </td>
                                            <td>
                                                <?php $pname = $con->query("SELECT projects.name FROM projects JOIN orders ON projects .id=orders.project_id WHERE orders.id=" . $v['order_id'])->fetch_assoc();
                                                echo $pname['name'] ?>
                                            </td>
                                            <td>
                                                <?php $price = $con->query("select orders.rate from orders where id=" . $v['order_id'])->fetch_assoc();
                                                echo $price['rate'];
                                                $rate = round($price['rate']); ?>
                                            </td>
                                            <td>
                                                <?php echo round($v['quantity']);
                                                $quan = round($v['quantity']); ?>
                                            </td>
                                            <td>
                                                <?php echo $rate * $quan ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>
<?php

require_once('../footer.php')
    ?>