<?php
     require_once("../header.php");
    // //$con = new mysqli('localhost', 'root', '',  'production_automation');
    $search=$_POST['supplier_id'];
     
        $edit=$con->query("SELECT supplier_payment.*,suppliers.contract_person	 FROM supplier_payment JOIN suppliers ON supplier_payment.supplier_id=suppliers.id where supplier_payment.supplier_id= $search")->fetch_all(MYSQLI_ASSOC);
    
    
  
   
    //$con = new mysqli('localhost', 'root', '',  'production_automation');
     $dep=$con->query("select * from suppliers")->fetch_all(MYSQLI_ASSOC);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            
            <!-- <div class="row mb-2"> -->
                <div class="col-sm-4">
                    <h1>supplier payment List</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">supplier payment List</li>
                    </ol>
                </div>
            <!-- </div>       -->
                     
                    <div class="card-header">
                        <h3 class="card-title">supplier payment List</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th style="width: 10px">SL</th>
                                    <th>Supplier</th>
                                    <th>amount</th>
                                    <th>method</th>
                                    <th>date</th>
                                    
                                    <th style="width: 160px">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              <?php foreach($edit as $i=>$p) {?>
                                <tr>
                                    <td><?php echo ++$i ?></td>
                                    <td><?php echo $p['contract_person'] ?></td>
                                    <td><?php echo $p['amount'] ?></td>
                                    <td><?php echo $p['method'] ?></td>
                                    <td><?php echo $p['date'] ?></td>
                                    
                                    <td>
                                        <a href="supplier_payment_update.php?id=<?php echo $p['id'] ?>" class="btn btn-success btn-sm">Update</a>

                                        <a href="supplier_payment_delete.php?id=<?php echo $p['id'] ?>" class="btn btn-danger" onclick="return confirm('are you sure to delete')">Delete</a>
                                    </td>
                                </tr>
                                <?php } ?>

                            </tbody>
                            <a href="supplier_payment_list.php" class="btn btn-primary btn-md">Show Payment</a>
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