<?php
require_once('../header.php');
// $user = $con->query('select * from users')->fetch_all(MYSQLI_ASSOC);
$user = $con->query('select users.*,departments.name as dpt_name from users join departments on departments.id=users.department_id')->fetch_all(MYSQLI_ASSOC);

?>
<!-- Content Wrapper. Contains page content -->
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
            <li class="breadcrumb-item active">Users List</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <h3 class="card-title">Premium Users List</h3>
          </div>
          <div class="col-md-2 offset-8 text-right">
          <a href="<?php echo $_SESSION['base_url'] ?>/users/signup.php" class="btn btn-warning">Add Users</a>
          </div>
        </div>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">SL</th>
            <th>Image</th>
            <th>Name</th>
            <th>Email</th>
            <th>Address</th>
            <th>Department</th>
            <th>designation</th>
            <th style="width:125px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($user as $ui => $ul) { ?>
            <tr>
              <td> <?php echo ++$ui ?></td>
              <td> <img src="<?php  ?>" alt=""> </td>
              <td> <?php echo $ul['name'] ?></td>
              <td> <?php echo $ul['email'] ?></td>
              <td> <?php echo $ul['address'] ?></td>
              <td> <?php echo $ul['dpt_name'] ?></td>
              <td> <?php echo $ul['designation'] ?></td>
              <td>
                <a href="user_edit.php?id=<?php echo $ul['id'] ?>" class="btn btn-success btn-sm">Edit</a>
                <a href="user_delete.php?id=<?php echo $ul['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Moyna tumi ki ata dashbin e pele dite cao')">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require_once('../footer.php')
?>