<?php
require_once("../header.php");
//require_once('../database_con.php');
$fin = $con->query("select * from finished_product")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Product List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/rezaul_finish_product/finished_product.php"
                                    class="btn btn-warning">Add Products</a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Projects</th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>date</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($fin as $i => $p) { ?>
                                    <tr>
                                        <td>
                                            <?php echo ++$i ?>
                                        </td>
                                        <td>
                                            <?php $oid = $p['order_id'];
                                            $pname = $con->query("SELECT o.id, p.name FROM orders o JOIN projects p ON o.project_id=p.id where o.id=$oid;")->fetch_assoc()["name"];
                                            echo $pname;
                                            ?>
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
                                            <a href="finished_edit.php?id=<?php echo $p['id'] ?>"
                                                class="btn btn-success btn-sm">Update</a>

                                            <a href="finished_delete.php?id=<?php echo $p['id'] ?>"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('are you sure to delete')">Delete</a>
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