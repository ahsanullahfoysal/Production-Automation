<?php
require_once("../header.php");
$data =$con->query("SELECT expense_category.name AS category_name, SUM(expense.amount) AS amount, MAX(expense.date) AS date FROM expense JOIN expense_category ON expense.category_id = expense_category.id GROUP BY expense_category.name ORDER BY amount DESC;")
?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <a href="expense.php"><button type="submit" name="submit" class="btn        btn-primary">ADD</button></a>
                <div class="col-sm-6">
                <h1 style="color:tomato">EXPENSE CATEGORY WISE REPORT</h1>
                  </div>
                    <div class="col-sm-6">
                      <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Expense Category Report</li>
                    </ol>
                </div>
            </div>
              <!-- /.card-header -->
                <div class="card-body">
                   <table class="table table-bordered table-hover">
                      <thead>
                          <tr>
                            <th>SL NO</th>
                            <th>CATEGORY NAME</th>
                            <th>AMOUNT</th>
                            <th>DATE</th>
                          </tr>
                      </thead>
                    <tbody>
                               <?php foreach ($data as $i => $d) { ?>
                                  <tr>
                                      <th><?php echo ++$i ?></th>
                                      <th><?php  echo $d['category_name'] ?></th>
                                       <th style="color: tomato;"><?php echo $d['amount'] ?></th>
                                      <th><?php echo $d['date'] ?></th>
                                  </tr>
                                <?php } ?>

                    </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->

                </div>
          </div>
      </section>
 </div>
 <?php
require_once("../footer.php");
?>