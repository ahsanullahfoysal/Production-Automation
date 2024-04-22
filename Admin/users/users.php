<?php 
  require_once('../header.php');
  $user=$con->query('select *from users')->fetch_all(MYSQLI_ASSOC);
   ?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header"> <h3 class="card-title">Add Users</h3></div>
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
                    <th style="width:180px">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($user as $ui=>$ul){ ?>
                <tr>
                    <td> <?php echo ++$ui ?></td>
                    <td> <img src="<?php  ?>" alt=""> </td>
                    <td> <?php echo $ul['name'] ?></td>
                    <td> <?php echo $ul['email'] ?></td>
                    <td> <?php echo $ul['address'] ?></td>
                    <td> <?php echo $ul['department_id'] ?></td>
                    <td> <?php echo $ul['designation'] ?></td>
                    <td> 
                                        <a href="user_edit.php?id=<?php echo $ul['id'] ?>" class="btn btn-success">Edit</a>
                                        <a href="user_delete.php?id=<?php echo $ul['id'] ?>" class="btn btn-danger" onclick="return confirm('Moyna tumi ki ata dashbin e pele dite cao')">Delete</a>
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