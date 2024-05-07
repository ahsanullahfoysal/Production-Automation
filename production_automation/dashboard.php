<?php
require_once('header.php');
$orders = $con->query("select * from orders where status='running'")->fetch_all(MYSQLI_ASSOC);
$total_orders = count($orders);
$buyers = $con->query("select * from buyers")->fetch_all(MYSQLI_ASSOC);
$total_buyers = count($buyers);
$transfers = $con->query("select * from transfers where transfer_date=0")->fetch_all(MYSQLI_ASSOC);
$total_transfers = count($transfers);
$employees = $con->query("SELECT * FROM `users` WHERE designation='CEO' OR designation='Manager' OR designation='Supervisor' OR designation='Manager' OR designation='worker'")->fetch_all(MYSQLI_ASSOC);


$total_employees = count($employees);
$t_orders = $con->query("select * from orders")->fetch_all(MYSQLI_ASSOC);
// $total_t_orders = count($t_orders);
// $r_orders = $con->query("select * from orders")->fetch_all(MYSQLI_ASSOC);
// $total_r_orders = count($r_orders);
// $f_orders = $con->query("select * from orders where status='finished'")->fetch_all(MYSQLI_ASSOC);
// $total_f_orders = count($f_orders);
// echo $ff=$total_f_orders/$total_t_orders*100;
?>




