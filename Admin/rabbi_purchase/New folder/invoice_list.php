<?php
require_once("../header.php");
$products=$con->query("SELECT DISTINCT invoice_id from purchase")->fetch_all(MYSQLI_ASSOC);
?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Invoice List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Invoice List</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Invoice List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Invoice ID</th>
                                    <!-- <th>Date</th> -->
                                    <th style="width: 200px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($products as $i=>$p){ ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $p['invoice_id'] ?></td>
                                    <!-- <td><?php #echo $p['date'] ?></td> -->
                                    <td>
                                        <a href="view_purchase.php?id=<?php echo $p['invoice_id'] ?>" class="btn btn-success btn-sm">View</a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
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