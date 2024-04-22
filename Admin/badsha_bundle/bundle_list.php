<?php
require_once("../header.php");
// $con = new mysqli('localhost', 'root', '', 'production_automation');
$data = $con->query("select * from bundles")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Bundle list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Bundle List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/badsha_bundleus/add_bundles.php" class="btn btn-warning">Add Bundle</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Project Name</th>
                                    <th>Bundle Code</th>
                                    <th style="width: 160px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($data as $i => $d) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php $oid = $d['order_id'];
                                            $pname = $con->query("select projects.name as pn FROM orders JOIN projects ON orders.project_id=projects.id where orders.id=$oid ")->fetch_assoc()["pn"];
                                            echo $pname;
                                            ?></td>
                                        <td><?php echo $d['bundle_code'] ?></td>
                                        <td>
                                            <a href="edit_bundle.php?id=<?php echo $d['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                            <a href="delete_bundle.php?id=<?php echo $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure to delete')">Delete</a>
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