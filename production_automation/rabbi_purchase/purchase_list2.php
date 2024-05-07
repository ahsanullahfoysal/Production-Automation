<?php
require_once("../header.php");
$products = $con->query("SELECT * from purchase group by invoice_id ORDER BY date DESC;")->fetch_all(MYSQLI_ASSOC);
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit1'])) {
    $matid = $_POST['material'];
    $products = $con->query("SELECT * from purchase WHERE material_id=$matid group by invoice_id ORDER BY date DESC;")->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['submit2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];
    $products = $con->query("SELECT * from purchase WHERE (date BETWEEN '$date1' AND '$date2') group by invoice_id ORDER BY date DESC;")->fetch_all(MYSQLI_ASSOC);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Purchase List</li>
                    </ol>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-sm-4">
                    <form action="#" class="form-inline" method="POST">
                        <div class="form-group">
                            <select name="material" id="material" onchange="getprice((this.value),1)"
                                class="form-control">
                                <option value="">Select Material</option>
                                <?php foreach ($materials as $d) { ?>
                                    <option value="<?php echo $d['id'] ?>">
                                        <?php echo $d['name'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
                            <a href="purchase_list.php" class="btn btn-primary" style="margin-left: 15px;">Individual
                                Edit</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <form action="#" class="form-inline float-sm-right" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">From</label>
                            <input type="date" name="date1" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter title">
                            <label for="exampleInputEmail1">To</label>
                            <input type="date" name="date2" class="form-control" id="exampleInputEmail1"
                                placeholder="Enter title">
                            <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Purchase List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/rabbi_purchase/add_purchase.php"
                                    class="btn btn-warning">Add Purchase</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Invoice</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th style="width: 220px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $i => $p) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php echo $p['invoice_id'] ?>
                                        </td>
                                        <td>
                                            <?php
                                            $inid = $p['invoice_id'];
                                            $fprice = 0;
                                            $price = $con->query("select price from purchase where invoice_id=$inid")->fetch_all(MYSQLI_ASSOC);
                                            foreach ($price as $n) {
                                                $fprice += $n["price"];
                                            }
                                            echo $fprice;
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $p['date'] ?>
                                        </td>
                                        <td>
                                            <a href="purchase_update2.php?id=<?php echo $p['invoice_id'] ?>"
                                                class="btn btn-success btn-sm">Update</a>
                                            <a href="delete_purchase2.php?id=<?php echo $p['invoice_id'] ?>"
                                                class="btn btn-danger btn-sm">Delete</a>
                                            <a href="view_purchase.php?id=<?php echo $p['invoice_id'] ?>"
                                                class="btn btn-success btn-sm" target="_blank">View</a>
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