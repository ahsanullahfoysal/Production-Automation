<?php
require_once("../header.php");
// require_once('../database_con.php');
$data = $con->query("select * from buyers")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Buyers List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buyer list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Buyer List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/badsha_buyer/add_buyers.php" class="btn btn-warning">Add Buyer</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Company Name</th>
                                    <th>Contact Person</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Bank Information</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $i => $d) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $d['company_name'] ?></td>
                                        <td><?php echo $d['contract_person'] ?></td>
                                        <td><?php echo $d['email'] ?></td>
                                        <td><?php echo $d['phone'] ?></td>
                                        <td><?php echo $d['address'] ?></td>
                                        <td><?php echo $d['bank_info'] ?></td>
                                        <td>
                                            <a href="edit_buyer.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                            <a href="delete_buyer.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure to delete')">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <!-- <a href="department.php" class="btn btn-primary btn-md">Add Department</a> -->
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