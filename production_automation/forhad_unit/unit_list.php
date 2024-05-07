<?php
    require_once("../header.php");
    //require_once('../database_con.php');
    $unit=$con->query("select * from units")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Unit List </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Unit list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header" style="background:orange">
                        <h3 class="card-title" >Unit List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Name</th>
                                    <th style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($unit as $i=>$p){ ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $p['name'] ?></td>
                                    <td>
                                        <a href="unit_edit.php?id=<?php echo $p['id'] ?>" class="btn btn-success">Update</a>

                                        <a href="unit_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                            <a href="units.php" class="btn btn-primary btn-md">Add Unit</a>
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