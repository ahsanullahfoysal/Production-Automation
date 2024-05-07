<?php
require_once("../header.php");
$id = $_GET['id'];
$edit = $con->query("select * from users where id=$id")->fetch_assoc();
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

    $con->query("UPDATE `users` SET `department_id`='$department',`name`='$name',`email`=' $email',`password`='$password',`phone`='$phone',`address`='$address',`photo`=' $photo',`designation`='$designation' WHERE id=$id ");
?>
    <script>
        window.location.assign('users_list.php')
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
                    <h1>User Update/Edit</h1>
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
                        <h3 class="card-title"><a href="user_list.php" class="btn btn-primary btn-md">See User List</a></h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="" method="post" enctype="multipart/form-data" >
                        <div class="card-body">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Department</label>
                                        <select name="department" id="" class="form-control">
                                            <option value="">Select Department </option>
                                            <?php while($c=$department->fetch_assoc()) {?>
                                            <option value="<?php echo $c['id'] ?>" <?php if($c['id'] ==$edit['department_id']){echo "selected";} ?>><?php echo $c['name']?> </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                


                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Name</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $edit['name']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" value="<?php echo $edit['email']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <input type="password" name="password" class="form-control" value="<?php echo $edit['password']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <input type="text" name="phone" class="form-control" value="<?php echo $edit['phone']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Address</label>
                                        <input type="text" name="address" class="form-control" value="<?php echo $edit['address']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Photo</label>
                                        <input type="file" name="photo" class="form-control" value="<?php echo $edit['photo']?>">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="">Designation</label>
                                        <select name="designation" id="" class="form-control">
                                            <option value="">Select Designation </option>
                                            <option value="CEO"<?php if($edit['designation']=='CEO'){echo "selected";} ?>>CEO</option>
                                            <option value="Manager"<?php if($edit['designation']=='Manager'){echo "selected";} ?>>Manager</option>
                                            <option value="Supervisor"<?php if($edit['designation']=='Supervisor'){echo "selected";} ?>>Supervisor</option>
                                            <option value="Worker"<?php if($edit['designation']=='Worker'){echo "selected";} ?>>Worker</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
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