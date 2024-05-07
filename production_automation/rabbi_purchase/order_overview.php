<?php
require_once('../header.php')
?>
<?php
$id = $_GET['id']; //put order id here.

$orders = $con->query("select * from orders where id=$id")->fetch_assoc();
$project_id = $orders["project_id"];
$buyer_id = $orders["buyer_id"];
$start_date = $orders["start_date"];
$end_date = $orders["end_date"];
$quantity = $orders["quantity"];
$unit_id = $orders["unit_id"];
$project_manager = $orders["project_manager_id"];
$supervisor = $orders["supervisor_id"];
$rate = $orders["rate"];
$status = $orders["status"];

//order details table
$project_name = $con->query("select * from projects where id=$project_id")->fetch_assoc()["name"];
$buyer_name = $con->query("select * from buyers where id=$buyer_id")->fetch_assoc()["company_name"];
$unit_name = $con->query("select * from units where id=$unit_id")->fetch_assoc()["name"];
$manager_name = $con->query("SELECT u.name FROM orders o JOIN users u ON u.id=o.project_manager_id WHERE o.id=$id;")->fetch_assoc()["name"];
$supervisor_name = $con->query("SELECT u.name FROM orders o JOIN users u ON u.id=o.supervisor_id WHERE o.id=$id;")->fetch_assoc()["name"];

//order info table 
$psteps = $con->query("SELECT p.prossesing_steps as total_steps, s.title as name, s.id as processing_steps_id FROM projects p JOIN processing_steps s ON s.project_id=p.id where p.id=$project_id;")->fetch_all(MYSQLI_ASSOC);

//worker list
$wlist = $con->query("SELECT u.name, u.id as uid FROM worker_assign w JOIN transfers t ON w.processing_steps_id=t.processing_steps_id AND w.order_id=t.order_id JOIN processing_steps s ON w.processing_steps_id=s.id JOIN users u ON u.id=w.user_id WHERE t.order_id=$id GROUP BY u.name;")->fetch_all(MYSQLI_ASSOC);

$fsum = $con->query("SELECT SUM(quantity) as fsum FROM `finished_product` WHERE order_id=$id;")->fetch_assoc();
$rp = $quantity - $fsum["fsum"];

?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load("current", {
    packages: ["corechart"]
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Finished Product', 'Remaining'],
      ['Finished', <?php echo $fsum["fsum"] ?>],
      ['Remaining', <?php echo $rp ?>]
    ]);

    var options = {
      title: 'Order Progress',
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
    chart.draw(data, options);
  }
</script>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Order Overview</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <h1 class="m-0">Status: <?php echo $status ?></h1>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">

          <!-- order table 1 order details -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Order Details</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <tbody>
                  <tr>
                    <td>
                      Project Name
                    </td>
                    <td><?php echo $project_name ?></td>
                  </tr>
                  <tr>
                    <td>
                      Buyer Name
                    </td>
                    <td>
                      <?php echo $buyer_name ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Manager
                    </td>
                    <td><?php echo $manager_name ?></td>
                  </tr>
                  <tr>
                    <td>
                      Supervisor
                    </td>
                    <td>
                      <?php echo $supervisor_name ?>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      Quantity
                    </td>
                    <td><?php echo $quantity . " " . $unit_name ?></td>
                  </tr>
                  <tr>
                    <td>
                      Rate
                    </td>
                    <td><?php echo $rate ?></td>
                  </tr>
                  <tr>
                    <td>
                      Start Date
                    </td>
                    <td><?php echo $start_date ?></td>
                  </tr>
                  <tr>
                    <td>
                      End Date
                    </td>
                    <td><?php echo $end_date ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- order table 1 end -->

          <!-- /.card -->
          <!-- table 2 starts here processing steps-->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Processing Steps</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>Step Name</th>
                    <th>Done</th>
                    <th>Remaining</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $a = array();
                  foreach ($psteps as $s) {
                  ?>
                    <tr>
                      <td><?php echo $s["name"]  ?></td>
                      <td>
                        <?php
                        $psi = $s["processing_steps_id"];
                        $data = $con->query("SELECT count(*) as done FROM transfers WHERE processing_steps_id=$psi and order_id=$id and NOT transfer_date='';")->fetch_assoc();
                        $done = $data["done"];
                        array_push($a, $done);
                        echo $done;
                        ?>
                      </td>
                      <td>
                        <?php

                        // $data2 = $con->query("SELECT count(*) as remain FROM transfers WHERE processing_steps_id=$psi and order_id=$id and transfer_date='';")->fetch_assoc();

                        // $remain = $data2["remain"];
                        echo $quantity - $done;

                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                  <tr>
                    <th>
                      Finished Product
                    </th>
                    <th>
                      <?php
                      sort($a);
                      echo $a[0];
                      ?>
                    </th>
                    <th>
                      <?php echo $quantity - $a[0] ?>
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <!-- table 2 ends here -->
          <!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
        <div class="col-lg-6">

          <!-- pi chart starts here table 3 -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Order Progress Chart</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div id="piechart_3d" style="height: 500px;"></div>
          </div>
          <!-- pi chart ends here -->
          <!-- worker progress table 4 -->
          <div class="card">
            <div class="card-header border-0">
              <h3 class="card-title">Worker Progress</h3>
              <div class="card-tools">
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-download"></i>
                </a>
                <a href="#" class="btn btn-tool btn-sm">
                  <i class="fas fa-bars"></i>
                </a>
              </div>
            </div>
            <div class="card-body table-responsive p-0">
              <table class="table table-striped table-valign-middle">
                <thead>
                  <tr>
                    <th>Worker Name</th>
                    <th>Step Name</th>
                    <th>Completed</th>
                    <th>Remaining</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $owlist = $con->query("SELECT u.name, p.id as psid, u.id as uid, p.title as psname FROM worker_assign w JOIN processing_steps p ON p.id=w.processing_steps_id JOIN users u ON u.id=w.user_id WHERE w.order_id=$id GROUP BY u.id;")->fetch_all(MYSQLI_ASSOC);
                  $a = array();
                  foreach ($owlist as $s) {
                  ?>
                    <tr>
                      <td><?php echo $s["name"]  ?></td>
                      <td>
                        <?php echo $s["psname"]  ?>
                      </td>
                      <td>
                        <?php
                        $completed = $con->query("SELECT COUNT(*) as done FROM transfers t WHERE t.processing_steps_id={$s['psid']} AND t.order_id=$id AND t.transfer_date!='';")->fetch_assoc();
                        echo $completed["done"];
                        ?>
                      </td>
                      <td>
                        <?php
                        // $remaining = $con->query("SELECT COUNT(*) as remaining FROM transfers t WHERE t.processing_steps_id={$s['psid']} AND t.order_id=$id AND t.transfer_date='';")->fetch_assoc();
                        // echo $remaining["remaining"];
                        echo $quantity-$completed["done"];
                        ?>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
          </div>
          <!-- worker progress table ends here table 4-->
          <!-- /.card -->

        </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
require_once('../footer.php')
?>