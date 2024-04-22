<?php
require_once("../header.php");
$department = $con->query('select * from departments');
$name = $con->query('select * from users');
$email = $con->query('select * from users');
$password = $con->query('select * from users');
$phone = $con->query('select * from users');
$address = $con->query('select * from users');
$photo = $con->query('select * from users');
$designation = $con->query('select * from users');



if (isset($_POST['submit'])) {
    $department  = $_POST['department'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $photo = $_POST['photo'];
    $designation = $_POST['designation'];


    $con->query("INSERT into users(department_id,name,email,password,phone,address,photo,designation) VALUES ('$department','$name ','$email','$password',' $phone','$address','$photo','$designation')");
?>
    <script>
        window.location.assign('user_list.php')
    </script>
<?php
}
?>





<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title"><a href="user_list.php" class="btn btn-primary btn-md">See Users List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Department</label>
                                        <select name="department" class="form-control">
                                            <option value="">Select Department </option>
                                            <?php while ($c = $department->fetch_assoc()) { ?>
                                                <option value="<?php echo $c['id'] ?>"><?php echo $c['name'] ?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>








                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">E-mail</label>
                                        <input type="text" name="email" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Photo</label>
                                        <input type="file" name="photo" class="form-control">
                                    </div>
                                </div>


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Designation</label>
                                        <select name="designation" class="form-control">
                                            <option value="">Select Designation </option>
                                            <option value="ceo">CEO</option>
                                            <option value="manager">Manager</option>
                                            <option value="supervisor">Supervisor</option>
                                            <option value="worker">Worker</option>
                                        </select>

                                    </div>
                                </div>
                            </div>


                        </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <input type="submit" value="Submit" name="submit" class="btn btn-primary"></input>
                </div>
                </form>
            </div>

        </div>
</div><!-- /.container-fluid -->
</section>
</div>
<!-- /.content-wrapper -->

<?php
require_once("../footer.php");
?>