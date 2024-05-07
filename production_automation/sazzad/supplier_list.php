<?php
require_once("../header.php");
//require_once('../database_con.php');
$dep = $con->query("select * from suppliers")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Supplier List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Supplier list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Supplier List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="supplier.php" class="btn btn-warning ">Add Supplier</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-2 pb-3">

                            </div>

                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Company Name</th>
                                    <th>Email</th>
                                    <th>Contract person</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Bank Information</th>
                                    <th style="width: 180px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dep as $i => $p) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $p['company_name'] ?></td>
                                        <td><?php echo $p['email'] ?></td>
                                        <td><?php echo $p['contract_person'] ?></td>
                                        <td><?php echo $p['phone'] ?></td>
                                        <td><?php echo $p['address'] ?></td>
                                        <td><?php echo $p['bank_info'] ?></td>
                                        <td>
                                            <a href="supplier_update.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                            <a href="supplier_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure to delete')">Delete</a>
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