<?php
require_once("../header.php");
// $con = new mysqli('localhost', 'root', '', 'production_automation');
$user = $con->query('SELECT users. *, departments.name as department from users join departments on departments.id=users.department_id')->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users list</li>
                    </ol>
                </div>

                <div>
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Premium Users List</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">SL</th>
                                        <th>Department</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Password</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Photo</th>
                                        <th>Designation</th>
                                        <th style="width: 160px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $i => $u) { ?>

                                        <tr>
                                            <td><?php echo ++$i ?></td>
                                            <td><?php echo $u['department'] ?></td>
                                            <td><?php echo $u['name'] ?></td>
                                            <td><?php echo $u['email'] ?></td>
                                            <td><?php echo $u['password'] ?></td>
                                            <td><?php echo $u['phone'] ?></td>
                                            <td><?php echo $u['address'] ?></td>
                                            <td><?php echo $u['photo'] ?></td>
                                            <td><?php echo $u['designation'] ?></td>
                                            <td>
                                                <a href="user_edit.php?id=<?php echo $u['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                                <a href="user_delete.php?id=<?php echo $u['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
                                            </td>
                                        </tr>
                                    <?php } ?>

                                </tbody>

                                <div class="row">
                                    <div class="col-md-3">

                                        <a href="user.php" class="btn btn-primary btn-md">Add User</a> <br> <br>
                                    </div>
                                </div>





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