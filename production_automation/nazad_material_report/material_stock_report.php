<?php
require_once('../header.php');
$product = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
?>
<script>
    $(document).ready(function () {

        $('#formValidation').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true,
                }
            }
        });

    });
</script>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Stock Report</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="container card">
            <div class="card-header">
                <h2 class="card-title">Report Details</h2>
            </div>
            <div class="h3 text-bold">Today</div>
            <div class="h3 text-bold">
                <?php $now = date("Y-m-d");
                echo $now; ?>
            </div>
            <div class="text-left">
                <?php
                $eerror = "";
                if (isset($_POST['submit'])) {
                    $name = $_POST['name'];
                    $product = $con->query("select * from raw_materials where name='$name'
                    ")->fetch_all(MYSQLI_ASSOC);
                } ?>
                <form action="" method="post">
                    <div class="d-flex float-sm-left">
                        <div>
                            <label class="btn btn-info">Search</label>
                        </div>
                        <div>
                            <input type="text" name="name" class="form-control" id="name"
                                value="<?php if (isset($name)) {
                                    echo $name;
                                } ?>" placeholder="product name" required>
                            <span style="color:red" id="e_error">
                                <?php echo $eerror; ?>
                            </span>
                        </div>
                        <div class="width-100%">
                            <input class="btn btn-secondary" type="submit" class="form-control" name="submit"
                                value="Search">
                        </div>

                    </div>




                </form>
            </div>
            <table class="table table-bordered table-primary table-striped">
                <thead>
                    <tr class="">
                        <th style="width: 10px">SL</th>
                        <th>Product_Name</th>
                        <th>purchase Quantity</th>
                        <th>Wastage</th>
                        <th>Return</th>
                        <th>Available</th>
                        <th> Unit price</th>

                        <th>Total Value</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>

                    <?php


                    $price = 0;
                    $quantity = 0;
                    $total = 0;
                    foreach ($product as $ui => $ul) { ?>
                        <tr>
                            <td>
                                <?php echo ++$ui ?>
                            </td>
                            <td>
                                <?php echo $ul['name'] ?>
                            </td>
                            <td>
                                <?php //echo round($ul['quantity']) ?>
                                <?php $sum = $con->query("SELECT sum(quantity) from purchase where material_id=" . $ul['id'])->fetch_assoc();
                                echo round($sum['sum(quantity)']);

                                ?>
                            </td>
                            <td>
                                <?php //echo round($ul['mat']) ?>
                                <?php $sum1 = $con->query("SELECT sum(quantity) from material_wastage where material_id=" . $ul['id'])->fetch_assoc();
                                echo round($sum1['sum(quantity)']);

                                ?>
                            </td>
                            <td>
                                <?php //echo round($ul['stock']) ?>
                                <?php $sum2 = $con->query("SELECT sum(quantity) from stock_return where material_id=" . $ul['id'])->fetch_assoc();
                                echo round($sum2['sum(quantity)']);

                                ?>
                            </td>
                            <td>
                                <?php echo round($sum['sum(quantity)']) - round($sum1['sum(quantity)']) - round($sum2['sum(quantity)']) ?>
                                <?php $quantity = (round($sum['sum(quantity)']) - round($sum1['sum(quantity)']) - round($sum2['sum(quantity)'])) ?>

                            </td>

                            <td>
                                <?php echo round($ul['price']) ?>
                                <?php $price = round($ul['price']) ?>
                            </td>
                            <td>
                                <?php echo $price * $quantity ?>
                                <?php $total += $price * $quantity ?>



                            </td>
                            <td><a class="btn btn-primary"
                                    href="material_report.php?id=<?php echo $ul['id'] ?>&name=<?php echo $ul['name'] ?>">Details</a>
                            </td>
                        </tr>

                        <?php
                    } ?>

                    <tr>
                        <td colspan="7" style="text-align:right">Total Price</td>
                        <td>
                            <?php echo $total ?>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->
<?php

require_once('../footer.php')
    ?>