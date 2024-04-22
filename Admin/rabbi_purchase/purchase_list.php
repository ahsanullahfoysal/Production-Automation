<?php
require_once("../header.php");
$products = $con->query("SELECT p.date,p.id,p.invoice_id as invoice,p.price,p.quantity,m.name as material,s.company_name as supplier FROM purchase p JOIN raw_materials m ON p.material_id=m.id JOIN suppliers s ON p.supplier_id=s.id;")->fetch_all(MYSQLI_ASSOC);
$materials = $con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);

if (isset($_POST['submit1'])) {
    $matid = $_POST['material'];

    $products = $con->query("SELECT p.date,p.id,p.invoice_id as invoice,p.price,p.quantity,m.name as material,s.company_name as supplier FROM purchase p JOIN raw_materials m ON p.material_id=m.id JOIN suppliers s ON p.supplier_id=s.id WHERE p.material_id=$matid;")->fetch_all(MYSQLI_ASSOC);
}

if (isset($_POST['submit2'])) {
    $date1 = $_POST['date1'];
    $date2 = $_POST['date2'];

    $products = $con->query("SELECT p.date,p.id,p.invoice_id as invoice,p.price,p.quantity,m.name as material,s.company_name as supplier FROM purchase p JOIN raw_materials m ON p.material_id=m.id JOIN suppliers s ON p.supplier_id=s.id WHERE (p.date BETWEEN '$date1' AND '$date2');")->fetch_all(MYSQLI_ASSOC);
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
                            <select name="material" id="material" onchange="getprice((this.value),1)" class="form-control">
                                <option value="">Select Material</option>
                                <?php foreach ($materials as $d) { ?>
                                    <option value="<?php echo $d['id'] ?>"><?php echo $d['name'] ?></option>
                                <?php } ?>
                            </select>
                            <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
                            <a href="invoice_list.php" class="btn btn-primary" style="margin-left: 15px;">Invoice List</a>
                        </div>
                    </form>
                </div>
                <div class="col-sm-8">
                    <form action="#" class="form-inline float-sm-right" method="POST">
                        <div class="form-group">
                            <label for="exampleInputEmail1">From</label>
                            <input type="datetime-local" name="date1" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                            <label for="exampleInputEmail1">To</label>
                            <input type="datetime-local" name="date2" class="form-control" id="exampleInputEmail1" placeholder="Enter title">
                            <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Purchase List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Invoice</th>
                                    <th>Material</th>
                                    <th>Supplier</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $i => $p) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $p['invoice'] ?></td>
                                        <td><?php echo $p['material'] ?></td>
                                        <td><?php echo $p['supplier'] ?></td>
                                        <td><?php echo $p['quantity'] ?></td>
                                        <td><?php echo $p['price'] ?></td>
                                        <td><?php echo $p['date'] ?></td>
                                        <td>
                                            <a href="purchase_update.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>
                                            <a href="delete_purchase.php?id=<?php echo $p['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
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