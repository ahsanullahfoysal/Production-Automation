<?php
require_once('../header.php');
$project = $con->query('select *from projects')->fetch_all(MYSQLI_ASSOC);

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Projects</h1>
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
      <div class="container-fluid">


        <div class="card-header">
          <div class="row">
            <div class="col-md-2">
              <h3 class="card-title">Projects List</h3>
            </div>
            <div class="col-md-2 offset-8 text-right">
            <a href="<?php echo $_SESSION['base_url'] ?>/helal/add_project.php" class="btn btn-warning">Add New Project</a>

        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="width: 10px">SL</th>
              <th>Name</th>
              <th>Details</th>
              <th style="width: 10px">Prossesing Steps</th>
              <th style="width:260px">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($project as $ui => $ul) { ?>
              <tr>
                <td> <?php echo ++$ui ?></td>
                <td> <?php echo $ul['name'] ?></td>
                <td> <?php echo $ul['details'] ?></td>
                <td> <?php $ida = $ul['id'];
                      $spl = $con->query("select * from processing_steps where project_id=" . $ida)->fetch_all(MYSQLI_ASSOC);
                      echo count($spl);
                      ?></td>

                <td>
                  <a href="details_project.php?id=<?php echo $ul['id'] ?>" class="btn btn-info">Details</a>
                  <a href="edit_project.php?id=<?php echo $ul['id'] ?>" class="btn btn-success">Update</a>
                  <a href="delete_project.php?id=<?php echo $ul['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure!')">Delete</a>
                </td>

              </tr>
            <?php } ?>
          </tbody>
        </table>
      </div>
    </div>
    <!-- /.card -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php
require_once('../footer.php')
?>