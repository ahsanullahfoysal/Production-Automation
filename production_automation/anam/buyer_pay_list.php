<?php
require_once("../header.php");
$buyer = $con->query("SELECT buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method,buyer_payment.id as buyer_payment_id FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id ORDER BY date DESC")->fetch_all(MYSQLI_ASSOC);
$buyer_name = $con->query("SELECT * from buyers")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST["submit"])) {
    $search = $_POST['buyer_id'];
    $search_error = "";

    if (!empty($search)) {
        $buyer = $con->query("SELECT buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id WHERE buyer_id= $search")->fetch_all(MYSQLI_ASSOC);
    } else {
        $search_error = "Please Select A Buyer";
    }
}

if (isset($_POST["d_submit"])) {
    $s_date_error = "";
    $e_date_error = "";
    $s_date = $_POST["s_date"];
    $e_date = $_POST["e_date"];
    if (!empty($s_date) && !empty($e_date)) {
        $buyer = $con->query("SELECT buyers.*,buyer_payment.amount,buyer_payment.date,buyer_payment.method FROM buyers JOIN buyer_payment ON buyers.id=buyer_payment.buyer_id WHERE date BETWEEN '$e_date' AND '$s_date'")->fetch_all(MYSQLI_ASSOC);
    } else {
        if (empty($s_date) && empty($e_date)) {
            $s_date_error = "Please Input PHP From Date";
            $e_date_error = "Please Input PHP To Date";
        } elseif (empty($s_date)) {
            $s_date_error = "Please Input PHP From Date";
        } else {
            $e_date_error = "Please Input PHP TO Date";
        }
    }
?>
    


<?php } ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyers Payment list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payment list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/anam/buyer_pay_add.php" class="btn btn-warning">Add Buyers Payment</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">

                        </div>
                        <table class="table table-bordered">
                            <form action="" method="post" onsubmit="return d_validation()">
                                <div class="row d-flex">
                                    <div class="col-md-4 form-group d-flex">
                                        <div>
                                            <select name="buyer_id" id="" class="form-control">
                                                <option value="">Select Buyers</option>
                                                <?php foreach ($buyer_name as $c) { ?>
                                                    <option value="<?php echo $c['id'] ?>"><?php echo $c['company_name'] ?></option>
                                                <?php } ?>
                                            </select>
                                            <span class="text-danger"><?php if (isset($_POST['submit'])) {
                                                                            echo $search_error;
                                                                        } ?></span>
                                        </div>
                                        <div>
                                            <input type="submit" name="submit" value="Search" class="btn btn-secondary">
                                        </div>
                                    </div>

                                    <div class="col-md-6 offset-md-2 d-flex">
                                        <div class=" form-group d-flex ml-auto">
                                            <div>
                                                <label for="for" class="btn btn-info">From </label>
                                            </div>
                                            <div>
                                                <input type="date" name="s_date" class="form-control" id="s_date"><span id="s_date_error" class="text-danger"><?php if (isset($_POST['d_submit'])) {
                                                                                                                                                                    echo $s_date_error;
                                                                                                                                                                } ?></span>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex">
                                            <div>
                                                <label for="for" class="btn btn-info">To</label>
                                            </div>
                                            <div>
                                                <input type="date" name="e_date" class="form-control" id="e_date"><span id="e_date_error" class="text-danger"><?php if (isset($_POST['d_submit'])) {
                                                                                                                                                                    echo $e_date_error;
                                                                                                                                                                } ?></span>
                                            </div>

                                        </div>
                                        <div>
                                            <input type="submit" name="d_submit" value="Search" class="btn btn-secondary">
                                        </div>
                                    </div>

                                </div>
                            </form>
                    </div>

                    <thead>
                        <tr>
                            <th style="width: 10px">SL</th>
                            <th>Buyers Name</th>
                            <th>Contact Person Name</th>
                            <th>Amount </th>
                            <th>Date</th>
                            <th>Method</th>
                            <th style="width: 150px">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($buyer as $i => $p) { ?>
                            <tr>
                                <td><?php echo ++$i ?></td>
                                <td><?php echo $p['company_name'] ?></td>
                                <td><?php echo $p['contract_person'] ?></td>
                                <td><?php echo $p['amount'] ?></td>
                                <td><?php echo $p['date'] ?></td>
                                <td><?php echo $p['method'] ?></td>
                                <td>
                                    <a href="buyer_pay_edit.php?id=<?php echo $p['buyer_payment_id'] ?>" class="btn btn-success">Edit</a>
                                    <a href="buyer_pay_delete.php?id=<?php echo $p['buyer_payment_id'] ?>" class="btn btn-danger" onclick="return confirm('Are You sure?')">Delete</a>
                                </td>

                            </tr>
                        <?php } ?>

                    </tbody>
                    </table>
                </div>
                <!-- /.card-body -->

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
                s_date: "required",
                e_date: "required",

            },
            messages: {
                buyer_id: "Please select a Buyer",
                s_date: "Enter only Numeric Value",
                e_date: "Please Input js TO Date",
            }
        })
    })
    </script>