<?php
require_once("../header.php");
//require_once('../database_con.php');
$serror = '';
$eerror = '';
if (isset($_POST['submit1'])) {
    $sdate = $_POST['s_date'];
    $edate = $_POST['e_date'];

    if (empty($sdate) || empty($edate)) {
        if (empty($sdate)) {
            $serror = "input from date";
        } else {
            $serror = "";
        }
        if (empty($edate)) {
            $eerror = "input to date";
        } else {
            $eerror = "";
        }
        $ship = $con->query("select * from shipping ")->fetch_all(MYSQLI_ASSOC);
    } else {
        $ship = $con->query("select * from shipping where date between '$sdate' and '$edate' ")->fetch_all(MYSQLI_ASSOC);
    }
} else {
    $ship = $con->query("select * from shipping ")->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Department list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Department list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Department List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                            <a href="<?php echo $_SESSION['base_url'] ?>/nazad_shiping/shipping_insert.php" class="btn btn-warning">Add Shipping</a>
                            </div>
                        </div>
                    </div>
                    <div>
                        <form action="" method="post">
                            <label>From : </label>
                            <input type="date" name="s_date" id="s_date">
                            <span style="color:red" id="s_error">
                                <?php echo $serror; ?>
                            </span>
                            <label>To : </label>
                            <input type="date" name="e_date" id="e_date">
                            <span style="color:red" id="e_error">
                                <?php echo $eerror; ?>
                            </span>
                            <input class="btn btn-primary" type="submit" name="submit1" value="Search">
                        </form>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Invoice Id</th>
                                    <th>Shipping Id</th>
                                    <th>Product</th>
                                    <th>Buyer Name</th>
                                    <th>Quantity</th>
                                    <th>Units</th>
                                    <th>date</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($ship as $i => $p) {

                                ?>

                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $p['invoice_id'] ?>
                                        </td>
                                        <td>
                                            <?php echo $p['id'] ?>
                                        </td>
                                        <td>
                                        <?php $project = $con->query("select orders.*, projects.name,shipping.order_id from orders join projects on orders. project_id= projects.id join shipping on orders.id=".$p['order_id'])->fetch_assoc();
                                            echo $project['name'] ?>
                                        </td>
                                        <td>
                                            <?php $buyer = $con->query("select orders.*, buyers.company_name,shipping.order_id from orders join buyers on orders.buyer_id= buyers.id join shipping on orders.id=".$p['order_id'])->fetch_assoc();
                                            echo $buyer['company_name'] ?>
                                        </td>
                                        <td>
                                            <?php echo round($p['quantity']) ?>
                                        </td>
                                        <td>
                                            <?php $user = $con->query("select * from units where id=" . $p['unit_id'])->fetch_assoc();
                                            echo $user['name'] ?>
                                        </td>
                                        <td>
                                            <?php echo $p['date'] ?>
                                        </td>
                                        <td>
                                            <a href="shipping_edit.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                            <a href="shipping_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
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