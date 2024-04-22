<?php
require_once('../header.php');
// $stockout=$con->query('select * from stock_out')->fetch_all(MYSQLI_ASSOC);
// $material=$con->query('select * from raw_materials')->fetch_all(MYSQLI_ASSOC);
$data = $con->query("SELECT stock_out.*,raw_materials.name as material,users.name as users,projects.name FROM stock_out JOIN raw_materials ON stock_out.material_id=raw_materials.id JOIN users ON stock_out.user_id=users.id JOIN projects ON stock_out.project_id=projects.id;")
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Stock Out List</h1>
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
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <h3 class="card-title">Stock Out List</h3>
          </div>
          <div class="col-md-2 offset-8 text-right">
            <a href="<?php echo $_SESSION['base_url'] ?>/forhad_stock_out/stockout.php" class="btn btn-warning">Add Stock Out</a>
          </div>
        </div>
      </div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th style="width: 10px">SL</th>

            <th>Material</th>
            <th>Quantity</th>
            <th>User</th>
            <th>Date</th>
            <th>Order</th>
            <th style="width: 150px">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($data as $i => $d) { ?>
            <tr>
              <td> <?php echo ++$i ?></td>
              <td> <?php echo $d['material'] ?> </td>
              <td> <?php echo $d['quantity'] ?></td>
              <td> <?php echo $d['users'] ?></td>
              <td> <?php echo $d['date'] ?></td>
              <td> <?php echo $d['name'] ?></td>
              <td>
                <a href="edit_stockout.php?id=<?php echo $d['id'] ?>" class="btn btn-success">Edit</a>
                <a href="delete_stockout.php?id=<?php echo $d['id'] ?>" class="btn btn-danger" onclick="return confirm('Mayarimi tmi ki hariye jete chao?')">Delete</a>
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