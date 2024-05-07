<?php
require_once("../header.php");
$order = $con->query('SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id')->fetch_all(MYSQLI_ASSOC);

$lemon = $con->query('SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id')->fetch_all(MYSQLI_ASSOC);

$super = $con->query("select * from users where designation='Supervisor'")->fetch_all(MYSQLI_ASSOC);
$man1 = $con->query("select * from users where designation='Manager'")->fetch_all(MYSQLI_ASSOC);
$buy1 = $con->query("select * from buyers")->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['search_1'])) {
    $date_1 = $_POST['start_date'];
    $order = $con->query("SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id where start_date='$date_1;'")->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['search_2'])) {
    $date_2 = $_POST['end_date'];
    $order = $con->query("SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id where end_date='$date_2;'")->fetch_all(MYSQLI_ASSOC);
}


if (isset($_POST['search_3'])) {
    $buyer = $_POST['buyer'];
    $order = $con->query("SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id  where buyer_id='$buyer;'")->fetch_all(MYSQLI_ASSOC);
}


if (isset($_POST['search_4'])) {
    $manager = $_POST['manager'];
    // echo $manager;
    $order = $con->query("SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id where project_manager_id=$manager;")->fetch_all(MYSQLI_ASSOC);
}


if (isset($_POST['search_5'])) {
    $supervisor = $_POST['supervisor'];
    $order = $con->query("SELECT orders. *, projects.name as product,buyers.company_name as buyer,units.name as volume,users.name as manager,u.name from orders join projects on projects.id=orders.project_id join buyers on buyers.id=orders.buyer_id join units on units.id=orders.unit_id join users on users.id=orders.project_manager_id join users as u on u.id=orders.supervisor_id where supervisor_id='$supervisor;'")->fetch_all(MYSQLI_ASSOC);
}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Orders List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Orders list</li>
                    </ol>
                </div>
            </div>

            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Orders List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/minhaj/orders.php"
                                    class="btn btn-warning">Add Orders</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <div class="row">
                                <div class="col-md-2">
                                    <form action="" method="post">
                                        <div class="d-flex">
                                            <div>
                                                <select name="buyer" id="" class="form-control">
                                                    <option value="">Buyer</option>
                                                    <?php foreach ($buy1 as $o) { ?>
                                                        <option value="<?php echo $o['id'] ?>">
                                                            <?php echo $o['company_name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="submit" value="Search" name="search_3"
                                                    class="btn btn-secondary">
                                                </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <form action="" method="post">
                                        <div class="d-flex">
                                            <div>
                                                <select name="manager" id="" class="form-control"> <br>
                                                    <option value="">Manager</option>
                                                    <?php foreach ($man1 as $o) { ?>
                                                        <option value="<?php echo $o['id'] ?>">
                                                            <?php echo $o['name'] ?>
                                                        </option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="submit" value="Search" name="search_4"
                                                    class="btn btn-secondary">
                                                </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-2">
                                    <form action="" method="post">
                                        <div class="d-flex">
                                            <div>
                                                <select name="supervisor" id="" class="form-control"> <br>
                                                    <option value="">Supervisor</option>
                                                    <?php foreach ($super as $o) { ?>
                                                        <option value="<?php echo $o['id'] ?>">
                                                            <?php echo $o['name'] ?>
                                                        <option>
                                                        <?php } ?>
                                                </select>
                                            </div>
                                            <div>
                                                <input type="submit" value="Search" name="search_5"
                                                    class="btn btn-secondary">
                                                </input>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-5 offset-1 justify-content-end d-flex">
                                    <form action="" method="post">
                                        <div class="d-flex">
                                            <label for="" class="btn btn-info">From</label>
                                            <input type="date" class="form-control" name="start_date"
                                                placeholder="Enter Start Date">
                                        </div>
                                        <div class="d-flex">
                                            <label for="" class="btn btn-info">To</label>
                                            <input type="date" class="form-control" name="end_date"
                                                placeholder="Enter End Date">
                                        </div>
                                        <div>
                                            <input type="submit" value="Search" name="search_1"
                                                class="btn btn-secondary">
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Invoice</th>
                                    <th>Products</th>
                                    <th>Buyer</th>
                                    <th>Unit</th>
                                    <th>Rate</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th style="width: 160px">Processing</th>
                                    <th style="width: 210px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($order as $i => $o) {
                                    $quantity = $o['quantity'];
                                    $rate = $o['rate'];
                                    $total_price = $quantity * $rate;
                                    ?>

                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $o['invoice'] ?>
                                        </td>
                                        <td>
                                            <?php echo $o['product'] ?>
                                        </td>
                                        <td>
                                            <?php echo $o['buyer'] ?>
                                        </td>
                                        
                                        <td>
                                            <?php echo $o['volume'] ?>
                                        </td>
                                        <td>
                                            <?php echo $o['rate'] ?>
                                        </td>
                                        <td>
                                            <?php echo $o['quantity'] ?>
                                        </td>
                                        <td>
                                            <?php echo $total_price ?>
                                        </td>
                                        
                                        <td style="text-transform:capitalize">
                                            <?php echo $o['status'] ?>
                                        </td>
                                        <td>
                                            <a href="<?php echo $_SESSION['base_url'] ?>/foysal_assign_material/assign_material.php"
                                                class="btn btn-warning btn-sm mb-2">Material</a>
                                            <a href="<?php echo $_SESSION['base_url'] ?>/badsha_bundle/add_bundles.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-info btn-sm mb-2">Bundle</a>

                                            <a href="<?php echo $_SESSION['base_url'] ?>/shauli_worker/assign_worker.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-primary btn-sm">Worker</a>

                                            <a href="<?php echo $_SESSION['base_url'] ?>/helal_transfer/transfers_report.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-dark btn-sm">Transfer</a>
                                        </td>
                                        <td>
                                            <a href="orders_edit.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-success btn-sm">Update</a>

                                            <a href="orders_delete.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-danger btn-sm"
                                                onclick="return confirm('are you sure to delete')">Delete</a>

                                            <a href="<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/order_overview.php?id=<?php echo $o['id'] ?>"
                                                class="btn btn-warning btn-sm">Report</a>
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