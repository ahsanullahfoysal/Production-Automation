<?php
require_once('../header.php');
//$con = new mysqli('localhost', 'root', '', 'production_automation');
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
                    <h1>Return Product</h1>
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
                            invoice: {
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
            $date=$_POST['date'];
            $invoice=$_POST['invoice'];
            $con->query("INSERT INTO `return_from_buyer`(`date`,`invoice_id`,`order_id`, `quantity` ) VALUES ('$date','$invoice','$order','$quantity')");
            ?>
            <script>
                window.location.assign("return_from%20_buyer.php")
            </script>
            <?php
        } ?>

        <!-- Default box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Products</h3>
            </div>
            <script>
                    function arii(val) {
                        //vari=document.getElementById("ff").value
                        fetch(`<?php echo $_SESSION['base_url'] ?>nazad_return_from_buyer/api.php?id=${val}`)
                            .then((response) => response.json())
                            .then((data) => {
                                    document.querySelector('#invoice').value = parseInt(data);
                                
                            })



                    }
                </script>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="" method="post" id="formValidation">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Buyer</label>
                                <div>
                                
                                <select name="order_id" id="order_id" class="form-control" onchange="arii(this.value)">
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
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" name="date" class="form-control" id="date" placeholder="Enter date">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Invoice Id</label>
                                <input type="text" name="invoice" class="form-control" id="invoice">
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