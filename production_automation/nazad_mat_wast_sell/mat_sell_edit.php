<?php
require_once('../header.php');
$id=$_GET["id"];
//require_once('../database_con.php');
$ship = $con->query("select * from material_wastage_sale where id=$id")->fetch_assoc();

$raw=$con->query("SELECT * FROM raw_materials ");
$buyer=$con->query("SELECT * FROM secondary_buyer ");
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
    <script>

$(document).ready(function() {

$('#formValidation').validate({ // initialize the plugin
    rules: {
        buyer: {
            required: true,

        },
        quantity: {
            required: true,
        },
        invoice: {
            required: true,
        },
        mat: {
            required: true,
        },

        price: {
            required: true,
        },

        date: {
            required: true,
        },
    }
});
})
        </script>
        <?php if(isset($_POST["submit"])){
            $buyer=$_POST['buyer'];
            $mat=$_POST['mat'];
            $quantity=$_POST['quantity'];
            $invoice=$_POST['invoice'];
            $price=$_POST['price'];
            $date=$_POST['date'];
             //echo $buyer.'-'.$mat.'-'.$quantity.'-'.$invoice.'-'.$price.'-'.$date;
             $con->query("UPDATE `material_wastage_sale` SET `invoice_id`='$invoice',`material_id`='$mat',`price`='$price',`secondary_buyer_id`='$buyer',`quantity`='$quantity',`date`='$date' WHERE id=$id");
            //$con->query("INSERT INTO material_wastage_sale(invoice_id,material_id,price,secondary_buyer_id,quantity,date)VALUES($invoice,$mat,$price,$buyer,$quantity,'$date');");
            ?>
            <script>
                window.location.assign("mat_was_sel_list.php")
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
            <form action="" method="post" onsubmit=" return vvalidation()" id="formValidation" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Secondary Buyer Name</label>
                                <div>
                                
                                <select name="buyer" id="buyer">
                                    <option value="">Select one</option>
                                    <?php while($ord = $buyer->fetch_assoc() ){ ?>
                                    <option value="<?php echo $ord['id'] ?>"<?php if($ord['id']==$ship['secondary_buyer_id']){echo "selected";} ?>><?php echo $ord['name'] ?></option>
                                    <?php } ?>
                                </select>
                                <div id="berror"></div>
                                
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Quantity</label>
                                <input type="text" name="quantity" class="form-control" id="quantity"
                                    placeholder="Enter quantity" value="<?php echo round($ship['quantity']) ?>" >
                            </div>
                            <div id="qerror"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">invoice Id</label>
                                <input type="text" name="invoice" class="form-control" id="invoice"
                                    placeholder="Enter Invoice id" value="<?php echo $ship['invoice_id'] ?>" >
                            </div>
                            <div id="ierror"></div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Material Name</label>
                                <div>
                                
                                <select name="mat" id="mat">
                                    <option value="">Select one</option>
                                    <?php while($un = $raw->fetch_assoc() ){ ?>
                                    <option value="<?php echo $un['id'] ?>"<?php if($un['id']==$ship['material_id']){echo "selected";} ?>><?php echo $un['name'] ?></option>
                                    <?php } ?>
                                </select>
                                
                                </div>
                                <div id="merror"></div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" name="price" class="form-control" id="price"
                                    placeholder="Enter price" value="<?php echo round($ship['price']) ?>" >
                            </div>
                            <div id="perror"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" name="date" class="form-control" id="date" placeholder="Enter date" value="<?php echo $ship['date'] ?>" >
                            </div>
                            <div id="derror"></div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <span id="error" ></span>
                    <button type="submit" name="submit" class="btn btn-primary" >Update</button>
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