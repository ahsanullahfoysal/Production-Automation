<?php
require_once("../header.php");
$buyer = $con->query("SELECT * from buyers")->fetch_all(MYSQLI_ASSOC);

?>

<?php
if (isset($_POST['submit'])) {
    $buyer_id = trim($_POST['buyer_id']);
    $amount = trim($_POST['amount']);
    $date = trim($_POST['date']);
    $method = trim($_POST['method']);
    $con->query("INSERT INTO buyer_payment (buyer_id, amount, date, method) VALUES('$buyer_id', '$amount', '$date', '$method')");
?>

    <script>
        window.location.assign('buyer_pay_list.php')
    </script>

<?php }
?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Buyer Payment</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Buyers</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" onsubmit="return validation()" enctype="multipart/form-data" id="frm_valid" >
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Buyers Name</label>
                                    <select name="buyer_id" id="buyers_id" class="form-control">
                                        <option value="">Select Buyers</option>
                                        <?php foreach ($buyer as $c) { ?>
                                            <option value="<?php echo $c['id'] ?>"><?php echo $c['company_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <span id="buyer_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="amount">Amount</label>
                                    <input type="number" name="amount" class="form-control" id="amount" placeholder="Enter Buyer Amount"><span id="amount_error"></span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="method">Method</label>
                                    <input type="text" name="method" class="form-control" id="method" placeholder="Enter Payment Method"><span id="method_error"></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="date">Date</label>
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Enter Payment Date"><span id="date_error"></span>
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

<script>
     $(document).ready(function () {
        $('#frm_valid').validate({
            rules: {
                buyer_id: "required",
                amount: "required",
                method: "required",
                date: "required",

            },
            messages: {
                buyer_id: "Please select a Buyer",
                amount: "This field is required.",
                method: "This field is required.",
                date: "Please input a Date",
            }
        })
    })
</script>