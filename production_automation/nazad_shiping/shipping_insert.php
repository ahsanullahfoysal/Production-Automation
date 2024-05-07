<?php
require_once('../header.php');
//require_once('../database_con.php');
$unit=$con->query("SELECT * FROM units ");
$order=$con->query("SELECT * FROM orders ");

//$shipping = $con->query("INSERT INTO `shipping`(`order_id`, `quantity`, `unit_id`, `date`) VALUES ('','','','')")
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shipping</h1>
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
            <script type="text/javascript">
                 $(document).ready(function () {
                    $('#formValidation').validate({ // initialize the plugin
                        rules: {
                            date: {
                                required: true,
                            },
                            quantity: {
                                required: true,
                                minlength: 1
                            },
                            unit_id: {
                                required: true,
                                minlength: 1
                            },
                            order_id: {
                                required: true,
                                minlength: 1
                            },
                        }
                    });

                });
        </script>
        <?php if(isset($_POST["submit"])){
            $order=$_POST['order_id'];
            $quantity=$_POST['quantity'];
            $unit=$_POST['unit_id'];
            $date=$_POST['date'];
            $invoice=rand(1, 999999999);
            $con->query("INSERT INTO `shipping`(`invoice_id`,`order_id`, `quantity`, `unit_id`, `date`) VALUES ('$invoice','$order','$quantity','$unit','$date')");
            ?>
            <script>
                window.location.assign("shipping_list.php")
            </script>
            <?php
        } ?>

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Products</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" id="formValidation" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Buyer</label>
                                <div>
                                
                                <select name="order_id" id="order_id" class="form-control">
                                    <option value="">Select one</option>
                                    <?php while($ord = $order->fetch_assoc() ){ ?>
                                    <option value="<?php echo $ord['id'] ?>"><?php $buye=$con->query("select * from buyers where id=".$ord['buyer_id'])->fetch_assoc() ; echo $buye['company_name'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity"
                                    placeholder="Enter quantity">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Unit</label>
                                <div>
                                
                                <select name="unit_id" id="unit_id" class="form-control">
                                    <option value="">Select one</option>
                                    <?php while($un = $unit->fetch_assoc() ){ ?>
                                    <option value="<?php echo $un['id'] ?>"><?php echo $un['name'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" name="date" class="form-control" id="date" placeholder="Enter date">
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <span id="error" ></span>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>


<!-- /.content-wrapper -->
<?php

require_once('../footer.php')
    ?>