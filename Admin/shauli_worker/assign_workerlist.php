<?php
require_once("../header.php");
$project = $con->query("select * from projects")->fetch_all(MYSQLI_ASSOC);
$worker = $con->query("select worker_assign.*,processing_steps.title as processing,users.name as user from worker_assign join processing_steps on processing_steps.id=worker_assign.processing_steps_id join users on users.id=worker_assign.user_id;")->fetch_all(MYSQLI_ASSOC);
if (isset($_POST['submit1'])) {
    $ws = $_POST['search'];
    $worker = $con->query("select worker_assign.*,processing_steps.title as processing,users.name as user from worker_assign join processing_steps on processing_steps.id=worker_assign.processing_steps_id join users on users.id=worker_assign.user_id where project_id=$ws");
}

?>


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Worker list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Worker List</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-2">
                                <h3 class="card-title">Worker List</h3>
                            </div>
                            <div class="col-md-2 offset-8 text-right">
                                <a href="<?php echo $_SESSION['base_url'] ?>/shauli_worker/assign_worker.php" class="btn btn-warning">Add Worker</a>
                            </div>
                        </div>
                        
                        <!-- <h3 class="card-title">Raw Materials List</h3> -->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="pb-3">
                        <form action="" method="post" class="form-inline">
                            <select name="search" id="" class="form-control">
                                <option value="">select Project</option>
                                <?php foreach ($project as $p) { ?>
                                    <option value="<?php echo $p['id'] ?>"><?php echo $p['name'] ?></option>
                                <?php } ?>
                                <input type="submit" name="submit1" value="search" class="btn btn-primary">
                            </select>
                        </form>
                        </div>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Processing Step</th>
                                    <th>Worker Name</th>
                                    <th>Duration(Minutes)</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($worker as $i => $w) { ?>
                                    <tr>
                                        <td><?php echo ++$i ?></td>
                                        <td><?php echo $w['processing'] ?></td>
                                        <td><?php echo $w['user'] ?></td>
                                        <td><?php echo $w['duration'] ?></td>


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