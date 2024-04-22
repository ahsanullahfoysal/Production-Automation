<?php
require_once("../header.php");
$id = $_GET['id'];
$buyer = $con->query("SELECT * from buyers")->fetch_all(MYSQLI_ASSOC);
$edit = $con->query("SELECT buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method,buyer_payment.id as buyer_payment_id FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id WHERE buyer_payment.id=$id")->fetch_assoc();
?>
<script>
        function validation() {
            let buyer_id = document.getElementById("buyers_id").value;
            let amount = document.getElementById("amount").value;
            let date = document.getElementById("date").value;
            let method = document.getElementById("method").value;
            console.log(buyer_id);
            if (buyer_id == '' || amount == '' || date == '' || method == '') {

                if (buyer_id == '') {
                    document.getElementById("buyers_id").style.border = '1px solid red';
                    document.getElementById("buyer_error").innerHTML = 'Please Select A Buyer';
                    document.getElementById("buyer_error").style.color = 'red';
                } else {
                    document.getElementById("buyers_id").style.border = '1px solid green';
                    document.getElementById("buyer_error").innerHTML = '';
                }
                if (amount == '') {
                    document.getElementById("amount").style.border = '1px solid red';
                    document.getElementById("amount_error").innerHTML = 'Enter only Numeric Value';
                    document.getElementById("amount_error").style.color = 'red';
                } else {
                    document.getElementById("amount").style.border = '1px solid green';
                    document.getElementById("amount_error").innerHTML = '';
                }
                if (date == '') {
                    document.getElementById("date").style.border = '1px solid red';
                    document.getElementById("date_error").innerHTML = 'Enter date Like MM/DD/YYYY';
                    document.getElementById("date_error").style.color = 'red';
                } else {
                    document.getElementById("date").style.border = '1px solid green';
                    document.getElementById("date_error").innerHTML = '';
                }
                if (method == '') {
                    document.getElementById("method").style.border = '1px solid red';
                    document.getElementById("method_error").innerHTML = 'Enter Text Only';
                    document.getElementById("method_error").style.color = 'red';
                } else {
                    document.getElementById("method").style.border = '1px solid green';
                    document.getElementById("method_error").innerHTML = '';
                }
                return false;
            } else {
                document.getElementById("amount").style.border = '1px solid green';
                document.getElementById("amount_error").innerHTML = '';
                document.getElementById("date").style.border = '1px solid green';
                document.getElementById("date_error").innerHTML = '';
                document.getElementById("method").style.border = '1px solid green';
                document.getElementById("method_error").innerHTML = '';
                document.getElementById("buyers_id").style.border = '1px solid green';
                document.getElementById("buyer_error").innerHTML = '';
                return true;
            }
        }
    </script>
    <?php 
if (isset($_POST['submit'])) {
    $buyer_id = $_POST['buyer_id'];
    $amount = $_POST['amount'];
    $date = $_POST['date'];
    $method = $_POST['method'];

    $con->query("update buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id set buyer_id='$buyer_id',amount='$amount',date='$date',method='$method' where buyer.id=$id");
?>
    
    <script>
        window.location.assign('buyer_pay_list.php')
    </script>
<?php } ?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buyers</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Edit Buyers</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validation()">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="buyers_id">Buyer Name</label>
                                        <select name="buyer_id" id="buyers_id" class="form-control">
                                            <option value="">Select Buyers</option>
                                            <?php foreach ($buyer as $c) { ?>
                                                <option value="<?php echo $c['id'] ?>" <?php if ($c['id'] == $edit['id']) {echo "selected";} ?>><?php echo $c['company_name'] ?></option>
                                            <?php } ?>
                                        </select><span id="buyer_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="amount">Amount</label>
                                        <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Buyer Amount" value="<?php echo $edit['amount'] ?>"><span id="amount_error"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="method">Method</label>
                                        <input type="text" name="method" class="form-control" id="method" placeholder="Enter Payment Method" value="<?php echo $edit['method'] ?>"><span id="method_error"></span>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input type="date" name="date" class="form-control" id="date" placeholder="Enter Payment Date" value="<?php echo $edit['date'] ?>"><span id="date_error"></span>
                                    </div>
                                </div>
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="row">
                            <div class="col-6">
                                <div class="card-footer">
                                    <button type="submit" name="submit" class="btn btn-success btn-block">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>