<div class="content-wrapper">
  <!-- Content Header (Page header) -->

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Welcome Admin!</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <h5 class="m-0" style="color:rgb(87 90 95)">Dashboard</h5>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->
  <!-- /.container-fluid -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Info boxes -->


      <!-- ........................Start sort card........................ -->
      <!-- ........................Start sort card........................ -->
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div style="text-align:center" class="inner">
              <h3>
                <?php echo $total_orders ?>
              </h3>

              <p>Runnig Orders</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="minhaj/orders_list.php" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div style="text-align:center" class="inner">
              <h3>
                <?php echo $total_buyers ?>
              </h3>

              <p>Clients</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="badsha_buyer/buyer_list.php" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div style="text-align:center" class="inner">
              <h3>
                <?php echo $total_transfers ?>
              </h3>

              <p>Tasks</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="helal_transfer/transfers.php" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div style="text-align:center" class="inner">
              <h3>
                <?php echo $total_employees ?>
              </h3>

              <p>Employees</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="users/users_list.php" class="small-box-footer">More info <i
                class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->

      <!-- ........................Start sort End........................ -->
      <!-- ........................Start sort End........................ -->






      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title">Monthly Recap Report</h5>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <div class="btn-group">
                  <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                    <i class="fas fa-wrench"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a href="#" class="dropdown-item">Action</a>
                    <a href="#" class="dropdown-item">Another action</a>
                    <a href="#" class="dropdown-item">Something else here</a>
                    <a class="dropdown-divider"></a>
                    <a href="#" class="dropdown-item">Separated link</a>
                  </div>
                </div>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-8">
                  <p class="text-center">
                    <strong>Order:
                      <span class="col-4">
                        <?php echo $dt2 = (new DateTime('-1 month'))->format('d-M-Y'); ?>
                      </span>
                      <span style="color:green" class="col-2">To</span>
                      <span class="col-4">
                        <?php echo $dt1 = (new DateTime())->format('d-M-Y'); ?>
                      </span>
                    </strong>
                  </p>

                  <!-- ..................progress start......................... -->


                  <div class="progress_body">
                    <div class="row d-flex justify-content-center mt-100a">
                      Complete Order
                      <div class="progressa blue">
                        <span class="progressa-left">
                          <span class="progressa-bar"></span>
                        </span>
                        <span class="progressa-right">
                          <span class="progressa-bar"></span>
                        </span>
                        <div class="progressa-value">
                          80%

                        </div>
                      </div>


                      <div class="progressa yellow">
                        <span class="progressa-left">
                          <span class="progressa-bar"></span>
                        </span>
                        <span class="progressa-right">
                          <span class="progressa-bar"></span>
                        </span>
                        <div class="progressa-value">37.5%</div>
                      </div>
                      complete Delivary

                    </div>
                  </div>

                  <!-- ..................progress end......................... -->



                </div>

                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>Goal Completion</strong>
                  </p>

                  <div class="progress-group">
                    Add Products to Cart
                    <span class="float-right"><b>160</b>/200</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-primary" style="width: 80%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->

                  <div class="progress-group">
                    Complete Purchase
                    <span class="float-right"><b>310</b>/400</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-danger" style="width: 75%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text">Visit Premium Page</span>
                    <span class="float-right"><b>480</b>/800</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-success" style="width: 60%"></div>
                    </div>
                  </div>

                  <!-- /.progress-group -->
                  <div class="progress-group">
                    Send Inquiries
                    <span class="float-right"><b>250</b>/500</span>
                    <div class="progress progress-sm">
                      <div class="progress-bar bg-warning" style="width: 50%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./card-body -->
            <div class="card-footer">
              <div class="row">
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 17%</span>
                    <h5 class="description-header">$35,210.43</h5>
                    <span class="description-text">TOTAL REVENUE</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-warning"><i class="fas fa-caret-left"></i> 0%</span>
                    <h5 class="description-header">$10,390.90</h5>
                    <span class="description-text">TOTAL COST</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block border-right">
                    <span class="description-percentage text-success"><i class="fas fa-caret-up"></i> 20%</span>
                    <h5 class="description-header">$24,813.53</h5>
                    <span class="description-text">TOTAL PROFIT</span>
                  </div>
                  <!-- /.description-block -->
                </div>
                <!-- /.col -->
                <div class="col-sm-3 col-6">
                  <div class="description-block">
                    <span class="description-percentage text-danger"><i class="fas fa-caret-down"></i> 18%</span>
                    <h5 class="description-header">1200</h5>
                    <span class="description-text">GOAL COMPLETIONS</span>
                  </div>
                  <!-- /.description-block -->
                </div>
              </div>
              <!-- /.row -->
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->










      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-8">


          <!-- TABLE: LATEST ORDERS -->
          <div class="card">
            <div class="card-header border-transparent">
              <h3 class="card-title">Latest Orders</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <div class="table-responsive">
                <table class="table m-0">
                  <thead>
                    <tr>
                      <th>Order ID</th>
                      <th>Item</th>
                      <th>Status</th>
                      <th>Total Price</th>
                    </tr>
                  </thead>
                  <tbody>

                    <?php
                    foreach ($t_orders as $tii => $til) {
                      $quantity = $til['quantity'];
                      $rate = $til['rate'];
                      $total_price = $quantity * $rate;
                      ?>
                      <tr>
                        <td>
                          <?php echo $til['invoice'] ?>
                        </td>
                        <td>
                          <?php echo $til['quantity'] ?>
                        </td>
                        <td><span>
                            <?php
                            if ($til['status'] == 'running') {
                              ?>
                              <span class="badge badge-success">
                                <?php echo $til['status']; ?>
                              </span>
                              <?php
                            } else { ?>
                              <span class="badge badge-danger">
                                <?php echo $til['status']; ?>
                              </span>
                              <?php
                            }
                            ?>
                          </span></td>
                        <td>
                            <?php echo $total_price ?>
                        </td>
                      </tr>
                    <?php } ?>
                    <!-- <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-info">Processing</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00c0ef" data-height="20">90,80,-90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR1848</a></td>
                      <td>Samsung Smart TV</td>
                      <td><span class="badge badge-warning">Pending</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f39c12" data-height="20">90,80,-90,70,61,-83,68</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR7429</a></td>
                      <td>iPhone 6 Plus</td>
                      <td><span class="badge badge-danger">Delivered</span></td>
                      <td>
                        <div class="sparkbar" data-color="#f56954" data-height="20">90,-80,90,70,-61,83,63</div>
                      </td>
                    </tr>
                    <tr>
                      <td><a href="pages/examples/invoice.html">OR9842</a></td>
                      <td>Call of Duty IV</td>
                      <td><span class="badge badge-success">Shipped</span></td>
                      <td>
                        <div class="sparkbar" data-color="#00a65a" data-height="20">90,80,90,-70,61,-83,63</div>
                      </td>
                    </tr> -->
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->
            <div class="card-footer clearfix">
              <a href="minhaj/orders.php" class="btn btn-sm btn-info float-left">Place New Order</a>
              <a href="minhaj/orders_list.php" class="btn btn-sm btn-secondary float-right">View All Orders</a>
            </div>
            <!-- /.card-footer -->
          </div>
          <!-- /.card -->


          <!-- MAP & BOX PANE -->

          <!-- /.card -->


          <!-- /.row -->
















        </div>
        <!-- /.col -->

        <div class="col-md-4">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Recently Purchase</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
              <ul class="products-list product-list-in-card pl-2 pr-2">
                <?php $purchase_list = $con->query("SELECT * FROM `purchase`")->fetch_all(MYSQLI_ASSOC);
                foreach ($purchase_list as $iip => $llp) {
                  ?>
                  <li class="item">
                    <div class="product-img">
                      <img src="dist/img/default-150x150.png" alt="Product Image" class="img-size-50">
                    </div>
                    <div class="product-info">
                      <a href="#" class="product-title">
                        <?php echo $llp['invoice_id'] ?>
                        <span class="badge badge-warning float-right">$
                          <?php echo $llp['price'] ?>
                        </span>
                      </a>
                      <span class="product-description">
                        <?php echo $llp['quantity'] ?>
                      </span>
                    </div>
                  </li>
                <?php } ?>
                <!-- /.item -->

              </ul>
            </div>
            <!-- /.card-body -->
            <div class="card-footer text-center">
              <a href="rabbi_purchase/purchase_list2.php" class="uppercase">View All Purchase</a>
            </div>
            <!-- /.card-footer -->
          </div>

        </div>

        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!--/. container-fluid -->
  </section>


</div>
<!-- /.content-wrapper -->














<?php
require_once('footer.php')
  ?>