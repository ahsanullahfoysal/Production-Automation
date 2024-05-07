<?php
require_once('../header.php');
//require_once('../database_con.php');
$raw = $con->query("SELECT * FROM raw_materials ");
$material = $con->query("SELECT * FROM material_wastage ");
$buyer = $con->query("SELECT * FROM secondary_buyer ");

//$shipping = $con->query("INSERT INTO `shipping`(`order_id`, `quantity`, `unit_id`, `date`) VALUES ('','','','')")
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2" style="background:blue;color:white">
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
        <script>
            // 
            
            $(document).ready(function () {

$('#formValidation').validate({ // initialize the plugin
    rules: {
        buyer: {
            required: true,
        },
        squantity: {
            required: true,
        },
        invoice: {
            required: true,
        },
        ff: {
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
        <?php if (isset($_POST["submit"])) {
            $buyer = $_POST['buyer'];
            $mat = $_POST['ff'];
            $squantity = $_POST['squantity'];
            $invoice = $_POST['invoice'];
            $price = $_POST['price'];
            $date = $_POST['date'];
            //echo $buyer.'-'.$mat.'-'.$quantity.'-'.$invoice.'-'.$price.'-'.$date;
            $con->query("INSERT INTO material_wastage_sale(invoice_id,material_id,price,secondary_buyer_id,quantity,date)VALUES($invoice,$mat,$price,$buyer,$squantity,'$date');");
        ?>
            <script>
                window.location.assign("mat_was_sel_list.php")
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
            <form action="" method="post" onsubmit=" return vvalidation()" id="formValidation" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Secondary Buyer Name</label>
                                <div>

                                    <select name="buyer" id="buyer">
                                        <option value="">Select one</option>
                                        <?php while ($ord = $buyer->fetch_assoc()) { ?>
                                            <option value="<?php echo $ord['id'] ?>">
                                                <?php echo $ord['name'] ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                    <div id="berror"></div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Sell Quantity</label>
                                <input type="text" name="squantity" class="form-control" id="squantity" placeholder="Enter quantity">
                            </div>
                            <div id="qerror"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">invoice Id</label>
                                <input type="text" value="<?php echo rand(1, 999999999) ?>" name="invoice" class="form-control" id="invoice">
                            </div>
                            <div id="ierror"></div>
                        </div>
                        <div class="col-6">
                        <div class="form-group">
            <label for="exampleInputEmail1">Material Wastage</label>
            <div>
                <script>
                    function arii(val) {
                        //vari=document.getElementById("ff").value
                        fetch(`<?php echo $_SESSION['base_url'] ?>/nazad_mat_wast_sell/api.php?id=${val}`)
                            .then((response) => response.json())
                            .then((data) => {
                                 document.querySelector('#input1').value = parseInt(data);
                            })



                    }
                </script>


                <select name="ff" id="ff" onchange="arii(this.value)">
                    <option value="">Select one</option>
                    <?php while ($matq = $raw->fetch_assoc()) { ?>
                        <option value="<?php echo $matq['id'] ?>">
                            <?php  echo $matq['name'] ?>
                        </option>
                    <?php } ?>
                </select>
                <div class="form-group">
                    <label for="exampleInputEmail1">Wastage Quantity</label>
                    <div>
                        <input id=input1 type="text" value="<?php ?>" disabled>
                    </div>
                </div>
            </div>
            <div id="merror"></div>
        </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Price</label>
                                <input type="text" name="price" class="form-control" id="price" placeholder="Enter price">
                            </div>
                            <div id="perror"></div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Date</label>
                                <input type="date" name="date" class="form-control" id="date" placeholder="Enter date">
                            </div>
                            <div id="derror"></div>
                        </div>
                    </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <span id="error"></span>
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