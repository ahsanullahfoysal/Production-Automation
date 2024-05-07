<?php
require_once('../header.php');
$id=$_GET["id"];
$ship = $con->query("select * from shipping where id=$id")->fetch_assoc();

$unit=$con->query("SELECT * FROM units ");
$order=$con->query("SELECT * FROM orders ");
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="background:blue;color:white">
                <div class="col-sm-6">
                    <h1>Shipping details</h1>
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
            $con->query("UPDATE `shipping` SET `order_id`='$order',`quantity`='$quantity',`unit_id`='$unit',`date`='$date' WHERE id=$id");
            ?>
            <script>
                window.location.assign("shipping_list.php")
            </script>
            <?php
        } ?>

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Shipping</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" id="formValidation">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order Id</label>
                                <div>
                                
                                <select name="order_id" id="order_id">
                                    <option value="">Select one</option>
                                    <?php while($ord = $order->fetch_assoc() ){ ?>
                                    <option value="<?php echo $ord['id'] ?>"<?php if($ord['id']==$ship['order_id']){
                                        echo "selected";
                                    } ?>><?php $buye=$con->query("select * from buyers where id=".$ord['buyer_id'])->fetch_assoc() ; echo $buye['company_name'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity"
                                    placeholder="Enter quantity" value="<?php echo round($ship['quantity']) ?>" >
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">unit Id</label>
                                <div>
                                
                                <select name="unit_id" id="unit_id">
                                    <option value="">Select one</option>
                                    <?php while($un = $unit->fetch_assoc() ){ ?>
                                    <option value="<?php echo $un['id'] ?>"<?php if($un['id']==$ship['unit_id']){echo "selected";} ?>><?php echo $un['name'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="datetime" name="date" class="form-control" id="date" value="<?php echo  $ship['date'];  ?>" >
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <span id="error" ></span>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
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