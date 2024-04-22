<?php
require_once('../header.php');
//$con = new mysqli('localhost', 'root', '', 'production_automation');
$unit=$con->query("SELECT * FROM units ");
$order=$con->query("SELECT * FROM orders ");


?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" >
                <div class="col-sm-6">
                    <h1>Finished Product Management</h1>
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
        <script>
            function validation(){
                let order = document.getElementById("order_id").value.trim()
                let quantity = document.getElementById("quantity").value.trim()
                let unit = document.getElementById("unit_id").value.trim()
                let date = document.getElementById("date").value.trim()
                if (order !=="" &&  quantityc !=="" && unit !=="" && date !==""){
                    return true;
                }else{
                    document.getElementById("error").innerHTML="All fields are required"
                    document.getElementById("error").style.color="red"
                    return false;
                }
            }
        </script>
        <?php if(isset($_POST["submit"])){
            $order=$_POST['order_id'];
            $quantity=$_POST['quantity'];
            $unit=$_POST['unit_id'];
            $date=$_POST['date'];
            $con->query("INSERT INTO `finished_product`(`order_id`, `quantity`, `unit_id`, `date`) VALUES ('$order','$quantity','$unit','$date')");
            ?>
            <script>
                window.location.assign("finished_product_list.php")
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
            <form action="" method="post" onsubmit=" return validation()">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Order</label>
                                <div>
                                
                                <select name="order_id" id="order_id" class="form-control">
                                    <option value="">Select one</option>
                                    <?php while($ord = $order->fetch_assoc() ){ ?>
                                    <option value="<?php echo $ord['id'] ?>"><?php echo $ord['id'] ?></option>
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
                    <button type="submit" name="submit" class="btn btn-primary">Insert</button>
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