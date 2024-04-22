<?php
require_once("../header.php");
$trasfer = $con->query("SELECT * from transfers")->fetch_all(MYSQLI_ASSOC);
$bundele_code_error = "";
if (isset($_POST['sh'])) {
    $bndl_code = $_POST['get_bundle_code'];
    $bundle1 = $con->query("SELECT * from bundles where bundle_code='$bndl_code'");
    if (mysqli_num_rows($bundle1) > 0) {
        $bnd = $con->query("SELECT * from bundles where bundle_code='$bndl_code'")->fetch_assoc();
        $bnd_allcode = $bnd['bundle_code'];
        if ($bnd_allcode != $bndl_code) {
            $bundele_code_error = "Not found the bundle code";
        }
        if (!empty($bndl_code)) {
            $bndl_idd = $bnd["id"];
            $trasfer = $con->query("SELECT * from transfers where bundle_id='$bndl_idd'")->fetch_all(MYSQLI_ASSOC);
        } else {
        }
    } else {
        $bundele_code_error = "Not found the bundle code";
    }
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Transfers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">ADD Transfers</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card ">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Transfer List</h3>
                            </div>
                            <div class="col-md-4 offset-6 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/helal_transfer/transfers_report.php" class="btn btn-info">Transfer Report</a>
                                <a href="<?php echo $_SESSION['base_url'] ?>/helal_transfer/add_transfers.php" class="btn btn-warning">Add Transfer</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <div class="container-fluid">
                        <div class="col-md-6 bg-warning ">
                            <form action="" method="post">
                                <label for="">Enter Bundle code</label>
                                <input type="text" class="form-control" name="get_bundle_code" placeholder="Search to bundle code" onkeyup="src()">
                                </input><button name="sh">Search</button><span style="color: red;"><?php echo $bundele_code_error ?></span>
                            </form>
                        </div>
                        <table border="1" class="table table-striped table-hover">
                            <thead class="thead-dark">
                                <tr>
                                    <th>SL</th>
                                    <th>Bundle Code</th>
                                    <th>Order Name</th>
                                    <th>Company Name</th>
                                    <th>Processing Step</th>
                                    <th>Received Date</th>
                                    <th>Transfer Date</th>
                                    <th width="180">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($trasfer as $ti => $tl) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$ti ?>
                                        </td>
                                        <td>
                                            <?php $bid = $tl['bundle_id'];
                                            $_b = $con->query("SELECT * from bundles where id='$bid'")->fetch_assoc();
                                            echo $_b['bundle_code'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php $oid = $tl['order_id'];
                                            $ordr = $con->query("SELECT * from orders where id='$oid'")->fetch_assoc();
                                            $buyer_id = $ordr['buyer_id'];
                                            $buyer = $con->query("SELECT * from buyers where id='$buyer_id'")->fetch_assoc();
                                            $project_id = $ordr["project_id"];
                                            $project = $con->query("SELECT * from projects where id='$project_id'")->fetch_assoc();


                                            echo $project["name"];

                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $buyer["company_name"]; ?>
                                        </td>
                                        <td>
                                            <?php $sp = $tl['processing_steps_id'];
                                            $_p_s = $con->query("SELECT * from processing_steps where id='$sp'")->fetch_assoc();
                                            echo $_p_s['title'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $tl['received_date']  ?>
                                        </td>
                                        <td>
                                            <?php echo $tl['transfer_date']
                                            ?>
                                        </td>

                                        <td>
                                            <a href="edit_transfer.php?id=<?php echo $tl['id'] ?>" class="btn btn-success">Update</a>
                                            <a href="delete_transfer.php?id=<?php echo $tl['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure!')">Delete</a>

                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>