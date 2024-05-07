<?php
   require_once("../header.php");
    //require_once('../database_con.php');
    $deps=$con->query("select * from finished_product_wastage")->fetch_all(MYSQLI_ASSOC);
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Finished Product Wastage list</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Finished Product Wastage list</li>
                    </ol>
                </div>
            </div>
            <div>
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Finished Product Wastage</th>
                                    <th>Company Name </th>
                                    <th>Quantity</th>
                                    <th>Unit</th>
                                    <th>Date</th>
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php foreach($deps as $i=>$p){ ?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php $idd=$p['id'] ;
                                   $deps=$con->query("select * from finished_product_wastage where id=".$idd)->fetch_assoc();
                                   $order_id=$deps['order_id'];
                                   
                                   $order=$con->query("select * from orders where id =".$order_id)->fetch_assoc();
                                   $project_id=$order['project_id'];
                                   
                                   
                                   $project=$con->query("select * from projects where id =".$project_id)->fetch_assoc();
                                  echo $project_name=$project['name'];
                                    
                                    
                                    ?></td>
                                    <td><?php $buyer=$con->query("select orders.*, buyers.company_name from orders join buyers on orders.buyer_id=buyers.id ")->fetch_assoc(); echo $buyer['company_name'] ?></td>
                                        <td><?php echo round($p['quantity']) ?></td>
                                        <td><?php $user = $con->query("select * from units where id=" . $p['unit_id'])->fetch_assoc();
                                            echo $user['name'] ?></td>
                                        <td><?php echo $p['date'] ?></td>
                                    <td>
                                        <a href="edit_finished_product_wastage.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Edit</a>

                                        <a href="delete_finished_product_wastage.php?id=<?php echo $p['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('are you sure to delete')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                            <a href="add_finished_product_wastage.php" class="btn btn-primary btn-md">Add Finished Product Wastage</a>
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