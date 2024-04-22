<?php
require_once("../header.php");
//$con = new mysqli('localhost', 'root', '', 'production_automation');
$dep = $con->query("select * from expense_category")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Expense Category list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense Category list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Expense Category list</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/sazib/expense_category_add.php" class="btn btn-warning">Add Expense Category</a>
                            </div>
                        </div>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th style="width: 180px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dep as $i => $p) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $p['name'] ?></td>
                                        <td>
                                            <a href="expense_category_edit.php?id=<?php echo $p['id'] ?>" class="btn btn-success">Update</a>

                                            <a href="expense_category_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
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
require_once('../footer.php')
?>